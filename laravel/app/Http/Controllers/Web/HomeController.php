<?php

namespace App\Http\Controllers\Web;
use App\categories;
use App\Http\Controllers\Controller;
use App\invoice;
use App\lessons;
use DateTime;
use Session;

class HomeController extends Controller {
	//
	public function index() {
		# code...
		$now = new DateTime();
		$mem_id = Session::get('memberID');
		$categories = categories::where('enable', '=', 1)->get();
		$newlessons = lessons::where('enable', '=', 1)->orderBy('id','DESC')->get();
		$lessons = lessons::where('enable', '=', 1)->orderBy('id','ASC')->get();
		$invoice = invoice::where('status', '=', 1)->where('members_id', '=', $mem_id)->first();
		return view('web.home', [
			'categories' => $categories,
			'newlessons' => $newlessons,
			'lessons' => $lessons,
			'invoice' => $invoice,
			'mem_id' => $mem_id,
		]);
	}
}
