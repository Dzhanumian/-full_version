<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TrialLesson extends Model
{
    protected $fillable = [
        'id', 'lesson_id', 'user_id', 'status', 'created_at', 'updated_at',
    ];


	public function add($lesson_id, $user_id){

		//dd($lesson_id, $user_id);

    	$dateTime = Carbon::now('Europe/Kiev');
      	$lastId = \DB::table('trial_lessons')->max('id');

	    TrialLesson::create([
        	'id' => $lastId+1,
        	'lesson_id' => $lesson_id,
	    	'user_id' => $user_id,
	    	'status' => 'назначено', 
	    	'created_at' => $dateTime,
	   	]);
	}
}
