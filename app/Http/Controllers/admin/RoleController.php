<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function getAll()
    {
        $roles = Role::select('role_id', 'role_name', 'role_description')
            ->latest()
            ->get();
        return response()->json($roles);
    }

    public function create(Request $request)
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

    public function update(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
        ]);

        $roleId = $request->input('role_id');
        $role = Role::find($roleId);

        if (!$role) {
            return response()->json([
                'message' => 'Không tìm thấy Role.',
            ], 404);
        }

        $role->update([
            'role_name' => $request->input('role_name'),
            'role_description' => $request->input('role_description'),
        ]);

        return response()->json([
            'message' => 'Chỉnh sửa Role thành công!',
            'data' => $role,
        ], 200);
    }
}
