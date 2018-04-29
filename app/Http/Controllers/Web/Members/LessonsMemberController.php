<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Viewer;
use App\Models\Video;
use App\Models\Member;
use App\Models\Service;
use App\Models\Category;
use App\Models\File;
use App\Models\LessonDetail;
use App\Models\LessonDetailView;
use DateTime;
use Session;
use DB;
use Auth;

class LessonsMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mem_id = Auth::guard('members')->user()->id;
          if (!$mem_id) {
            return redirect('/member/signin');
            exit;
          }
        $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                     ->select('videos.*', 'viewers.*')
                     ->where('viewers.member_id', '=', $mem_id)->orderBy('viewers.updated_at', 'desc')->first();
        
        $last_lessons = Lesson::where('lessons.id', '=', $last_videos->lessons_id)->first();

        $watched_video = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                       ->join('viewers', 'viewers.video_id', '=', 'videos.id')
                       ->select('viewers.member_id', 'lessons.title', 'videos.lessons_id', DB::raw(count('DISTINCT viewers.video_id')))
                       // ->count()
                       ->where('viewers.member_id', '=', $mem_id)
                       ->groupBy('viewers.member_id', 'lessons.title', 'videos.lessons_id')
                       ->orderBy('viewers.created_at', 'asc')
                       ->get();

        $get_lessons = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                     ->join('viewers', 'videos.id', '=', 'viewers.video_id')
                     ->where('viewers.member_id', '=', $mem_id)
                     ->orderBy('viewers.member_id', 'viewers.updated_at', 'asc')
                     ->distinct()
                     ->get(['viewers.member_id', 'lessons.*']);           

        $get_videos = Video::where('videos.lessons_id', '=', $last_videos->lessons_id)->get();
        

        $progress = count($watched_video)*100/count($get_videos);
        // dd($progress);
        return view('web.members.dashboard_tutorial', [
            'progress' => $progress,
            'last' => $last_lessons,
            'lessons' => $get_lessons,
            // 'videos' => $last_videos,
        ]);
    }
    public function detail($slug) {


        $now = new DateTime();
        $mem_id = Auth::guard('members')->user()->id;

        $services = Service::where('status', '=', 1)->where('download', '=', 1)->where('members_id', '=', $mem_id)->where('expired', '>', $now)->first();
        $lessons = Lesson::where('enable', '=', 1)->where('status', '=', 1)->where('slug', '=', $slug)->first();
        $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                     ->select('videos.*', 'viewers.*')
                     ->where('viewers.member_id', '=', $mem_id)->orderBy('viewers.updated_at', 'desc')->first();
        
        $last_lessons = Lesson::where('lessons.id', '=', $last_videos->lessons_id)->first();

        $watched_video = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                       ->join('viewers', 'viewers.video_id', '=', 'videos.id')
                       ->select('viewers.member_id', 'lessons.title', 'videos.lessons_id', DB::raw(count('DISTINCT viewers.video_id')))
                       // ->count()
                       ->where('viewers.member_id', '=', $mem_id)
                       ->groupBy('viewers.member_id', 'lessons.title', 'videos.lessons_id')
                       ->orderBy('viewers.created_at', 'asc')
                       ->get();

        $get_lessons = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                     ->join('viewers', 'videos.id', '=', 'viewers.video_id')
                     ->where('viewers.member_id', '=', $mem_id)
                     ->orderBy('viewers.member_id', 'viewers.updated_at', 'asc')
                     ->distinct()
                     ->get(['viewers.member_id', 'lessons.*']);           

        $get_videos = Video::where('videos.lessons_id', '=', $last_videos->lessons_id)->get();

        $get_hist = Viewer::select('hits')
                    ->where('member_id', '=', $mem_id)
                    ->where('video_id', '=',$last_videos)->get();
        dd($get_hist);
        $progress = count($watched_video)*100/count($get_videos);

      if (count($lessons) > 0) {
                $main_videos = Video::where('enable', '=', 1)->where('lessons_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
                $files = File::where('enable', '=', 1)->where('lesson_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
            // Contributor
            $contributors = DB::table('contributors')->where('id',$lessons->contributor_id)->first();
            $contributors_total_lessons = Lesson::where('enable', '=', 1)->where('contributor_id', '=', $lessons->contributor_id)->get();
            $contributors_total_view        = 0;
      //
      //
            foreach ($contributors_total_lessons as $key => $lesson) {
                $videos = Video::where('lessons_id',$lesson->id)->get();
                if ($videos) {
                    foreach ($videos as $key => $video) {
                        $viewers = Viewer::where('video_id', '=', $video->id)->first();
                        if ($viewers) {
                            $contributors_total_view = $contributors_total_view + 1;
                        }
                    }
                }
            }

            return view('web.lessons.dashboard_lesson', [
                'lessons' => $lessons,
                'main_videos' => $main_videos,
                'file' => $files,
                'services' => $services,
                'contributors' => $contributors,
                'contributors_total_lessons' => $contributors_total_lessons,
                'contributors_total_view' => $contributors_total_view,
                'progress' => $progress,
                'last' => $last_lessons,
                'get' =>$get_videos,
                'hits' => $get_hist,
            ]);
        }else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}