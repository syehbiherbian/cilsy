<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\Course;
use App\Models\Section;
use DateTime;
use DB;
class BootcampController extends Controller
{

	public function bootcamp($slug)
    {
    	$bc = Bootcamp::where('status', 1)->where('slug', $slug)->first();
        $cs = Course::where('bootcamp_id', $bc->id)->first();
        // $courses = DB::table('course')->where('bootcamp_id', $bc->id)->get();
        $courses = Course::with('section')->where('bootcamp_id', $bc->id)->get();
        $main_videos = Section::with('video_section')->where('course_id', $cs->id)->get();
        $main_course = Course::where('bootcamp_id', $bc->id)->get();
    	$now = new DateTime();
    	$time = strtotime($bc->created_at);
        $myFormatForView = date("d F y", $time);
        $contributors = DB::table('contributors')->where('contributors.id',$bc->contributor_id)->first();

        return view('web.bootcamp.bootcamp',[
            'bca' => $bc,
            'contributors' => $contributors,
            'course' => $courses,
            'main_videos' => $main_videos,
            'tanggal' => $myFormatForView,
            'main_course' => $main_course,
        ]);
    }

}
