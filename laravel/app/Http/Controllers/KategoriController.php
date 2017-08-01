<?php

namespace App\Http\Controllers;

use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class KategoriController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct() {
		$this->middleware('auth');
	}
	public function index() {
		$kategori = DB::table('categories')->get();
		return view('admin.kategori.index', [
			'kategori' => $kategori,
		]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.kategori.tambah');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		# code...
		// validate the info, create rules for the inputs
		$rules = array(
			// 'image'        => 'required',
			// 'status'     => 'required',
		);
		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {

			$nama_kat = Input::get('nama_kat');
			$icon = Input::get('icon');
			$desc = Input::get('desc');
			$now = new DateTime();

			$insert = DB::table('categories')->insert([
				'title' => $nama_kat,
				'image' => $icon,
				'enable' => 1,
				'description' => $desc,
				'created_at' => $now,

			]);
			if ($insert) {

//                //fungsi untuk sytem log
				//                $logcontent ="Add new bank  $name - $holder - $number for bank management";
				//                $logtype ="Bank";
				//                $loguser =Auth::user()->id;
				//                $logdateTime=new DateTime();
				//                $log=  Helper::userlog($logtype,$logcontent,$loguser,$logdateTime);
				//                //end userlog
				return redirect()->to('system/cat')->with('success-create', 'Sukses Tambah Kategori');

			} else {
				return Redirect()->back()->with('error', 'Sorry something is error !');
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$categories = categories::find($id);
		return view('admin.kategori.edit', [
			'categories' => $categories,
		]);}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
