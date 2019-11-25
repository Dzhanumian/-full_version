<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $fillable = [
        'id', 'student_id', 'test_id', 'value', 'created_at', 'updated_at',
    ];


    public function add($student_id, $test_id, $value){

    	$dateTime = Carbon::now('Europe/Kiev');

    	$lastId = \DB::table('tests')->max('id');

	    Test::create([
	    	'id' => $lastId+1,
	    	'student_id' => $student_id, 
	    	'test_id' => $test_id, 
	    	'value' => $value,
	    	'created_at' => $dateTime, 
	    	'updated_at' => $dateTime, 
	   	]);
	}
}
