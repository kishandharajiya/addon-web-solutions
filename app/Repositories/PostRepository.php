<?php
namespace App\Repositories;

use App\Models\Post;
use App\Models\User;

class PostRepository
{
    /**
     * Creates a new post for the authenticated user.
     */
    public function create($request)
    {
        return $request->user()->posts()->create($request->validated());
    }

    /**
     * Retrieve a list of posts based on the user's role.
     */
    public function list($request){
        if ($request->user()->role == User::ROLE_ADMIN) {
            return Post::with('user')->search($request->search)->paginate(10);
        }
        return $request->user()->posts()->search($request->search)->paginate(10);
    }

    /**
     * Retrieves a post based on the provided ID.
     */
    public function edit($request)
    {
        return Post::find($request->id);
    }

    /**
     * Updates a post based on the provided request.
     */
    public function update($request)
    {
        return Post::where('id', $request->id)->update($request->validated());
    }
    /**
     * Deletes a post based on the provided request.
     */
    public function delete($request)
    {
        return Post::where('id', $request->id)->delete();
    }
}