<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;

use App\members;
use App\lessons;
use App\categories;
use App\videos;
use App\services;
use App\files;

use Session;
class LessonsController extends Controller
{
  public function index($by,$keyword)
  {
    $categories = categories::where('enable','=',1)->get();
    if($by == 'category'){
      $category = categories::where('enable','=',1)->where('title','like','%'.$keyword.'%')->first();
      $results  = lessons::leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
                  ->select('lessons.*','categories.title as category_title')
                  ->where('lessons.enable','=',1)
                  ->where('lessons.category_id','=',$category->id)
                  ->paginate(10);
    }else {
      $results = lessons::leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
          ->select('lessons.*','categories.title as category_title')
          ->where('lessons.enable','=',1)
          ->paginate(10);
    }
    # code...
    return view('web.lessons.index',[
      'categories' => $categories,
      'results' => $results
    ]);
  }

  public function detail($lesson)
  {
    $lessons      = lessons::where('enable','=',1)->where('title','like','%'.$lesson.'%')->first();
    $main_videos  = videos::where('enable','=',1)->where('lessons_id','=',$lessons->id)->orderBy('id','asc')->get();
    $files = files::where('enable', '=', 1)->where('lesson_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
    return view('web.lessons.detail',[
      'lessons'=>$lessons,
      'main_videos'=>$main_videos,
      'file'=>$files,
    ]);
  }

  public function getplaylist()
  {

    $now        = date('Y-m-d');
    $lessons_id = Input::get('lessons_id');
    $videos     = videos::where('enable','=',1)->where('lessons_id','=',$lessons_id)->orderBy('id','asc')->get();

    $memberID   = Session::get('memberID');
    $members    = members::where('id','=',$memberID)->first();
    $services   = services::where('status','=',1)->where('members_id','=',$memberID)->where('expired','>=',$now)->first();

    if(count($services)> 0){
      if ($services->access == 1) {
        $access = 1;
      }else {
        $access = 0;
      }
    }else{
      $access = 0;
    }

    $play = array();
    $i = 1 ;
        foreach ($videos as $key => $video) {
            if($i >=4 && $access == 0){ // Guest

              $item = array(
                'name'         => $video->title,
                'description'  => strip_tags($video->description),
                'duration'     => $video->durasi,
                'sources'      => 'Invalid',
                'poster'       => 'http://dev.cilsy.id/template/web/img/video-lock.png',
                'thumbnail'    => array([
                  'srcset'=>'http://dev.cilsy.id/template/web/img/video-lock.png',
                  'type'  =>'image/png',
                  'media' =>'(min-width: 400px;)'
                ],
                [
                  'src' => 'http://dev.cilsy.id/template/web/img/video-lock.png'
                ])
              );


            }else{

              $item = array(
                'name'         => $video->title,
                'description'  => strip_tags($video->description),
                'duration'     => $video->durasi,
                'sources'      => array([
                    'src'  => $video->video,
                    'type' => $video->type_video
                ]),
                'poster'        => $video->image,
                'thumbnail'     => array([
                  'srcset'=>$video->image,
                  'type'  =>'image/png',
                  'media' =>'(min-width: 400px;)'
                ],
                [
                  'src' => $video->image
                ])
              );

            }
            array_push($play,$item);
            $i++;
          }
          return json_encode($play,JSON_UNESCAPED_SLASHES)."\n";
          exit;
        }

      }
