<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller {
	public function index() {
		if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }else{
			return view('contrib.home.home');
		{
			$this->middleware('contrib');
		}
		}
		
	}
}