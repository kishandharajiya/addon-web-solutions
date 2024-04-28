<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUser;
use App\Http\Requests\EditUser;
use App\Http\Requests\UpdateUser;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepo;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    /**
     * Retrieves a list of users based on the given request.
     */
    public function list(Request $request)
    {
        return  $this->toJson(['users' => $this->userRepo->list($request)], '');
    }
    /**
     * Edit a user.
     *
     * @param Request $request The request object containing the user data.
     */
    public function edit(Request $request)
    {
        return  $this->toJson(['user' => $this->userRepo->edit($request)], '');
    }

    /**
     * Updates a user based on the given request.
     *
     * @param UpdateUser $request The request object containing the updated user data.
     */
    public function update(UpdateUser $request)
    {
        return  $this->toJson(['user' => $this->userRepo->update($request)], '');
    }

    /**
     * A description of the entire PHP function.
     *
     * @param DeleteUser $request description
     */
    public function delete(DeleteUser $request)
    {
        return  $this->toJson(['user' => $this->userRepo->delete($request)], '');
    }
}
