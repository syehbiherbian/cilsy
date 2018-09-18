<?php

namespace App\Http\Controllers\Contributors;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Video;
use Auth;
use DateTime;
use FFMpeg;
use Illuminate\Support\Facades\Input;
use Validator;

class VideosController extends Controller
{
    public function create($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $lesson = Lesson::where('id', $lessonsid)->first();

        if ($lesson == null) {
            return redirect('not-found');
        }
        if ($lesson->status == 2) {
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('no-delete', 'Tutorial sedang / dalam verifikasi!');
        }
        $video = Video::where('lessons_id', $lessonsid)->get();
        $count_video = count($video);

        # code...
        return view('contrib.videos.create', [
            'lesson' => $lesson,
            'count_video' => $count_video,
        ]);
    }
    
    public function doCreate($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        # code...
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'judul' => 'required',
            //   'video.*'  => 'mimes:mp4,mov,ogg,webm |required|max:100000',
            //   'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:30000'
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $now = new DateTime();
            $cid = Auth::guard('contributors')->user()->id;
            $title = Input::get('judul');
            $image_video = Input::file('image');
            $lessons_video = Input::file('video');
            // dd($lessons_video);
            $description = Input::get('desc');
            $video = Video::where('lessons_id', $lessonsid)->get();
            $count_video = count($video);
            // dd(!is_dir("assets/source/lessons/lessons-$lessonsid"));
            if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid);
            }

            $i = $count_video + 1;
            foreach ($title as $key => $titles) {
                $type_video = $lessons_video[$key]->getMimeType();
                $DestinationPath = "assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i;
                if (!is_dir($DestinationPath)) {
                    $newforder = mkdir($DestinationPath);
                }
                // dd($DestinationPath);
                //insert video
                $lessonsfilename = '';
                if (!empty($lessons_video[$key])) {
                    $lessonsfilename = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                }
                //insert image
                /* if (!empty($image_video[$key])) {
                    $imagefilename = $image_video[$key]->getClientOriginalName();
                    $image_video[$key]->move($DestinationPath, $imagefilename);
                } else {
                    $imagefilename = '';
                }
                if ($imagefilename == '') {
                    $url_image = $imagefilename;
                } else {
                    $url_image = $DestinationPath . '/' . $imagefilename;
                }
                //insert video
                if (!empty($lessons_video[$key])) {
                    $lessonsfilename = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                } else {
                    $lessonsfilename = '';
                }
                if ($lessonsfilename == '') { 
                    $url_video = $lessonsfilename;
                } else {
                    $url_video = $DestinationPath . '/' . $lessonsfilename;
                } */

                /* siapin video */
                $media = FFMpeg::fromDisk('local_public')->open($DestinationPath . '/' . $lessonsfilename);
                /* ambil durasi */
                $duration = $media->getDurationInSeconds();
                // dd($duration);
                /* generate thumbnail */
                $filename = pathinfo($lessonsfilename, PATHINFO_FILENAME);
                $thumbnailname = 'thumbnail-' . $filename . '.jpg';
                $thumnail = $media->getFrameFromSeconds(0)->export()->save($DestinationPath . '/' . $thumbnailname);
                // dd($thumnail);

                $store = new Video;
                $store->lessons_id = $lessonsid;
                $store->title = $titles;
                $store->image = '/' . $DestinationPath . '/' . $thumbnailname;
                $store->video = '/' . $DestinationPath . '/' . $lessonsfilename;
                $store->description = $description[$key];
                $store->type_video = $type_video;
                $store->durasi = $duration;
                $store->created_at = $now;
                $store->enable = 1;
                $store->save();
                // dd($store->video);
                /*if($store){
                dd($url_video);
                $media = FFMpeg::open($url_video);
                // $frame = FFMpeg::open($link)
                //         ->getFrameFromSeconds(10)
                //         ->export()
                //         ->toDisk('public')
                //         ->save($filename.'.png');
                dd($media);
                $durationInSeconds = $media->getDurationInSeconds();
                // dd($media);

                }*/
                $i++;
            }
            // Session::set('lessons_title',$title);
            // Session::set('lessons_category_id',$category_id);
            // Session::set('lessons_image',$image);
            // Session::set('lessons_description',$description);
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('success', 'Penambahan video berhasil');
        }
    }

    public function edit($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $lesson = Lesson::where('id', $lessonsid)->first();

        if ($lesson == null) {
            return redirect('not-found');
        }
        if ($lesson->status == 2) {
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('no-delete', 'Tutorial sedang / dalam verifikasi!');
        }
        $video = Video::where('lessons_id', $lessonsid)->get();
        $count_video = count($video);

        # code...
        return view('contrib.videos.edit', [
            'lesson' => $lesson,
            'count_video' => $count_video,
            'video' => $video,
        ]);
    }

    public function doEdit($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        # code...
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'judul' => 'required',
            //   'video.*'  => 'mimes:mp4,mov,ogg,webm|max:100000',
            //   'image.*' => 'mimes:jpeg,jpg,png,gif|max:30000' // max 10000kb
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now = new DateTime();
            $cid = Auth::guard('contributors')->user()->id;
            $title = Input::get('judul');
            $image_video = Input::file('image');
            $image_text = Input::get('image_text');
            $lessons_video = Input::file('video');
            $video_text = Input::get('video_text');
            $type_videos = Input::get('type_video');
            $description = Input::get('desc');

            $delete = Video::where('lessons_id', $lessonsid)->delete();
            $video = Video::where('lessons_id', $lessonsid)->get();
            $count_video = count($video);

            if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid);
            }

            $i = $count_video + 1;

            foreach ($title as $key => $titles) {
                if (!empty($image_video[$key])) {
                    $type_video = $lessons_video[$key]->getMimeType();
                } else {
                    $type_video = $type_videos[$key];
                }

                if (!is_dir("assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i)) {
                    $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i);
                }
                $DestinationPath = 'assets/source/lessons/lessons-' . $lessonsid . '/video-' . $i;

                //insert image
                if (!empty($image_video[$key])) {
                    $imagefilename = $image_video[$key]->getClientOriginalName();
                    $image_video[$key]->move($DestinationPath, $imagefilename);
                } else {
                    $imagefilename = '';
                }
                if ($imagefilename == '') {
                    $url_image = $image_text[$key];
                } else {
                    $urls = url('');
                    $url_image = $urls . '/assets/source/lessons/video-' . $i . '/' . $imagefilename;
                }

                //insert video
                if (!empty($lessons_video[$key])) {
                    $lessonsfilename = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                } else {
                    $lessonsfilename = '';
                }
                if ($lessonsfilename == '') {
                    $url_video = $video_text[$key];
                } else {
                    $urls = url('');
                    $url_video = $urls . '/assets/source/lessons/video-' . $i . '/' . $lessonsfilename;
                }
                /* siapin video */
                // $media = FFMpeg::fromDisk('local_public')->open($DestinationPath . '/' . $lessonsfilename);
                // /* ambil durasi */
                // $duration = $media->getDurationInSeconds();
                // // dd($duration);
                // /* generate thumbnail */
                // $filename = pathinfo($lessonsfilename, PATHINFO_FILENAME);
                // $thumbnailname = 'thumbnail-' . $filename . '.jpg';
                // $thumnail = $media->getFrameFromSeconds(0)->export()->save($DestinationPath . '/' . $thumbnailname);
                // dd($thumnail);

                $store = new Video;
                $store->lessons_id = $lessonsid;
                $store->title = $titles;
                // $store->image = $thumbnailname;
                $store->video = $url_video;
                $store->description = $description[$key];
                $store->type_video = $type_video;
                $store->durasi = $duration;
                $store->created_at = $now;
                $store->enable = 1;
                $store->save();
                $i++;
            }

            // Session::set('lessons_title',$title);
            // Session::set('lessons_category_id',$category_id);
            // Session::set('lessons_image',$image);
            // Session::set('lessons_description',$description);

            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('success', 'video berhasil update');

        }
    }
    public function destroy($id) {
		$delete = Video::where('id', $id)->delete();

		return redirect()->back()->with('success', 'Data successfully deleted');
	}
}
