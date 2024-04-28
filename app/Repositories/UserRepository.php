<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Retrieves a list of users based on the given request.
     */
    public function list($request){
        return User::where('role', 'user')->search($request->search)->paginate(10);
    }

    /**
     * Retrieves a user from the database based on the provided request ID.
     */
    public function edit($request)
    {
        return User::find($request->id);
    }

    /**
     * Update the users based on the provided request ID.
     */
    public function update($request)
    {
        return User::where('id', $request->id)->update($request->validated());
    }
    /**
     * Deletes a user from the database based on the provided request ID.
     */
    public function delete($request)
    {
        return User::where('id', $request->id)->delete();
    }
}