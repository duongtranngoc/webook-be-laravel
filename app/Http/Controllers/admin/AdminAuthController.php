<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function loginAdminAccount(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return response()->json([
                'message' => 'Tài khoản đã đăng nhập.'
            ], 400);
        }

        $credentials = $request->validate([
            'admin_username' => 'required|string',
            'admin_password' => 'required|string',
        ]);

        $adminAccount = Admin::where('admin_username', $credentials['admin_username'])->first();

        if (
            $adminAccount &&
            Hash::check($credentials['admin_password'], $adminAccount->admin_password)
        ) {
            $token = $adminAccount->createToken('admin-token')->plainTextToken;

            return response()->json([
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'Đăng nhập không thành công. Vui lòng kiểm tra thông tin đăng nhập của bạn.'
        ], 401);
    }

    public function logoutAdminAccount(Request $request)
    {
        $adminAccount = $request->user('admin');

        if ($adminAccount) {
            $adminAccount->tokens()->delete();
        }

        return response()->json([
            'message' => 'Đăng xuất thành công'
        ]);
    }
}
