<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


use DB;
use Validator;
use DateTime;
use App\members;
use App\packages;
use App\invoice;
use App\services;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = members::all();
        return view('admin.members.index', [
            'members' => $members
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = packages::all();
        return view('admin.members.create',[
          'packages'=>$packages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
        'username'          => 'required|unique:members',
        'email'             => 'required|email|unique:members',
        'password'          => 'required|min:8',
        'retype_password'   => 'required|min:8|same:password',
        'services_packages' => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $username           = Input::get('username');
          $email              = Input::get('email');
          $password           = md5(Input::get('password'));


          $services_status    = Input::get('services_status');
          $services_packages  = Input::get('services_packages');


          $now            = new DateTime();

          // store
          $members = new members;
          $members->status       = 1;
          $members->username     = $username;
          $members->email        = $email;
          $members->password     = $password;
          $members->created_at   = $now;
          $members->save();


          $packages = packages::where('id',$services_packages)->first();

          // ADD INVOICE
          $code           = $this->generateCode();

          // store
          $invoice = new invoice;
          $invoice->status       = $services_status;
          $invoice->code         = $code;
          $invoice->members_id   = $members->id;
          $invoice->packages_id  = $packages->id;
          $invoice->price        = $packages->price;
          $invoice->created_at   = $now;
          $invoice->updated_at   = $now;
          $invoice->save();



          // ADD SERVICES

          $start    = date('Y-m-d');
          $expired  = date('Y-m-d', strtotime(' + '.$packages->expired.' days'));

          // store
          $services = new services;
          $services->status       = $services_status;
          $services->members_id   = $members->id;
          $services->invoice_id   = $invoice->code;
          $services->title        = $packages->title;
          $services->price        = $packages->price;
          $services->start        = $start;
          $services->expired      = $expired;
          $services->access       = $packages->access;
          $services->update       = $packages->update;
          $services->chat         = $packages->chat;
          $services->download     = $packages->download;
          $services->created_at   = $now;
          $services->updated_at   = $now;
          $services->save();

          // redirect
          return redirect('system/members')->with('success','Succesfully created new data');
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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $members    = members::find($id);
        return view('admin.members.edit',[
            'members'       => $members
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = array(
          'username'        => 'required|unique:members,username,'.$id,
          'email'           => 'required|unique:members,email,'.$id,
          'password'        => 'min:8',
          'retype_password' => 'min:8|same:password'
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          // Input
          $username       = Input::get('username');
          $email          = Input::get('email');
          $now            = new DateTime();

          // get old password
          $members = members::where('id',$id)->first();

          if (!empty('password') && !empty('retype_password')) {
            $password = $members->password;
          }else{
            $password = md5(Input::get('password'));
          }


          // store
          $store = members::find($id);
          $store->status       = 1;
          $store->username     = $username;
          $store->email        = $email;
          $store->password     = $password;
          $store->updated_at   = new DateTime();
          $store->save();

          // redirect
          return redirect('system/members')->with('success','Data successfully updated');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = members::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }
}
