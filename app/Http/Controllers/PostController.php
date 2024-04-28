<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Http\Requests\DeletePost;
use App\Http\Requests\UpdatePost;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $postRepo;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepo = $postRepository;
    }

    /**
     * Create a new post.
     * @param CreatePost $request The request object containing the post data.
     */
    public function create(CreatePost $request){
        return $this->toJson(['post' => $this->postRepo->create($request)], '');
    }

    /**
     * Retrieves a list of posts based on the given request.
     * @param Request $request The request object containing the parameters for filtering the posts.
     */
    public function list(Request $request){
        return  $this->toJson(['posts' => $this->postRepo->list($request)], '');
    }

    /**
     * Edit a user.
     * @param Request $request The request object containing the user data.
     */
    public function edit(Request $request){
        return  $this->toJson(['post' => $this->postRepo->edit($request)], '');
    }
  
    /**
     * Updates a post based on the given request.
     * @param UpdatePost $request The request object containing the updated post data.
     */
    public function update(UpdatePost $request)
    {
        return  $this->toJson(['post' => $this->postRepo->update($request)], '');
    }
   
    /**
     * A description of the entire PHP function.
     * @param DeletePost $request description
     */
    public function delete(DeletePost $request)
    {
        return  $this->toJson(['post' => $this->postRepo->delete($request)], '');
    }

}
