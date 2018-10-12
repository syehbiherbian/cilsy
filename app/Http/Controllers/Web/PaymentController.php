<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Invoice;
use App\Models\Cart;
use DB;
use Auth;
use Session;
class PaymentController extends Controller
{
  public function index($response)
  {
    Cart::where('member_id', Auth::guard('members')->user())->delete();
    
    if($response == 'finish'){
      return view('web.payment.finish');
    }else if($response == 'unfinish'){
      return view('web.payment.unfinish');
    }else if($response == 'error'){
      return view('web.payment.error');
    }


  }

  public function notification()
  {

  }


}
