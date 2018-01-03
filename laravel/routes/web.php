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
Route::get('lessons/coments/getComments/{lesson_id}','Web\LessonsController@getComments');
Route::post('lessons/coments/doComment','Web\LessonsController@doComment');
Route::post('lessons/videoTracking','Web\LessonsController@videoTracking');

// Search
Route::get('search', 'Web\SearchController@index');
Route::get('search/autocomplete', 'Web\SearchController@autocomplete');

// Point
Route::get('point', 'Web\PointController@index');

// Conributor Profile
Route::get('contributor/profile/{username}', 'Web\ContributorsController@getProfile');

// PAGES
Route::get('pages/{pages}', 'Web\PagesController@index');

// VERITRANS
Route::get('checkout', 'Veritrans\VtwebController@vtweb');
Route::post('notification/handling', 'Veritrans\VtwebController@notification');
// PAYMENT
Route::get('payment/{response}', 'Web\PaymentController@index');
//page
Route::get('/harga', 'HargaController@index');
Route::get('/kontak', function () {
	return view('web.contact');
});
Route::get('/faq', function () {
	return view('web.faq');
});
Route::get('/carapesan', function () {
	return view('web.cara');
});
Route::get('/petunjuk', function () {
	return view('web.petunjuk');
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

Route::get('member/profile', 'Web\Members\ProfileController@index');
Route::post('member/profile', 'Web\Members\ProfileController@doSubmit');
Route::get('member/change-password', 'Web\Members\PasswordController@index');
Route::post('member/change-password', 'Web\Members\PasswordController@doSubmit');
Route::get('member/subscriptions', 'Web\Members\SubscriptionsController@index');
Route::get('member/subscriptions/unsubscribe/{id}', 'Web\Members\SubscriptionsController@doUnsubscribe');
Route::get('member/point', 'Web\PointController@index');


// Route::post('member/change', 'Web\Members\AuthController@doreset');
// Route::get('member/change', 'Web\Members\AuthController@resetpassword');
Route::get('member/reset', 'Web\Members\AuthController@forgetpassword');
Route::post('member/reset', 'Web\Members\AuthController@doforgetpassword');
Route::post('member/reset/update', 'Web\Members\AuthController@doupdate');
Route::get('member/reset/update/{token}', 'Web\Members\AuthController@updatereset');
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
	Route::resource('system/reward', 'RewardController');
	Route::resource('system/reward-category', 'RewardCategoryController');
	Route::resource('system/pages', 'PagesController');
	Route::resource('system/lessons', 'LessonController');
	Route::resource('system/files', 'FilesController');
	Route::resource('system/videos', 'VideosController');
	Route::resource('system/income','IncomeController');
});

 Route::get('cron/system/generate-income', 'GenerateIncomeController@generate');
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

Route::get('contributor/login', 'Contributors\AuthController@login');
Route::post('contributor/login', 'Contributors\AuthController@doLogin');

Route::get('contributor/register', 'Contributors\AuthController@register');
Route::post('contributor/register', 'Contributors\AuthController@doRegister');
Route::get('contributor/aktivasi/{token}', 'Contributors\AuthController@aktivasi');

Route::get('contributor/logout', 'Contributors\AuthController@logout');

// Home
Route::get('contributor/', 'Contributors\DashboardController@home');
Route::get('contributor/dashboard', 'Contributors\DashboardController@index');
// Lessons
Route::get('contributor/lessons', 'Contributors\LessonsController@redirect');
Route::get('contributor/lessons/{filter}/list', 'Contributors\LessonsController@index');
Route::get('contributor/lessons/create', 'Contributors\LessonsController@create');
Route::post('contributor/lessons/create', 'Contributors\LessonsController@doCreate');
Route::get('contributor/lessons/revision/{id}/proccess', 'Contributors\LessonsController@doProcess');


Route::get('contributor/lessons/{id}/view', 'Contributors\LessonsController@view');
Route::get('contributor/lessons/{id}/edit', 'Contributors\LessonsController@edit');
Route::post('contributor/lessons/{id}/edit', 'Contributors\LessonsController@doEdit');
Route::get('contributor/lessons/{id}/submit', 'Contributors\LessonsController@submit');
Route::post('contributor/lessons/{id}/submit', 'Contributors\LessonsController@doSubmit');
Route::get('contributor/lessons/{id}/delete', 'Contributors\LessonsController@doDelete');

// Videos
Route::get('contributor/lessons/{lesson_id}/create/videos', 'Contributors\VideosController@create');
Route::post('contributor/lessons/{lesson_id}/create/videos', 'Contributors\VideosController@doCreate');
Route::get('contributor/lessons/{lesson_id}/edit/videos', 'Contributors\VideosController@edit');
Route::post('contributor/lessons/{lesson_id}/edit/videos', 'Contributors\VideosController@doEdit');


// Attachment
Route::get('contributor/lessons/{lesson_id}/create/attachments', 'Contributors\AttachmentsController@create');
Route::post('contributor/lessons/{lesson_id}/create/attachments', 'Contributors\AttachmentsController@doCreate');
Route::get('contributor/lessons/{lesson_id}/edit/attachments', 'Contributors\AttachmentsController@edit');
Route::post('contributor/lessons/{lesson_id}/edit/attachments', 'Contributors\AttachmentsController@doEdit');

// Quiz
Route::get('contributor/lessons/{id}/create/quiz', 'Contributors\QuizController@create');
Route::post('contributor/lessons/{id}/store_quiz', 'Contributors\QuizController@store_quiz');
Route::post('contributor/lessons/{id}/update_quiz', 'Contributors\QuizController@update_quiz');
Route::get('contributor/lessons/quiz/{quiz_id}/view', 'Contributors\QuizController@view');
Route::get('contributor/lessons/quiz/{quiz_id}/edit', 'Contributors\QuizController@edit');
Route::get('contributor/lessons/quiz/{quiz_id}/delete', 'Contributors\QuizController@delete_quiz');

// Question/
Route::get('contributor/lessons/quiz/{quiz_id}/create/questions', 'Contributors\QuestionQuizController@create');
Route::post('contributor/lessons/{quiz_id}/store_questions', 'Contributors\QuestionQuizController@store');

Route::get('contributor/lessons/quiz/{quiz_id}/edit/questions', 'Contributors\QuestionQuizController@edit');
Route::post('contributor/lessons/{quiz_id}/update_questions', 'Contributors\QuestionQuizController@update');

// pendapatan
Route::get('contributor/income', 'Contributors\IncomeController@index');
Route::get('contributor/income/account/create', 'Contributors\IncomeController@create');
Route::post('contributor/income/account/create', 'Contributors\IncomeController@doCreate');
Route::get('contributor/income/account/{id}/edit', 'Contributors\IncomeController@edit');
Route::get('contributor/income/account/{id}/delete', 'Contributors\IncomeController@dodelete');
Route::post('contributor/income/account/{id}/edit', 'Contributors\IncomeController@doEdit');
Route::get('contributor/income/view-all', 'Contributors\IncomeController@view');

//reward
Route::get('contributor/reward','Contributors\PointController@index');
Route::get('contributor/reward/{id}/change', 'Contributors\PointController@change');
Route::post('contributor/reward/{id}/change', 'Contributors\PointController@doChange');
Route::get('contributor/reward/{id}/detail','Contributors\PointController@detail');

// Route::get('contributor/info-point','Contributors\PointController@point');
//notif
Route::get('contributor/notif','Contributors\NotifController@index');
Route::get('ajax/notif/view','Contributors\NotifController@view');
Route::get('ajax/notif/read','Contributors\NotifController@read');
Route::post('contributor/notif/delete/{id}','Contributors\NotifController@delete');
// Coments
Route::get('contributor/coments','Contributors\ComentsController@index');
Route::get('contributor/coments/detail/{coment_id}','Contributors\ComentsController@detail');
Route::post('contributor/coments/postcomment','Contributors\ComentsController@postcomment');
Route::post('contributor/coments/deletecomment/{coment_id}','Contributors\ComentsController@deletecomment');

//Akun Contributor dan Halaman Contributor
Route::get('contributor/account/informasi', 'Contributors\AccountController@informasi');
Route::get('contributor/account/informasi/{id}/edit', 'Contributors\AccountController@edit');
Route::post('contributor/account/informasi/{id}/edit', 'Contributors\AccountController@update_informasi');
Route::get('contributor/account/profile', 'Contributors\AccountController@halaman');
