<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Bootcamp;
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
}
