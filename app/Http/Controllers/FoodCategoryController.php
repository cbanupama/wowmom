<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFoodCategoryRequest;
use App\Http\Requests\UpdateFoodCategoryRequest;
use App\Image;
use App\Repositories\FoodCategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Response;

class FoodCategoryController extends AppBaseController
{
    use UploadImage;

    /** @var  FoodCategoryRepository */
    private $foodCategoryRepository;

    public function __construct(FoodCategoryRepository $foodCategoryRepo)
    {
        $this->foodCategoryRepository = $foodCategoryRepo;
    }

    /**
     * Display a listing of the FoodCategory.
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
        $foodCategories = $this->foodCategoryRepository->all();

        return view('food_categories.index')
            ->with('foodCategories', $foodCategories);
    }

    /**
     * Show the form for creating a new FoodCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('food_categories.create');
    }

    /**
     * Store a newly created FoodCategory in storage.
     *
     * @param CreateFoodCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodCategoryRequest $request)
    {
        $input = $request->all();
        $userId = Input::get('user_id');

        if (!isset($userId) && empty($userId)) {
            $userId = auth()->id();
        }
        $input['user_id'] = $userId;

        $foodCategory = $this->foodCategoryRepository->create($input);
        $foodCategory->languages()->sync($input['language_id']);
        $foodCategory->superCategories()->sync($input['super_category_id']);
        $foodCategory->tags()->sync($input['tag_id']);
        $foodCategory->interests()->sync($input['interest_id']);
        Flash::success('Food Category saved successfully.');

        $this->uploadImage($input, $foodCategory, 'food_Category');

        return redirect(route('foodCategories.index'));
    }

    /**
     * Display the specified FoodCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);

        if (empty($foodCategory)) {
            Flash::error('Food Category not found');

            return redirect(route('foodCategories.index'));
        }

        return view('food_categories.show')->with('foodCategory', $foodCategory);
    }

    /**
     * Show the form for editing the specified FoodCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);

        if (empty($foodCategory)) {
            Flash::error('Food Category not found');

            return redirect(route('foodCategories.index'));
        }

        return view('food_categories.edit')->with('foodCategory', $foodCategory);
    }

    /**
     * Update the specified FoodCategory in storage.
     *
     * @param int $id
     * @param UpdateFoodCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodCategoryRequest $request)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);

        if (empty($foodCategory)) {
            Flash::error('Food Category not found');

            return redirect(route('foodCategories.index'));
        }

        $foodCategory = $this->foodCategoryRepository->update($request->all(), $id);
        $input = $request->all();
        $foodCategory->languages()->sync($input['language_id']);
        $foodCategory->superCategories()->sync($input['super_category_id']);
        $foodCategory->tags()->sync($input['tag_id']);
        $foodCategory->interests()->sync($input['interest_id']);

        $this->uploadImage($input, $foodCategory, 'food_Category');

        Flash::success('Food Category updated successfully.');

        return redirect(route('foodCategories.index'));
    }

    /**
     * Remove the specified FoodCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);

        if (empty($foodCategory)) {
            Flash::error('Food Category not found');

            return redirect(route('foodCategories.index'));
        }

        $this->foodCategoryRepository->delete($id);

        Flash::success('Food Category deleted successfully.');

        return redirect(route('foodCategories.index'));
    }
}
