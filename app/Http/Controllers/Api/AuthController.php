<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'Username' => 'required|string|max:255',
                'Password' => 'required|min:6|confirmed',
            ]);

            $user = User::create([
                'Username' => $request->Username,
                'Password' => Hash::make($request->Password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        } catch (Exception  $e) {
            Log::error('Error Sign in: ' . $e->getMessage());
            return response()->json([
                'message' => 'Đăng ký không thành công.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'Username' => 'required|string|',
                'Password' => 'required',
            ]);

            $user = User::where('Username', $request->Username)->first();

            if (!$user || !Hash::check($request->Password, $user->Password)) {
                throw ValidationException::withMessages([
                    'Username' => ['Thông tin đăng nhập không chính xác.'],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            log::info('User logged in: ' . $user->Username);
            log::info('Token: ' . $token);

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        } catch (Exception  $e) {
            log::error('Error logging in: ' . $e->getMessage());
            return response()->json([
                'message' => 'Đăng nhập không thành công.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
{
    try {
        // Xóa token hiện tại
        $request->user()->currentAccessToken()->delete();

        // Tạo response logout thành công
        $response = response()->json(['message' => 'Đăng xuất thành công']);

        // Xóa cookie session và sanctum cookie
        return $response
            ->withoutCookie(cookie('laravel_session'))
            ->withoutCookie(cookie('sanctum'))
            ->withoutCookie(cookie('XSRF-TOKEN'));

    } catch (Exception $e) {
        Log::error('Error logging out: ' . $e->getMessage());
        return response()->json([
            'message' => 'Đăng xuất không thành công',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
