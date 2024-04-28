<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $authRepository;
   
    /**
     * Constructor for the class.
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
  
    /**
     * Registers a user.
     * @param Register $request The request object containing the user data.
     */
    public function register(Register $request)
    {
        $user = $this->authRepository->register($request);
        if ($user['status']) {
            return $this->toJson(['user' => $user['message']],trans('api.register.success'), 200);
        }
        return $this->toJson([], $user['message'], 402);
    }

    /**
     * Logs in a user.
     * @param Login $request The login request object.
     */
    public function login(Login $request)
    {
        // Validation logic here...
        $user = $this->authRepository->login($request);
        if ($user) {
            return $this->toJson($user,trans('api.login.success'), 200);
        } else {
            return $this->toJson([],trans('api.login.error'), 401);
        }
    }
}
