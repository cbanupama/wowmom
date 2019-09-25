<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSuperCategoryAPIRequest;
use App\Http\Requests\API\UpdateSuperCategoryAPIRequest;
use App\Models\SuperCategory;
use App\Repositories\SuperCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Input;
use Response;

/**
 * Class SuperCategoryController
 * @package App\Http\Controllers\API
 */

class SuperCategoryAPIController extends AppBaseController
{
    /** @var  SuperCategoryRepository */
    private $superCategoryRepository;

    public function __construct(SuperCategoryRepository $superCategoryRepo)
    {
        $this->superCategoryRepository = $superCategoryRepo;
    }

    /**
     * Display a listing of the SuperCategory.
     * GET|HEAD /superCategories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $superCategories = $this->superCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        $id = Input::get('id');

        if (isset($id) && !empty($id)) {
            $superCategories = SuperCategory::findOrFail($id);
        }

        return $this->sendResponse($superCategories->toArray(), 'Super Categories retrieved successfully','super_Category');
    }

    /**
     * Store a newly created SuperCategory in storage.
     * POST /superCategories
     *
     * @param CreateSuperCategoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSuperCategoryAPIRequest $request)
    {
        $input = $request->all();

        $superCategory = $this->superCategoryRepository->create($input);

        return $this->sendResponse($superCategory->toArray(), 'Super Category saved successfully','super_Category');
    }

    /**
     * Display the specified SuperCategory.
     * GET|HEAD /superCategories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SuperCategory $superCategory */
        $superCategory = $this->superCategoryRepository->find($id);

        if (empty($superCategory)) {
            return $this->sendError('Super Category not found');
        }

        return $this->sendResponse($superCategory->toArray(), 'Super Category retrieved successfully','super_Category');
    }

    /**
     * Update the specified SuperCategory in storage.
     * PUT/PATCH /superCategories/{id}
     *
     * @param int $id
     * @param UpdateSuperCategoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSuperCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var SuperCategory $superCategory */
        $superCategory = $this->superCategoryRepository->find($id);

        if (empty($superCategory)) {
            return $this->sendError('Super Category not found');
        }

        $superCategory = $this->superCategoryRepository->update($input, $id);

        return $this->sendResponse($superCategory->toArray(), 'SuperCategory updated successfully','super_Category');
    }

    /**
     * Remove the specified SuperCategory from storage.
     * DELETE /superCategories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SuperCategory $superCategory */
        $superCategory = $this->superCategoryRepository->find($id);

        if (empty($superCategory)) {
            return $this->sendError('Super Category not found');
        }

        $superCategory->delete();

        return $this->sendResponse($id, 'Super Category deleted successfully','super_Category');
    }
}
