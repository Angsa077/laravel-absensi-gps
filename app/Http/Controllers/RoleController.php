<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::when(request()->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->with('permissions:id,name')->latest()->paginate(5);

        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permissions);

        if ($role) {
            return redirect()->route('role.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('role.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::with('permissions:id,name')->findOrFail($id);
        $permissions = Permission::all();
        return view('admin.role.edit', compact('roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required',
        ]);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        
        if ($role) {
            return redirect()->route('role.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('role.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        if ($role) {
            return redirect()->route('role.index')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->route('role.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
