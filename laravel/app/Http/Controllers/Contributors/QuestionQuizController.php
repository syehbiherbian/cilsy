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
}
