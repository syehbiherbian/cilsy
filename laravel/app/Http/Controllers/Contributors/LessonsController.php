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
use App\Questions;
use App\Answars;
use App\revision;
use App\lessons_detail;
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
        ->select('lessons.*','categories.title as category_title')
        ->where('lessons.status',3)
        ->get();
    }else {
      $data = lessons::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->get();
    }
    $now = new DateTime();
    $date= $now->format('Y-m-d');
    $moth=$now->format('m');
    $year=$now->format('Y');
    $views=lessons_detail::where('moth',$moth)->where('year',$year)->get();
    $students=lessons_detail::join('lessons_detail_view','lessons_detail.id','=','lessons_detail_view.detail_id')
                            ->where('lessons_detail.moth',$moth)->where('lessons_detail.year',$year)->get();


    return view('contrib.lessons.index',[
      'filter'  => $filter,
      'data'    => $data,
      'views'=>$views,
      'students'=>$students,
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
            $urls=url('');
            $url_image= $urls.'/assets/source/lessons/'.$lessonsfilename;
        }


        $str = strtolower($title);
        $store                  = new lessons;
        $store->contributor_id  = $cid;
        $store->status          = 0;
        $store->enable          = 1;
        $store->title           = $title;
        $store->slug            = preg_replace('/\s+/', '-', $str);
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

  public function submit($id)
  {

    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    # code...
    $contribID = Session::get('contribID');
    $check = lessons::where('contributor_id',$contribID)
        ->where('id',$id)->first();
    if($check ==null){
        return redirect('not-found');
    }
    $row = lessons::where('contributor_id',$contribID)
        ->where('id',$id)->where('status',0)->first();
        if($row ==null){
            return redirect()->back()->with('no-delete','Totorial sedang / dalam verifikasi!');
        }

        // $checkvideo = videos::where('lessons_id',$id)->get();
        // if(count($checkvideo) < 5){
        //     return redirect()->back()->with('no-delete','Minimal harus 5 buah video 1 tutorial untuk Verifikasi!');
        // }
        // $checkkuis=quiz::where('lesson_id',$id)->get();
        // if(count($checkkuis) < 2){
        //     return redirect()->back()->with('no-delete','Minimal harus ada 2 buah kuis dalam 1 tutorial untuk Verifikasi!');
        // }
        // foreach ($checkkuis as $key => $value) {
        //     $questions=Questions::where('quiz_id',$value->id)->get();
        //     if(count($questions ) < 20 ){
        //         return redirect()->back()->with('no-delete',' Dalam 1 kuis minimal harus membuat 20 soal untuk Verifikasi!');
        //     }
        // }






    return view('contrib.lessons.submit',[
        'row'=>$row,
    ]);

  }

  public function doSubmit($id)
  {
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
      $now                    = new DateTime();;
      $cid                    = Session::get('contribID');
      $store                  = lessons::find($id);
      $store->status          = 2;
      $store->updated_at      = $now;
      $store->save();
      return redirect('contributor/lessons/'.$id.'/view')->with('success','Totorial berhasil di submit!');


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
    $revisi = revision::where('lession_id',$id)->get();
    # code...
    return view('contrib.lessons.view',[
        'row'=>$row,
        'quiz'=>$quiz,
        'video'=>$video,
        'files'=>$files,
        'revisi'=>$revisi,
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
    if($row->status==2){
        return redirect('contributor/lessons/'.$id.'/view')->with('no-delete','Totorial sedang / dalam verifikasi!');
    }
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
              $urls=url('');
              $url_image= $urls.'/assets/source/lessons/'.$lessonsfilename;
          }
          $str = strtolower($title);
          $store                  = lessons::find($id);
          $store->contributor_id  = $cid;
          // $store->status          = 0;
          $store->enable          = 1;
          $store->title           = $title;
          $store->slug            = preg_replace('/\s+/', '-', $str);
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
  public function doDelete($id){
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
     $contribID = Session::get('contribID');
     $lessons =lessons::where('id',$id)->where('contributor_id',$contribID)->delete();
     if($lessons){
         $video =videos::where('lessons_id',$id)->delete();
         $files= files::where('lesson_id',$id)->delete();
         $quiz = Quiz::where('lesson_id',$id)->get();
         foreach ($quiz as $key => $value) {
             $question = Questions::where('quiz_id',$value->id)->get();
             foreach ($question as $key => $qu) {
                  $answer = Answars::where('question_id',$qu->id)->delete();
             }
             Questions::where('quiz_id',$value->id)->delete();

         }
         Quiz::where('lesson_id',$id)->delete();

        return redirect('contributor/lessons')->with('success','Delete totorial berhasil!');
     }else{
        return redirect()->back()->with('no-delete','Delete totorial gagal!');
     }
  }


  public function doProcess($id){

      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
        $now          = new DateTime();
        $cid          = Session::get('contribID');
        $update = revision::find($id);
        $update->status = 2;
        $update->updated_at=$now;
        $update->save();

        return redirect()->back()->with('success','Revisi akan diproses oleh admin!');



  }
}
