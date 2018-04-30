<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Member;
use App\Models\Point;
// use App\Models\Package;
use Session;
// use Hash;
use DateTime;
use Auth;

// use DB;
class PointController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Authentication
        $mem_id = Auth::guard('members')->user()->id;
        if (!$mem_id) {
            return redirect('/member/signin');
            exit;
        }
        $members = Member::where('status', 1)->where('id', $mem_id)->first();
        if ($members) {

            $point_question = Point::where('type', 'QUESTION')->where('member_id', $mem_id)->sum('value');
            $point_reply = Point::where('type', 'REPLY')->where('member_id', $mem_id)->sum('value');
            $point_complete = Point::where('type', 'COMPLETE')->where('member_id', $mem_id)->sum('value');
            return view('web.members.point', [
                'members' => $members,
                'point_question' => $point_question,
                'point_reply' => $point_reply,
                'point_complete' => $point_complete
            ]);
        } else {
            return redirect('/member/signin');
            exit;
        }
    }

    //
    //
    // public function doSubmit()
    // {
    //   // Authentication
    //   $mem_id = Session::get('memberID');
    //   if (!$mem_id) {
    //     return redirect('/member/signin');
    //     exit;
    //   }
    //   // validate
    //   // read more on validation at http://laravel.com/docs/validation
    //   $rules = array(
    //     'username'      => 'required|min:3|max:255',
    //     'email'         => 'required|min:3|max:255|email'
    //   );
    //   $validator = Validator::make(Input::all(), $rules);
    //
    //   // process the login
    //   if ($validator->fails()) {
    //     return redirect()->back()->withErrors($validator)->withInput();
    //   } else {
    //
    //     $now = new DateTime();
    //     $username = Input::get('username');
    //     $email    = Input::get('email');
    //
    //     $update = Member::findOrFail($mem_id);
    //     $update->username   = $username;
    //     $update->email      = $email;
    //     $update->updated_at = $now;
    //
    //     if ($update->save()) {
    //       return redirect()->back()->with('success','Profil Berhasil di ubah');
    //     }
    //   }
    // }
}
