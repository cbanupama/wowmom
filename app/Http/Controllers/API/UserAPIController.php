<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Requests\API\UserLoginRequest;
use App\Models\Language;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\UserRepository;
use GuzzleHttp\Client;
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

    public function login(UserLoginRequest $request)
    {
        $http = new Client();
        $appUrl = config('app.url') . '/oauth/token';

        $user = User::where('employee_id', $request->get('employee_id'))->first();

        $response = $http->post($appUrl, [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => config('passport.client_id'),
                'client_secret' => config('passport.client_secret'),
                'username'      => $user->email,
                'password'      => $request->get('password'),
                'scope'         => '',
            ],
        ]);

        $data = json_decode((string)$response->getBody(), true);
        $data['user_id'] = $user->id;
        $data['can_edit'] = $user->can_edit;

        return $this->sendResponse($data, 'Logged in successfully');
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
<<<<<<< HEAD
//        $accessTokenResponse= Socialite::driver('google')->getAccessTokenResponse($googleAuthCode);
//        $accessToken=$accessTokenResponse["access_token"];
//        $expiresIn=$accessTokenResponse["expires_in"];
//        $idToken=$accessTokenResponse["id_token"];
//        $refreshToken=isset($accessTokenResponse["refresh_token"])?$accessTokenResponse["refresh_token"]:"";
//        $tokenType=$accessTokenResponse["token_type"];
        $user = Socialite::driver('google')->userFromToken($googleAuthCode);

        $existingUser = User::where('email', $user->getEmail())->first();
//        dd($existingUser, $user->getEmail());
        if($existingUser) {
            $user = User::where('email', $user->getEmail())->first();
        } else {
            $user = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('wowmom')
            ]);
        }

        $profile = Profile::updateOrCreate(['user_id' => $user->id],
            [
            'phone' => $request->get('phone'),
            'photo' => $request->get('photo'),
            'date_of_birth' => $request->get('date_of_birth'),
            'kid_date_of_birth' => $request->get('kid_date_of_birth'),
            'due_date' => $request->get('due_date'),
            'last_period_date' => $request->get('last_period_date'),
            'gender' => $request->get('gender')
        ]);

// language_user
// super_category_user
        $user->interests()->sync($request->get('interest_id'));
//        $user->languages()->sync($request->get('language_id'));
//        $user->superCategories()->sync($request->get('super_category_id'));

        return response()->json($user);
    }

    public function onBoardAndroid(Request $request) {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt('wowmom'),
        ]);
        $user = Profile::updateOrCreate(['user_id' => $user->id],
            [
            'phone' => $request->get('phone'),
            'photo' => $request->get('photo'),
            'date_of_birth' => $request->get('date_of_birth'),
            'kid_date_of_birth' => $request->get('kid_date_of_birth'),
            'due_date' => $request->get('due_date'),
            'last_period_date' => $request->get('last_period_date'),
            'gender' => $request->get('gender')
        ]);

=======
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

>>>>>>> 4c48a9ae165410a179d82cb55e8a476b162ad9f4
        return response()->json($user);
    }
}
