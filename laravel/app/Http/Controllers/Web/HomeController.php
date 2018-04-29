<?php

namespace App\Http\Controllers\Web;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Lesson;
use DateTime;
use Session;
use Auth;
use App\rate;
use DB;

class HomeController extends Controller {
	//

	public function index() {
		# code...
		$now = new DateTime();
		$mem_id = Auth::guard("members")->user()->id;
		$categories = Category::where('enable', '=', 1)->get();
		$newlessons = Lesson::where('enable', '=', 1)->orderBy('id','DESC')->get();
		$lessons = Lesson::where('enable', '=', 1)->orderBy('id','ASC')->get();
		$invoice = Invoice::where('status', '=', 1)->where('members_id', '=', $mem_id)->first();
		$mem_id= Auth::guard("members")->user();

		if(($mem_id) != null){
		$ratenow = rate::select('id_member')
		->where('id_member', '=', Auth::guard("members")->user()->id)
    	->whereRaw('YEAR(created_at) = YEAR(now()) AND MONTH(created_at) = MONTH(now())')
    	->get();

		}else{
			$ratenow=[''];
		}
    	$now = new DateTime();
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
			'ratenow' => $ratenow
		]);
	}
}
