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

                if($updates->status==1){
                  if($updates->moth=='01'){
                    $bulan='Januari';
                  }
                  elseif($updates->moth=='02'){
                    $bulan='Februari';
                  }elseif($updates->moth=='03'){
                    $bulan='Maret';
                  }elseif($updates->moth=='04'){
                    $bulan="April";
                  }elseif($updates->moth=='05'){
                      $bulan="Mei";
                  }elseif($updates->moth=='06'){
                      $bulan="Juni";
                  }elseif($updates->moth=='07'){
                      $bulan="Juli";
                  }elseif($updates->moth=='08'){
                      $bulan="Agustus";
                  }elseif($updates->moth=='09'){
                    $bulan="September";
                  }elseif($updates->moth=='10'){
                    $bulan="Oktober";
                  }elseif($updates->moth=='11'){
                    $bulan="November";
                  }elseif($updates->moth=='12'){
                    $bulan="Desember";
                  }else{
                    $bulan="-";
                  }

                  DB::table('contributor_notif')->insert([
                      'contributor_id'=> $updates->contributor_id,
                      'category'=>'transfer',
                      'title'   => 'fee sudah ditransfer oleh admin',
                      'notif'        => 'fee '.$bulan.' '.$updates->year.' telah ditransfer oleh admin ke rekening '.$bank->bank.' anda',
                      'status'        => 0,
                      'created_at'    => new DateTime()
                  ]);
                }
            }


            // redirect
            return redirect()->back()->with('success','Data successfully updated');
        }
    }



}
