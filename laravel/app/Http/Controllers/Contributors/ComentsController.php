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
use App\Model\Contributor;
class ComentsController extends Controller
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
        $getcomment = DB::table('coments')
            ->leftJoin('lessons','lessons.id','=','coments.lesson_id')
            ->where('coments.parent',0)
            // ->where('coments.status',0)
            // ->where('member_id','!=',null)
            ->where('lessons.contributor_id',$uid)
            ->orderBy('coments.created_at','DESC')
            ->select('coments.*')
            ->get();

        $getabaikan = DB::table('coments')
            ->leftJoin('lessons','lessons.id','=','coments.lesson_id')
            ->where('coments.parent',0)
            // ->where('coments.status',0)
            // ->where('member_id','!=',null)
            ->where('lessons.contributor_id',$uid)
            ->orderBy('coments.created_at','DESC')
            ->select('coments.*')
            ->get();
        return view('contrib.coments.index', [
            'data' => $getcomment,
            'abaikan'=>$getabaikan
        ]);
    }

    public function detail($id){
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $uid = Session::get('contribID');

        $detailcomment  = DB::table('coments')->where('id',$id)->first();
        $getlesson      = DB::table('lessons')->where('id',$detailcomment->lesson_id)->first();
        $getcomment     = DB::table('coments')
            ->leftJoin('members','members.id','=','coments.member_id')
            ->where('coments.lesson_id',$getlesson->id)
            ->where('coments.parent',0)
            ->where('coments.status',0)
            ->orderBy('coments.created_at','DESC')
            ->select('coments.*','members.username as username')
            ->get();

        if ($getlesson->contributor_id == $uid) {
            return view('contrib.coments.detail',[
                'datalesson'    => $getlesson,
                'datacomment'   => $getcomment
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function postcomment(){
        if (empty(Session::get('contribID'))) {
            return 0;
            exit();
        }
        $uid = Session::get('contribID');
        $isi_balas  = Input::get('isi_balas');
        $comment_id = Input::get('comment_id');
        $lesson_id  = Input::get('lesson_id');
        $lessons = DB::table('lessons')->where('id',$lesson_id)->first();

        DB::table('coments')->insert([
            'lesson_id'     => $lesson_id,
            'contributor_id'=> $uid,
            'description'   => $isi_balas,
            'parent'        => $comment_id,
            'status'        => 0,
            'created_at'    => new DateTime()
        ]);
        $check=DB::table('coments')->where('parent',$comment_id)->get();
        if(count($check)==1){
            $check_contri=Contributor::where('id',$uid)->first();
            if(count($check_contri)>0){
              $contri = Contributor::find($uid);
              $contri->points      = $check_contri->points + 3;
              $contri->updated_at  = new DateTime();
              $contri->save();

              DB::table('contributor_notif')->insert([
                  'contributor_id'=> $uid,
                  'category'=>'point',
                  'title'   => 'Anda mendapatkan pemambahan 3 point',
                  'notif'        => 'Anda mendapatkan pemambahan sebanyak 3 point karena  mereplay komentar dari '.$lessons->title.' ',
                  'status'        => 0,
                  'created_at'    => new DateTime()
              ]);
            }

        }

        DB::table('contributor_notif')->insert([
            'contributor_id'=> $uid,
            'category'=>'coments',
            'title'   => 'Anda berhasil mereplay komentar',
            'notif'        => 'Anda berhasil mereplay komentar pada '.$lessons->title,
            'status'        => 0,
            'created_at'    => new DateTime()
        ]);
        return 1;

    }

    public function deletecomment($id){
        if (empty(Session::get('contribID'))) {
          return redirect('contributor/login');
        }
        $uid = Session::get('contribID');
        $detailcomment  = DB::table('coments')->where('id',$id)->first();
        $getlesson      = DB::table('lessons')->where('id',$detailcomment->lesson_id)->first();

        if ($getlesson->contributor_id == $uid) {
            DB::table('coments')->where('id',$id)->update([
                'status' => 1
            ]);

            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    // public function create()
    // {
    //   if (empty(Session::get('contribID'))) {
    //     return redirect('contributor/login');
    //   }
    //   # code...
    //   return view('contrib.questions.create');
    // }
}
