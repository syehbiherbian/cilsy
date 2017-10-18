<?php
namespace App\Http\Controllers\Contributors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Redirect;
use Session;
use Hash;
use DateTime;
use DB;
use App\services;
use App\invoice;
use App\members;
use App\Contributors;
use App\lessons;
use App\lessons_detail;
use App\income_details;
use App\contributor_account;
class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $date= new DateTime();
        $moth= $date->format('m');
        $year= $date->format('Y');

        $contribID = Session::get('contribID');
        $row = income_details::where('contributor_id',$contribID)->where('moth',$moth)->where('year',$year)->first();
        if(count($row) ==0){
        $row = income_details::where('contributor_id',$contribID)->orderBy('created_at','desc')->first();
        }

      $rekening=contributor_account::where('contributor_id',$contribID)->get();
      return view('contrib.income.index', [
        'row'=>$row,
        'rekening'=>$rekening,
      ]);
    }
    public function create(){

        return view('contrib.income.create', [
        ]);
    }
    public function doCreate()
    {
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $contribID = Session::get('contribID');
      # code...
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'bank'          => 'required',
        'noreg'          => 'required',
        'name'          => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $now          = new DateTime();
          $bank         = Input::get('bank');
          $noreg        = Input::get('noreg');
          $name         = Input::get('name');

          $store                  = new contributor_account;
          $store->contributor_id  = $contribID;
          $store->account_no      = $noreg;
          $store->bank            = $bank;
          $store->holder          = $name;
          $store->created_at      = $now;
          $store->enable=1;
          $store->save();

          return redirect('contributor/income')->with('success','Penambahan rekening berhasil');

      }
    }

    public function edit($id){
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $contribID = Session::get('contribID');
        $row =contributor_account::where('contributor_id',$contribID)->where('id',$id)->first();
        if(count($row)==0){
            return Redirect('not-found');
        }
        return view('contrib.income.edit', [
            'row'=>$row,
        ]);
    }

    public function doEdit($id)
    {
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $contribID = Session::get('contribID');
      # code...
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'bank'          => 'required',
        'noreg'          => 'required',
        'name'          => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $now          = new DateTime();
          $bank         = Input::get('bank');
          $noreg        = Input::get('noreg');
          $name         = Input::get('name');

          $store                  = contributor_account::find($id);
          $store->contributor_id  = $contribID;
          $store->account_no      = $noreg;
          $store->bank            = $bank;
          $store->holder          = $name;
          $store->updated_at      = $now;
          $store->save();

          return redirect('contributor/income')->with('success','Penambahan rekening berhasil');

      }
    }

    public function view()
    {
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $date= new DateTime();
        $moth= $date->format('m');
        $year= $date->format('Y');

        $contribID = Session::get('contribID');
        $row = income_details::where('contributor_id',$contribID)->get();
      return view('contrib.income.view', [
        'row'=>$row,
      ]);
    }

    public function doDelete($id){

        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $contribID = Session::get('contribID');
        $row =contributor_account::where('contributor_id',$contribID)->where('id',$id)->first();
        if(count($row)==0){
            return Redirect('not-found');
        }

      $i = contributor_account::where('contributor_id',$contribID)->where('id',$id)->delete();
      if($i > 0)
      {
        return redirect('contributor/income')->with('success-delete','Rekening berhasil di hapus');
      }else{
        return redirect()->back()->with('no-delete','Delete Rekening gagal!');
      }

    }
}
