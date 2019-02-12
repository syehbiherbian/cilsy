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
    public function addLesson(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
            $input = Bootcamp::find($request->input('boot_id'));
            // $input = $request->all();  
            $input['status'] = $request->input('status');
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }
}
