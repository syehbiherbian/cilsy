<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use DateTime;
use DB;
class BootcampController extends Controller
{

	  public function bootcamp($slug)
    {
    	$bc = Bootcamp::where('status', 1)->where('slug', $slug)->first();
    	$now = new DateTime();
    	$time = strtotime($bc->created_at);
        $myFormatForView = date("d F y", $time);
        
        $contributors = DB::table('contributors')->where('contributors.id',$bc->contributor_id)->first();

        return view('web.bootcamp.bootcamp',[
            'bca' => $bc,
            'contributors' => $contributors,
            'tanggal' => $myFormatForView,
        ]);
    }

}
