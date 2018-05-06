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
use App\Models\Contributor;
use Auth;

class ComentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $uid = Auth::guard('contributors')->user()->id;
        $getcomment = DB::table('comments')
            ->leftJoin('lessons','lessons.id','=','comments.lesson_id')
            ->where('comments.parent_id',0)
            // ->where('comments.status',0)
            // ->where('member_id','!=',null)
            ->where('lessons.contributor_id',$uid)
            ->orderBy('comments.created_at','DESC')
            ->select('comments.*')
            ->get();
        // dd($getcomment);
        $getabaikan = DB::table('comments')
            ->leftJoin('lessons','lessons.id','=','comments.lesson_id')
            ->where('comments.parent_id',0)
            // ->where('comments.status',0)
            // ->where('member_id','!=',null)
            ->where('lessons.contributor_id',$uid)
            ->orderBy('comments.created_at','DESC')
            ->select('comments.*')
            ->get();
        // dd($getcomment);
        return view('contrib.coments.index', [
            'data' => $getcomment,
            'abaikan'=>$getabaikan
        ]);
    }

    public function detail($id){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $uid = Auth::guard('contributors')->user()->id;

        $detailcomment  = DB::table('comments')->where('lesson_id',$id)->first();
        $getlesson      = DB::table('lessons')->where('id',$detailcomment->lesson_id)->first();
        $getcomment     = DB::table('comments')
            ->leftJoin('members','members.id','=','comments.member_id')
            ->where('comments.lesson_id',$getlesson->id)
            ->where('comments.parent_id',0)
            ->where('comments.status',0)
            ->orderBy('comments.created_at','DESC')
            ->select('comments.*','members.username as username')
            ->get();
        // dd($detailcomment);
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
        if (empty(Auth::guard('contributors')->user()->id)) {
            return 0;
            exit();
        }
        $uid = Auth::guard('contributors')->user()->id;
        $isi_balas  = Input::get('isi_balas');
        $comment_id = Input::get('comment_id');
        $lesson_id  = Input::get('lesson_id');
        $lessons = DB::table('lessons')->where('id',$lesson_id)->first();

        DB::table('comments')->insert([
            'lesson_id'     => $lesson_id,
            'contributor_id'=> $uid,
            'body'   => $isi_balas,
            'parent_id'        => $comment_id,
            'status'        => 0,
            'created_at'    => new DateTime()
        ]);
        $check=DB::table('comments')->where('parent_id',$comment_id)->get();
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
                  'title'   => 'Anda mendapatkan penambahan 3 point',
                  'notif'        => 'Anda mendapatkan penambahan sebanyak 3 point karena  mereply komentar dari '.$lessons->title.' ',
                  'status'        => 0,
                  'created_at'    => new DateTime()
              ]);
            }

        }

        DB::table('contributor_notif')->insert([
            'contributor_id'=> $uid,
            'category'=>'comments',
            'title'   => 'Anda berhasil mereply komentar',
            'notif'        => 'Anda berhasil mereply komentar pada '.$lessons->title,
            'status'        => 0,
            'created_at'    => new DateTime()
        ]);
        return 1;

    }

    public function deletecomment($id){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $uid = Auth::guard('contributors')->user()->id;
        $detailcomment  = DB::table('comments')->where('id',$id)->first();
        $getlesson      = DB::table('lessons')->where('id',$detailcomment->lesson_id)->first();

        if ($getlesson->contributor_id == $uid) {
            DB::table('comments')->where('id',$id)->update([
                'status' => 1
            ]);

            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    // public function create()
    // {
    //   if (empty(Auth::guard('contributors')->user()->id)) {
    //     return redirect('contributor/login');
    //   }
    //   # code...
    //   return view('contrib.questions.create');
    // }
}
