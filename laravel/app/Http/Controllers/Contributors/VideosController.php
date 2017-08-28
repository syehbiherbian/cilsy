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
  public function create($id)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    $lessons  = lessons::where('id',$id)->first();
    return view('contrib.videos.create',[
      'lessons'   =>  $lessons
    ]);
  }

  public function store($id)
  {
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      // 'title'          => 'required|min:3',
      // 'video'          => 'required',
      // 'description'    => 'required|min:3',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Session::get('contribID');
        $title        = Input::get('title');
        $description  = Input::get('description');




        for ($i=0; $i < count($title) ; $i++) {



            $DestinationPath= 'assets/source/lessons';
            $video        = Input::file('video');

            if(!empty($video)){
                $file    = $video[$i]->getClientOriginalName();
                $video[$i]->move($DestinationPath, $file);
                $filename   = 'https://cilsy.id/'.$DestinationPath.'/'.$file;
            }else{
                $filename    = '';
            }



            $store                  = new videos;
            $store->contributor_id  = $cid;
            $store->enable          = 0;
            $store->title           = $title[$i];
            $store->lessons_id      = $id;
            $store->image           = '';
            $store->video           = $filename;
            $store->durasi          = '0';
            $store->type_video      = '';
            $store->description     = $description[$i];
            $store->created_at      = $now;
            $store->updated_at      = $now;
            $store->save();

        }


        return redirect('contributor/lessons/'.$id.'/edit')->with('success','Video berhasil di submit');

    }
  }

  public function edit($id)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }

    $lessons  = lessons::where('id',$id)->first();
    $videos  = videos::where('lessons_id',$id)->get();
    return view('contrib.videos.edit',[
      'lessons'   =>  $lessons,
      'videos'    =>  $videos
    ]);
  }


  public function update($id)
  {

    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      // 'title'          => 'required|min:3',
      // 'video'          => 'required',
      // 'description'    => 'required|min:3',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Session::get('contribID');
        $title        = Input::get('title');
        $description  = Input::get('description');



        videos::where('lessons_id',$id)->delete();

        for ($i=0; $i < count($title) ; $i++) {





            $DestinationPath= 'assets/source/lessons';
            $video        = Input::file('video');

            if(!empty($video)){
                $file    = $video[$i]->getClientOriginalName();
                $video[$i]->move($DestinationPath, $file);
                $filename   = 'https://cilsy.id/'.$DestinationPath.'/'.$file;
            }else{
                $filename    = '';
            }



            $store                  = new videos;
            $store->contributor_id  = $cid;
            $store->enable          = 0;
            $store->title           = $title[$i];
            $store->lessons_id      = $id;
            $store->image           = '';
            $store->video           = $filename;
            $store->durasi          = '0';
            $store->type_video      = '';
            $store->description     = $description[$i];
            $store->created_at      = $now;
            $store->updated_at      = $now;
            $store->save();

        }


        return redirect('contributor/lessons/'.$id.'/edit')->with('success','Video berhasil di update');

    }
  }

}
