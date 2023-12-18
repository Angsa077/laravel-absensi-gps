<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $permissions = Permission::when(request()->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5)->appends(request()->only('q'));

        return view('admin.permission.index', compact('permissions'));
    }
}
