<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class PaymentController extends Controller
{
  public function index($response)
  {
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
