<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use DateTime;
use App\files;
use App\lessons;
class AttachmentsController extends Controller
{
  public function create($lessonsid)
  {
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    $lesson= lessons::where('id',$lessonsid)->first();

    if($lesson==null){
        return redirect('contributor/not-found');
    }
    $files=files::where('lesson_id',$lessonsid)->get();
    $count_files=count($files);

    # code...
    return view('contrib.attachments.create',[
        'lesson'=>$lesson,
        'count_files'=>$count_files
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
      'files'    => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Session::get('contribID');
        $title        = Input::get('judul');
        $lessons_files = Input::file('files');
        $description  = Input::get('desc');

        $files=files::where('lesson_id',$lessonsid)->get();
        $count_files=count($files);


        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid);
        }

        $i=$count_files + 1;
        foreach ($title as $key => $titles) {
                if (!is_dir("assets/source/lessons/lessons-".$lessonsid."/files-".$i)) {
                        $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid."/files-".$i);
                }
                $DestinationPath= 'assets/source/lessons/lessons-'.$lessonsid.'/files-'.$i;


                //insert files
                if(!empty($lessons_files[$key])){
                    $lessonsfilename    = $lessons_files[$key]->getClientOriginalName();
                    $lessons_files[$key]->move($DestinationPath, $lessonsfilename);
                }else{
                    $lessonsfilename    = '';
                }
                if($lessonsfilename ==''){
                    $url_files= $lessonsfilename;
                }else{
                    $url_files= 'http://localhost:8080/cilsy/assets/source/lessons/files-'.$i.'/'.$lessonsfilename;
                }


                $store                  = new files;
                $store->lesson_id      = $lessonsid;
                $store->title           = $titles;
                $store->source           = $url_files;
                $store->description     = $description[$key];
                $store->created_at      = $now;
                $store->enable=1;
                $store->save();
        $i++;
        }

        // Session::set('lessons_title',$title);
        // Session::set('lessons_category_id',$category_id);
        // Session::set('lessons_image',$image);
        // Session::set('lessons_description',$description);

        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('success','Penambahan lampiran berhasil');

    }
  }

  public function edit($lessonsid){
      if (empty(Session::get('contribID'))) {
        return redirect('contributor/login');
      }
      $lesson= lessons::where('id',$lessonsid)->first();

      if($lesson==null){
          return redirect('contributor/not-found');
      }
      $files=files::where('lesson_id',$lessonsid)->get();
      $count_files=count($files);

      # code...
      return view('contrib.attachments.edit',[
          'lesson'=>$lesson,
          'count_files'=>$count_files,
          'files'=>$files,
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
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Session::get('contribID');
        $title        = Input::get('judul');

        $lessons_files = Input::file('files');
        $files_text        = Input::get('files_text');
        $description  = Input::get('desc');
        $delete= files::where('lesson_id',$lessonsid)->delete();
        $files=files::where('lesson_id',$lessonsid)->get();
        $count_files=count($files);


        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid);
        }

        $i=$count_files + 1;

        foreach ($title as $key => $titles) {
                if (!is_dir("assets/source/lessons/lessons-".$lessonsid."/files-".$i)) {
                        $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid."/files-".$i);
                }
                $DestinationPath= 'assets/source/lessons/lessons-'.$lessonsid.'/files-'.$i;


                //insert files
                if(!empty($lessons_files[$key])){
                    $lessonsfilename    = $lessons_files[$key]->getClientOriginalName();
                    $lessons_files[$key]->move($DestinationPath, $lessonsfilename);
                }else{
                    $lessonsfilename    = '';
                }
                if($lessonsfilename ==''){
                    $url_files= $files_text[$key];
                }else{
                    $url_files= 'http://localhost:8080/cilsy/assets/source/lessons/files-'.$i.'/'.$lessonsfilename;
                }

                $store                  = new files;
                $store->lesson_id      = $lessonsid;
                $store->title           = $titles;
                $store->source           = $url_files;
                $store->description     = $description[$key];
                $store->created_at      = $now;
                $store->enable=1;
                $store->save();
        $i++;
        }

        // Session::set('lessons_title',$title);
        // Session::set('lessons_category_id',$category_id);
        // Session::set('lessons_image',$image);
        // Session::set('lessons_description',$description);

        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('success','files berhasil update');

    }
  }

}
