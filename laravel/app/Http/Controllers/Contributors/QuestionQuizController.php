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
      $quiz = Quiz::where('id',$quiz_id)->first();
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

              $count=Questions::where('id',$quiz_id)->count();
              $i=0;
              foreach ($question as $key => $questions) {
                $no =$i + 1 + $count;
                $store_question= new Questions();
                $store_question->quiz_id =$quiz_id;
                $store_question->question =$questions;
                $store_question->question_no=$no;
                $store_question->created_at =$now;
                $store_question->save();
                $answer           = Input::get('answer'.$i);

                $check=Questions::where('quiz_id','=',$quiz_id)->orderBy('id','=','desc')->first();
                $j=0;
                foreach ($answer as $key => $a) {
                  $check_a= Answars::where('question_id','=',$check->question_id)->where('type','=','a')->get();
                  $store_answer_a = new Answars();
                  $store_answer_a->question_id= $check->id;
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
              $checks=Quiz::where('id','=',$quiz_id)->first();

              return Redirect('contributor/lessons/'.$checks->lesson_id.'/edit')->with('success','Terimakasih, Quiz berhasil di simpan');
      }

      public function edit($quiz_id){
          if (empty(Session::get('contribID'))) {
            return redirect('contributor/login');
          }
          $quiz = Quiz::where('id',$quiz_id)->first();
          if(count($quiz) < 1){
            return redirect()->back()->with('get_errol','sorry, data not found');
          }
          $question = Questions::where('quiz_id',$quiz_id)->get();
          $answer = Answars::all();
          # code...
          return view('contrib.questions-quiz.edit',[
              'quiz'=>$quiz,
              'question'=>$question,
              'answer'=>$answer,
          ]);
      }

      public function update(Request $request, $quiz_id){
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
               //delete questin old
               $checkdata=Questions::where('quiz_id',$quiz_id)->get();
                foreach ($checkdata as $key => $questions) {
                  DB::table('answers')->where('question_id',$questions->question_id)->delete();
                }
                DB::table('questions')->where('quiz_id',$quiz_id)->delete();

                $i=0;
                foreach ($question as $key => $questions) {
                  $no = $i + 1 ;
                  $store_question= new Questions();
                  $store_question->quiz_id =$quiz_id;
                  $store_question->question =$questions;
                  $store_question->question_no=$no;
                  $store_question->created_at =$now;
                  $store_question->save();
                  $answer           = Input::get('answer'.$i);

                  $check=Questions::where('quiz_id','=',$quiz_id)->orderBy('id','=','desc')->first();
                  $j=0;
                  foreach ($answer as $key => $a) {
                    $check_a= Answars::where('question_id','=',$check->question_id)->where('type','=','a')->get();
                    $store_answer_a = new Answars();
                    $store_answer_a->question_id= $check->id;
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
                $checks=Quiz::where('id','=',$quiz_id)->first();

                return Redirect('contributor/lessons/quiz/'.$quiz_id.'/edit')->with('success','Terimakasih, Quiz berhasil di update');
        }
}
