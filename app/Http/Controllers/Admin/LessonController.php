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

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {	
      $time = strtotime("-1 day");
      $yesterday = date("Y-m-d", $time);

      $time = strtotime("+1 day");
      $tomorrow = date("Y-m-d", $time);
        
		  $dateTime = Carbon::now('Europe/Kiev');
		  $date = substr($dateTime, 0, 10);	
    	$lessons = Lesson::all()->where('lesson_date', '=', $date)->sortByDesc('lesson_time');

    	return view('admin.lesson.index', compact('lessons', 'date', 'yesterday', 'tomorrow'));
    }

    public function create()
    {	

    	$teachers = User::all()->where('teaches', 'да');
    	$groups = Group::all()->where('status', 'активная');
    	$class_rooms = Class_room::all();

    	return view('admin.lesson.create', compact('teachers', 'groups', 'class_rooms'));
    }

    public function store(Request $request)
    {	

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
		$lesson->add(
			$lesson_id+1,
			$teacher_idd,
			$request->input('group_id'),
			$pieces[0],
			$pieces[1],
			$request->input('lesson_date'),
			$request->input('lesson_time'),
			$request->input('class_room'),
			$les_data,
			$subsidiaries_id,
      $request->input('lesson_time_end'),
      $request->input('type')
		);


      $log = new Event_log();
      $log->log($request->input('subs_name'), $lesson_id, 'добавил урок');

  		return redirect('/dashboard/lesson_week');
      //echo '<script>window.close()</script>';
    }

    public function edit($id)
    {
      
    	$lesson = Lesson::find($id);

    	$teaches = User::find($lesson->teacher_id);
    	$group = Group::find($lesson->group_id);
    	$room = Class_room::find($lesson->room);

    	$teachers = User::all()->where('teaches', 'да');
    	$groups = Group::all()->where('status', 'активная');
    	$class_rooms = Class_room::all();

      $back = back()->getTargetUrl();

    	return view('admin.lesson.edit', compact('lesson', 'teachers', 'groups', 'class_rooms', 'teaches', 'group', 'room', 'back'));
    }

    public function update(Request $request, $id)
    {

        if(Auth::user()->role ==  'teacher'){
          $lesson_date = strtotime($request->input('lesson_date'));
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
        

    	  $lesson_id = $id;
        $update = Lesson::find($id);
        $dateTime = Carbon::now('Europe/Kiev');

        $id = $request->input('group_id');
     	
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


		$id = $request->input('group_id');
		$group_stud = Group::where('id','=' ,$id)->with(
    	[

    		'student' => function($query) use ($id){
    			$query->with(['group'])->where('group_id', '=', $id);
    		}

    	])->get();


    	$update->update([
        'teacher_id' => $teacher_idd,
	    	'group_id' => $request->input('group_id'), 
	    	'status' => $pieces[0],
	    	'room' => $request->input('class_room'),
	    	'subsidiaries' => $subsidiaries_id,
	    	'color' => $pieces[1], 
	    	'lesson_date' => $request->input('lesson_date'),
	    	'lesson_time' => $request->input('lesson_time'),
        'lesson_time_end' =>$request->input('lesson_time_end'),
	    	'data_lesson' => $les_data,
        'updated_at' => $dateTime,
        'type' => $request->input('type')
        ]);

      if ($pieces[0] == 'Отмененный') {
        Lesson_students::where('lesson_id', $id)->delete();
      }

      $log = new Event_log();
      $log->log('Урок № '.$lesson_id, $lesson_id + 1, 'редактировал урок');
      
  		
      $timestamp = strtotime($request->input('lesson_date'));

      $days_t = (int) 86400;
      $yesterdayy = $timestamp - $days_t;
      $tomorroww = $timestamp + $days_t;

      $time = strtotime("-1 day");
      $yesterday = date("Y-m-d", $yesterdayy);
      $date = date("Y-m-d", $timestamp);
      $tomorrow = date("Y-m-d", $tomorroww);
      

      $lessons = Lesson::all()->where('lesson_date', '=', $date)->sortByDesc('lesson_time');

      $back = $request->input('back');
      //echo '<script>window.close()</script>';
      return redirect($back);
      //return view('admin.lesson.index', compact('lessons', 'date', 'yesterday', 'tomorrow'));
    }

    public function destroy($id)
    {
    	
    	$del_stud = Lesson_students::all()->where('lesson_id', $id);

  		foreach ($del_stud as $del)
  		{	
  			Lesson_students::find($del->id)->delete();
  		}

    	$log = new Event_log();
    	$log->log('Урок № '.$id, $id, 'удалил урок');

    	lesson::find($id)->delete();

    	return redirect()->back();
    }
}
