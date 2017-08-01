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
class QuestionQuizController extends Controller
{

    public function create()
    {
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
      # code...
      return view('contrib.questions.create');
    }
}
