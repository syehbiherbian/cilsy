<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller {
	public function home() {
		if (empty(Auth::guard("contributors")->user())) {
		  return redirect('contributor/login')->with('errors','Kamu Harus Login terlebih dahulu');
		} else{
			return view('contrib.home.home');
		}
		

	}
	public function index() {
		if (empty(Auth::guard("contributors")->user())) {
		  return redirect('contributor/login')->with('error','Kamu Harus Login terlebih dahulu');
		}else{
			return view('contrib.dashboard');
		}
		

	}

}