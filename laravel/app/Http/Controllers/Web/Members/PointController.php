<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
// use App\members;
// use App\invoice;
// use App\packages;
use Session;
// use Hash;
use DateTime;
// use DB;
class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Authentication
      $mem_id = Session::get('memberID');
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      // $members = members::where('status',1)->where('id',$mem_id)->first();
      // if ($members) {
        return view('web.members.point', [
          // 'members' => $members
        ]);
      // }else {
      //   return redirect('/member/signin');
      //   exit;
      // }
    }
}
