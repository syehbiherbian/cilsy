<?php

namespace App\Http\Controllers\Web\Members;

use App\Http\Controllers\Controller;
use App\members;
use DateTime;
use DB;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;
use Validator;

class AuthController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function signin() {
		$this->forgetMember();
		return view('web.members.signin');

	}
	public function dosignin() {
		$this->forgetMember();
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {

			$email = Input::get('email');
			$password = md5(Input::get('password'));
			$now = new DateTime();

			// store
			$member = members::where('email', '=', $email)->where('password', '=', $password)->first();

			if (count($member) > 0) {
				Session::set('memberID', $member->id);
				// redirect
				return redirect('/')->with('success', 'Selamat datang kembali,' . $member->username);

				// return redirect('member/dashboard')->with('success','Selamat datang,'.$member->username);
			} else {
				// redirect
				return redirect()->back()->with('error', 'Akun tidak di temukan !');
			}
		}
	}

	public function signup() {
		$this->forgetMember();
		return view('web.members.signup');

	}
	public function dosignup() {
		$this->forgetMember();
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'username' => 'required|unique:members',
			'email' => 'required|email|unique:members',
			'password' => 'required|min:8',
			'retype_password' => 'required|min:8|same:password',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {

			$username = Input::get('username');
			$email = Input::get('email');
			$password = md5(Input::get('password'));
			$now = new DateTime();
			// store
			$members = new members;
			$members->status = 1;
			$members->username = $username;
			$members->email = $email;
			$members->password = $password;
			$members->created_at = $now;
			$members->save();

			// store
			$member = members::where('username', '=', $username)->where('email', '=', $email)->first();

			Session::set('memberID', $member->id);
			Session::set('membername', $member->username);
			// redirect
			return redirect('member/package')->with('success', 'Silahkan Pilih Paket Anda !');
		}
	}

	public function signout() {
		$this->forgetMember();

		return redirect('member/signin');
	}

	public function resetpassword() {
		return view('web.members.edit-password');
	}

	public function forgotpassword() {
		return view('web.members.forgot');
	}

	public function doforgotpassword() {
		$rules = array(
			'email' => 'required|email',
			'birthofdate' => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);
		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator);
		} else {
			$email = Input::get('email');
			$birthofdate = Input::get('birthofdate');
			$token = str_random(30) . $email;
			$now = new DateTime();
			$insert = DB::table('password_resets')->insert([
				'email' => $email,
				'token' => $token,
				'created_at' => $now,
			]);
			if ($insert) {
				echo "sukses";
			} else {
				echo "gagal";
			}
		}
	}

	public function doreset() {
		{
			if (Session::get('memberID')) {
				$memberid = Session::get('memberID');
				# code...
				// validate the info, create rules for the inputs
				$rules = array(

					'password' => 'required|min:6', // password can only be alphanumeric and has to be greater than 3 characters

				);
				// run the validation rules on the inputs from the form
				$validator = Validator::make(Input::all(), $rules);
				// if the validator fails, redirect back to the form
				if ($validator->fails()) {
					return redirect()->back()
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
				} else {

					$passwordbaru = md5(Input::get('password'));
					$retypepassword = md5(Input::get('retypepassword'));

					if ($retypepassword !== $passwordbaru) {
						return Redirect()->back()->with('error_get', 'These passwords don t match. Try again?!');
					} else {

						$update = DB::table('members')
							->where('id', $memberid)
							->update([
								'password' => $passwordbaru,
							]);
						if ($update) {

							return Redirect()->to('/member/signin')->with('success', 'Successfully change Password,please your login again   !');

						} else {
							return Redirect()->back()->with('error', 'Sorry something is error !');
						}

					}

				}
			} else {
				Session::flash('error_must_login', 'You must sign');
				return Redirect('member/login');
			}
		}
	}

	private function forgetMember() {
		Session::forget('memberID');
	}

}
