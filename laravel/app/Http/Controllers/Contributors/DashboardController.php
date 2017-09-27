<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
	public function home() {

		return view('contrib.home.home');

	}
	public function index() {

		return view('contrib.dashboard');

	}

}
