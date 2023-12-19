<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;

class AdminAccountController extends Controller
{
    public function getAllAdminAccounts()
    {
        $admins = Admin::with('role:role_id,role_name')
            ->select('admin_id', 'admin_username', 'admin_full_name', 'admin_phone_number', 'admin_address', 'role_id')
            ->latest()
            ->get();

        $admins = $admins->map(function ($admin) {
            return [
                'admin_id' => $admin->admin_id,
                'admin_username' => $admin->admin_username,
                'admin_full_name' => $admin->admin_full_name,
                'admin_phone_number' => $admin->admin_phone_number,
                'admin_address' => $admin->admin_address,
                'role_id' => $admin->role_id,
                'role_name' => optional($admin->role)->role_name,
            ];
        });

        return response()->json($admins);
    }

    public function addAdminAccount(Request $request)
    {
        $data = $request->validate([
            'admin_username' => [
                'required',
                'regex:/^[a-z0-9]+$/',
                'string',
                'max:255',
            ],
            'admin_password' => 'required|string',
            'admin_full_name' => 'required|string|max:255',
            'admin_phone_number' => 'nullable|string',
            'admin_address' => 'nullable|string',
            'role_id' => 'required|exists:roles,role_id',
        ]);

        try {
            $existingAccount = Admin::where('admin_username', $data['admin_username'])->first();

            if ($existingAccount) {
                return response()->json([
                    'message' => 'Username đã tồn tại. Vui lòng nhập một username khác.',
                ], 422);
            }

            $admin = Admin::create([
                'admin_username' => $data['admin_username'],
                'admin_password' => bcrypt($data['admin_password']),
                'admin_full_name' => $data['admin_full_name'],
                'admin_phone_number' => $data['admin_phone_number'],
                'admin_address' => $data['admin_address'],
                'role_id' => $data['role_id'],
            ]);

            return response()->json([
                'message' => 'Thêm tài khoản thành công!',
                'data' => $admin,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình thêm tài khoản.',
            ], 500);
        }
    }

    public function editAdminAccount(Request $request)
    {
        try {
            $data = $request->validate([
                'admin_id' => 'required|int',
                'admin_username' => [
                    'required',
                    'regex:/^[a-z0-9]+$/',
                    'string',
                    'max:255',
                ],
                'admin_full_name' => 'required|string|max:255',
                'admin_phone_number' => 'nullable|string',
                'admin_address' => 'nullable|string',
                'role_id' => 'required|exists:roles,role_id',
            ]);

            $admin = Admin::find($data['admin_id']);

            if (!$admin) {
                return response()->json([
                    'message' => 'Không tìm thấy tài khoản.',
                ], 404);
            }

            if ($data['admin_username'] !== $admin->admin_username) {
                $existingAccount = Admin::where('admin_username', $data['admin_username'])->first();

                if ($existingAccount) {
                    return response()->json([
                        'message' => 'Username đã tồn tại. Vui lòng nhập một username khác.',
                    ], 422);
                }
            }

            $admin->update([
                'admin_username' => $data['admin_username'],
                'admin_full_name' => $data['admin_full_name'],
                'admin_phone_number' => $data['admin_phone_number'],
                'admin_address' => $data['admin_address'],
                'role_id' => $data['role_id'],
            ]);

            return response()->json([
                'message' => 'Chỉnh sửa tài khoản thành công!',
                'data' => $admin,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình chỉnh sửa tài khoản.',
            ], 500);
        }
    }

    public function getAdminAccountDetail(Request $request)
    {
        $data = $request->validate([
            'admin_id' => 'required|int',
        ]);

        try {
            $admin = Admin::with('role')->find($data['admin_id']);

            if (!$admin) {
                return response()->json([
                    'message' => 'Không tìm thấy tài khoản.',
                ], 404);
            }

            $result = [
                'admin_username' => $admin->admin_username,
                'admin_password' => $admin->admin_password,
                'admin_full_name' => $admin->admin_full_name,
                'admin_phone_number' => $admin->admin_phone_number,
                'admin_address' => $admin->admin_address,
                'role_id' => $admin->role_id,
            ];

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình lấy thông tin tài khoản.',
            ], 500);
        }
    }

    public function deleteAdminAccount(Request $request)
    {
        $data = $request->validate([
            'admin_id' => 'required|int',
        ]);

        try {
            $admin = Admin::find($data['admin_id']);

            if (!$admin) {
                return response()->json([
                    'message' => 'Không tìm thấy tài khoản.',
                ], 404);
            }

            $admin->delete();

            return response()->json([
                'message' => 'Xóa tài khoản thành công!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình xóa tài khoản.',
            ], 500);
        }
    }

    public function searchAdminAccounts(Request $request)
    {
        $data = $request->validate([
            'keySearch' => 'nullable|string|max:255',
            'role_id' => 'nullable|exists:roles,role_id',
        ]);

        try {
            $query = Admin::with('role:role_id,role_name')
                ->select('admin_id', 'admin_username', 'admin_full_name', 'admin_phone_number', 'admin_address', 'role_id')
                ->when($data['keySearch'], function ($query) use ($data) {
                    $query->where(function ($q) use ($data) {
                        $q->where('admin_username', 'like', '%' . $data['keySearch'] . '%')
                            ->orWhere('admin_full_name', 'like', '%' . $data['keySearch'] . '%')
                            ->orWhere('admin_phone_number', 'like', '%' . $data['keySearch'] . '%')
                            ->orWhere('admin_address', 'like', '%' . $data['keySearch'] . '%');
                    });
                })
                ->when($data['role_id'], function ($query) use ($data) {
                    $query->where('role_id', $data['role_id']);
                })
                ->latest()
                ->get();

            $admins = $query->map(function ($admin) {
                return [
                    'admin_id' => $admin->admin_id,
                    'admin_username' => $admin->admin_username,
                    'admin_full_name' => $admin->admin_full_name,
                    'admin_phone_number' => $admin->admin_phone_number,
                    'admin_address' => $admin->admin_address,
                    'role_id' => $admin->role_id,
                    'role_name' => optional($admin->role)->role_name,
                ];
            });

            return response()->json($admins);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình tìm kiếm.',
            ], 500);
        }
    }
}
