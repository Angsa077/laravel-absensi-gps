<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = User::when(request()->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->with('roles:id,name')->latest()->paginate(5)->appends(request()->only('q'));

        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.karyawan.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'unique:users,email',
            'nip' => 'numeric|unique:users,nip',
            'nik' => 'numeric|unique:users,nik',
            'no_hp'    => 'numeric',
        ], [
            'email.unique' => 'Email sudah terdaftar',
            'nip.unique' => 'NIP sudah terdaftar',
            'nip.numeric' => 'NIK harus angka',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.numeric' => 'NIK harus angka',
            'no_hp.numeric' => 'No HP harus angka',
        ]);

        $karyawan = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'nip'      => $request->nip,
            'nik'      => $request->nik,
            'no_hp'    => $request->no_hp,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat'   => $request->alamat,
            'password' => bcrypt("user2023"),
        ]);

        $karyawan->assignRole($request->roles);

        if ($karyawan) {
            return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('karyawan.index')->with(['error' => 'Data Gagal Disimpan']);
        }        
    }

    public function edit(string $id)
    {
        $karyawan = User::with('roles:id,name')->findOrFail($id);
        $roles = Role::all();
        return view('admin.karyawan.edit', compact('karyawan', 'roles'));
    }

    public function update(Request $request, User $karyawan)
    {

        $this->validate($request, [
            'email'    => 'unique:users,email,'.$karyawan->id,
            'nip' => 'numeric|unique:users,nip,'.$karyawan->id,
            'nik' => 'numeric|unique:users,nik,'.$karyawan->id,
            'no_hp'    => 'numeric',
        ], [
            'email.unique' => 'Email sudah terdaftar',
            'nip.unique' => 'NIP sudah terdaftar',
            'nip.numeric' => 'NIK harus angka',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.numeric' => 'NIK harus angka',
            'no_hp.numeric' => 'No HP harus angka',
        ]);

        $karyawan->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'nip'      => $request->nip,
            'nik'      => $request->nik,
            'no_hp'    => $request->no_hp,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat'   => $request->alamat,
            'password' => bcrypt("user2023"),
        ]);

        $karyawan->syncRoles($request->roles);
        if ($karyawan) {
            return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('karyawan.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function destroy(string $id)
    {
        $karyawan = User::findOrFail($id);

        $karyawan->delete();
        if ($karyawan) {
            return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->route('karyawan.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
