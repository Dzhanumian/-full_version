<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentTestLesson extends Model
{
    protected $fillable = [
        'id', 'lesson_id', 'fio', 'phone_number', 'comment', 'created_at', 'updated_at',
    ];


	public function add($lesson_id, $fio, $phone_number, $comment){

    	$dateTime = Carbon::now('Europe/Kiev');
      	$lastId = \DB::table('student_test_lessons')->max('id');

      	//dd($lesson_id, $fio, $phone_number, $comment);

	    StudentTestLesson::create([
        	'id' => $lastId+1,
        	'lesson_id' => $lesson_id,
	    	'fio' => $fio,
	    	'phone_number' => $phone_number, 
	    	'comment' => $comment, 
	    	'created_at' => $dateTime,
	   	]);
	}
}
