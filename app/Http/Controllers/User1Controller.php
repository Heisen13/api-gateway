<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;
use App\Services\User1Service;
use Illuminate\Support\Facades\Auth;

Class User1Controller extends Controller {
use ApiResponser;   

public $user1Service;

public function __construct(User1Service $user1Service){
    $this->user1Service = $user1Service;
}

public function register(Request $request)
{
    return $this->successResponse($this->user1Service->create($request->all(), Response::HTTP_CREATED));
}

public function login(Request $request)
{
    return $this->successResponse($this->user1Service->login($request->all(), Response::HTTP_CREATED));
}

public function profile()
{
    $user = Auth::user();
    if (!$user) {
        return response()->json(['Message' => 'User not found'], 404);
    }
    $userWithoutApiToken = $user->makeHidden('api_token');
    return response()->json(['user' => $user]);
}

public function update(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $user = Auth::user();

    if (!$user) {
        return response()->json(['Message' => 'User not found'], 404);
    }

    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');

    if ($user->name === $name && $user->email === $email && $user->password === $password) {
        return response()->json(['Message' => 'No changes detected'], 400);
    }

    $user->name = $name;
    $user->email = $email;
    $user->password = $password;
    $user->save();

    return response()->json(['Message' => 'User updated successfully']);
}

public function delete()
{
    $user = Auth::user();

        if (!$user) {
            return response()->json(['Message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['Message' => 'User deleted successfully']);
}

}