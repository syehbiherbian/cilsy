<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Bootcamp;
use App\Models\Section;
use App\Models\VideoSection;
use App\Models\ProjectSection;
use App\Models\ProjectUser;
use DB;


class CourseController extends Controller
{
    public function courseSylabus($slug)
    {	

    	
    	// $courses = DB::table('course')->first();
    	// $bcs = Bootcamp::where('bootcamp.id',$courses->bootcamp_id)->first();
        $bcs = Bootcamp::where('slug', $slug)->first();
        $courses = Course::where('bootcamp_id', $bcs->id)->first();
        $cs = DB::table('course')->where('bootcamp_id', $bcs->id)->get();
        return view('web.courses.CourseSylabus',[
            'course' => $courses,
            'bc' => $bcs,
            'cs' => $cs,
            
        ]);
    }
    public function courseLesson($slug, $id)
    {   

        $bcs = Bootcamp::where('slug', $slug)->first();
        $courses = Course::where('id', $id)->first();
        $section = Section::where('course_id', $courses->id)->first();
        $vsection = VideoSection::where('section_id', $section->id)->orderBy('position', 'asc')->get();
        $cs = DB::table('section')->where('course_id', $courses->id)->get();
        return view('web.courses.CourseLesson',[
            'course' => $courses,
            'bc' => $bcs,
            'cs' => $cs,
            'stn' => $section,
            'vsection' => $vsection,
            
        ]);
    }
     public function videoPage($slug, $id)
    {   

        $bcs = Bootcamp::where('slug', $slug)->first();
        $courses = Course::where('id', $id)->first();
        $section = Section::with('video_section')->where('course_id', $courses->id)->orderBy('position', 'asc')->get();
        $vsection = $section->first()->video_section->first();
        $psection = Section::with('project_section')->where('course_id', $courses->id)->get();
        // $vmateri = DB::table('video_section')->where('section_id', $vsection->id)->get();
        return view('web.courses.VideoPage',[
            'course' => $courses,
            'bc' => $bcs,
            'stn' => $section,
            'psection' => $psection,
            'vsection' => $vsection,
            
        ]);
    }
     public function projectSubmit($slug, $id)
    {
        $bcs = Bootcamp::where('slug', $slug)->first();
        $section = Section::with('video_section')->where('id', $id)->get();
        $vsection = $section->first()->video_section->first();
        $psection = Section::with('project_section')->where('id', $id)->get();
        // $ps = ProjectSection::
        $project = ProjectSection::where('section_id', $id)->first();
        // dd($psection);
         return view('web.courses.ProjectSubmit',[
            
            'bc' => $bcs,
            'stn' => $section,
            'psection' => $psection,
            'vsection' => $vsection,
            'project' => $project,
            
        ]);
    }

    public function saveProject(){
        $response = array();
        if (empty(Auth::guard('members')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('members')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
   
            $input = new ProjectUser();
            $input['komentar)user'] = $request->input('body');
            $input['project_section_id'] =  $request->input('project_id');
            if ($request->hasFile('file')){
                $input['file'] = '/assets/source/bootcamp/project-'.$request->input('project_id'). $request->image->getClientOriginalName();
                $request->image->move(public_path('/assets/source/bootcamp/project-'.$request->input('project_id')), $input['file']);
            }
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }
    
}
