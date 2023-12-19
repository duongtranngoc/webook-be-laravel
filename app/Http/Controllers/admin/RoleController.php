<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function getAllRoles()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function addRole(Request $request)
    {
        $data = $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
        ]);

        try {
            $role = Role::create($data);
            return response()->json([
                'message' => 'Thêm role thành công!',
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Thêm role không thành công.',
            ], 500);
        }
    }

    public function editRole(Request $request)
    {
        try {
            $data = $request->validate([
                'role_id' => 'required|int',
                'role_name' => 'required|string|max:255',
                'role_description' => 'nullable|string',
            ]);

            $role = Role::find($data['role_id']);

            if (!$role) {
                return response()->json([
                    'message' => 'Không tìm thấy role.',
                ], 404);
            }

            $role->update([
                'role_name' => $data['role_name'],
                'role_description' => $data['role_description'],
            ]);

            return response()->json([
                'message' => 'Chỉnh sửa role thành công!',
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình chỉnh sửa role.',
            ], 500);
        }
    }

    public function getRoleDetail(Request $request)
    {
        $data = $request->validate([
            'role_id' => 'required|int',
        ]);

        try {
            $role = Role::find($data['role_id']);

            if (!$role) {
                return response()->json([
                    'message' => 'Không tìm thấy role.',
                ], 404);
            }

            return response()->json($role);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình lấy thông tin role.',
            ], 500);
        }
    }

    public function searchRoles(Request $request)
    {
        $data = $request->validate([
            'keySearch' => 'nullable|string|max:255',
        ]);

        try {
            $query = Role::select('role_id', 'role_name', 'role_description')
                ->when($data['keySearch'], function ($query) use ($data) {
                    $query->where(function ($q) use ($data) {
                        $q->where('role_name', 'like', '%' . $data['keySearch'] . '%')
                            ->orWhere('role_description', 'like', '%' . $data['keySearch'] . '%');
                    });
                })
                ->latest()
                ->get();

            $roles = $query->map(function ($role) {
                return [
                    'role_id' => $role->role_id,
                    'role_name' => $role->role_name,
                    'role_description' => $role->role_description,
                ];
            });

            return response()->json($roles);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra trong quá trình tìm kiếm.',
            ], 500);
        }
    }
}
