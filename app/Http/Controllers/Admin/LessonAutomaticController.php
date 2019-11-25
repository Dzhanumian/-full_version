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

class LessonAutomaticController extends Controller
{
    public function create()
    {	
    	if(Auth::user()->role == 'teacher'){
    		echo '<script>window.close()</script>';
     	}

    	$teachers = User::all()->where('teaches', 'да');
    	$groups = Group::all()->where('status', 'активная');
    	$class_rooms = Class_room::all();

    	return view('admin.lesson.automatic_create', compact('teachers', 'groups', 'class_rooms'));
    }

    
    public function store(Request $request)
    {	
		if(Auth::user()->role == 'teacher'){
        	echo '<script>window.close()</script>';
    	}

     	$id = $request->input('group_id');
     	$lesson_id = Lesson::max('id');
     	
    	$groups = Group::all()->where('id', $id);

    	$room_id = $request->input('class_room');
    	$lesson_data = Class_room::all()->where('id', $room_id);

    	foreach ($lesson_data as $data_r) {
    		$sub = $data_r->subsidiaries_name;
    		$room =	$data_r->room_name;
    	}

    	foreach ($groups as $group) {
    		$id_t = $group->teacher_id;
    		$teacher_name = $group->teacher_name;
     	}

     	$teacher = $request->input('teacher_id');
     	if ($teacher == 'Не выбрано'){
     		$teacher_idd = $id_t;
     		$name = $teacher_name;
     	}else{
     		$teacher_idd = $request->input('teacher_id');
     		$teacher_namee = User::find($teacher_idd);
     		$name = $teacher_namee->surname.' '.$teacher_namee->name;
     	}
     	$group_find = Group::find($request->input('group_id'));
      	$group_name = $group_find->group_name;

     	$les_data = $name.'<br>'.$group_name.'<br>'.$room.'<br>'.$sub;
    	$pieces = explode(",", $request->input('status'));
		
		$id_room = $request->input('class_room');
    	$subs = Class_room::find($id_room);
    	$subsidiaries_id = $subs->subsidiaries_id;

		$lesson = new Lesson();

		$date1 = $request->input('from');
		$date2 = $request->input('before');

		$diff = abs(strtotime($date2) - strtotime($date1));

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		$years_l = $years * 365;
		$months_l = $months * 30;
		$limit = $years_l + $months_l + $days;

		$day_week = $request->input('day_week');

		$id = $request->input('group_id');
		$group_stud = Group::where('id','=' ,$id)->with(
    	[

    		'student' => function($query) use ($id){
    			$query->with(['group'])->where('group_id', '=', $id);
    		}

    	])->get();

		$less_stud = new Lesson_students();
		$log = new Event_log();

	    for ($i=0; $i < $limit; $i++) { 

	    	$time = strtotime("$date1");
	    	$time = 86400 * $i + $time;
	    	$date_aut = date("Y-m-d", $time);
	     	$day_w = date("l", $time);
	    	if ($day_w == $day_week) {

	    		$lesson_id = Lesson::max('id');
	    		$lesson->add(
					$lesson_id+1,
					$teacher_idd,
					$request->input('group_id'),
					$pieces[0],
					$pieces[1],
					$date_aut,
					$request->input('lesson_time'),
					$request->input('class_room'),
					$les_data,
					$subsidiaries_id,
					$request->input('lesson_time_end'),
					$request->input('type')
				);
	    	}
	    }

		//$log->log($request->input('subs_name'), $lesson_id + 1, 'добавил уроки');

  		return redirect('/dashboard/lesson_week');
  		
    }

    public function destroy($id)
    {	
    	if(Auth::user()->role == 'teacher'){
        	echo '<script>window.close()</script>';
    	}

	    $dateTime = Carbon::now('Europe/Kiev');echo "<br>";
	    $limit = substr($dateTime, 0, 10);
	    
	    $destroy_l = Lesson::all()->where('lesson_date', '>', $limit)->where('group_id', $id);

	    //$log = new Event_log();
	    $del_stud = Lesson_students::all()->where('group_id', $id);	

	    foreach ($destroy_l as $del_l)
	    {	
	    	Lesson::find($del_l->id)->delete();
	    	Lesson_students::where('lesson_id', $del_l->id)->delete();	   	
	    }

		return redirect()->back(); 	  	
    }
}
