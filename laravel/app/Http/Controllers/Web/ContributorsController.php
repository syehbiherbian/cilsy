<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Redirect;
use Session;
use Hash;
use DateTime;
use DB;



use App\Contributors;
use App\lessons;
use App\videos;
use App\Viewers;

class ContributorsController extends Controller
{

  public function getProfile($username='')
  {
    $contributors = Contributors::where('username',$username)->first();

    if ($contributors) {
      $contributors_lessons = lessons::where('enable', '=', 1)->where('contributor_id', '=', $contributors->id)->get();
      $contributors_total_view 		= 0;
      foreach ($contributors_lessons as $key => $lesson) {
				$videos = videos::where('lessons_id',$lesson->id)->get();
				if ($videos) {
					foreach ($videos as $key => $video) {
						$viewers = Viewers::where('video_id', '=', $video->id)->first();
						if ($viewers) {
							$contributors_total_view = $contributors_total_view + 1;
						}
					}
				}
			}
      return view('web.contributors.profile',[
          'contributors'              => $contributors,
          'contributors_lessons'      => $contributors_lessons,
          'contributors_total_view'   => $contributors_total_view,
      ]);
    }else {
      abort(404);
    }
  }


}
