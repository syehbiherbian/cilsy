<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOME PAGE
Route::get('/', 'Web\HomeController@index');
// LESSONS PAGE
Route::get('lessons/{by}/{keyword}', 'Web\LessonsController@index');
Route::get('lessons/{lessons}', 'Web\LessonsController@detail');
Route::post('lessons/getplaylist','Web\LessonsController@getplaylist');
// PAGES
Route::get('pages/{pages}', 'Web\PagesController@index');

// VERITRANS
Route::get('checkout', 'Veritrans\VtwebController@vtweb');
Route::post('notification/handling', 'Veritrans\VtwebController@notification');
// PAYMENT
Route::get('payment/{response}', 'Web\PaymentController@index');


Route::get('/kontak', function () {
    return view('web.contact');
});
Route::get('/kebijakan', function () {
    return view('web.kebijakan');
});
Route::get('/tentang', function () {
    return view('web.tentang');
});



// MEMBER PAGE
Route::get('member', 'Web\Members\AuthController@index');
Route::get('member/signup', 'Web\Members\AuthController@signup');
Route::post('member/signup', 'Web\Members\AuthController@dosignup');
Route::get('member/signin', 'Web\Members\AuthController@signin');
Route::post('member/signin', 'Web\Members\AuthController@dosignin');
Route::get('member/signout', 'Web\Members\AuthController@signout');
Route::post('member/change', 'Web\Members\AuthController@doreset');
Route::get('member/change', 'Web\Members\AuthController@resetpassword');
Route::get('member/dashboard', function ()
{
  echo "Halaman Member !";
});

Route::get('member/package', 'Web\Members\PackageController@index');
Route::post('member/package', 'Web\Members\PackageController@dopackage');



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/system/login', function () {
    return view('admin.login');
});
Route::group(['middleware' => ['auth']], function () {
        Route::get('/system/dashboard', function () {
            return view('admin.home');
        });
        Route::resource('system/member','MemberController');
        Route::resource('system/cat','KategoriController');
        Route::resource('system/page', 'PageController');
        Route::resource('system/lessons','LessonController');
        Route::resource('system/files','FilesController');
        Route::resource('system/videos','VideosController');
});
