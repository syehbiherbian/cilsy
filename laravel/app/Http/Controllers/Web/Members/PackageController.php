<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Member;
use App\Models\Invoice;
use App\Models\Package;
use Session;
use Hash;
use DateTime;
use DB;
use Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $packages = Package::all();
      return view('web.members.package', [
        'packages' => $packages
      ]);
    }
    public function dopackage()
    {
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'packages_id'          => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $packages_id    = Input::get('packages_id');
          $packages       = Packages::where('id','=',$packages_id)->first();
          if(Auth::guard('members')->user()){
            $member_id      = Auth::guard('members')->user()->id;
          }else{
            $member_id      = null;
          }
          $member = members::where('id', '=', $member_id)->first();
          // dd($packages);
          Session::set('price', $packages->price);
          if($member_id == null){
            session()->put('package', [
            'paket' => $packages->title,
            'harga' => $packages->price,
            'expired' => $packages->expired,
            ]);
            Session::set('package_id', $packages->id);
                // dd(Session::get('invoiceCODE'));
                return redirect('member/signup');
                
          } else{
            session()->put('package', [
            'paket' => $packages->title,
            'harga' => $packages->price,
            'expired' => $packages->expired,
            ]);
            Session::set('email', $member->email);
            Session::set('package_id', $packages->id);
            # code...
            return view('web.payment.summary', compact('packages', 'member')
              
            );
          }
          
          
          
      }
    }
    public function summary(){

          $packages_id    = Session::get('package_id');
          $packages       = packages::where('id','=',$packages_id)->first();
          if(Auth::guard('members')->user()){
            $member_id      = Auth::guard('members')->user()->id;
          }else{
            $member_id      = null;
          }
          $now            = new DateTime();
          // var_dump($packages_id);

          $code           = $this->generateCode();
          // store
          $invoice = new Invoice;
          $invoice->status       = 0;
          $invoice->code         = $code;
          $invoice->members_id   = $member_id;
          $invoice->packages_id  = $packages_id;
          if(session()->get('coupon')['discount']){
          $invoice->price        = session()->get('coupon')['discount'];
          }else{
          $invoice->price        = $packages->price;            
          }
          $invoice->created_at   = $now;
          $invoice->save();
          // store
          $invoice = Invoice::where('code','=',$code)->first();

          Session::set('invoiceCODE',$invoice->code);
          Session::set('price', $invoice->price);
          if($member_id == null){
                // dd(Session::get('invoiceCODE'));
                return redirect('member/signup');
                
          } else{
            # code...
            return redirect('checkout');
          }
  }
    private function generateCode()
    {
      $randomCode     = 'INV'.rand(000000,999999);
      // $randomCode = uniqid();
      $check = Invoice::where('code','=',$randomCode)->count();
      if($check > 0){
        $this->generateCode();
      }else{
        return $randomCode;
      }
    }

}
