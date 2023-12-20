<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserAuthController extends Controller
{
    public function loginUserAccount(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'message' => 'Tài khoản đã đăng nhập.'
            ], 400);
        }

        $credentials = $request->validate([
            'user_username' => 'required|string',
            'user_password' => 'required|string',
        ]);

        $userAccount = User::where('user_username', $credentials['user_username'])->first();

        if (
            $userAccount &&
            Hash::check($credentials['user_password'], $userAccount->user_password)
        ) {
            $token = $userAccount->createToken('user-token')->plainTextToken;

            return response()->json([
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'Đăng nhập không thành công. Vui lòng kiểm tra thông tin đăng nhập của bạn.'
        ], 401);
    }

    public function logoutUserAccount(Request $request)
    {
        $userAccount = $request->user();

        if ($userAccount) {
            $userAccount->tokens()->delete();
        }

        return response()->json([
            'message' => 'Đăng xuất thành công'
        ]);
    }
}
