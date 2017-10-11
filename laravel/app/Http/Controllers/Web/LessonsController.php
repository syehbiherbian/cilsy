<?php

namespace App\Http\Controllers\Web;
use App\categories;
use App\files;
use App\Http\Controllers\Controller;
use App\lessons;
use App\members;
use App\services;
use App\lessons_detail;
use App\lessons_detail_view;
use App\videos;
use DateTime;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

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

		$services = services::where('status', '=', 1)->where('download', '=', 1)->where('members_id', '=', $mem_id)->where('expired', '>=', $now)->first();
		$lessons = lessons::where('enable', '=', 1)->where('lessons.status', '=', 1)->where('slug', '=', $slug)->first();

		$main_videos = videos::where('enable', '=', 1)->where('lessons_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
		$files = files::where('enable', '=', 1)->where('lesson_id', '=', $lessons->id)->orderBy('id', 'asc')->get();

		//coments
        $getcomment     = DB::table('coments')
            ->leftJoin('members','members.id','=','coments.member_id')
			 ->select('coments.*','members.username as username')
            ->where('coments.lesson_id',$lessons->id)
            ->where('coments.parent',0)
            ->where('coments.status',0)
            ->orderBy('coments.created_at','DESC')
            ->get();

		$date= $now->format('Y-m-d');
		$moth=$now->format('m');
		$year=$now->format('Y');
		$check=lessons_detail::where('lesson_id',$lessons->id)->where('moth',$moth)->where('year',$year)->first();

		//hitung view;
		if(count($check) == 0){
			$store                  = new lessons_detail;
			$store->lesson_id       = $lessons->id;
			$store->moth           = $moth;
			$store->year		    = $year;
			$store->view			= 1;
			$store->created_at      = $now;
			$store->save();

			$detail = new lessons_detail_view;
			$detail->detail_id =$store->id;
			$detail->member_id =$mem_id;
			$detail->created_at= $now;
			$detail->save();

		}else{
			$checkdetail= lessons_detail_view::where('detail_id',$check->id)->where('member_id',$mem_id)->get();
			if(count($checkdetail) == 0 ){
				$store                  = lessons_detail::find($check->id);
				$store->view			= $check->view + 1;
				$store->updated_at      = $now;
				$store->save();

				$detail = new lessons_detail_view;
				$detail->detail_id =$store->id;
				$detail->member_id =$mem_id;
				$detail->created_at= $now;
				$detail->save();
			}

		}

		return view('web.lessons.detail', [
			'lessons' => $lessons,

			'main_videos' => $main_videos,
			'file' => $files,
			'services' => $services,
			'datacomment'=>$getcomment,
		]);
	}

	public function kirimcomment(){
		if (empty(Session::get('memberID'))) {
			return 0;
			exit();
		}
		$uid = Session::get('memberID');
		$member=DB::table('members')->where('id',$uid)->first();
		$isi_kirim  = Input::get('isi_kirim');
		$lesson_id  = Input::get('lesson_id');
		$lessons = DB::table('lessons')->where('id',$lesson_id)->first();

		$store= DB::table('coments')->insertGetId([
				'lesson_id'     => $lesson_id,
				'member_id'=> $uid,
				'description'   => $isi_kirim,
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
