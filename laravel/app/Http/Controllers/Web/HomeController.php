<?php

namespace App\Http\Controllers\Web;
use App\categories;
use App\Http\Controllers\Controller;
use App\invoice;
use App\lessons;
use DateTime;
use Session;
use Auth;
use App\rate;
use DB;

class HomeController extends Controller {
	//

	public function index() {
		# code...
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
			'ratenow' => $ratenow
		]);
	}
}
