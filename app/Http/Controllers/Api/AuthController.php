<?php

namespace App\Http\Controllers\Api;
use App\Enums\Gender;
use App\Enums\Role;
use Illuminate\Validation\Rules\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => ['required','string' ,'regex:/^[a-zA-Z][a-zA-Z0-9]{3,15}$/'],
            'lname' => ['required','string' ,'regex:/^[a-zA-Z][a-zA-Z0-9]{3,15}$/'],
            'username' => ['required','unique:users,username', 'regex:/^[a-zA-Z][a-zA-Z0-9]{3,15}$/'],
            'phone' => ['nullable', 'regex:/^(010|011|012|015)[0-9]{8}$/', 'unique:users,phone'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:8','max:16'],
            'image_path' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
            'gender' => ['required', new Enum(Gender::class)],
            'role' => ['nullable', new Enum(Role::class)],
        ]);

        if($validator->fails()) {
            return ApiHelper::getResponse(422, 'Validation failed', $validator->errors());
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'role' => 'customer',
        ]);

        $token = $user->createToken('ApiToken')->plainTextToken; 
        return ApiHelper::getResponse(
            201, 
            'User registered successfully', 
            [
                'user' => $user,
                'token' => $token
            ]
        );  
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('ApiToken')->plainTextToken;
            return ApiHelper::getResponse(201, 'User logedin successfully!',
                [
                    'token' => $token,
                ]
            );
        } else {
            return ApiHelper::getResponse(404, 'not found');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiHelper::getResponse(
            201, 
            'User logedout successfully'
        ); 
    }
}