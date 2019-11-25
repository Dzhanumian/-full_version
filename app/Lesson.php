<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'id', 'teacher_id', 'group_id', 'room', 'color', 'lesson_date', 'subsidiaries', 'lesson_time', 'lesson_time_end', 'status', 'type', 'data_lesson', 'created_at', 'updated_at',
    ];


	public function add($id ,$teacher_id, $group_id, $status, $color, $lesson_date, $lesson_time, $room, $data_lesson, $subsidiaries, $lesson_time_end, $type){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$status_ar = explode(",", $status);


	    Lesson::create([

	    	'id' => $id,
	    	'teacher_id' => $teacher_id, 
	    	'group_id' => $group_id, 
	    	'status' => $status,
	    	'type' => $type,
	    	'room' => $room,
	    	'subsidiaries' => $subsidiaries,
	    	'color' => $color, 
	    	'lesson_date' => $lesson_date,
	    	'lesson_time' => $lesson_time,
	    	'lesson_time_end'=>$lesson_time_end,
	    	'data_lesson' => $data_lesson, 
	    	'created_at' => $dateTime
	   	]);
	}

	public function lesson_students()
  	{
    	return $this->hasMany('App\Lesson_students', 'lesson_id');
  	}

  	// public function group()
  	// {
   //  	return $this->belongsTo('App\Group', 'group_id');
  	// }
}
