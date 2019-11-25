<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $fillable = [
        'id','name', 'surname', 'patronymic', 'date_of_birth', 'phone_number', 'email_s', 'responsible', 'relations', 'surname_r', 'name_r' ,  'patronymic_r', 'date_of_birth_r', 'phone_number_r', 'studied_or_studying_r', 'field_of_activity',  'education', 'meaning', 'about_us', 'status', 'created_at', 'updated_at', 'studied', 'email_r', 'payouts', 'comment'
    ];

	public function add($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var11, $var12, $var13, $var14, $var15, $var16, $var17, $var18, $var19, $var20){

    	$dateTime = Carbon::now('Europe/Kiev');
    	$lastUserId = \DB::table('students')->max('id');

	    Student::create([
	    	'id' => $lastUserId+1,
	    	'name' => $var1, 
	    	'surname' => $var2, 
	    	'patronymic' => $var3,
	    	'date_of_birth' => $var4,
	    	'phone_number' => $var5, 
	    	'email_s' => $var6, 
	    	'responsible' => $var7, 
	    	'relations' => $var8, 
	    	'field_of_activity' => $var9, 
	    	'education' => $var10, 
	    	'meaning' => $var11, 
	    	'about_us' => $var12, 
	    	'status' => 'Новый студент',
	    	'surname_r' =>  $var13,
	    	'name_r' => $var14,
	    	'patronymic_r' => $var15,
	    	'date_of_birth_r' => $var16,
	    	'phone_number_r' => $var17,
	    	'studied' => $var18,
	    	'email_r' => $var19,
	    	'created_at' => $dateTime, 
	    	'updated_at' => $dateTime,
	    	'comment' => $var20
	   	]);
	}

	public function group()
    {
    	return $this->belongsToMany('App\Group', 'group_student', 'student_id', 'group_id')->withPivot('id', 'status_s');
  	}
}