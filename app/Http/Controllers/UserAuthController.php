<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\AuthRequest;

use App\Models\User;

class UserAuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
	$user = User::create([
	    'name' => $request['name'],
	    'cpf' => $request['cpf'],
	    'email' => $request['email'],
	    'password' => Hash::make($request['password'])
	]);

	return response()->json([
	    'message' => 'User created successfully'
	]);
    }
    
    public function login(AuthRequest $request)
    {
	$user = User::where('cpf', $request->cpf)->first();

	if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Incorrect Password'],
            ], 401);
        }

	$token = $user->createToken('v-token')->plainTextToken;
	return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
	auth()->user()->tokens()->delete();

	return response()->json([
	    'message' => 'User Logged Out'
	]);
    }
}
