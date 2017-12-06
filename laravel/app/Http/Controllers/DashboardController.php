<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class DashboardController extends Controller
{
    public function __construct()
   {
       $this->middleware('auth');
   }
}
