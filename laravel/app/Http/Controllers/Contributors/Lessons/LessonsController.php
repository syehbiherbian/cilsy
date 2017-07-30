<?php

namespace App\Http\Controllers\Contributors\Lessons;
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
  public function redirect()
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    return redirect('contributor/lessons/revision/list');
  }


  public function index($filter)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    $contribID = Session::get('contribID');

    if ($filter == 'revision') {
      $data = lessons::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->where('lessons.status',0)
      ->get();
    }elseif ($filter == 'processing') {
      $data = lessons::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->where('lessons.status',2)
      ->get();
    }elseif ($filter == 'publish') {
      $data = lessons::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->where('lessons.status',1)
      ->get();
    }else {
      $data = lessons::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->where('lessons.status',1)
      ->get();
    }

    return view('contrib.lessons.index',[
      'filter'  => $filter,
      'data'    => $data
    ]);

  }

  // CREATE TUTORIAL

  public function create()
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    $categories = categories::where('enable',1)->get();
    # code...
    return view('contrib.lessons.create',[
      'categories' => $categories
    ]);
  }

  public function doCreate()
  {
    # code...
  }

  public function submit()
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    # code...
    return view('contrib.lessons.create.submit');
  }


  // EDIT
  public function edit($id)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    # code...
    return view('contrib.lessons.edit');
  }








}
