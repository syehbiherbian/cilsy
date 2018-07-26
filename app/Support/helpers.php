<?php
use App\Models\Member;
use App\Models\Page;
use App\Models\Service;
use App\Models\Contributor;
use App\Models\IncomeDetail;
use App\Models\Lesson;
use App\Models\ContributorNotif;
use App\Models\Video;
use App\Models\UserNotif;
use App\Models\Income;
use App\Models\Cart;
/**
 *
 */
class Helper
{
  static function getTotalVideo($lesson_id)
  {
    $data = Video::where('enable',1)->where('lessons_id',$lesson_id)->count();
    return $data;
  }
  static function member($field)
  {
      $mem_id   = Auth::guard('members')->user()->id ;
      if ($mem_id) {
        $members  = Member::where('id','=',$mem_id)->first();
        $result   = $members->$field;
        return $result;
      }
  }
  static function package($field)
  {
      $now = new DateTime();


      $mem_id   =  Auth::guard('members')->user()->id;
      if ($mem_id) {
        $services  = Service::where('status','=',1)->where('members_id','=',$mem_id)->where('expired','>=',$now)->first();
        if(count($services) > 0){
          if ($field == 'title') {
            $result = $services->title;
          }elseif ($field == 'expired') {


            $datetime1 = $now;
            $datetime2 = new DateTime($services->expired);

            // if($datetime2 > $datetime1 ){
              $difference = $datetime1->diff($datetime2);
              $result = $difference->days;
            // }else {
            //   $result = 0;
            // }
          }
          return $result;
        }else {

          if ($field == 'title') {
            return 'Belum langganan';
          }elseif ($field == 'expired') {
            return 0;
          }

        }
      }

  }

  static function pageMenu()
  {
    $pages  = Page::where('enable',1)->paginate(3);
    $html   = '';
    $html .='<ul class="nav-footer">';
    $html .='<li>Cilsy</li>';
    foreach ($pages as $key => $row) {
      $html .='<li><a href="'.url('pages/'.$row->url).'">'.$row->title.'</a></li>';
    }
    $html .='</ul>';

    return $html;
  }

  static function searchForm()
  {
      $html  = '';
      $html .= '<form class="navbar-form navbar-left form-search" action="" method="post">
        <div class="input-group">
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
          <div class="input-group-btn">
            <button type="button" class="btn btn-secondary dropdown-toggle btn-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Kategori <i class="ion-android-arrow-dropdown"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#">Lorem</a>
              <a class="dropdown-item" href="#">Lorem</a>
              <a class="dropdown-item" href="#">Lorem</a>
              <!-- <div role="separator" class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a> -->
            </div>
          </div>
          <span class="input-group-btn">
             <button class="btn btn-secondary btn-search" type="button"><i class="ion-android-search"></i></button>
           </span>
        </div>
      </form>';
      return $html;

  }
}
function cart(){
  $member_id = Auth::guard('members')->user()->id ?? null;
  $data = Cart::where('member_id', $member_id)->with('member', 'contributor', 'lesson')->get();
  $html='';
  foreach ($data as $cart) {
        $html .='<li class="clearfix">
                <img style="max-width:70px;max-height:70px;" src="'.$cart->lesson->image.'" alt="item1">
                <span class="item-name">'.$cart->lesson->title.'</span>
                <span class="item-price">Rp'.number_format($cart->lesson->price, 0, ",", ".") .'</span>
                </li>';
  }
  return $html;
}
function getTotalCart(){
  $member_id =  Auth::guard('members')->user()->id ?? null;
  $data = Cart::where('member_id', $member_id)->count();
  return $data;
}

function namemember(){
  $member_name =  substr(Auth::guard('members')->user()->username, '0', 5);
  return $member_name;
}

function notif(){

    $contribID = Auth::guard('contributors')->user()->id;
    $notif =ContributorNotif::where('contributor_id',$contribID)->where('status',0)->latest()->take(5)->get();
    $html='';
    foreach ($notif as  $value) {
        $url = url('/contributor/comments/detail', $parameters = [$value->slug], $secure = null);
        $html .='<li><a href="'.$url.'" onclick="notifview('.$value->id.')">'.$value->title.'</a></li>';
        
    }
    return $html;
}
function totalnotif(){
  $mem_id =  Auth::guard('contributors')->user()->id;
  $notif = ContributorNotif::where('contributor_id',$mem_id)->where('status',0)->count();
  return $notif;
}
function notifuser(){
  
  $mem_id =  Auth::guard('members')->user()->id;
  $notif = UserNotif::where('id_user',$mem_id)->where('status',0)->latest()->take(5)->get();
  $html='';
  
  foreach ($notif as  $value) {
      $url = url('lessons', $parameters = [$value->slug], $secure = null);
      $html .='<li><a href="'.$url.'" onclick="notifview('.$value->id.')">'.substr($value->title, '0', 40).'</a></li>';

  }
  return $html;
}

function totalnotifuser(){
  $mem_id =  Auth::guard('members')->user()->id;
  $notif = UserNotif::where('id_user',$mem_id)->where('status',0)->count();
  return $notif;
}

function coments(){
  $contribID = Auth::guard('contributors')->user()->id;
  $html='';
  if($contribID !==null){
      $cotrib= DB::table('comments')
              ->leftjoin('lessons','lessons.id','=','comments.lesson_id')
              ->where('comments.contributor_id',$contribID)->where('comments.status','0')
              ->where('desc', '<>', 1)
              ->select('comments.*')->get();
       
      $html.=''.count($cotrib).'';

  }
 return $html;
}
function badge(){
      $contribID = Auth::guard('contributors')->user()->id;
      $cotrib= Contributor::where('id',$contribID)->first();

      $html='';
      if($cotrib !==null){
          if($cotrib->points >=0 and $cotrib->points <=99){
              $html.='Kontributor';

          }elseif($cotrib->points >=100 and $cotrib->points <=499){
              $html.='Profesional';
          }
          elseif($cotrib->points >=500 and $cotrib->points <=1499){
              $html.='Expert';
          }
          elseif($cotrib->points >=1500 and $cotrib->points <=4999){
              $html.='Master';
          }
          elseif($cotrib->points >=5000 ){
              $html.='Guru';
          }
      }
      return $html;
}
function points(){
      $contribID = Auth::guard('contributors')->user()->id;
      $html='';
      if($contribID !==null){
          $cotrib= Contributor::where('id',$contribID)->first();
          $html.=''.$cotrib->points.'';

      }
     return $html;
}
function income(){
  if (empty(Auth::guard('contributors')->user()->id)) {
    return redirect('contributor/login');
  }

  $contribID = Auth::guard('contributors')->user()->id;
  $html='';
  if($contribID !==null){
    
      $row = Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
      ->where('lessons.contributor_id',$contribID)
      ->where('flag', '0')->sum('invoice_details.harga_lesson');
 
        if(count($row) ==0){
                $row = Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
                 ->where('contributor_id',$contribID)
                 ->where('flag', '0');
                 }

        if(count($row)>0){
            $html.=''.number_format($row*70/100,0,",",".").'';
        }else{
            $html.='0';
        }
    }
    return $html;
}
function lessons_pending(){
      $contribID = Auth::guard('contributors')->user()->id;
      $html='';
      if($contribID !==null){
          $data = Lesson::where('contributor_id',$contribID)->where('lessons.status',0)->count();
          $html.=''.$data.'';

      }
    return $html;
}
function lessons_publish(){
      $contribID = Auth::guard('contributors')->user()->id;
      $html='';
      if($contribID !==null){
          $data = Lesson::where('contributor_id',$contribID)->where('lessons.status',1)->count();
          $html.=''.$data.'';

      }
    return $html;
}

function search_video_index($videos, $id) {
  foreach ($videos as $key => $video) {
    if ($video['id'] == $id) {
      return $key;
    }
  }
}

function insert_array( $array, $search_key, $insert_key, $insert_value, $insert_after_founded_key = true, $append_if_not_found = false ) {

  $new_array = array();

  foreach( $array as $key => $value ){

      // INSERT BEFORE THE CURRENT KEY? 
      // ONLY IF CURRENT KEY IS THE KEY WE ARE SEARCHING FOR, AND WE WANT TO INSERT BEFORE THAT FOUNDED KEY
      if( $key === $search_key && ! $insert_after_founded_key )
          $new_array[ $insert_key ] = $insert_value;

      // COPY THE CURRENT KEY/VALUE FROM OLD ARRAY TO A NEW ARRAY
      $new_array[ $key ] = $value;

      // INSERT AFTER THE CURRENT KEY? 
      // ONLY IF CURRENT KEY IS THE KEY WE ARE SEARCHING FOR, AND WE WANT TO INSERT AFTER THAT FOUNDED KEY
      if( $key === $search_key && $insert_after_founded_key )
          $new_array[ $insert_key ] = $insert_value;

  }

  // APPEND IF KEY ISNT FOUNDED
  if( $append_if_not_found && count( $array ) == count( $new_array ) )
      $new_array[ $insert_key ] = $insert_value;

  return $new_array;

}

// function join_video_quiz($videos, $quiz) {
//   $video = $videos->toArray();
  
//   foreach ($quiz as $key=> $q) {
//     $after_vid = $q->video_id;
//     $idx = search_video_index($videos, $after_vid);
//     $videos = insert_array($videos, $idx, 'kuis'.$key, $q->toArray());
//   }

//   return array_values($videos);
// }
