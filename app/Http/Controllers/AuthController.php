<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // function register user
    public function register(Request $request)
    {
        // Menangkap inputan
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        // Membuat user baru
        $user = User::create($input);

        $data = [
            'message' => 'User is created successfully',
        ];
        
        return response()->json($data, 200);
    }


    // function login user
    public function login(Request $request)
    {
        // Menangkap inputan
        $input = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Mengambil data user (Database)
        $user = User::where('email', $input['email'])->first();

        // Membandingkan user dengan data user (Database)
        $isLoginSuccessfully = ($input['email'] == $user->email && Hash::check($input['password'], $user->password));

        If ($isLoginSuccessfully) {
            // Membuat Token
            $token = $user->createToken('auth_token');

            $data = [
                'message' => 'User is logged in successfully',
                'token' => $token->plainTextToken,
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'message' => 'Email or password is wrong',
            ];

            return response()->json($data, 401);
        }
    }
}
