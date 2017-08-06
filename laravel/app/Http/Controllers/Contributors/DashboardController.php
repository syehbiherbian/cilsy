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
class DashboardController extends Controller
{

  public function index()
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    return view('contrib.dashboard');

  }

}
