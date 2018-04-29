<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Member;
// use App\Models\Invoice;
// use App\Models\Package;
use Session;
// use Hash;
use DateTime;
// use DB;
use Auth;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Authentication
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      // $packages = Package::all();
      return view('web.members.change-password', [
        // 'packages' => $packages
      ]);
    }
    public function doSubmit()
    {
      // Authentication
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'old_password'    => 'required|min:8|max:255',
        'password'        => 'required|min:8|max:255',
        'retype_password' => 'required|min:8|max:255|same:password',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
      } else {

        $now = new DateTime();
        $old_password = md5(Input::get('old_password'));
        $password = md5(Input::get('password'));
        $check_password = Member::where('status',1)->where('id',$mem_id)->where('password',$old_password)->first();
        if ($check_password) {
          $update = Member::find($mem_id);
          $update->password = $password;
          $update->updated_at = $now;
          $update->save();
          return redirect()->back()->with('success','Password Anda telah di ubah');
        }else {
          return redirect()->back()->with('error','Password Lama Salah !');
        }

      }
    }

}
