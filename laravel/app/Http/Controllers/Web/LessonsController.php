<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use DateTime;
use Session;
use DB;


use App\categories;
use App\files;
use App\Http\Controllers\Controller;
use App\lessons;
use App\videos;
use App\Viewers;
use App\members;
use App\services;
use App\lessons_detail;
use App\lessons_detail_view;

class LessonsController extends Controller {
	public function index($by, $keyword) {
		$categories = categories::where('enable', '=', 1)->get();
		if ($by == 'category') {
			$category = categories::where('enable', '=', 1)->where('title', 'like', '%' . $keyword . '%')->first();
			$results = lessons::leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
				->select('lessons.*', 'categories.title as category_title')
				->where('lessons.enable', '=', 1)
				->where('lessons.status', '=', 1)
				->where('lessons.category_id', '=', $category->id)
				->paginate(10);
		} else {
			$results = lessons::leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
				->select('lessons.*', 'categories.title as category_title')
				->where('lessons.status', '=', 1)
				->where('lessons.enable', '=', 1)
				->paginate(10);
		}
		# code...
		return view('web.lessons.index', [
			'categories' => $categories,
			'results' => $results,
		]);
	}

	public function detail($slug) {


		$now = new DateTime();
		$mem_id = Session::get('memberID');

		$services = services::where('status', '=', 1)->where('download', '=', 1)->where('members_id', '=', $mem_id)->where('expired', '>', $now)->first();
		$lessons = lessons::where('enable', '=', 1)->where('status', '=', 1)->where('slug', '=', $slug)->first();

	  if (count($lessons) > 0) {
				$main_videos = videos::where('enable', '=', 1)->where('lessons_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
				$files = files::where('enable', '=', 1)->where('lesson_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
			// Contributor
			$contributors = DB::table('contributors')->where('id',$lessons->contributor_id)->first();
			$contributors_total_lessons = lessons::where('enable', '=', 1)->where('contributor_id', '=', $lessons->contributor_id)->get();
			$contributors_total_view 		= 0;
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

			return view('web.lessons.detail', [
				'lessons' => $lessons,
				'main_videos' => $main_videos,
				'file' => $files,
				'services' => $services,
				'contributors' => $contributors,
				'contributors_total_lessons' => $contributors_total_lessons,
				'contributors_total_view' => $contributors_total_view,
			]);
		}else {
			abort(404);
		}
	}

	public function videoTracking()
	{
		if (Session::get('memberID')) {
			$mem_id = Session::get('memberID');
		}else {
			$mem_id = 0;
		}

		$rules = array(
			'videosrc'      => 'required|min:3|max:255'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {

			$now 				= new DateTime();
		  $ip_address = $this->getUserIP();
			$videosrc 	= Input::get('videosrc');

			$video 			= videos::where('video','like','%'.$videosrc.'%')->first();
			if ($video) {

				$viewers  = Viewers::where('video_id',$video->id)->where('ip_address',$ip_address)->where('member_id',$mem_id)->first();

				if ($viewers) { // Viewers exist

					$update = Viewers::find($viewers->id);
					$update->member_id 	= $mem_id;
					$update->hits 			= $viewers->hits + 1;
					$update->updated_at = $now;
					if ($update->save()) {
						return 'true';
					}
				}else { // Create new Viewers

					$store = new Viewers;
					$store->video_id 		= $video->id;
					$store->ip_address 	= $ip_address;
					$store->hits				= 1;
					$store->member_id 	= $mem_id;
					$store->created_at 	= $now;
					$store->updated_at 	= $now;
					if($store->save()){
						return 'true';
					}
				}
			}
		}
	}

  //
  // public function checkViewers($lesson_id)
  // {
  //   // ADD VIEWERS
  //   $now            = new DateTime();
	// 	if (Session::get('memberID')) {
	// 		$mem_id = Session::get('memberID');
	// 	}else {
	// 		$mem_id = 0;
	// 	}
  //   $ip_address     = $this->getUserIP();
  //   $lessons_viewers  = DB::table('lessons_viewers')->where('lesson_id',$lesson_id)->where('ip_address',$ip_address)->first();
  //
  //   if (count($lessons_viewers) > 0) {
  //
  //     // Update hits Viewers
	// 		DB::table('lessons_viewers')->where('lesson_id',$lesson_id)
	// 		->update([
	// 			'member_id' 	=> $mem_id,
	// 			'hits' 				=> $lessons_viewers->hits + 1,
	// 			'updated_at' 	=> $now,
	// 		]);
  //
  //     return true;
  //
  //   }else {
  //
  //     // Create New Viewers
	// 		DB::table('lessons_viewers')->insert([
	// 			'lesson_id' 		=> $lesson_id,
	// 			'ip_address' 	=> $ip_address,
	// 			'hits' 				=> 1,
	// 			'member_id' 	=> $mem_id,
	// 			'created_at' 	=> $now,
	// 			'updated_at' 	=> $now,
	// 		]);
  //
  //     return true;
  //   }
  //
  // }

  private static function getUserIP()
  {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
  }

	public function doComment()
	{
		$response= array();
		if (empty(Session::get('memberID'))) {
			$response['success'] 		= false;
		}else {

			$now 				= new DateTime();
			$uid 				= Session::get('memberID');
			$body 	  	= Input::get('body');
			$lesson_id  = Input::get('lesson_id');
			$parent_id 	= Input::get('parent_id');

			$store= DB::table('comments')->insertGetId([
					'lesson_id'     => $lesson_id,
					'member_id'			=> $uid,
					'body'   				=> $body,
					'parent_id'     => $parent_id,
					'status'        => 0,
					'created_at'    => $now,
					'updated_at'    => $now
			]);

			if ($store) {
				$response['success'] 		= true;
			}

		}

		echo json_encode($response);

	}

	public function getComments($lesson_id)
	{

			$comments     = DB::table('comments')
											->leftJoin('members','members.id','=','comments.member_id')
											->select('comments.*','members.username as username','members.avatar as avatar')
											->where('comments.parent_id','=',0)
											->where('comments.lesson_id','=',$lesson_id)
											->orderBy('comments.id','DESC')
											->get();
			$html = '';
			$i = 1;
			foreach ($comments as $key => $comment) {

				$html .= '<div class="row">
				                <div class="col-sm-1">
													<div class="thumbnail">';
														if ($comment->avatar) {
														$html .= '<img class="img-responsive user-photo" src="'.asset($comment->avatar).'">';
														}else{
														$html .= '<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">';
														}
													$html .= '</div><!-- /thumbnail -->
				                </div>

				                <div class="col-sm-11">

				                  <div class="panel panel-default">
				                    <div class="panel-heading">
				                      <strong>'.$comment->username.'</strong> <span class="text-muted">commented '.$this->time_elapsed_string($comment->created_at).'</span>
				                    </div>
				                    <div class="panel-body">
				                      '.$comment->body.'
				                    </div>';
														if (!empty(Session::get('memberID'))) {
				                    $html .= '<div class="panel-footer reply-btn-area text-right">
									                        <button type="button" name="button" class="btn btn-primary" data-toggle="collapse" data-target="#reply'.$comment->id.'"><i class="glyphicon glyphicon-share-alt"></i> Balas</button>
									                    </div>
									                    <div class="collapse" id="reply'.$comment->id.'">
									                      <div class="panel-footer ">
									                        <div class="row reply">
									                          <div class="col-md-12">
									                            <div class="form-group">
									                              <label>Komentar</label>
									                              <textarea name="name" rows="8" cols="80" class="form-control" name="body" id="textbody'.$comment->id.'"></textarea>
									                            </div>
									                            <button type="submit" class="btn btn-primary pull-right" onClick="doComment('.$lesson_id.','.$comment->id.')" >Kirim</button>
									                          </div>
									                        </div>
									                      </div>
									                    </div>';
														}




				                  $html .= '</div><!-- /panel panel-default -->';


						$childcomments  = DB::table('comments')
														->leftJoin('members','members.id','=','comments.member_id')
														->select('comments.*','members.username as username','members.avatar as avatar')
														->where('comments.parent_id','=',$comment->id)
														->where('comments.lesson_id','=',$lesson_id)
														->orderBy('comments.id','DESC')
														->get();

						foreach ($childcomments as $key => $child) {

				     $html .= '<!-- Comments Child -->
				                  <div class="row">
				                    <div class="col-sm-1">
				                      <div class="thumbnail">';
																if ($child->avatar) {
				                        $html .= '<img class="img-responsive user-photo" src="'.asset($child->avatar).'">';
																}else{
					                      $html .= '<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">';
																}
				                      $html .= '</div><!-- /thumbnail -->
				                    </div><!-- /col-sm-1 -->

				                    <div class="col-sm-11">
				                      <div class="panel panel-default">
				                        <div class="panel-heading">
				                          <strong>'.$child->username.'</strong> <span class="text-muted">commented '.$this->time_elapsed_string($child->created_at).'</span>
				                        </div>
				                        <div class="panel-body">
				                          '.$child->body.'
				                        </div><!-- /panel-body -->
				                      </div><!-- /panel panel-default -->
				                    </div><!-- /col-sm-5 -->
				                  </div><!-- ./row -->
				                  <!-- ./Comments Childs -->';


											}

				          $html .= '</div><!-- /col-sm-5 -->
				              </div><!-- ./row -->';
				$i++;
			}
		echo $html;
	}

	private static function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	public function doComment_bak(){
		if (empty(Session::get('memberID'))) {
			return 0;
			exit();
		}
		$uid = Session::get('memberID');

		$member			= DB::table('members')->where('id',$uid)->first();
		$comment  	= Input::get('comment');
		$lesson_id  = Input::get('lesson_id');
		$lessons 		= DB::table('lessons')->where('id',$lesson_id)->first();

		$store= DB::table('coments')->insertGetId([
				'lesson_id'     => $lesson_id,
				'member_id'			=> $uid,
				'description'   => $comment,
				'parent'        => 0,
				'status'        => 0,
				'created_at'    => new DateTime()
		]);

		// if(count($check)==1){
		// 	$check_contri=Contributors::where('id',$uid)->first();
		// 	if(count($check_contri)>0){
		// 	  $contri = Contributors::find($uid);
		// 	  $contri->points      = $check_contri->points + 3;
		// 	  $contri->updated_at  = new DateTime();
		// 	  $contri->save();
		//
		// 	  DB::table('contributor_notif')->insert([
		// 		  'contributor_id'=> $uid,
		// 		  'category'=>'point',
		// 		  'title'   => 'Anda mendapatkan pemambahan 3 point',
		// 		  'notif'        => 'Anda mendapatkan pemambahan sebanyak 3 point karena  mereplay komentar dari '.$lessons->title.' ',
		// 		  'status'        => 0,
		// 		  'created_at'    => new DateTime()
		// 	  ]);
		// 	}
		//
		// }

		if($store){
			DB::table('contributor_notif')->insert([
				'contributor_id'=> $lessons->contributor_id,
				'category'=>'coments',
				'title'   => 'Anda mendapat pertanyaan dari '.$member->username,
				'notif'        => 'Anda mendapatkan pertanyaan dari '.$member->username.' pada '.$lessons->title,
				'status'        => 0,
				'created_at'    => new DateTime()
			]);

			$comment     = DB::table('coments')
				->leftJoin('members','members.id','=','coments.member_id')
				 ->select('coments.*','members.username as username')
				->where('coments.id',$store)
				->where('coments.parent',0)
				->where('coments.status',0)
				->orderBy('coments.created_at','DESC')
				->first();

					echo '<div class="col-md-12" style="margin-bottom:30px;" id="row'.$comment->id.'">';
					echo '<img class="user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">';
					echo '	<strong>'.$comment->username .'</strong> pada <strong>'.date('d/m/Y',strtotime($comment->created_at)).'</strong>';
					echo '	<strong style="color:#ff5e10;">';
					if($comment->member_id !==null){
					echo 'User' ;
					}
					if($comment->contributor_id  !==null){
					echo 'Contributor';
					}
					echo '</strong>';

					echo '	<div class="col-md-12" style="margin-top:10px;padding-left:5%;">'. $comment->description.'</div>';
					echo '	<br><br>';

					$getchild = DB::table('coments')
					->leftJoin('members','members.id','=','coments.member_id')
					->leftJoin('contributors','contributors.id','=','coments.contributor_id')
					->where('coments.lesson_id',$lessons->id)
					->where('parent',$comment->id)
					->orderBy('coments.created_at','ASC')
					->select('coments.*','members.username as username','contributors.username as contriname')
					->get();

					if (count($getchild) > 0) {
					foreach ($getchild as $child) {

					echo'<div class="col-md-12" style="margin-top:10px;padding-left:7%;">';
					echo'<img class="user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">';
					echo'<strong>';
					if(!empty($child->username)){
					echo''.$child->username.'';
					}else{
					echo''.$child->contriname.'';

					}
					echo'</strong> pada <strong>'.date('d/m/Y',strtotime($child->created_at)).'</strong>';
					echo'	<div class="col-md-12" style="margin-top:10px;margin-bottom:10px;padding-left:5%;">';
					echo''.$child->description.'';
					echo'</div>';
					echo'	<div class="clearfix"></div>';
					echo'</div>';

					}
					}

					echo'<div class="col-md-12" id="balas'.$comment->id.'" style="padding-top:10px; padding-left:0px; padding-right:0px;">';
					echo'<a href="javascript:void(0)" class="btn btn-info pull-right" onclick="formbalas('.$comment->id.')">Balas</a>';
					echo'	</div>';
					echo'</div>';

		}else{
			return null;
		}



	}
	public function postcomment(){
		if (empty(Session::get('memberID'))) {
			return 0;
			exit();
		}
		$uid = Session::get('memberID');
		$member=DB::table('members')->where('id',$uid)->first();
		$isi_balas  = Input::get('isi_balas');
		$comment_id = Input::get('comment_id');
		$lesson_id  = Input::get('lesson_id');
		$lessons = DB::table('lessons')->where('id',$lesson_id)->first();

		DB::table('coments')->insert([
			'lesson_id'     => $lesson_id,
			'member_id'=> $uid,
			'description'   => $isi_balas,
			'parent'        => $comment_id,
			'status'        => 0,
			'created_at'    => new DateTime()
		]);
		$check=DB::table('coments')->where('parent',$comment_id)->get();
		// if(count($check)==1){
		// 	$check_contri=Contributors::where('id',$uid)->first();
		// 	if(count($check_contri)>0){
		// 	  $contri = Contributors::find($uid);
		// 	  $contri->points      = $check_contri->points + 3;
		// 	  $contri->updated_at  = new DateTime();
		// 	  $contri->save();
		//
		// 	  DB::table('contributor_notif')->insert([
		// 		  'contributor_id'=> $uid,
		// 		  'category'=>'point',
		// 		  'title'   => 'Anda mendapatkan pemambahan 3 point',
		// 		  'notif'        => 'Anda mendapatkan pemambahan sebanyak 3 point karena  mereplay komentar dari '.$lessons->title.' ',
		// 		  'status'        => 0,
		// 		  'created_at'    => new DateTime()
		// 	  ]);
		// 	}
		//
		// }

		DB::table('contributor_notif')->insert([
			'contributor_id'=> $lessons->contributor_id,
			'category'=>'coments',
			'title'   => 'Anda kembali mendapat pertanyaan dari '.$member->username,
			'notif'        => 'Anda kembali mendapatkan pertanyaan dari '.$member->username.' pada '.$lessons->title,
			'status'        => 0,
			'created_at'    => new DateTime()
		]);
		return 1;

	}

	public function getplaylist() {

		$now = date('Y-m-d');
		$lessons_id = Input::get('lessons_id');
		$videos = videos::where('enable', '=', 1)->where('lessons_id', '=', $lessons_id)->orderBy('id', 'asc')->get();

		$memberID = Session::get('memberID');
		$members = members::where('id', '=', $memberID)->first();
		$services = services::where('status', '=', 1)->where('members_id', '=', $memberID)->where('expired', '>=', $now)->first();

		if (count($services) > 0) {
			if ($services->access == 1) {
				$access = 1;
			} else {
				$access = 0;
			}
		} else {
			$access = 0;
		}

		$play = array();
		$i = 1;
		foreach ($videos as $key => $video) {
			if ($i >= 4 && $access == 0) {
				// Guest

				$item = array(
					'name' => $video->title,
					'description' => strip_tags($video->description),
					'duration' => $video->durasi,
					'sources' => 'Invalid',
					'poster' => 'https://www.cilsy.id/template/web/img/video-lock.png',
					'thumbnail' => array([
						'srcset' => 'https://www.cilsy.id/template/web/img/video-lock.png',
						'type' => 'image/png',
						'media' => '(min-width: 400px;)',
					],
						[
							'src' => 'https://www.cilsy.id/template/web/img/video-lock.png',
						]),
				);

			} else {

				$item = array(
					'name' => $video->title,
					'description' => strip_tags($video->description),
					'duration' => $video->durasi,
					'sources' => array([
						'src' => $video->video,
						'type' => $video->type_video,
					]),
					'poster' => $video->image,
					'thumbnail' => array([
						'srcset' => $video->image,
						'type' => 'image/png',
						'media' => '(min-width: 400px;)',
					],
						[
							'src' => $video->image,
						]),
				);

			}
			array_push($play, $item);
			$i++;
		}
		return json_encode($play, JSON_UNESCAPED_SLASHES) . "\n";
		exit;
	}

}
