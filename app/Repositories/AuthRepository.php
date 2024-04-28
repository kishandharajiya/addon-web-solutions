<?php
namespace App\Repositories;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthRepository
{

    public function login($request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user =  Auth::user();
            $user['token'] = Auth::user()->createToken('MyApp')->accessToken;
            return $user;
        } 
        return false;
    }

    public function register($request){
        try{
            DB::beginTransaction();
            $user = User::create($request->validated());
            $user['token'] = $user->createToken('MyApp')->accessToken;
            //Send Welcome Email Using event
            event(new UserRegistered($user));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
        return ['status' => true, 'message' => $user];
    }
}