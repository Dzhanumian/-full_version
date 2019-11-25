<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    protected $fillable = [
        'id','course_name', 'category', 'level', 'language', 'status', 'created_at', 'updated_at',
    ];

    public function add($course_name1, $category1, $level1){

        $dateTime = Carbon::now('Europe/Kiev');
        $lastUserId = \DB::table('courses')->max('id');

        Course::create([
            'id' => $lastUserId+1,
            'course_name' => $course_name1,
            'category' => $category1, 
            'level' => $level1, 
            'language' => 'english',
            'status' => 'active',
            'created_at' => $dateTime,
        ]);
    }
}
