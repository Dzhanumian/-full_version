<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group_students extends Model
{
	protected $table = 'group_student';

	protected $fillable = [
        'id','group_id', 'student_id', 'status_s', 'created_at', 'updated_at',
    ];

    public function add($groups_id, $students_id){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$lastUserId = \DB::table('group_student')->max('id');

	    Group_students::create([
	    	'id' => $lastUserId+1,
	    	'group_id' => $groups_id, 
	    	'student_id' => $students_id,
	    	'status_s' => 'учится',
	    	'created_at' => $dateTime  
	   	]);
	}

}
