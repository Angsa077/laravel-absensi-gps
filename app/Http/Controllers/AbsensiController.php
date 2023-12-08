<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function create()
    {
        return view('absensi.create');
    }
}
