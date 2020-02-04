<?php

Route::group(['prefix' => 'dashboard', 'middleware' => 'teacher'], function()
{
	Route::get('/lesson_worked/create', 'Lesson\LessonWorkedController@create')->name('lesson.worked.create');
	Route::post('/lesson_worked/store', 'Lesson\LessonWorkedController@store')->name('lesson.worked.store');
});

