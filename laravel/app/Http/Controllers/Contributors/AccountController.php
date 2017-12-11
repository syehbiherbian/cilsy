<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Contributors;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Input;
use DB;

class AccountController extends Controller
{
    public function informasi()
    {
    	$contribID = Session::get('contribID');
    	$contributor = Contributors::find($contribID);

    	return view('contrib.account.informasi', [
    		'contrib' => $contributor
    	]);
    }

    public function edit($id)
    {
    	$contribID = Session::get('contribID');
    	$contributor = Contributors::find($contribID);

    	return view('contrib.account.edit_informasi', [
    		'contrib' => $contributor
    	]);
    }

    public function update_informasi(Request $request, $id)
    {
    	$rules = array(
    		'email' => 'required|email',
    		// 'password' => 'required|min:8', // password can only be alphanumeric and has to be greater than 3 characters
    	);
    	$validator = Validator::make(Input::all(), $rules);

    	if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // sen d back the input (not the password) so that we can repopulate the form
		}else{
			$email = Input::get('email');
			$passwordbaru = (Input::get('new_password'));
			$retypepassword = (Input::get('new_confirm'));
			$checkid = DB::table('contributors')->where('email', '=', $email)->first();
			$check = DB::table('contributors')->where('email', '=', $email)->count();

			if ($check > 0) {
				// $checkid =DB::table('members')->where('email','=',$email)->first();
				if ($retypepassword !== $passwordbaru) {
					return Redirect()->back()->with('geterror', 'Password Tidak sama!');
				} else {

					$update = DB::table('contributors')
						->where('email', $checkid->email)
						->update([
							'password' => bcrypt($passwordbaru),
						]);
					if ($update) {
						return Redirect()->to('/contributor/account/informasi')->with('success', 'Sukses Perbaharui Informasi Akun');

					} else {
						return Redirect()->back()->with('error', 'Maaf Ada yang Error');
					}

				}
			} else {
				return Redirect()->back()->with('geterror', 'Sorry email is not valid !');
			}
		}
    }

    public function halaman()
    {
    	return view('contrib.account.halaman');
    }
}
