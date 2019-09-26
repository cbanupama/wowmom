<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\Language;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Laravel\Socialite\Facades\Socialite;
use Response;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */
class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendResponse($id, 'User deleted successfully');
    }

    public function onBoard(Request $request)
    {
        $googleAuthCode = $request->get( 'googleAuthCode' );
        $accessTokenResponse= Socialite::driver('google')->getAccessTokenResponse($googleAuthCode);
        $accessToken=$accessTokenResponse["access_token"];
        $expiresIn=$accessTokenResponse["expires_in"];
        $idToken=$accessTokenResponse["id_token"];
        $refreshToken=isset($accessTokenResponse["refresh_token"])?$accessTokenResponse["refresh_token"]:"";
        $tokenType=$accessTokenResponse["token_type"];
        $user = Socialite::driver('google')->userFromToken($accessToken);

        $user = \App\User::create([
            'name'  => $user->getName(),
            'email' => $user->getEmail()
        ]);

        $profile = Profile::create([
            'user_id'           => $user->id,
            'phone'             => $request->get('phone'),
            'photo'             => $request->get('photo'),
            'date_of_birth'     => $request->get('date_of_birth'),
            'kid_date_of_birth' => $request->get('kid_date_of_birth'),
            'due_date'          => $request->get('kid_date_of_birth'),
            'last_period_date'  => $request->get('kid_date_of_birth'),
            'gender'            => $request->get('gender')
        ]);

        // language_user
        // super_category_user
        $user->interests()->sync($request->get('interest_id'));
        $user->languages()->sync($request->get('language_id'));
        $user->superCategories()->sync($request->get('super_category_id'));

        return response()->json($user);
    }
}
