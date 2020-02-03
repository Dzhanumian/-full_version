<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Group;
use App\Lesson;
use App\Event_log;
use App\Student;
use Carbon\Carbon;
use App\Class_room;
use App\Lesson_students;
use App\StudentTestLesson;
use App\TestLessonStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\Lesson\DBWorkedLesson;
use Illuminate\Support\Facades\DB;
use App\TrialLesson;

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
      //dd($request);
      if($teacher = $request->input('teacher_id') == 'Не выбрано' and $request->input('group_id') =='Пробное занятие'){ return redirect()->back()->with('failure', ["У урока должен быть учитель"]);;}
      //dd($request);
      $trial = $request->input('trial');
      if(isset($trial) == true){
        

        $lesson_id = Lesson::max('id');
        
        if($request->input('group_id') !='Пробное занятие')
        {
          $groups = Group::all()->where('id', $request->input('group_id'));

          foreach ($groups as $group) {
            $id_t = $group->teacher_id;
            $teacher_name = $group->teacher_name;
            $group_name = $group->group_name;
            $group_id = $group->id;
          }
        }else{
          $group_name = 'Пробное занятие';
          $group_id = 10001;
        }

        $room_id = $request->input('class_room');
        $lesson_data = Class_room::all()->where('id', $room_id);

        foreach ($lesson_data as $data_r) {
          $sub = $data_r->subsidiaries_name;
          $room = $data_r->room_name;
        }

        $teacher = $request->input('teacher_id');
        if($teacher == 'Не выбрано'){
          $teacher_idd = $id_t;
          $name = $teacher_name;
        }else{
          $teacher_idd = $request->input('teacher_id');
          $teacher_namee = User::find($teacher_idd);
          $name = $teacher_namee->surname.' '.$teacher_namee->name;
        }
        
        $les_data = $name.'<br>'.$group_name.'<br>'.$room.'<br>'.$sub;
        $pieces = explode(",", $request->input('status'));
      
        $id_room = $request->input('class_room');
        $subs = Class_room::find($id_room);
        $subsidiaries_id = $subs->subsidiaries_id;


        // dd(
        //   $lesson_id+1,
        //   $teacher_idd,
        //   $request->input('group_id'),
        //   $pieces[0],
        //   $pieces[1],
        //   $request->input('lesson_date'),
        //   $request->input('lesson_time'),
        //   $request->input('class_room'),
        //   $les_data,
        //   $subsidiaries_id,
        //   $request->input('lesson_time_end'),
        //   $request->input('type')
        // );
        
        $lesson = new Lesson();
        $lesson->add(
          $lesson_id+1,
          $teacher_idd,
          $group_id,
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


        $student = new TrialLesson;
        //dd($request->input('students'), $request);
        $student_list = $request->input('students');

        foreach ($student_list as $stud){
          $student->add($lesson_id+1, $stud);
        }
        
        $del_id = DB::table('trial_lessons')->where('lesson_id', $lesson_id)->pluck('user_id');


        $log = new Event_log();
        $log->log($request->input('subs_name'), $lesson_id+1, 'добавил пробный урок');

        return redirect('/dashboard/lesson_week');

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

    //dd($request);
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
      $room = Class_room::find($lesson->room);

      $teachers = User::all()->where('teaches', 'да');
      $class_rooms = Class_room::all();

      $back = back()->getTargetUrl();

      if($lesson->group_id == 9999){
        $Lesson_student = Lesson_students::where('lesson_id', $id)->get();
        $student = $Lesson_student->where('lesson_id', $id);

        $studentIdArr = [];
        foreach ($student as $stud) {
          $studentIdArr[] = $stud->student_id;
        }
        
        $DBWorkedLesson = new DBWorkedLesson;
        $dataUpdateLesson = $DBWorkedLesson->GetDataCreate();
        $dataUpdateLesson['students'] = Student::where('status', 'Активный')->whereNotIn('id', $studentIdArr)->get();
        $dataUpdateLesson[] = Student::where('status', 'Активный')->whereIn('id', $studentIdArr)->get();
        //dd($dataUpdateLesson);
        return view('admin.lesson.edit_worked', compact('dataUpdateLesson', 'lesson', 'teachers', 'groups', 'class_rooms', 'teaches', 'group', 'room', 'back'));
      }

      if($lesson->type == 'Тестирование'){

        $student = StudentTestLesson::where('lesson_id', $id)->get();
        return view('admin.lesson.edit_test', compact('lesson', 'teachers','class_rooms', 'teaches', 'room', 'back', 'student'));
      }

      $groups = Group::all()->where('status', 'активная');

      if($lesson->group_id == 10001){
        return view('admin.lesson.edit', compact('lesson', 'teachers', 'groups', 'class_rooms', 'teaches', 'room', 'back'));
      }

      $group = Group::find($lesson->group_id);
    

    	return view('admin.lesson.edit', compact('lesson', 'teachers', 'groups', 'class_rooms', 'teaches', 'group', 'room', 'back'));
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->role == 'teacher'){
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
        $update = Lesson::find($id);
        //dd($update);

      if($update->type == 'Тестирование'){    
        $teacher = User::find($request->input('teacher_id'));
        $class_room = Class_room::find($request->input('class_room'));
        $sub = $class_room->subsidiaries_name;
        $room = $class_room->room_name;
        $les_data = $teacher->surname.' '.$teacher->name.'<br>'.'Тестирование'.'<br>'.$room.'<br>'.$sub;

        $dateTime = Carbon::now('Europe/Kiev');

          $lessonData = [
            'teacher_id' => $request->input('teacher_id'), 
            'group_id' => 10000,
            'room' => $class_room->id,
            'subsidiaries' => $class_room->subsidiaries_id,
            'lesson_date' => $request->input('lesson_date'),
            'lesson_time' => $request->input('lesson_time'),
            'lesson_time_end'=>$request->input('lesson_time_end'),
            'data_lesson' => $les_data,
            'updated_at' => $dateTime
          ];
          //dd($lessonData);
        
        StudentTestLesson::where('lesson_id', $update->id)->delete();
        TestLessonStudent::where('lesson_id', $update->id)->delete();
        $tests_stud = new StudentTestLesson;
        $stud_tests = new TestLessonStudent;
        $lastId = \DB::table('student_test_lessons')->max('id');

        $lesson_id = $update->id;
        for ($i=1; $i < 8; $i++){ 
            if($request->input('fio'.$i) != null)
            {
                $tests_stud->add(
                    $lesson_id, 
                    $request->input('fio'.$i), 
                    $request->input('phone'.$i), 
                    $request->input('comment'));

                $stud_tests->add(
                    $lesson_id, 
                    (int)$lastId+1,
                    $request->input('fio'.$i),  
                    'планируемо');
            }; //echo "<br>";
            $lastId = $lastId + $i;
        }
        
        DB::table('lessons')->where('id', $lesson_id)->update($lessonData);

        $back = $request->input('back');
        //echo '<script>window.close()</script>';
        return redirect($back);

        //return redirect($request->input('back'));
      }

        if ($update->group_id == 9999) {
        
          $pieces = explode(",", $request->input('status'));
          $class_id = $request->input('class_room');
          $class = Class_room::find($class_id);
          //$class->

          $arr_stud = $request->input('students');

          //dd($request);
          $arr_stud = $request->input('students');

          $teacher = User::find($request->input('teacher_id'));
          $Student = Student::all()->whereIN('id', $arr_stud)->values();
          $lesson_id = $update->id;

          $selected_student = $Student;
          $limit_stud = count($arr_stud);

          $selected_name = [];
          for ($i=0; $i < $limit_stud; $i++){ 
            $selected_name[] = $selected_student[$i]->surname.' '.$selected_student[$i]->name;
          }

          //dd($request);
          $student_list = implode(", ", $selected_name);
          $student_list_id = implode(",", $arr_stud);
          $les_data = $teacher->surname.' '.$teacher->name."<br>".'Отработка:'."               ".$student_list."<br>".$class->room_name."<br>".$class->subsidiaries_name;

          $dateTime = Carbon::now('Europe/Kiev');

          $lessonData = [
            //'id' => $lesson_id,
            'teacher_id' => $request->input('teacher_id'), 
            'group_id' => 9999,
            'status' => $pieces[0],
            'type' => $request->input('type'),
            'room' => $class->id,
            'subsidiaries' => $class->subsidiaries_id,
            'color' => $pieces[1],
            'lesson_date' => $request->input('lesson_date'),
            'lesson_time' => $request->input('lesson_time'),
            'lesson_time_end'=>$request->input('lesson_time_end'),
            'data_lesson' => $les_data,
            //'created_at' => $dateTime
          ];
          //dd($lessonData);
          DB::table('lessons')->where('id', $lesson_id)->update($lessonData);

          // DB::table('users')
          //     ->where('id', 1)
          //     ->update(['votes' => 1]);

          
          $log = new Event_log();
          $log->log(null, null, 'добавил отработку');

          $Lesson_students = new Lesson_students;

          Lesson_students::where('lesson_id', $lesson_id)->delete();

          foreach ($arr_stud as $stud){
            $Lesson_students->planned($id, $stud);
          }
          $back = $request->input('back');
        
          return redirect($back);
          //dd($lessonData);
        }
        //
    	  $lesson_id = $id;
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
      $dell = Lesson::find($id);
      //dd($update);

      if($dell->type == 'Тестирование')
      {
        StudentTestLesson::where('lesson_id', $id)->delete();
        TestLessonStudent::where('lesson_id', $id)->delete();

        $log = new Event_log();
        $log->log('Урок № '.$id, $id, 'удалил урок');

        lesson::find($id)->delete();

        return redirect()->back();
      }

    	$del_stud = Lesson_students::all()->where('lesson_id', $id);

  		foreach ($del_stud as $del)
  		{	
  			Lesson_students::find($del->id)->delete();
  		}



    	$log = new Event_log();
    	$log->log('Урок № '.$id, $id, 'удалил урок');

    	lesson::find($id)->delete();

      TrialLesson::where('lesson_id', $id)->delete();

    	return redirect()->back();
    }
}
