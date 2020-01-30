<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TestLessonStudent extends Model
{
    protected $fillable = [
        'id', 'lesson_id', 'fio', 'student_id', 'status', 'created_at', 'updated_at',
    ];


	public function add($lesson_id, $student_id, $fio, $status){
    	$dateTime = Carbon::now('Europe/Kiev');
      	$lastId = \DB::table('test_lesson_students')->max('id');

	    TestLessonStudent::create([
        	'id' => $lastId+1,
        	'lesson_id' => $lesson_id,
	    	'student_id' => $student_id,
	    	'fio' => $fio,
	    	'status' => $status, 
	    	'created_at' => $dateTime,
	   	]);
	}
}
