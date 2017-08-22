<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Quiz;
use App\Questions;
use App\videos;
use DateTime;
use Session;
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
           $store->appear =$video;
           $store->description =$desc;
           $store->created_at =$now;
           $store->save();

           return Redirect('contributor/lessons/quiz/'.$store->id.'/create/questions');
  }
  public function edit($quiz_id){
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    $row=Quiz::where('quiz_id','=',$quiz_id)->first();
    $lessons=lessons::where('lessons.id',$row->lessons_id)->first();
    $question=Questions::where('quiz_id',$row->quiz);
    $video= videos::where('lessons_id',$row->lessons_id)->get();
    # code...
    return view('contrib.quiz.edit', [
        'row'=>$row,
        'question'=>$question,
        'video'=>$video,
        'lessons'=>$lessons
    ]);
  }

}
