<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Quiz;
use App\Questions;
use App\videos;
use App\lessons;
use DateTime;
use Session;
use DB;
class QuizController extends Controller
{
  public function create($lessons_id)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    # code...

    $data = lessons::where('contributor_id',Session::get('contribID'))
    ->where('id',$lessons_id)
    ->first();
    if(empty($data)){
      return redirect()->back();
    }

    $video= videos::where('lessons_id',$lessons_id)->get();

    return view('contrib.quiz.create', [
      'lessons_id'=>$lessons_id,
      'video' =>$video,
    ]);
  }
  public function store_quiz(Request $request, $lessons_id){
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    //Store new Data
           $validator = Validator::make($request->all(), [
               'title'            => 'required',
               'video'            => 'required',
               'desc'             =>'required',
           ]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();
           }
           $now                = new DateTime();
           $title             = Input::get('title');
           $video              = Input::get('video');
           $desc             = Input::get('desc');
           $store = new Quiz();
           $store->lesson_id =$lessons_id;
           $store->title =$title;
           $store->video_id =$video;
           $store->description =$desc;
           $store->created_at =$now;
           $store->save();

           return Redirect('contributor/lessons/quiz/'.$store->id.'/create/questions');
  }

  public function edit($quiz_id){
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    $row=Quiz::where('id','=',$quiz_id)->first();
    if($row==null){
      return redirect()->back();
    }
    $lessons=lessons::where('lessons.id',$row->lesson_id)->first();
    $question=Questions::where('quiz_id',$row->id)->get();
    $video= videos::where('lessons_id',$row->lesson_id)->get();
    # code...
    return view('contrib.quiz.edit', [
        'row'=>$row,
        'question'=>$question,
        'video'=>$video,
        'lessons'=>$lessons
    ]);
  }

  public function update_quiz(Request $request, $quiz_id){
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    //Store new Data
           $validator = Validator::make($request->all(), [
               'title'            => 'required',
               'video'            => 'required',
               'desc'             =>'required',
           ]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();
           }

           $now                = new DateTime();
           $title             = Input::get('title');
           $video              = Input::get('video');
           $desc             = Input::get('desc');
           $store =  Quiz::find($quiz_id);
           $store->title =$title;
           $store->video_id =$video;
           $store->description =$desc;
           $store->updated_at =$now;
           $store->save();

           return Redirect()->back()->with('success','Quiz Berhasil di update');
  }

  public function delete_quiz($id){
       $data= DB::table('quiz')->where('id',$id)->first();
       $checkdata=Questions::where('id',$id)->get();
        foreach ($checkdata as $key => $questions) {
          DB::table('answers')->where('question_id',$questions->question_id)->delete();
        }

        $i = DB::table('quiz')->where('id',$id)->delete();
        if($i > 0)
        {
          return redirect('contributor/lessons/'.$data->lesson_id.'/edit')->with('success-delete','Quiz berhasil di hapus');
        }else{
        return redirect()->back()->with('no-delete','Can not be removed!');
        }

  }

}
