<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;

use App\members;
use App\lessons;
use App\categories;
use App\videos;
use App\services;
use App\files;
use DateTime;

use Session;
class LessonsController extends Controller
{
  //
  // public function default()
  // {
  //   return redirect('lessons/pending/list');
  // }

  public function index($filter)
  {

    return view('contrib.lessons.index',[
      'filter' => $filter
    ]);

  }

  public function create()
  {
    # code...
    return view('contrib.lessons.create.index');
  }

  public function video()
  {
    # code...
    return view('contrib.lessons.create.video');
  }
  public function attachment()
  {
    # code...
    return view('contrib.lessons.create.attachment');
  }
  public function quiz()
  {
    # code...
    return view('contrib.lessons.create.quiz');
  }
  public function questions()
  {
    # code...
    return view('contrib.lessons.create.questions');
  }

  public function submit()
  {
    # code...
    return view('contrib.lessons.create.submit');
  }






}
