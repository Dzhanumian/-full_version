<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Event_log extends Model
{
    protected $fillable = [
        'id','user_id', 'user_id_event', 'user_name', 'user_name_event', 'event', 'created_at', 'updated_at',
    ];

    // $auth = new Authentication();
    // return $auth->test();

    public function log($user_name_event, $id, $event){

    	$userId = Auth::id();
    	$userName = Auth::user()->name;
    	$dateTime = Carbon::now('Europe/Kiev');
        $lastUserId = \DB::table('event_logs')->max('id');

    	Event_log::create([
            'id' => $lastUserId+1,
    		'user_id' => $userId, 
    		'user_id_event' => $id, 
    		'user_name' => $userName,
    	 	'user_name_event' => $user_name_event,
    		'event' => $event,
    	 	'created_at' => $dateTime, 
    	]);
    }

    public function logStud($user_name_event){

        $dateTime = Carbon::now('Europe/Kiev');
        $lastUserId = \DB::table('event_logs')->max('id');

        Event_log::create([
            'id' => $lastUserId+1,
            'user_name_event' => $user_name_event,
            'event' => 'зарегистрировался',
            'created_at' => $dateTime, 
        ]);
    }


    public function test($name_stud, $userId, $test){

        $dateTime = Carbon::now('Europe/Kiev');
        $lastUserId = \DB::table('event_logs')->max('id');

        Event_log::create([
            'id' => $lastUserId+1,
            'user_name' => $name_stud,
            'event' => $test,
            'user_id' => $userId,
            'created_at' => $dateTime, 
        ]);
    }
}
