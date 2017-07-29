<?php
use App\members;
use App\Pages;
use App\services;
/**
 *
 */
class Helper
{
  static function member($field)
  {
      $mem_id   = Session::get('memberID');
      if ($mem_id) {
        $members  = members::where('id','=',$mem_id)->first();
        $result   = $members->$field;
        return $result;
      }
  }
  static function package($field)
  {
      $now = new DateTime();


      $mem_id   = Session::get('memberID');
      if ($mem_id) {
        $services  = services::where('status','=',1)->where('members_id','=',$mem_id)->where('expired','>=',$now)->first();
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
    $pages  = Pages::where('enable',1)->get();
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
