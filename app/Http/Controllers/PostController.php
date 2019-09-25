<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Image;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Http\Controllers\AppBaseController;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostController extends AppBaseController
{
    use UploadImage;

    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->all();

        return view('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        $post = Post::create($input);
        $post->languages()->sync($input['language_id']);
        $post->superCategories()->sync($input['super_category_id']);
        $post->interests()->sync($input['interest_id']);
        $post->tags()->sync($input['tag_id']);
        $post->foodCategories()->sync($input['food_category_id']);

        Flash::success('Post saved successfully.');

        // if request has images then we need to upload ad
        $this->uploadImage($input, $post, 'posts');

        return redirect(route('posts.index'));

    }

    /**
     * Display the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param int $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->uploadImage($request->file('images'), $post, 'posts');


        $post = $this->postRepository->update($request->all(), $id);
        $input = $request->all();
        $post->languages()->sync($input['language_id']);
        $post->superCategories()->sync($input['super_category_id']);
        $post->interests()->sync($input['interest_id']);
        $post->tags()->sync($input['tag_id']);
        $post->foodCategories()->sync($input['food_category_id']);
        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}
