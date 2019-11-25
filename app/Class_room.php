<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Class_room extends Model
{
    protected $fillable = [
        'id','subsidiaries_id', 'room_name', 'seating_capacity', 'subsidiaries_name', 'created_at', 'updated_at',
    ];


	public function add($subsidiaries_name1, $room_name1, $seating_capacity1, $sub_id1){

    	$dateTime = Carbon::now('Europe/Kiev');

    	$lastUserId = \DB::table('class_rooms')->max('id');

	    Class_room::create([
	    	'id' => $lastUserId+1,
	    	'subsidiaries_id' => $sub_id1,
	    	'subsidiaries_name' => $subsidiaries_name1, 
	    	'room_name' => $room_name1, 
	    	'seating_capacity' => $seating_capacity1,
	    	'created_at' => $dateTime,
	   	]);
	}
}
