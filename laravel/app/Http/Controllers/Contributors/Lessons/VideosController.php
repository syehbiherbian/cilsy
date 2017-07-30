<?php

namespace App\Http\Controllers\Contributors\Lessons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use DateTime;

use App\videos;
class VideosController extends Controller
{
  public function create()
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    # code...
    // return view('contrib.videos.create');
  }

}
