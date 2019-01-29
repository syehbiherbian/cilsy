<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Course;
use App\Models\VideoSection;
use App\Models\ProjectSection;
use Auth;
use DateTime;

class SectionController extends Controller
{
    public function index($id){
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $course = Course::where('id', $id)->first();
        $sec = Section::where('course_id', $id)->get();
        // dd($course);
        return view('contrib.kurikulum.kurikulum',[
            'sec' => $sec,
            'course' => $course,
        ]);
    }

    public function getJsonSection($id){
        $sec = Section::where('course_id', $id)->with('video_section', 'project_section')->get();
        // var_dump($sec);
        return response()->json($sec);
    }

    public function store(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
        $title = Input::get('title');
        $desk = Input::get('desk');
        $course_id = Input::get('course_id');
        $now = new DateTime();

        $section = new Section();
        $section->title = $title;
        $section->course_id = $course_id;
        $section->deskripsi = $desk;
        $section->created_at = $now;
        $section->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }
    public function storeProject(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
        $title = Input::get('title');
        $desk = Input::get('desk');
        $type = Input::get('type');
        $value = Input::get('value');
        $section_id = Input::get('section_id');

        $now = new DateTime();

        $section = new ProjectSection();
        $section->title = $title;
        $section->section_id = $section_id;
        $section->deskripsi_project = $desk;
        $section->instruksi = $value;
        $section->type = $type;
        $section->created_at = $now;
        $section->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }

    public function SaveVideo(){
        set_time_limit(0);
        
        $statusCode = 500;
        $response = [
            'status' => false,
            'message' => 'Upload video failed'
        ];
        $file = Input::file('video');
        $lessonsid = Input::get('lesson_id');
        $i = Input::get('position');

        // if (!is_dir("assets/source/lessons/video")) {
        //     $newforder = mkdir("assets/source/lessons/video");
        // }

        $type_video = $file->getMimeType();
        $DestinationPath = "assets/source/lessons" ;
        if (!is_dir($DestinationPath)) {
            $newforder = mkdir($DestinationPath);
        }

        //insert video
        $lessonsfilename = '';
        if (!empty($file)) {
            $fullname = $file->getClientOriginalName();
            $filename = pathinfo($fullname, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $lessonsfilename = md5($filename.time()). '.' . strtolower($extension);
            $file->move($DestinationPath, $lessonsfilename);
        }

        /* siapin video */
        $media = FFMpeg::fromDisk('local_public')->open($DestinationPath . '/' . $lessonsfilename);
        
        /* ambil durasi */
        $duration = $media->getDurationInSeconds();
        
        /* generate thumbnail */
        $midsecs = round($duration/2);
        $filename = pathinfo($lessonsfilename, PATHINFO_FILENAME);
        $thumbnailname = 'thumbnail-' . $filename . '.jpg';
        $thumbnail = $media->getFrameFromSeconds($midsecs)->export()->save($DestinationPath . '/' . $thumbnailname);

        /* save as draft */
        $store = new VideoSection;
        $store->image_video = '/' . $DestinationPath . '/' . $thumbnailname;
        $store->file_video = '/' . $DestinationPath . '/' . $lessonsfilename;
        $store->description = '';
        $store->type_video = $type_video;
        $store->durasi = $duration;
        // $store->created_at = $now;
        $store->save();

        if ($store) {
            $statusCode = 200;
            $response = [
                'status' => true,
                'message' => 'Upload video success',
            ];
        } else {

        }

        return response()->json($response, $statusCode);
    }
}
