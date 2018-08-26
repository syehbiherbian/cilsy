<?php

namespace App\Http\Controllers\Web;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Lesson;
use App\Models\TutorialMember;
use DateTime;
use Session;
use Auth;
use App\Models\Rate;
use DB;

class HomeController extends Controller {
	//

	public function index() {
		# code...
		$now = new DateTime();
		if(Auth::guard('members')->user()){
            $mem_id      = Auth::guard('members')->user()->id;
          }else{
            $mem_id      = 0;
        }
		$categories = Category::where('enable', '=', 1)->get();
		$newlessons = Lesson::where('enable', '=', 1)->where('status', 1)->orderBy('id','DESC')->get();
		$lessons = Lesson::where('enable', '=', 1)
				   ->where('status', 1)
				   ->orderBy('id','ASC')->get();
		$invoice = Invoice::where('status', '=', 1)->where('members_id', '=', $mem_id)->first();
		$mem_id= Auth::guard("members")->user();

		if(($mem_id) != null){

		$cekdulu = TutorialMember::where('member_id', Auth::guard("members")->user()->id)
		->where(DB::raw('DATEDIFF( now(),`created_at`)') , '>', 30)
		->orderby('created_at', 'asc')->first();

		$ratenow = Rate::select('id_member')
		->where('id_member', '=', Auth::guard("members")->user()->id)
    	->whereRaw('YEAR(created_at) = YEAR(now()) AND MONTH(created_at) = MONTH(now())')
    	->get();

		}else{
			$ratenow=[''];
		}
    	$now = new DateTime();
		$categories = Category::where('enable', '=', 1)->get();
		$newlessons = Lesson::where('enable', '=', 1)->where('status', 1)->orderBy('id','DESC')->get();
		$lessons = Lesson::where('enable', '=', 1)
					->where('status', 1)
					->orderBy('id','ASC')->get();
		$invoice = Invoice::where('status', '=', 1)->where('members_id', '=', $mem_id)->first();
		return view('web.home', [
			'categories' => $categories,
			'newlessons' => $newlessons,
			'lessons' => $lessons,
			'invoice' => $invoice,
			'mem_id' => $mem_id,
			'ratenow' => $ratenow,
			'cekdulu' => $cekdulu
		]);
	}
}