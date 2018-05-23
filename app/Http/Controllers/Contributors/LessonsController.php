<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Models\Member;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\Service;
use App\Models\File;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Revision;
use App\Models\LessonDetail;
use DateTime;
use Auth;


use Session;
class LessonsController extends Controller
{
  //
  public function redirect()
  {
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    return redirect('contributor/lessons/pending/list');
  }


  public function index($filter)
  {

    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }

    $contribID = Auth::guard('contributors')->user()->id;
    if ($filter == 'pending') {
      $data = Lesson::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->where('lessons.status',1)
      ->orderby('created_at', 'desc')
      ->get();
    }elseif ($filter == 'processing') {
      $data = Lesson::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->where('lessons.status',2)
      ->get();
    }elseif ($filter == 'publish') {
      $data = Lesson::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->where('lessons.status',1)
      ->get();
    }elseif($filter == 'revision'){
        $data = Lesson::where('contributor_id',$contribID)
        ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
        ->select('lessons.*','categories.title as category_title')
        ->where('lessons.status',3)
        ->get();
    }else {
      $data = Lesson::where('contributor_id',$contribID)
      ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
      ->select('lessons.*','categories.title as category_title')
      ->get();
    }
    $now = new DateTime();
    $date= $now->format('Y-m-d');
    $moth=$now->format('m');
    $year=$now->format('Y');
    $views=LessonDetail::where('moth',$moth)->where('year',$year)->get();
    $students=LessonDetail::join('lessons_detail_view','lessons_detail.id','=','lessons_detail_view.detail_id')
                            ->where('lessons_detail.moth',$moth)->where('lessons_detail.year',$year)->get();


    return view('contrib.lessons.index',[
      'filter'  => $filter,
      'data'    => $data,
      'views'   => $views,
      'students'=> $students,
    ]);

  }

  // CREATE TUTORIAL

  public function create()
  {
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }

    $categories = Category::where('enable',1)->get();
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
      'price'          => 'required|min:3',
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
        $cid          = Auth::guard('contributors')->user()->id;
        $title        = Input::get('title');
        $price        = Input::get('price');
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
        $store                  = new Lesson();
        $store->contributor_id  = $cid;
        $store->status          = 1;
        $store->enable          = 1;
        $store->title           = $title;
        $store->price           = $price;
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

        return redirect('contributor/lessons/'.$store->id.'/view')->with('success','Pembuatan tutorial berhasil');

    }
  }

  public function submit($id)
  {

    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    # code...
    $contribID = Auth::guard('contributors')->user()->id;
    $check = Lesson::where('contributor_id',$contribID)
        ->where('id',$id)->first();
    if($check ==null){
        return redirect('not-found');
    }
    // $row = Lesson::where('contributor_id',$contribID)
    //     ->where('id',$id)->where('status',0)->first();
    //     if($row ==null){
    //         return redirect()->back()->with('no-delete','Tutorial sedang / dalam verifikasi!');
    //     }

        // $checkvideo = Video::where('lessons_id',$id)->get();
        // if(count($checkvideo) < 5){
        //     return redirect()->back()->with('no-delete','Minimal harus 5 buah video 1 tutorial untuk Verifikasi!');
        // }
        // $checkkuis=quiz::where('lesson_id',$id)->get();
        // if(count($checkkuis) < 2){
        //     return redirect()->back()->with('no-delete','Minimal harus ada 2 buah kuis dalam 1 tutorial untuk Verifikasi!');
        // }
        // foreach ($checkkuis as $key => $value) {
        //     $questions=Question::where('quiz_id',$value->id)->get();
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
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
      $now                    = new DateTime();;
      $cid                    = Auth::guard('contributors')->user()->id;
      $store                  = Lesson::find($id);
      $store->status          = 2;
      $store->updated_at      = $now;
      $store->save();
      return redirect('contributor/lessons/'.$id.'/view')->with('success','Tutorial berhasil di submit!');


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
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }

    $contribID = Auth::guard('contributors')->user()->id;
    $row = Lesson::where('contributor_id',$contribID)
    ->where('lessons.id',$id)
    ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
    ->leftJoin('lessons_detail','lessons.id','lessons_detail.lesson_id')
    ->select('lessons.*','categories.title as category_title')
    ->first();
    $video =Video::where('lessons_id',$id)->get();
    $quiz = Quiz::where('lesson_id',$id)->get();
    $files= File::where('lesson_id',$id)->get();
    $revisi = Revision::where('lession_id',$id)->get();
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
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    $categories = Category::where('enable',1)->get();
    $contribID = Auth::guard('contributors')->user()->id;
    $row = Lesson::where('contributor_id',$contribID)
    ->where('lessons.id',$id)
    ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
    ->leftJoin('lessons_detail','lessons.id','lessons_detail.lesson_id')
    ->select('lessons.*','categories.title as category_title')
    ->first();
    if($row->status==2){
        return redirect('contributor/lessons/'.$id.'/view')->with('no-delete','Tutorial sedang / dalam verifikasi!');
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
        'price'          => 'required|min:3',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $now          = new DateTime();
          $cid          = Auth::guard('contributors')->user()->id;
          $title        = Input::get('title');
          $category_id  = Input::get('category_id');
          $price        = Input::get('price');
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
          $store                  = Lesson::find($id);
          $store->contributor_id  = $cid;
          // $store->status          = 0;
          $store->enable          = 1;
          $store->title           = $title;
          $store->price           = $price;
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

          return redirect('contributor/lessons/'.$id.'/view')->with('success','Update tutorial berhasil!');

      }
  }
  public function doDelete($id){
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
     $contribID = Auth::guard('contributors')->user()->id;
     $lessons =Lesson::where('id',$id)->where('contributor_id',$contribID)->delete();
     if($lessons){
         $video =Video::where('lessons_id',$id)->delete();
         $files= File::where('lesson_id',$id)->delete();
         $quiz = Quiz::where('lesson_id',$id)->get();
         foreach ($quiz as $key => $value) {
             $question = Question::where('quiz_id',$value->id)->get();
             foreach ($question as $key => $qu) {
                  $answer = Answer::where('question_id',$qu->id)->delete();
             }
             Question::where('quiz_id',$value->id)->delete();

         }
         Quiz::where('lesson_id',$id)->delete();

        return redirect('contributor/lessons')->with('success','Delete tutorial berhasil!');
     }else{
        return redirect()->back()->with('no-delete','Delete tutorial gagal!');
     }
  }


  public function doProcess($id){

      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
        $now          = new DateTime();
        $cid          = Auth::guard('contributors')->user()->id;
        $update = Revision::find($id);
        $update->status = 2;
        $update->updated_at=$now;
        $update->save();

        return redirect()->back()->with('success','Revisi akan diproses oleh admin!');



  }
}
