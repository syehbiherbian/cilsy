<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function informasi()
    {
    	return view('contrib.account.informasi');
    }
    public function halaman()
    {
    	return view('contrib.account.halaman');
    }
}
