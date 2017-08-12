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
use App\Quiz;
use App\Questions;
use App\Answars;
class QuestionQuizController extends Controller
{

    public function create($quiz_id)
    {
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
      $quiz = Quiz::where('quiz_id',$quiz_id)->first();
      if(count($quiz) < 1){
        return redirect()->back()->with('get_errol','sorry, data not found');
      }
      # code...
      return view('contrib.questions-quiz.create',[
          'quiz'=>$quiz,
      ]);
    }

    public function store(Request $request, $quiz_id){
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
      //Store new Data
             $validator = Validator::make($request->all(), [
                 'question'            => 'required',
             ]);

             if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
             }
             $now                = new DateTime();
             $question           = Input::get('question');

              $i=0;
              foreach ($question as $key => $questions) {
                $store_question= new Questions();
                $store_question->quiz_id =$quiz_id;
                $store_question->question =$questions;
                $store_question->created_at =$now;
                $store_question->save();
                $answer           = Input::get('answer'.$i);

                $check=Questions::where('quiz_id','=',$quiz_id)->orderBy('question_id','=','desc')->first();
                $j=0;
                foreach ($answer as $key => $a) {
                  $check_a= Answars::where('question_id','=',$check->question_id)->where('type','=','a')->get();
                  $store_answer_a = new Answars();
                  $store_answer_a->question_id= $check->question_id;
                  $store_answer_a->type = $j;
                  $store_answer_a->answer = $a;
                  $question_key     = Input::get('question_key'.$i.'_'.$j);
                  if(!empty($question_key)){
                     $key_s=1;
                   }else{
                     $key_s=0;
                   }
                  $store_answer_a->answer_key = $key_s;
                  $store_answer_a->created_at = $now;
                  $store_answer_a->save();
                  $j++;
                }

                 $i++;
              }
              $checks=Quiz::where('quiz_id','=',$quiz_id)->first();

              return Redirect('contributor/lessons/'.$checks->lesson_id.'/edit')->with('success','Terimakasih, Quiz berhasil di simpan');
      }
}
