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
// use App\Models\Service;
// use App\Models\Invoice;
// use App\Models\Member;
use App\Model\Contributor;
// use App\Models\Lesson;
// use App\Models\Lesson_detail;
use App\Models\IncomeDetail;
use App\Models\ContributorAccount;
use App\Models\IncomeTransfer;
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
        $data= IncomeDetail::join('contributors','income_details.contributor_id','=','contributors.id')
                ->select('income_details.*','income_details.status as status_paid','contributors.username as name')
            //    ->where('moth',$moth)->where('year',$year)
               ->orderby('income_details.id','=','desc')->get();
        $bank= ContributorAccount::all();
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
            $date_transfer  = Input::get('date'.$id);
            // update
            $updates = IncomeDetail::find($id);
            $updates->status      = $status;
            if(!empty($date_transfer)){
              $updates->transfer_date =$date_transfer;
            }
            if(!empty($bankid)){
              $updates->bank =$bankid;
            }

            $updates->updated_at= $now;
            $updates->save();

            if(!empty($bankid)){
                $bank= ContributorAccount::where('id',$bankid)->first();
                $store = new IncomeTransfer();
                $store->detail_income_id = $id;
                $store->bank_transfer=$bank->id;
                $store->transfer_date =$date_transfer;
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
