<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data)
    {
        try {
            $user = User::create([
                'Username' => $data['Username'],
                'Password' => Hash::make($data['Password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        } catch (Exception $e) {
            Log::error('Error Registering: ' . $e->getMessage());
            throw new Exception(Lang::get('messages.register_failed'));
        }
    }

    public function login(array $data)
    {
        try {
            $user = User::where('Username', $data['Username'])->first();

            if (!$user || !Hash::check($data['Password'], $user->Password)) {
                throw ValidationException::withMessages([
                    'Username' => [Lang::get('messages.invalid_credentials')],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('User logged in: ' . $user->Username);
            Log::info('Token: ' . $token);

            return [
                'user' => $user,
                'token' => $token,
            ];
        } catch (Exception $e) {
            Log::error('Error Logging in: ' . $e->getMessage());
            throw new Exception(Lang::get('messages.login_failed'));
        }
    }

    public function logout($user)
    {
        try {
            if ($user) {
                $user->currentAccessToken()->delete();
                Log::info('User logged out: ' . $user->Username);

                return ['message' => Lang::get('messages.logout_success')];
            }

            throw new Exception(Lang::get('messages.no_user_logout'));
        } catch (Exception $e) {
            Log::error('Error Logging out: ' . $e->getMessage());
            throw new Exception(Lang::get('messages.logout_failed'));
        }
    }
}
