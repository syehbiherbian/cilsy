<?php

namespace App\Http\Controllers\Web\Members;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\members;
use DateTime;
use DB;
use Illuminate\Support\Facades\Input;
use PHPMailer;
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

	public function forgetpassword() {
		return view('web.members.forget-password');
	}

	public function doforgetpassword() {
		$rules = array(
			'email' => 'required|email',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {
			$email = Input::get('email');
			$token = str_random(30) . $email;
			$now = new DateTime();

			$forget = DB::table('password_resets')->insert([
				'email' => $email,
				'token' => $token,
				'created_at' => $now,
			]);
			if ($forget) {
				$mail = new PHPMailer;

				$mail->SMTPDebug = 3; // Enable verbose debug output

				$mail->isSMTP(); // Set mailer to use SMTP
				$mail->Host = ' smtp.mailtrap.io'; // Specify main and backup SMTP servers
				$mail->SMTPAuth = true; // Enable SMTP authentication
				$mail->Username = '23183d23077daa'; // SMTP username
				$mail->Password = '75acd97bcbf595'; // SMTP password
				$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 2525; // TCP port to connect to

				$mail->setFrom('noreply@cilsy.id', 'No reply');
				$mail->addAddress($email); // Add a recipient
				// $mail->addAddress('ellen@example.com');               // Name is optional
				// $mail->addReplyTo('info@example.com', 'Information');
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				$mail->isHTML(true); // Set email format to HTML

				$mail->Subject = 'Tes Lupa Password';
				$mail->Body = 'Silahkan klik link berikut <a href="https://cilsy.id/member/reset/update/' . $token . '">disini</a>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				if (!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo 'Message has been sent';
				}
			} else {
				echo "error";
			}
		}
	}
	public function updatereset($token) {
		return view('members.edit-password');
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
