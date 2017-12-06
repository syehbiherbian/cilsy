<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use DateTime;
use App\videos;
use App\lessons;
class VideosController extends Controller
{
  public function create($lessonsid)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    $lesson= lessons::where('id',$lessonsid)->first();

    if($lesson==null){
        return redirect('not-found');
    }
    if($lesson->status==2){
        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('no-delete','Totorial sedang / dalam verifikasi!');
    }
    $video=videos::where('lessons_id',$lessonsid)->get();
    $count_video=count($video);

    # code...
    return view('contrib.videos.create',[
        'lesson'=>$lesson,
        'count_video'=>$count_video
    ]);
  }
  public function doCreate($lessonsid)
  {
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
    # code...
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      'judul'          => 'required',
    //   'video.*'  => 'mimes:mp4,mov,ogg,webm |required|max:100000',
    //   'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:30000'
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Session::get('contribID');
        $title        = Input::get('judul');
        $image_video = Input::file('image');
        $lessons_video = Input::file('video');




        $description  = Input::get('desc');

        $video=videos::where('lessons_id',$lessonsid)->get();
        $count_video=count($video);


        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid);
        }

        $i=$count_video + 1;
        foreach ($title as $key => $titles) {
                $type_video =$lessons_video[$key]->getMimeType();

                if (!is_dir("assets/source/lessons/lessons-".$lessonsid."/video-".$i)) {
                        $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid."/video-".$i);
                }
                $DestinationPath= 'assets/source/lessons/lessons-'.$lessonsid.'/video-'.$i;
                //insert image
                if(!empty($image_video[$key])){
                    $imagefilename    = $image_video[$key]->getClientOriginalName();
                    $image_video[$key]->move($DestinationPath, $imagefilename);
                }else{
                    $imagefilename    = '';
                }
                if($imagefilename ==''){
                    $url_image= $imagefilename;
                }else{
                    $urls=url('');
                    $url_image= $urls.'/assets/source/lessons/video-'.$i.'/'.$imagefilename;
                }

                //insert video
                if(!empty($lessons_video[$key])){
                    $lessonsfilename    = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                }else{
                    $lessonsfilename    = '';
                }
                if($lessonsfilename ==''){
                    $url_video= $lessonsfilename;
                }else{
                    $urls=url('');
                    $url_video= $urls.'/assets/source/lessons/video-'.$i.'/'.$lessonsfilename;
                }


                $store                  = new videos;
                $store->lessons_id      = $lessonsid;
                $store->title           = $titles;
                $store->image           = $url_image;
                $store->video           = $url_video;
                $store->description     = $description[$key];
                $store->type_video      = $type_video;
                $store->durasi          =0;
                $store->created_at      = $now;
                $store->enable=1;
                $store->save();
        $i++;
        }

        // Session::set('lessons_title',$title);
        // Session::set('lessons_category_id',$category_id);
        // Session::set('lessons_image',$image);
        // Session::set('lessons_description',$description);

        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('success','Penambahan video berhasil');

    }
  }

  public function edit($lessonsid){
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
      $lesson= lessons::where('id',$lessonsid)->first();

      if($lesson==null){
          return redirect('not-found');
      }
      if($lesson->status==2){
          return redirect('contributor/lessons/'.$lessonsid.'/view')->with('no-delete','Totorial sedang / dalam verifikasi!');
      }
      $video=videos::where('lessons_id',$lessonsid)->get();
      $count_video=count($video);

      # code...
      return view('contrib.videos.edit',[
          'lesson'=>$lesson,
          'count_video'=>$count_video,
          'video'=>$video,
      ]);
  }

  public function doEdit($lessonsid)
  {
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
    # code...
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      'judul'          => 'required',
    //   'video.*'  => 'mimes:mp4,mov,ogg,webm|max:100000',
    //   'image.*' => 'mimes:jpeg,jpg,png,gif|max:30000' // max 10000kb
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now                = new DateTime();
        $cid                = Session::get('contribID');
        $title              = Input::get('judul');
        $image_video        = Input::file('image');
        $image_text         = Input::get('image_text');
        $lessons_video      = Input::file('video');
        $video_text         = Input::get('video_text');
        $type_videos         = Input::get('type_video');
        $description        = Input::get('desc');

        $delete= videos::where('lessons_id',$lessonsid)->delete();
        $video=videos::where('lessons_id',$lessonsid)->get();
        $count_video=count($video);


        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid);
        }

        $i=$count_video + 1;

        foreach ($title as $key => $titles) {
                if(!empty($image_video[$key])){
                    $type_video =$lessons_video[$key]->getMimeType();
                }else{
                    $type_video=$type_videos[$key];
                }

                if (!is_dir("assets/source/lessons/lessons-".$lessonsid."/video-".$i)) {
                        $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid."/video-".$i);
                }
                $DestinationPath= 'assets/source/lessons/lessons-'.$lessonsid.'/video-'.$i;

                //insert image
                if(!empty($image_video[$key])){
                    $imagefilename    = $image_video[$key]->getClientOriginalName();
                    $image_video[$key]->move($DestinationPath, $imagefilename);
                }else{
                    $imagefilename    = '';
                }
                if($imagefilename ==''){
                    $url_image= $image_text[$key];
                }else{
                    $urls=url('');
                    $url_image= $urls.'/assets/source/lessons/video-'.$i.'/'.$imagefilename;
                }

                //insert video
                if(!empty($lessons_video[$key])){
                    $lessonsfilename    = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                }else{
                    $lessonsfilename    = '';
                }
                if($lessonsfilename ==''){
                    $url_video= $video_text[$key];
                }else{
                    $urls=url('');
                    $url_video= $urls.'/assets/source/lessons/video-'.$i.'/'.$lessonsfilename;
                }

                $store                  = new videos;
                $store->lessons_id      = $lessonsid;
                $store->title           = $titles;
                $store->image           = $url_image;
                $store->video           = $url_video;
                $store->description     = $description[$key];
                $store->type_video      = $type_video;
                $store->durasi          =0;
                $store->created_at      = $now;
                $store->enable=1;
                $store->save();
        $i++;
        }

        // Session::set('lessons_title',$title);
        // Session::set('lessons_category_id',$category_id);
        // Session::set('lessons_image',$image);
        // Session::set('lessons_description',$description);

        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('success','video berhasil update');

    }
  }

}
