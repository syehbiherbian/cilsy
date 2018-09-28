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
// use App\Models\Package;
use Session;
// use Hash;
use DateTime;
use DB;
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
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }

      $get_hist = Invoice::join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
      ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
      ->where('invoice.members_id', '=', $mem_id)
      ->where('invoice.status', '2')
      ->where('B.harga_lesson', '<>', '0')
      ->orderBy('invoice.created_at', 'desc')
      ->distinct()
      ->select(['invoice.code as invoice' , 'invoice.created_at as hari',  'invoice.type as type', 
      DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status',  DB::raw('SUM(distinct invoice.price) as total'), DB::raw('SUM(distinct B.harga_lesson)-Sum(distinct invoice.price) as disc')])
      ->groupby('invoice.code', 'invoice.type', 'invoice.created_at', 'invoice.status' )
      ->get();

      $get_tot = Invoice::join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
      ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
      ->where('invoice.members_id', '=', $mem_id)
      ->where('invoice.status','<>', '2')
      ->where('B.harga_lesson', '<>', '0')
      ->orderBy('invoice.created_at', 'desc')
      ->distinct()
      ->select(['invoice.code as invoice' , 'invoice.created_at as hari',  'invoice.type as type', 
      DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status', DB::raw('SUM(distinct invoice.price) as total'),  DB::raw('SUM(distinct B.harga_lesson)-Sum(distinct invoice.price) as disc')])
      ->groupby('invoice.code','invoice.type', 'invoice.created_at', 'invoice.status' )
      ->get();

      
      return view('web.members.riwayat', [
        'get_hist' => $get_hist,
        'get_tot' => $get_tot,
    ]);
    }

    public function Tambah($invoice){
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }


    }
    public function download($inv){

      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      $get_hist = Invoice::join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
      ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
      ->join('members as D', 'invoice.members_id', '=', 'D.id')
      ->where('invoice.members_id', '=', $mem_id)
      ->where('invoice.code',$inv)
      ->orderBy('invoice.created_at', 'desc')
      ->distinct() 
      ->select(['invoice.code as invoice' ,'D.username as user', DB::raw('SUM(distinct B.harga_lesson) as subtotal'), 'D.email as email', 'invoice.created_at as hari',  'invoice.type as type', 
      DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , DB::raw('SUM(distinct invoice.price) as total'), DB::raw('SUM(distinct B.harga_lesson)-Sum(distinct invoice.price) as disc')])
      ->groupby('invoice.code', 'D.username', 'D.email', 'invoice.created_at', 'invoice.type', 'invoice.created_at' )
      ->get();

      return view('web.members.sertifikat.sertifikat',[
        'get_hist' => $get_hist,
      ]);


    }

}
