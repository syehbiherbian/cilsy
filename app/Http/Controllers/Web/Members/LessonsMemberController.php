<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lessons;
use App\Viewers;
use App\videos;
use App\members;
use App\services;
use App\categories;
use App\files;
use App\lessons_detail;
use App\lessons_detail_view;
use DateTime;
use Session;
use DB;

class LessonsMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mem_id = Session::get('memberID');
          if (!$mem_id) {
            return redirect('/member/signin');
            exit;
          }
        $last_videos = viewers::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                     ->select('videos.*', 'viewers.*')
                     ->where('viewers.member_id', '=', $mem_id)->orderBy('viewers.created_at', 'desc')->first();
        
        $last_lessons = lessons::where('lessons.id', '=', $last_videos->lessons_id)->first();

        $watched_video = lessons::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                       ->join('viewers', 'viewers.video_id', '=', 'videos.id')
                       ->select('viewers.member_id', 'lessons.title', 'videos.lessons_id', DB::raw(count('DISTINCT viewers.video_id')))
                       // ->count()
                       ->where('viewers.member_id', '=', $mem_id)
                       ->groupBy('viewers.member_id', 'lessons.title', 'videos.lessons_id')
                       ->orderBy('viewers.created_at', 'asc')
                       ->get();

        $get_lessons = lessons::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                     ->join('viewers', 'videos.id', '=', 'viewers.video_id')
                     ->where('viewers.member_id', '=', $mem_id)
                     ->orderBy('viewers.member_id', 'viewers.updated_at', 'asc')
                     ->distinct()
                     ->get(['viewers.member_id', 'lessons.*']);           

        $get_videos = viewers::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                    ->where('videos.lessons_id', '=', $last_videos->lessons_id)->get();

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
        $mem_id = Session::get('memberID');

        $services = services::where('status', '=', 1)->where('download', '=', 1)->where('members_id', '=', $mem_id)->where('expired', '>', $now)->first();
        $lessons = lessons::where('enable', '=', 1)->where('status', '=', 1)->where('slug', '=', $slug)->first();
        $last_videos = viewers::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                     ->select('videos.*', 'viewers.*')
                     ->where('viewers.member_id', '=', $mem_id)->orderBy('viewers.created_at', 'desc')->first();
        
        $last_lessons = lessons::where('lessons.id', '=', $last_videos->lessons_id)->first();

        $watched_video = lessons::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                       ->join('viewers', 'viewers.video_id', '=', 'videos.id')
                       ->select('viewers.member_id', 'lessons.title', 'videos.lessons_id', DB::raw(count('DISTINCT viewers.video_id')))
                       // ->count()
                       ->where('viewers.member_id', '=', $mem_id)
                       ->groupBy('viewers.member_id', 'lessons.title', 'videos.lessons_id')
                       ->orderBy('viewers.created_at', 'asc')
                       ->get();

        $get_lessons = lessons::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                     ->join('viewers', 'videos.id', '=', 'viewers.video_id')
                     ->where('viewers.member_id', '=', $mem_id)
                     ->orderBy('viewers.member_id', 'viewers.updated_at', 'asc')
                     ->distinct()
                     ->get(['viewers.member_id', 'lessons.*']);           

        $get_videos = viewers::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                    ->where('videos.lessons_id', '=', $last_videos->lessons_id)->get();

        $progress = count($watched_video)*100/count($get_videos);

      if (count($lessons) > 0) {
                $main_videos = videos::where('enable', '=', 1)->where('lessons_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
                $files = files::where('enable', '=', 1)->where('lesson_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
            // Contributor
            $contributors = DB::table('contributors')->where('id',$lessons->contributor_id)->first();
            $contributors_total_lessons = lessons::where('enable', '=', 1)->where('contributor_id', '=', $lessons->contributor_id)->get();
            $contributors_total_view        = 0;
      //
      //
            foreach ($contributors_total_lessons as $key => $lesson) {
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
