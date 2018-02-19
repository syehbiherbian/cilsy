<?php

namespace App\Http\Controllers\Web;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Lesson;
use DateTime;
use Session;

class HomeController extends Controller {
	//
	public function index() {
		# code...
		$now = new DateTime();
		$mem_id = Session::get('memberID');
		$categories = Category::where('enable', '=', 1)->get();
		$newlessons = Lesson::where('enable', '=', 1)->orderBy('id','DESC')->get();
		$lessons = Lesson::where('enable', '=', 1)->orderBy('id','ASC')->get();
		$invoice = Invoice::where('status', '=', 1)->where('members_id', '=', $mem_id)->first();
		return view('web.home', [
			'categories' => $categories,
			'newlessons' => $newlessons,
			'lessons' => $lessons,
			'invoice' => $invoice,
			'mem_id' => $mem_id,
		]);
	}
}
