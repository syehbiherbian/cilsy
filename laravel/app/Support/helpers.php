<?php
use App\Models\Member;
use App\Models\Page;
use App\Models\Service;
use App\Model\Contributor;
use App\Models\IncomeDetail;
use App\Models\Lesson;
use App\Models\ContributorNotif;
use App\Models\Video;
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

function notif(){

    $contribID = Session::get('contribID');
    $notif =ContributorNotif::where('contributor_id',$contribID)->where('status',0)->get();
    $url = 'http://localhost/cilsy';
    $html='';
    foreach ($notif as  $value) {
        $html .='<li><a href="'.$url.'/contributor/notif" onclick="notifview('.$value->id.')">'.$value->title.'</a></li>';

    }
    return $html;
}
function coments(){
  $contribID = Session::get('contribID');
  $html='';
  if($contribID !==null){
      $cotrib= DB::table('coments')
              ->join('lessons','lessons.id','=','coments.lesson_id')
              ->where('lessons.contributor_id',$contribID)->where('coments.parent','0')
              ->select('coments.*')->get();
          $total=0;
          foreach ($cotrib as $value) {
            	$cekanswer = DB::table('coments')->where('parent',$value->id)->get();
              if(count($cekanswer)==0){
                $total=$total+1;
              }
          }


      $html.=''.$total.'';

  }
 return $html;
}
function badge(){
      $contribID = Session::get('contribID');
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
      $contribID = Session::get('contribID');
      $html='';
      if($contribID !==null){
          $cotrib= Contributor::where('id',$contribID)->first();
          $html.=''.$cotrib->points.'';

      }
     return $html;
}
function income(){
    if (empty(Session::get('contribID'))) {
      return redirect('contributor/login');
    }
    $date= new DateTime();
    $moth= $date->format('m');
    $year= $date->format('Y');

    $contribID = Session::get('contribID');
    $html='';
    if($contribID !==null){
        $row = IncomeDetail::where('contributor_id',$contribID)->where('moth',$moth)->where('year',$year)->first();
        if(count($row) ==0){
        $row = IncomeDetail::where('contributor_id',$contribID)->orderBy('created_at','desc')->first();
        }

        if(count($row)>0){
            $html.=''.number_format($row->total_income,0,",",".").'';
        }else{
            $html.='0';
        }
    }
    return $html;
}
function lessons_pending(){
      $contribID = Session::get('contribID');
      $html='';
      if($contribID !==null){
          $data = Lesson::where('contributor_id',$contribID)->where('lessons.status',0)->count();
          $html.=''.$data.'';

      }
    return $html;
}
function lessons_publish(){
      $contribID = Session::get('contribID');
      $html='';
      if($contribID !==null){
          $data = Lesson::where('contributor_id',$contribID)->where('lessons.status',1)->count();
          $html.=''.$data.'';

      }
    return $html;
}
