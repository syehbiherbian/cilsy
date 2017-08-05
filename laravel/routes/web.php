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
Route::post('lessons/getplaylist', 'Web\LessonsController@getplaylist');
// Search
Route::get('search', 'Web\SearchController@index');
Route::get('search/autocomplete', 'Web\SearchController@autocomplete');

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

/*
|--------------------------------------------------------------------------
| Cronjob Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

 Route::get('cron/mail/user/reminder/payment', 'Cron\ReminderController@index');




/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('member', 'Web\Members\AuthController@index');
Route::get('member/signup', 'Web\Members\AuthController@signup');
Route::post('member/signup', 'Web\Members\AuthController@dosignup');
Route::get('member/signin', 'Web\Members\AuthController@signin');
Route::post('member/signin', 'Web\Members\AuthController@dosignin');
Route::get('member/signout', 'Web\Members\AuthController@signout');
Route::post('member/change', 'Web\Members\AuthController@doreset');
Route::get('member/change', 'Web\Members\AuthController@resetpassword');
Route::get('member/dashboard', function () {
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
	Route::resource('system/members', 'MembersController');
	// Edit Member

	Route::post('system/members/getServices', 'MembersController@getServices');
	Route::post('system/members/addServices', 'MembersController@addServices');
	Route::post('system/members/getEditServices', 'MembersController@getEditServices');
	Route::post('system/members/editServices', 'MembersController@editServices');

	Route::resource('system/cat', 'KategoriController');
	Route::resource('system/pages', 'PagesController');
	Route::resource('system/lessons', 'LessonController');
	Route::resource('system/files', 'FilesController');
	Route::resource('system/videos', 'VideosController');
});

/*
|--------------------------------------------------------------------------
| Contributor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

 // Authentication

 Route::get('contributor/login','Contributors\AuthController@login');
 Route::post('contributor/login','Contributors\AuthController@doLogin');

 Route::get('contributor/register','Contributors\AuthController@register');
 Route::post('contributor/register','Contributors\AuthController@doRegister');


Route::get('contributor/logout','Contributors\AuthController@logout');

// Home
Route::get('contributor','Contributors\DashboardController@index');
// Lessons
Route::get('contributor/lessons', 'Contributors\LessonsController@redirect');
Route::get('contributor/lessons/{filter}/list', 'Contributors\LessonsController@index');
Route::get('contributor/lessons/create', 'Contributors\LessonsController@create');
Route::post('contributor/lessons/create', 'Contributors\LessonsController@doCreate');


Route::get('contributor/lessons/{id}/edit', 'Contributors\LessonsController@edit');
Route::get('contributor/lessons/create/submit', 'Contributors\LessonsController@submit');
Route::post('contributor/lessons/create/submit', 'Contributors\LessonsController@doSubmit');

// Videos
Route::get('contributor/lessons/create/videos', 'Contributors\VideosController@create');

// Attachment
Route::get('contributor/lessons/create/attachments', 'Contributors\AttachmentsController@create');

// Quiz
Route::get('contributor/lessons/{id}/create/quiz', 'Contributors\QuizController@create');
Route::post('contributor/lessons/{id}/store_quiz', 'Contributors\QuizController@store_quiz');
Route::get('contributor/lessons/quiz/{quiz_id}/edit', 'Contributors\QuestionQuizController@edit');
// Question
Route::get('contributor/lessons/quiz/{quiz_id}/create/questions', 'Contributors\QuestionQuizController@create');
Route::post('contributor/lessons/{quiz_id}/store_questions', 'Contributors\QuestionQuizController@store');




//questions
Route::get('contributor/questions','Contributors\QuestionsController@getQuestions');
