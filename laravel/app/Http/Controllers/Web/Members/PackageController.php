<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
use App\members;
use App\invoice;
use App\packages;
use Session;
use Hash;
use DateTime;
use DB;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $packages = packages::all();
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
          $packages       = packages::where('id','=',$packages_id)->first();
          $member_id      = Session::get('memberID');
          $now            = new DateTime();
          // var_dump($packages_id);

          $code           = $this->generateCode();
          // store
          $invoice = new invoice;
          $invoice->status       = 0;
          $invoice->code         = $code;
          $invoice->members_id   = $member_id;
          $invoice->packages_id  = $packages_id;
          $invoice->price        = $packages->price;
          $invoice->created_at   = $now;
          $invoice->save();
          // store
          $invoice = invoice::where('code','=',$code)->first();
          Session::set('invoiceCODE',$invoice->code);
          if($member_id == null){
                return redirect('member/signup');
                // dd(Session::get('invoiceCODE'));
          } else{
            # code...
            return redirect('checkout');
          }
          
          
          
      }
    }
    private function generateCode()
    {
      $randomCode     = 'INV'.rand(000000,999999);
      // $randomCode = uniqid();
      $check = invoice::where('code','=',$randomCode)->count();
      if($check > 0){
        $this->generateCode();
      }else{
        return $randomCode;
      }
    }

}
