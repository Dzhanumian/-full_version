<?php

require_once('finance.php'); // роуты модуля финансы
require_once('lesson.php'); // роуты модуля уроки

$CS = ['create', 'store'];
Route::resource('/students', 'Admin\StudentController')->only($CS);

Route::get('/test/{id_user}', 'Admin\TestController@index');
Route::get('/test/{id_user}/1', 'Admin\TestController@test_first');
Route::get('/test/{id_user}/2', 'Admin\TestController@test_second');

Route::post('/test/first', 'Admin\TestController@store_1')->name('test1');
Route::post('/test/second', 'Admin\TestController@store_2')->name('test2');

Auth::routes();

Route::get('/', function () {
    return redirect("/dashboard");
});

Route::group(['middleware' => 'admin_owner'], function()
{
	Route::get('/register_user', function () {
	    return view('register_user');
	});
});	

Route::group(['prefix' => 'dashboard', 'middleware' => 'admin_owner'], function()
{

	$ICSEUD = ['index', 'create', 'store', 'edit', 'update', 'destroy'];
	Route::resource('/users', 'userController')->only($ICSEUD);
	Route::post('users/excel', 'userController@excel')->name('users.excel');

	// Модуль филии/кабинеты
	Route::resource('/subsidiary', 'Admin\SubsidiaryController')->only($ICSEUD);
	Route::resource('/class_room', 'Admin\ClassRoomController')->only($ICSEUD);

	// Работа с почтой и паролем
	$EU = ['edit', 'update'];
	Route::resource('/password', 'Admin\PasswordController')->only($EU);
	Route::resource('/email', 'Admin\EmailController')->only($EU);

	// Модуль курсы/группы
	Route::resource('/course', 'Admin\CourseController')->only($ICSEUD);
	Route::resource('/group', 'Admin\GroupController')->only($ICSEUD);
	Route::resource('/group_students', 'Admin\GroupStudentsController');

	Route::get('group_students/graduation/{id}', 'Admin\GroupStudentsController@graduation')->name('graduation');


	// Модуль финансы
	/*
	Route::resource('/finance', 'Admin\FinanceController');
	Route::get('/invoice/{id}/{group_id}', 'Admin\FinanceController@invoice');
	Route::resource('/account', 'Admin\AccountController')->only($EU);
	Route::get('debt/{student_id}', 'Admin\FinanceController@debt_pay')->name('debt.pay');
	Route::post('debt', 'Admin\FinanceController@debt_store')->name('debt.store');
	*/

	// Модуль статистика
	Route::get('/statistics', 'Admin\StatisticController@index')->name('statistic');

	//Архив
	Route::get('/log', 'Admin\LogController@index');

	//Excel
	Route::get('/download', 'Admin\StudentController@excel')->name('student.excel');
});


Route::group(['prefix' => 'dashboard', 'middleware' => 'teacher'], function()
{
	Route::get('/', 'Admin\DashboardController@index');
		
	// Модуль Студенты
	$EUD = ['index','edit', 'update', 'destroy'];
	//Route::get('/students/{status?}/{payouts?}', 'Admin\StudentController@index')->name('student.index');
	Route::post('/filter', 'Admin\FilterController@student_filter')->name('student.filter');
	Route::resource('/students', 'Admin\StudentController')->only($EUD);
	Route::get('/students/info/{id}', 'Admin\StudentController@info')->name('info');
	Route::get('/students/debtor_search', 'Admin\StudentController@debtor_search')->name('debtor_search');
	//тестовый урок

	//отработка
	// Route::get('/lesson_Worked/create', 'Admin\LessonWorkedController@create')->name('lesson.worked.create');
	// Route::post('/lesson_Worked/store', 'Admin\LessonWorkedController@store')->name('lesson.worked.store');

	//тестирование
	Route::get('/lesson_test/create', 'Admin\LessonTestController@create')->name('lesson.test.create');
	Route::post('/lesson_test/store', 'Admin\LessonTestController@store')->name('lesson.test.store');

	//пробное занятие
	Route::get('trial_student', 'Admin\TrialLessonController@get')->name('lesson.trial.student.get');
	Route::post('trial_student', 'Admin\TrialLessonController@store')->name('lesson.trial.student.store');

	// Модуль уроки
	$CSD = ['create', 'store', 'destroy'];
	Route::resource('/lesson', 'Admin\LessonController');
	Route::resource('/lesson/automatic', 'Admin\LessonAutomaticController')->only($CSD);
	Route::post('/lesson/automatic/filter', 'Admin\LessonFlippingController@filters')->name('filter');
	Route::post('/lesson/automatic/filterW', 'Admin\LessonFlippingController@filtersW')->name('filterW');
	
	Route::get('/lesson_one_day/{data}', 'Admin\LessonFlippingController@one_day_next')->name('one_day_next');
	Route::get('/lesson_week/{data?}/{teacher?}/{group?}/{room?}', 'Admin\LessonFlippingController@week')->name('week');
	Route::get('/lesson_month/{data?}/{teacher?}/{group?}/{room?}', 'Admin\LessonFlippingController@month')->name('month');

	Route::resource('/lesson/presence', 'Admin\PresenceController');
	$u = ['update'];
	Route::resource('/lesson/presence/status_up', 'Admin\lesson_storeController')->only($u);

});

Route::get('/home', 'HomeController@index')->name('home');

