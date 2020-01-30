<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TrialLesson;
use Illuminate\Support\Facades\DB;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Group;
use App\Class_room;
use App\Student;

class TrialLessonController extends Controller
{	
	public function get()
	{
		$teachers = User::all()->where('teaches', 'да');
    	$groups = Group::all()->where('status', 'активная');
    	$class_rooms = Class_room::all();
    	$student = Student::where('status', '!=', 'Не активный')->where('status', '!=', 'Закончил обучение')->get();

    	return view('admin.lesson.trial', compact('teachers', 'groups', 'class_rooms', 'student'));
	}

    public function store(Request $request)
    {	
    	$controll = Lesson::find($request->input('lesson_idd'));
        if($controll->status == 'Отмененный'){
            return redirect()->back()->with('failure', ["Невозможно отметить студентов, так как у урока статус 'Отмененный'"]);
        }

        if(Auth::user()->role ==  'teacher'){
            $les = Lesson::find($request['lesson_idd']);
            
            $lesson_date = strtotime($les->lesson_date);
            $to_dey = strtotime(date("Y-m-d"));
            $from = $lesson_date - 259200;
            $before = $lesson_date + 259200;

            if($from >= $to_dey || $before <= $to_dey){
                return redirect()->back()->with('failure', ["Урок можно редактировать за 48 часов и после 48 относительно даты занятия"]);
            } 
            //return redirect()->back();
        }

    	$student = new TrialLesson;
    	$lesson_id = $request->input('lesson_idd');

    	$student_list = $request->input('tria_users');

    	TrialLesson::where('lesson_id', $lesson_id)->delete();
    	if ($request->input('tria_users') == null){
    		return redirect()->back();
    	}

    	foreach ($student_list as $stud){
    		$student->add($lesson_id, $stud);
    	}
    	
    	$del_id = DB::table('trial_lessons')->where('lesson_id', $lesson_id)->pluck('user_id');

    	//DB::table('lesson_students')->where('lesson_id', $lesson_id)
    								//->whereIN('student_id', $del_id)
    								//->delete();
    	//dd($del_id);
        //$all_student = Student::where('status', 'Активный')->whereIN('id',$except->toArray())->get();

    	return redirect()->back();
    }
}
