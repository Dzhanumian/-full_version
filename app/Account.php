<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $fillable = [
        'id', 'student_id', 'account', 'created_at', 'updated_at',
    ];    


    public function add(){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$lastId = \DB::table('accounts')->max('id');

    	$lastUserId = \DB::table('students')->max('id');

	    Account::create([
	    	'id' => $lastUserId,
	    	'student_id' => $lastUserId, 
	    	'account' => 0, 
	    	'created_at' => $dateTime, 
	    	'updated_at' => $dateTime, 
	   	]);
	}
}
