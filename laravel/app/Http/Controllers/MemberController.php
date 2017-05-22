<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = DB::table('members')->get();
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
        return view('admin.members.create');
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
        'retype_password'   => 'required|min:8|same:password'
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $username       = Input::get('username');
          $email          = Input::get('email');
          $password       = md5(Input::get('password'));
          $now            = new DateTime();
          // store
          $members = new members;
          $members->status       = 1;
          $members->username     = $username;
          $members->email        = $email;
          $members->password     = $password;
          $members->created_at   = $now;
          $members->save();

          // store
          $member = members::where('username','=',$username)->where('email','=',$email)->first();

          Session::set('memberID',$member->id);
          Session::set('membername',$member->username);
          // redirect
          return redirect('member/package')->with('success','Silahkan Pilih Paket Anda !');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
