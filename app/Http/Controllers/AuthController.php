<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            throw new HttpResponseException(response([
                'errors'=>$validator->errors()->all()
            ],422));
        }
        $validator = $validator->validated();


        try {
            $user = User::where('username', $validator['username'])->first();

            if ($user) {
                $proxy = request()->create('/oauth/token', 'POST', [
                    'grant_type' => 'password',
                    'client_id' => config('passport.password_client_id'),
                    'client_secret' => config('passport.password_client_secret'),
                    'username' => $validator['username'],
                    'password' => $validator['password'],
                    'scope' => '',
                ]);

                $response = app()->handle($proxy);
                $data = json_decode($response->getContent(), true);

                if (isset($data['error'])) {
                    return response()->json($data, 401);
                }
                $data['user'] = [
                    'id' => $user->id,
                    'username' => $user->username,
                ];

                return response()->json($data, 200);
            }

            return response()->json([
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        } catch (Throwable $e) {
            Log::error('Login Error: '.$e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }

    public function refresh(Request $request)
    {
        $validated = $request->validate([
            'refresh_token' => ['required', 'string'],
        ]);

        try {
            $response = Http::asForm()->post(url('/oauth/token'), [
                'grant_type'    => 'refresh_token',
                'refresh_token' => $validated['refresh_token'],
                'client_id'     => config('passport.password_client_id'),
                'client_secret' => config('passport.password_client_secret'),
                'scope'         => '',
            ]);

            if ($response->failed()) {
                return response()->json([
                    'message' => 'Refresh token tidak valid'
                ], 401);
            }

            return response()->json($response->json(), 200);

        } catch (Throwable $e) {
            Log::error('Refresh Token Error: '.$e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();

            return response()->json([
                'message' => 'Logout berhasil'
            ]);
        } catch (Throwable $e) {
            Log::error('Logout Error: '.$e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan saat logout'
            ], 500);
        }
    }
}
