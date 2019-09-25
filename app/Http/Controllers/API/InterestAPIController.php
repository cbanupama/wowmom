<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInterestAPIRequest;
use App\Http\Requests\API\UpdateInterestAPIRequest;
use App\Models\Interest;
use App\Repositories\InterestRepository;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InterestController
 * @package App\Http\Controllers\API
 */

class InterestAPIController extends AppBaseController
{
    use UploadImage;
    /** @var  InterestRepository */
    private $interestRepository;

    public function __construct(InterestRepository $interestRepo)
    {
        $this->interestRepository = $interestRepo;
    }

    /**
     * Display a listing of the Interest.
     * GET|HEAD /interests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $interests = Interest::all();
        $superCategoryId = $request->get('super_category_id');

        if (isset($superCategoryId) && !empty($superCategoryId)) {
            $interests = Interest::whereHas('superCategories', function ($q) use ($superCategoryId) {
                $q->where('super_category_id', $superCategoryId);
            })->get();
        }

        return $this->sendResponse($interests->toArray(), 'Interests retrieved successfully');
    }

    /**
     * Store a newly created Interest in storage.
     * POST /interests
     *
     * @param CreateInterestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInterestAPIRequest $request)
    {
        $input = $request->all();

        $interest = $this->interestRepository->create($input);

        $interest = Interest::findOrFail($interest->id);

        $this->uploadImage($input, $interest, 'interests');

        $interest->languages()->sync($request->get('language_id'));
        $interest->superCategories()->sync($request->get('super_category_id'));
        $interest->refresh();

        return $this->sendResponse($interest->toArray(), 'Interest saved successfully', 'data');
    }

    /**
     * Display the specified Interest.
     * GET|HEAD /interests/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Interest $interest */
        $interest = $this->interestRepository->find($id);

        if (empty($interest)) {
            return $this->sendError('Interest not found');
        }

        return $this->sendResponse($interest->toArray(), 'Interest retrieved successfully',interests);
    }

    /**
     * Update the specified Interest in storage.
     * PUT/PATCH /interests/{id}
     *
     * @param int $id
     * @param UpdateInterestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInterestAPIRequest $request)
    {
        $input = $request->all();

        /** @var Interest $interest */
        $interest = $this->interestRepository->find($id);

        if (empty($interest)) {
            return $this->sendError('Interest not found');
        }

        $interest = $this->interestRepository->update($input, $id);

        return $this->sendResponse($interest->toArray(), 'Interest updated successfully',interests);
    }

    /**
     * Remove the specified Interest from storage.
     * DELETE /interests/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Interest $interest */
        $interest = $this->interestRepository->find($id);

        if (empty($interest)) {
            return $this->sendError('Interest not found');
        }

        $interest->delete();

        return $this->sendResponse($id, 'Interest deleted successfully',interests);
    }

//    public function getInterestBySuperCategory(Request $request)
//    {
//        $superCategoryId = $request->get('super_category_id');
//        $users = [];
//        if (isset($superCategoryId) && !empty($superCategoryId))
//        {
//            $users = User::where('super_category_id',$superCategoryId)->get();
//        }
//        return $this->sendResponse($users,"users");
//    }

}
