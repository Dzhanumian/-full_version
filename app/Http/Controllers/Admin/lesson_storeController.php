<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Group;
use App\Lesson;
use App\Event_log;
use Carbon\Carbon;
use App\Class_room;
use App\Lesson_students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class lesson_storeController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }	

    public function update(Request $request, $id)
    {   
        if(Auth::user()->role ==  'teacher'){
            $les = Lesson::find($id);
            
            $lesson_date = strtotime($les->lesson_date);
            $to_dey = strtotime(date("Y-m-d"));
            $from = $lesson_date - 259200;
            $before = $lesson_date + 259200;

            if($from >= $to_dey || $before <= $to_dey){
                return redirect()->back()->with('failure', ["Урок можно редактировать за 48 часов и после 48 относительно даты занятия"]);
            } 
            $count = Lesson_students::all()->where('lesson_id', $id)->count();
            if($count == 0){
                return redirect()->back()->with('failure', ["Вначале отметьте студентов"]);
            } 
            //return redirect()->back();
        }

        $update = Lesson::find($id);
        
        $pieces = explode(",", $request->input('status'));

    	$update->update([ 
	    	'status' => $pieces[0],
	    	'color' => $pieces[1], 
        ]);

        if ($pieces[0] == 'Отмененный') {
            Lesson_students::where('lesson_id', $id)->delete();
        }

      return redirect()->back();
    }
}
