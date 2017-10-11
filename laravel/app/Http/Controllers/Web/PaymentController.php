<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\invoice;
use DB;
use Session;
class PaymentController extends Controller
{
  public function index($response)
  {
    $invoice = invoice::where('code', '=', Session::get('invoiceCODE'))->first();
    var_dump($invoice);
    if($response == 'finish'){
      return view('web.payment.finish', [
        'invoice' => $invoice
      ]);
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
