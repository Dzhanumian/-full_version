<?php

Route::group(['prefix' => 'dashboard', 'middleware' => 'admin_owner'], function()
{
	Route::get('/invoice', 'Finance\FinanceController@showAllInvoice');
	Route::get('/invoice/payer_students', 'Finance\FinanceController@showPayerStudents');

	Route::get('/invoice/student/{id}', 'Finance\FinanceController@showStudentPaidGroup')->name('invoice.student');
});