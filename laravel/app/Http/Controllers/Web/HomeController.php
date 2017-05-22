<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\categories;
use App\lessons;

class HomeController extends Controller
{
    //
    public function index()
    {
      # code...
      $categories = categories::where('enable','=',1)->get();
      $lessons    = lessons::where('enable','=',1)->get();

      return view('web.home',[
        'categories'  =>$categories,
        'lessons'     =>$lessons
      ]);
    }
}
