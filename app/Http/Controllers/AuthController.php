<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'gender' => 'required|string|in:male,female,other',
            'phone' => 'nullable|string|max:15',
            'department' => 'nullable|string|max:100',
            'faculty' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:50',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'department' => $request->department,
            'faculty' => $request->faculty,
            'position' => $request->position,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $response = ['user' => $user, 'token' => $token];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        // Validation rules
        $rules =[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];

        // Validate the request
        $request->validate($rules);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if($user && Hash::check($request->password, $user->password)) {
            // Create token
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = ['user' => $user, 'token' => $token];
            return response()->json($response, 200);
        }

        // Return error if credentials are incorrect
        $response = ['message' => 'Incorrect email or password'];
        return response()->json($response, 400);
    }




    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }



}
