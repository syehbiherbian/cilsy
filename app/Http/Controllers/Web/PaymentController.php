<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Invoice;
use App\Models\Cart;
use App\Models\Member;
use DB;
use Auth;
use Session;
use App\Mail\InvoiceMail;
use App\Mail\SuksesMail;
use Mail;

class PaymentController extends Controller
{
  public function index($response)
  {
    Cart::where('member_id', Auth::guard('members')->user()->id)->delete();
    $invoice = Invoice::where('members_id', Auth::guard('members')->user()->id)->first();
    $members = Member::where('id', $invoice->members_id)->first();
    $send = Member::findOrFail($members->id);
    if($invoice->status == 2){
      Mail::to($members->email)->send(new InvoiceMail($send));
    } else if($invoice->status == 1){
      Mail::to($members->email)->send(new SuksesMail($send));
    }
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
