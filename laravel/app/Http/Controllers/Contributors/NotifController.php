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
use App\Contributors;
use App\contributor_notif;
class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $uid = Session::get('contribID');
        $getnotif = DB::table('contributor_notif')
            ->where('contributor_id',$uid)
            ->orderBy('contributor_notif.created_at','DESC')
            ->get();
        return view('contrib.notif.index', [
            'data' => $getnotif
        ]);
    }

    public function read(){
      $id = Input::get('id');
      $update= contributor_notif::find($id);
      $update->status=1;
      $update->save();
    }
    public function view(){
      $id = Input::get('id');
      $update= contributor_notif::find($id);
      $update->status=2;
      $update->save();
    }

    public function delete($id){
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $uid = Session::get('contribID');
        $detail  = DB::table('contributor_notif')
        ->where('id',$id)->first();
        if ($detail->contributor_id == $uid) {
            DB::table('contributor_notif')->where('id',$id)->update([
                'status' => 1,
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

}
