<?php
use App\members;

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
}
