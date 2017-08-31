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
use App\Quiz;
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
    return redirect('contributor/lessons/pending/list');
  }


  public function index($filter)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    $contribID = Session::get('contribID');
    if ($filter == 'pending') {
      $data = lessons::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->leftJoin('lessons_detail','lessons.id','lessons_detail.lesson_id')
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
    }elseif($filter == 'revision'){
        $data = lessons::where('contributor_id',$contribID)
        ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
        ->leftJoin('lessons_detail','lessons.id','lessons_detail.lesson_id')
        ->select('lessons.*','categories.title as category_title')
        ->where('lessons.status',3)
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
        $lessons_image = Input::file('image');
        $description  = Input::get('description');

        $lessonsDestinationPath= 'assets/source/lessons';

        if(!empty($lessons_image)){
            $lessonsfilename    = $lessons_image->getClientOriginalName();
            $lessons_image->move($lessonsDestinationPath, $lessonsfilename);
        }else{
            $lessonsfilename    = '';
        }
        if($lessonsfilename ==''){
            $url_image= $lessonsfilename;
        }else{
            $url_image= 'http://localhost:8080/cilsy/assets/source/lessons/'.$lessonsfilename;
        }



        $store                  = new lessons;
        $store->contributor_id  = $cid;
        $store->status          = 0;
        $store->title           = $title;
        $store->slug            = $category_id;
        $store->category_id     = $category_id;
        $store->image           = $url_image;
        $store->description     = $description;
        $store->created_at      = $now;
        $store->save();
        // Session::set('lessons_title',$title);
        // Session::set('lessons_category_id',$category_id);
        // Session::set('lessons_image',$image);
        // Session::set('lessons_description',$description);

        return redirect('contributor/lessons/'.$store->id.'/view')->with('success','Pembuatan totorial berhasil');

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

  public function doSubmit()
  {
      $now                    = new DateTime();;
      $cid                    = Session::get('contribID');
      // Lessons
      $lessons_title          = Session::get('lessons_title');
      $lessons_category_id    = Session::get('lessons_category_id');
      $lessons_description    = Session::get('lessons_description');


      $lessonsDestinationPath= 'assets/source/lessons';
      $lessons_image          = Session::get('lessons_image');

      if(!empty($lessons_image)){
          $lessonsfilename    = $lessons_image->getClientOriginalName();
          $lessons_image->move($lessonsDestinationPath, $lessonsfilename);
      }else{
          $lessonsfilename    = '';
      }


      $store                  = new lessons;
      $store->contributor_id  = $cid;
      $store->status          = 0;
      $store->title           = $lessons_title;
      $store->slug            = $lessons_title;
      $store->category_id     = $lessons_category_id;
      $store->image           = $lessonsfilename;
      $store->description     = $lessons_description;
      $store->created_at      = $now;
      $store->updated_at      = $now;
      $store->save();

      // Videos

      // Attachments

      // Quiz

      // Questions


      $forget = $this->forgetSession();
      if ($forget == true) {
          return redirect('contributor/lessons')->with('success','');
      }


  }

  private static function forgetSession()
  {

    Session::forget('lessons_title');
    Session::forget('lessons_category_id');
    Session::forget('lessons_image');
    Session::forget('lessons_description');

    return true;

  }

  // view
  public function view($id)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    $contribID = Session::get('contribID');
    $row = lessons::where('contributor_id',$contribID)
    ->where('lessons.id',$id)
    ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
    ->leftJoin('lessons_detail','lessons.id','lessons_detail.lesson_id')
    ->select('lessons.*','categories.title as category_title')
    ->first();
    $video =videos::where('lessons_id',$id)->get();
    $quiz = Quiz::where('lesson_id',$id)->get();
    $files= files::where('lesson_id',$id)->get();
    # code...
    return view('contrib.lessons.view',[
        'row'=>$row,
        'quiz'=>$quiz,
        'video'=>$video,
        'files'=>$files,
    ]);
  }

  public function edit($id)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    $categories = categories::where('enable',1)->get();
    $contribID = Session::get('contribID');
    $row = lessons::where('contributor_id',$contribID)
    ->where('lessons.id',$id)
    ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
    ->leftJoin('lessons_detail','lessons.id','lessons_detail.lesson_id')
    ->select('lessons.*','categories.title as category_title')
    ->first();
    # code...
    return view('contrib.lessons.edit',[
        'row'=>$row,
        'categories'=>$categories,
    ]);
  }
  public function doEdit($id){
      # code...
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'title'          => 'required|min:3',
        'category_id'    => 'required',
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
          $lessons_image = Input::file('image');
          $image_text =  Input::get('image_text');
          $description  = Input::get('description');

          $lessonsDestinationPath= 'assets/source/lessons';

          if(!empty($lessons_image)){
              $lessonsfilename    = $lessons_image->getClientOriginalName();
              $lessons_image->move($lessonsDestinationPath, $lessonsfilename);
          }else{
              $lessonsfilename = '';
          }
          if($lessonsfilename ==''){
              $url_image= $image_text;
          }else{
              $url_image= 'http://localhost:8080/cilsy/assets/source/lessons/'.$lessonsfilename;
          }

          $store                  = lessons::find($id);
          $store->contributor_id  = $cid;
          $store->status          = 0;
          $store->title           = $title;
          $store->slug            = $category_id;
          $store->category_id     = $category_id;
          $store->image           = $url_image;
          $store->description     = $description;
          $store->created_at      = $now;
          $store->save();
          // Session::set('lessons_title',$title);
          // Session::set('lessons_category_id',$category_id);
          // Session::set('lessons_image',$image);
          // Session::set('lessons_description',$description);

          return redirect('contributor/lessons/'.$id.'/view')->with('success','Update totorial berhasil!');

      }
  }
}
