<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointController extends Controller
{
	public function index(){
		return view('contrib.point.point');
	}
}
