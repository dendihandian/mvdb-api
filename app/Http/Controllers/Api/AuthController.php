<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $response_body = [
                'message' => 'User registered'
            ];

            return response()->json($response_body, Response::HTTP_CREATED);

        } catch (\Throwable $th) {

            if ((int) $th->getCode() === 23000) {

                $response_body = [
                    'message' => 'User already exists',
                ];

                return response()->json($response_body, Response::HTTP_UNPROCESSABLE_ENTITY);

            } else {

                $response_body = [
                    'message' => 'Internal server error',
                ];

                return response()->json($response_body, Response::HTTP_INTERNAL_SERVER_ERROR);

            }
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {

            $response_body = [
                'user' => ($user = Auth::user()),
                'token' => $user->createToken('authToken')->accessToken,
            ];

            return response()->json($response_body, Response::HTTP_OK);

        } else {

            $response_body = [
                'message' => 'Wrong credential',
            ];

            return response()->json($response_body, Response::HTTP_UNPROCESSABLE_ENTITY);

        }
    }

    public function user(Request $request)
    {
        $response_body = [
            'user' => $request->user(),
        ];

        return response()->json($response_body, Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        $response_body = [
            'message' => 'User logged out',
        ];

        return response()->json($response_body, Response::HTTP_OK);
    }
}
