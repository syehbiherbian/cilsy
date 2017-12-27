<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\packages;

class HargaController extends Controller
{
    public function index()
    {
      $packages = packages::all();
      return view('web.harga', [
        'packages' => $packages
      ]);
    }
}
