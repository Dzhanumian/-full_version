<?php

Route::group(['prefix' => 'dashboard', 'middleware' => 'teacher'], function()
{
	Route::get('/lesson_Worked/create', 'Lesson\LessonWorkedController@create')->name('lesson.worked.create');
	Route::post('/lesson_Worked/store', 'Lesson\LessonWorkedController@store')->name('lesson.worked.store');

});

