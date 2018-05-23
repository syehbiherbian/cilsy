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
use App\Models\Income;
// use App\Models\Service;
// use App\Models\Invoice;
// use App\Models\Member;
use App\Models\Contributor;
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
        $data= Income::join('contributors','cart.contributor_id','=','contributors.id')
                ->select('cart.contributor_id as id',DB::raw('SUM(cart.price)*70/100 as price'),'cart.flag as status_paid','contributors.username as name')
                ->groupby('cart.contributor_id','cart.flag','contributors.username')
                ->get();
        $bank= ContributorAccount::all();
        return view('admin.income.index',[
            'data' => $data,
            'bank' => $bank
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
            $statusy         = Input::get('status_paid'.$id);
            $bankid         = Input::get('bankid'.$id);
            $date_transfer  = Input::get('date'.$id);
            $nilai          = Input::get('nilaiid'.$id);
            $noted          = Input::get('noted'.$id);

           
            $update = Income::where('contributor_id',$id)->where('flag', '0')->update(['flag'=> 1, 'updated_at'=> $now]);

                $updates = new IncomeDetail;
                $updates->contributor_id= $id;
                $updates->status=$statusy;
                $updates->transfer_date =$date_transfer;
                $updates->total_income= $nilai;
                $updates->bank =$bankid;
                $updates->created_at= $now;
                $updates->updated_at= $now;
                $updates->save();

            if(!empty($bankid)){
                $bank= ContributorAccount::where('id',$bankid)->first();
                $store = new IncomeTransfer();
                $store->detail_income_id = $id;
                $store->bank_transfer=$bank->id;
                $store->transfer_date =$date_transfer;
                $store->created_at= $now;
                $store->total_transfer = $nilai;
                $store->note = $noted;
                $store->save();

               
                if($updates->statusy==1){
                 
                  DB::table('contributor_notif')->insert([
                      'contributor_id'=> $updates->contributor_id,
                      'category'     =>'transfer',
                      'title'        => 'fee sudah ditransfer oleh admin',
                      'notif'        => 'fee '.$bulan.' '.$updates->year.' telah ditransfer oleh admin ke rekening '.$bank->bank.' anda',
                      'status'       => 0,
                      'created_at'   => new DateTime()
                  ]);
                }
            }


            // redirect
            return redirect()->back()->with('success','Data successfully updated');
        }
    }



}
