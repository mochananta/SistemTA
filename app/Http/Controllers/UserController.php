<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function formview()
    {
        return view('user.layanan.form-surat.form');
    }

    public function formview2()
    {
        return view('user.layanan.form-konsultasi.form2');
    }

    public function jenissuratview()
    {
        return view('user.layanan.surat');
    }
    public function jenissuratview2()
    {
        return view('user.layanan.konsultasi');
    }
}
