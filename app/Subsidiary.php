<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Subsidiary extends Model
{
    protected $fillable = [
        'id','name', 'adress', 'city', 'created_at', 'updated_at',
    ];


	public function add($name1, $adress1, $city1){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$lastUserId = \DB::table('subsidiaries')->max('id');

	    Subsidiary::create([
	    	'id' => $lastUserId+1,
	    	'name' => $name1, 
	    	'adress' => $adress1, 
	    	'city' => $city1,
	    	'created_at' => $dateTime,
	   	]);
	}
}
