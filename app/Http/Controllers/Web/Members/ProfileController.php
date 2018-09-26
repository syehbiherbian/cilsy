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

class ProfileController extends Controller
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
      $members = Member::where('id',$mem_id)->first();
      if ($members) {
        return view('web.members.profile', [
          'members' => $members
        ]);
      }else {
        return redirect('/member/signin');
        exit;
      }
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
        'username'      => 'required|min:3|max:255',
        'email'         => 'required|min:3|max:255|email'
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
      } else {

        $now = new DateTime();
        $username = Input::get('username');
        $email    = Input::get('email');

        $update = Member::findOrFail($mem_id);
        $update->username   = $username;
        $update->email      = $email;
        $update->updated_at = $now;

        if ($update->save()) {
          return redirect()->back()->with('success','Profil Berhasil di ubah');
        }
      }
    }

    public function Riwayat(){
      return view('web.members.riwayat');
    }

}
