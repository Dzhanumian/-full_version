<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lesson_students extends Model
{
    protected $fillable = [
       'id','lesson_id', 'student_id', 'group_id', 'status', 'created_at', 'updated_at',
    ];


	public function missed($lesson_id ,$student_id, $group_id){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$lastUserId = \DB::table('lesson_students')->max('id');

	    Lesson_students::create([
	    	'id' => $lastUserId+1,
	    	'lesson_id' => $lesson_id, 
	    	'student_id' => $student_id,
	    	'group_id' => $group_id,
	    	'status' => 'пропустил',
	    	'created_at' => $dateTime
	   	]);
	}

	public function presence($lesson_id ,$student_id, $group_id){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$lastUserId = \DB::table('lesson_students')->max('id');

	    Lesson_students::create([
	    	'id' => $lastUserId+1,
	    	'lesson_id' => $lesson_id, 
	    	'student_id' => $student_id,
	    	'group_id' => $group_id,
	    	'status' => 'присутствовал',
	    	'created_at' => $dateTime
	   	]);
	}

	public function lesson()
  	{
    	return $this->belongsTo('App\Lesson', 'lesson_id');
  	}
}
