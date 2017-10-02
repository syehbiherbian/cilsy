<?php

namespace App\Http\Controllers\Web;
use App\categories;
use App\Http\Controllers\Controller;
use App\lessons;

class HomeController extends Controller {
	//
	public function index() {
		# code...
		$categories = categories::where('enable', '=', 1)->get();
		$lessons = lessons::where('enable', '=', 1)->get();
		// $services = services::where('status', '=', 1)->where('members_id', '=', $mem_id)->where('expired', '>=', $now)->first();

		return view('web.home', [
			'categories' => $categories,
			'lessons' => $lessons,
		]);
	}
}
