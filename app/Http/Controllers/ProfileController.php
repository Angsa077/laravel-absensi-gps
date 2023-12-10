<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg|max:1028',
        ]);

        $user = User::find($id);
        $password = Hash::make($request->password);

        if ($request->hasFile('profile_photo_path')) {
            $profile_photo_path = $user->name . "-" . $user->nip . "." . $request->file('profile_photo_path')->getClientOriginalExtension();
        } else {
            $profile_photo_path = $user->profile_photo_path;
        }


        if (empty($password)) {
            $data = [
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'profile_photo_path' => $profile_photo_path,
            ];
        } else {
            $data = [
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'password' => $password,
                'profile_photo_path' => $profile_photo_path,
            ];
        }

        $update = User::where('id', $id)->update($data);
        if ($update) {
            if ($request->hasFile('profile_photo_path')) {
                $folderPath = "public/uploads/profile/";
                $request->file('profile_photo_path')->storeAs($folderPath, $profile_photo_path);
            }
            return Redirect::back()->with('success', 'Data profile berhasil diubah');
        } else {
            return Redirect::back()->with('error', 'Data profile gagal diubah');
        }
    }
}
