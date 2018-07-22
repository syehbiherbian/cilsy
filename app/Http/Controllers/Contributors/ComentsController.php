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
use App\Models\UserNotif;
use App\Models\Member;
use App\Models\Lesson;
use App\Notifications\ContribReplyNotification;
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
            // ->where('comments.status',0)
            // ->where('member_id','!=',null)
            ->where('comments.contributor_id',$uid)
            ->where('desc', '<>', 1)
            ->orderBy('comments.created_at','DESC')
            ->select('comments.*')
            ->get();
        $getabaikan = DB::table('comments')
            ->leftJoin('lessons','lessons.id','=','comments.lesson_id')
            // ->where('comments.parent_id',0)
            // ->where('comments.status',0)
            // ->where('member_id','!=',null)
            ->where('comments.contributor_id',$uid)
            ->orderBy('comments.created_at','DESC')
            ->select('comments.*')
            ->get();
        return view('contrib.coments.index', [
            'data' => $getcomment,
            'abaikan'=>$getabaikan,
            'id'=>$uid,
        ]);
    }

    public function detail($id){
        
        $uid = Auth::guard('contributors')->user()->id ?? null;
        if (!$uid) {
        return redirect('contributor/login?next=/contributor/comments/detail/'.$id);
        }
        $detailcomment  = DB::table('comments')->where('id',$id)->first();
        $getlesson      = DB::table('lessons')->where('id',$detailcomment->lesson_id)->first();
        $getcomment     = DB::table('comments')
                    ->leftJoin('members','members.id','=','comments.member_id')
                    ->where('comments.lesson_id',$getlesson->id)
                    ->where('comments.parent_id',0)
                    ->where('comments.status',1)
                    ->orderBy('comments.created_at','DESC')
                    ->select('comments.*','members.username as username')
                    ->get();

            DB::table('comments')
            ->where('comments.lesson_id',$getlesson->id)
            ->where('comments.status',0)
            ->update(['status' => 1]);

            DB::table('contributor_notif')
            ->where('contributor_notif.slug',$id)
            ->where('contributor_notif.status',0)
            ->update(['status' => 1]);

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
        $member_id  = Input::get('member_id');
         

        $lessons = DB::table('lessons')->where('id',$lesson_id)->first();
        $notify = DB::table('comments')->where('id', $comment_id)->first();
        $contrib = Contributor::find($uid);

        DB::table('comments')->insert([
            'lesson_id'     => $lesson_id,
            'member_id'     => null,
            'contributor_id'=> $uid,
            'body'          => $isi_balas,
            'parent_id'     => $comment_id,
            'status'        => '0',
            'desc'        => '1',
            'created_at'    => new DateTime()
        ]);

        

        $notif_user =   DB::table('user_notif')->insertGetId([
                        'id_user'=> $notify->member_id,
                        'category'=>'comments',
                        'title'   => 'Anda mendapatkan balasan dari pertanyaan anda di tutorial ' . $lessons->title,
                        'notif'   => 'Anda mendapatkan balasan dari pertanyaan anda dari ' . Auth::guard('contributors')->user()->username,
                        'status'  => 0,
                        'slug'    => $lessons->slug,
                        'created_at'    => new DateTime(),
                        ]);
        
        $mem = DB::table('comments')->where('parent_id','<>', $comment_id)
        ->where('comments.member_id', '<>',$uid)
        ->select('comments.member_id')
        ->orderby('comments.created_at', 'DESC')
        ->first();
        // if(!empty($mem)){
          
        // $notif_nimbrung =   DB::table('user_notif')->insertGetId([
        //     'id_user'=> $mem->member_id,
        //     'category'=>'comments',
        //     'title'   => 'Anda mendapatkan balasan dari pertanyaan anda di tutorial ' . $lessons->title,
        //     'notif'   => 'Anda mendapatkan balasan dari pertanyaan anda dari ' . Auth::guard('contributors')->user()->username,
        //     'status'  => 0,
        //     'slug'    => $lessons->slug,
        //     'created_at'    => new DateTime(),
        // ]);  
        // $nimbrung = Member::Find($mem->member_id);
        // $nimbrung->notify(new ContribReplyNotification([$nimbrung, $lesson, $contrib]));

        // }


        $member = Member::Find($notify->member_id);

        $lesson = Lesson::Find($lesson_id);
        $contrib = Contributor::find($uid);

        // $member->notify(new ContribReplyNotification([$member, $lesson, $contrib]));

        // $check=DB::table('comments')->where('parent_id',$comment_id)->get();

        // if(count($check)==1){
        //     $check_contri=Contributor::where('id',$uid)->first();
        //     if(count($check_contri)>0){
        //       $contri = Contributor::find($uid);
        //       $contri->points      = $check_contri->points + 3;
        //       $contri->updated_at  = new DateTime();
        //       $contri->save();

        //     //   DB::table('contributor_notif')->insert([
        //     //       'contributor_id'=> $uid,
        //     //       'category'=>'point',
        //     //       'title'   => 'Anda mendapatkan penambahan 3 point',
        //     //       'notif'        => 'Anda mendapatkan penambahan sebanyak 3 point karena  mereply komentar dari '.$lessons->title.' ',
        //     //       'status'        => 0,
        //     //       'created_at'    => new DateTime()
        //     //   ]);
        //     }

        // }

        // DB::table('contributor_notif')->insert([
        //     'contributor_id'=> $uid,
        //     'category'=>'comments',
        //     'title'   => 'Anda berhasil mereply komentar',
        //     'notif'        => 'Anda berhasil mereply komentar pada '.$lessons->title,
        //     'status'        => 0,
        //     'created_at'    => new DateTime()
        // ]);
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
