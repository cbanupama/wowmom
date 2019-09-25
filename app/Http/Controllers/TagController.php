<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Repositories\TagRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Response;

class TagController extends AppBaseController
{
    /** @var  TagRepository */
    private $tagRepository;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    /**
     * Display a listing of the Tag.
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

        $tags = $this->tagRepository->all();

        return view('tags.index')
            ->with('tags', $tags);
    }

    /**
     * Show the form for creating a new Tag.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param CreateTagRequest $request
     *
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $input = $request->all();
        $userId = Input::get('user_id');

        if (!isset($userId) && empty($userId)) {
            $userId = auth()->id();
        }
        $input['user_id'] = $userId;

        $tag = $this->tagRepository->create($input);
        $tag->languages()->sync($input['language_id']);
        $tag->superCategories()->sync($input['super_category_id']);
        Flash::success('Tag saved successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Display the specified Tag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified Tag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        return view('tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified Tag in storage.
     *
     * @param int $id
     * @param UpdateTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagRequest $request)
    {
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        $tag = $this->tagRepository->update($request->all(), $id);
        $input = $request->all();
        $tag->languages()->sync($input['language_id']);
        $tag->superCategories()->sync($input['super_category_id']);
        Flash::success('Tag updated successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tag = $this->tagRepository->find($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        $this->tagRepository->delete($id);

        Flash::success('Tag deleted successfully.');

        return redirect(route('tags.index'));
    }
}
