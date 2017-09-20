<?php
namespace App\Http\Controllers;
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
// use App\services;
// use App\invoice;
// use App\members;
use App\Contributors;
// use App\lessons;
// use App\lessons_detail;
use App\income_details;
use App\contributor_account;
use App\income_transfer;
class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date= new DateTime();
        $moth= $date->format('m');
        $year= $date->format('Y');
        $data= income_details::join('contributors','income_details.contributor_id','=','contributors.id')
                ->select('income_details.*','income_details.status as status_paid','contributors.username as name')
            //    ->where('moth',$moth)->where('year',$year)
               ->get();
        $bank= contributor_account::all();
        return view('admin.income.index',[
            'data' => $data,
            'bank' =>$bank
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = array(

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $status         = Input::get('status_paid'.$id);
            $bankid         = Input::get('bankid'.$id);
            // update
            $updates = income_details::find($id);
            $updates->status      = $status;
            $updates->updated_at= $now;
            $updates->save();
            if(!empty($bankid)){
                $bank= contributor_account::where('id',$bankid)->first();
                $store = new income_transfer;
                $store->detail_income_id = $id;
                $store->bank_transfer=$bank->id;
                $store->created_at= $now;
                $store->save();
            }

            // redirect
            return redirect()->back()->with('success','Data successfully updated');
        }
    }



}
