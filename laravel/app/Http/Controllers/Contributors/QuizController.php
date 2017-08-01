<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Quiz;
use App\lessons;
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
    return view('contrib.quiz.create', [
      'lessons_id'=>$lessons_id,
    ]);
  }
  public function store_quiz($lessons_id){
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    var_dump($lessons_id);
    exit();
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
          //  $store->

  }
}
