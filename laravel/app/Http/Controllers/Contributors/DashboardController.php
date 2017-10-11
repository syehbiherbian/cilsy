<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Session;

class DashboardController extends Controller {
	public function home() {

		return view('contrib.home.home');

	}
	public function index() {
		if (empty(Session::get('contribID'))) {
		  return redirect('contributor/login');
		}
		return view('contrib.dashboard');

	}

}
