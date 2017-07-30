<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;

use DateTime;

use Session;
class QuizController extends Controller
{
  public function create()
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    # code...
    return view('contrib.quiz.create');
  }
}
