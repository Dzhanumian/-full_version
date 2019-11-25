<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'id','teacher_id', 'teacher_name', 'group_name', 'course', 'type', 'status', 'rate','created_at', 'updated_at',
    ];


	public function add($teacher_surname, $group_name1, $course1, $type1, $rate){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$pieces = explode(",", $teacher_surname);
    	$id = (int) $pieces[0];
      $lastUserId = \DB::table('groups')->max('id');

	    Group::create([
        'id' => $lastUserId+1,
	    	'teacher_id' => $id,
	    	'teacher_name' => $pieces[1].' '.$pieces[2], 
	    	'group_name' => $group_name1, 
	    	'course' => $course1,
	    	'type' => $type1, 
	    	'status' => 'новая группа',
        'rate' => $rate, 
	    	'created_at' => $dateTime,
	   	]);
	}

	public function student()
    {
    	return $this->belongsToMany('App\Student', 'group_student', 'group_id', 'student_id')->withPivot('id', 'status_s');
  	}

  	// public function lesson()
  	// {
   //  	return $this->hasMany('App\Lesson', 'group_id');
  	// }
}
