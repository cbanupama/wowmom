<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuperCategoryRequest;
use App\Http\Requests\UpdateSuperCategoryRequest;
use App\Image;
use App\Repositories\SuperCategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Response;

class SuperCategoryController extends AppBaseController
{
    use UploadImage;
    /** @var  SuperCategoryRepository */
    private $superCategoryRepository;

    public function __construct(SuperCategoryRepository $superCategoryRepo)
    {
        $this->superCategoryRepository = $superCategoryRepo;
    }

    /**
     * Display a listing of the SuperCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userId = Input::get('user_id');

        if (!isset($userId) && empty($userId)) {
            $userId = auth()->id();
        }

        $superCategories = $this->superCategoryRepository->all();

        return view('super_categories.index')
            ->with('superCategories', $superCategories);
    }

    /**
     * Show the form for creating a new SuperCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('super_categories.create');
    }

    /**
     * Store a newly created SuperCategory in storage.
     *
     * @param CreateSuperCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateSuperCategoryRequest $request)
    {
        $input = $request->all();

        $userId = Input::get('user_id');

        if (!isset($userId) && empty($userId)) {
            $userId = auth()->id();
        }
        $input['user_id'] = $userId;

        $superCategory = $this->superCategoryRepository->create($input);
        $superCategory->languages()->sync($input['language_id']);
        Flash::success('Super Category saved successfully.');

        $this->uploadImage($input, $superCategory, 'super_categories');

        return redirect(route('superCategories.index'));
    }

    /**
     * Display the specified SuperCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $superCategory = $this->superCategoryRepository->find($id);

        if (empty($superCategory)) {
            Flash::error('Super Category not found');

            return redirect(route('superCategories.index'));
        }

        return view('super_categories.show')->with('superCategory', $superCategory);
    }

    /**
     * Show the form for editing the specified SuperCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $superCategory = $this->superCategoryRepository->find($id);

        if (empty($superCategory)) {
            Flash::error('Super Category not found');

            return redirect(route('superCategories.index'));
        }

        return view('super_categories.edit')->with('superCategory', $superCategory);
    }

    /**
     * Update the specified SuperCategory in storage.
     *
     * @param int $id
     * @param UpdateSuperCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSuperCategoryRequest $request)
    {
        $superCategory = $this->superCategoryRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        if (empty($superCategory)) {
            Flash::error('Super Category not found');

            return redirect(route('superCategories.index'));
        }

        $superCategory = $this->superCategoryRepository->update($request->all(), $id);
        $input = $request->all();
        $superCategory->languages()->sync($input['language_id']);
        $this->uploadImage($input, $superCategory, 'super_categories');

        Flash::success('Super Category updated successfully.');

        return redirect(route('superCategories.index'));
    }

    /**
     * Remove the specified SuperCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $superCategory = $this->superCategoryRepository->find($id);

        if (empty($superCategory)) {
            Flash::error('Super Category not found');

            return redirect(route('superCategories.index'));
        }

        $this->superCategoryRepository->delete($id);

        Flash::success('Super Category deleted successfully.');

        return redirect(route('superCategories.index'));
    }
}
