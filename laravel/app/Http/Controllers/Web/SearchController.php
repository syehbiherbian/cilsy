<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;

// use App\members;
use App\lessons;
use App\categories;
// use App\videos;
// use App\services;
// use App\files;
use DateTime;

use Session;
class SearchController extends Controller
{
  public function index()
  {
    $c  = Input::get('category');
    $q  = Input::get('q');

    $categories = categories::where('enable','=',1)->get();

    if (!empty($c)) { //with Category

          $category = categories::where('enable','=',1)->where('title','like','%'.$c.'%')->first();
          if (count($category) > 0) {
            $cateid = $category->id;
          }else {
            $cateid = 0;
          }

          $results  = lessons::leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
                      ->select('lessons.*','categories.title as category_title')
                      ->where('lessons.enable','=',1)
                      ->where('lessons.title','like','%'.$q.'%')
                      ->where('lessons.category_id','=',$cateid)
                      ->paginate(10);



    }else { //Without Category

          $results  = lessons::leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
                      ->select('lessons.*','categories.title as category_title')
                      ->where('lessons.enable','=',1)
                      ->where('lessons.title','like','%'.$q.'%')
                      ->paginate(10);

    }


    return view('web.search.index',[
      'categories'  => $categories,
      'results'     => $results
    ]);
  }

  public function autocomplete()
  {


  		$keyword 			= Input::get('term');

  		$lessons 	= lessons::where('enable','=','1')->where('title','like','%'.$keyword.'%')->orderBy('id', 'DESC')->get();



  		$results = array();
  		foreach ($lessons as $key => $lesson) {
  			// if($av->ask->id_user == Sentry::getUser()->id){
  				// foreach ($pelajaran as $key => $pel) {
  					// if ($pel->id == $av->ask->id_pelajaran ) {
  						// if (!empty($keyword)) {
  						// 		if (strpos($av->ask->body, $keyword) !== false) {
  						// 			 array_push($results,['pelajaran'=> $pel->id ,'value'=>$av->ask->body,'label'=>$av->ask->body.' di '.$pel->title]);
  						// 		}
  						// }else{
  								 array_push($results,[
                    //  'pelajaran'=> $pel->id ,
                     'value'=>$lesson->title,
                    //  'label'=>$av->ask->body.' di '.$pel->title
                   ]);
  						// }
  					// }
  				// }
  			// }
  		}

  		echo json_encode($results);

  }


}
