<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function getAllRole()
    {
        $roles = Role::select('role_id', 'role_name', 'role_description')
            ->latest()
            ->get();
        return response()->json($roles);
    }

    public function addRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
        ]);

        $role = Role::create([
            'role_name' => $request->input('role_name'),
            'role_description' => $request->input('role_description'),
        ]);

        return response()->json([
            'message' => 'Thêm Role thành công!',
            'data' => $role,
        ], 200);
    }

    public function editRole(Request $request)
    {
        try {
            $request->validate([
                'role_id' => 'required|exists:roles,role_id',
                'role_name' => 'required|string|max:255',
                'role_description' => 'nullable|string',
            ]);

            $roleId = $request->input('role_id');
            $role = Role::find($roleId);

            $role->update([
                'role_name' => $request->input('role_name'),
                'role_description' => $request->input('role_description'),
            ]);

            return response()->json([
                'message' => 'Chỉnh sửa Role thành công!',
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Không tìm thấy Role.',
            ], 404);
        }
    }

    public function getRoleDetail(Request $request)
    {
        try {
            $request->validate([
                'role_id' => 'required|exists:roles,role_id',
            ]);

            $roleId = $request->input('role_id');
            $role = Role::findOrFail($roleId);

            return response()->json([
                'message' => 'Lấy chi tiết Role thành công!',
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Không tìm thấy Role.',
            ], 404);
        }
    }
}
