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
use App\Quiz;
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
      ->where('lessons.status',3)
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
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      'title'          => 'required|min:3',
      'category_id'    => 'required',
      'image'          => 'required',
      'description'    => 'required|min:3',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Session::get('contribID');
        $title        = Input::get('title');
        $category_id  = Input::get('category_id');
        $description  = Input::get('description');



        $DestinationPath= 'assets/source/lessons';
        $image        = Input::file('image');

        if(!empty($image)){
            $file    = $image->getClientOriginalName();
            $image->move($DestinationPath, $file);
            $filename   = 'https://cilsy.id/'.$DestinationPath.'/'.$file;
        }else{
            $filename    = '';
        }



        $store                  = new lessons;
        $store->contributor_id  = $cid;
        $store->status          = 0;
        $store->title           = $title;
        $store->slug            = $title;
        $store->category_id     = $category_id;
        $store->image           = $filename;
        $store->description     = $description;
        $store->created_at      = $now;
        $store->updated_at      = $now;
        $store->save();


        return redirect('contributor/lessons/'.$store->id.'/edit')->with('success','Pembuatan tutorial berhasil');

    }
  }

  public function submit()
  {

    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    # code...

    return view('contrib.lessons.submit');
  }

  // EDIT
  public function edit($id)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    $lessons  = lessons::leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
              ->select('lessons.*','categories.title as category_title')
              ->where('lessons.id',$id)
              ->first();
    $videos   = videos::where('lessons_id',$id)->get();
    $quiz     = Quiz::where('lesson_id',$id)->get();
    $files    = files::where('lesson_id',$id)->get();


    # code...
    return view('contrib.lessons.edit',[
      'lessons'   => $lessons,
      'videos'    => $videos,
      'quiz'      => $quiz,
      'files'     => $files
    ]);
  }








}
