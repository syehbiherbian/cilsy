<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller {
	public function home() {
		return view('contrib.home.home');

	}
	public function index() {
		if (empty(Auth::guard("contributors")->user())) {
		  return redirect('contributor/login');
		}
		return view('contrib.dashboard');

	}

}
