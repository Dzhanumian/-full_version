<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Group;
use App\Lesson;
use App\Student;
use App\Event_log;
use Carbon\Carbon;
use App\Class_room;
use App\Group_students;
use App\Lesson_students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $controll = Lesson::find($request->input('lesson_id'));
        if($controll->status == 'Отмененный'){
            return redirect()->back()->with('failure', ["Невозможно отметить студентов, так как у урока статус 'Отмененный'"]);
        }

        if(Auth::user()->role ==  'teacher'){
            $les = Lesson::find($request['lesson_id']);
            
            $lesson_date = strtotime($les->lesson_date);
            $to_dey = strtotime(date("Y-m-d"));
            $from = $lesson_date - 259200;
            $before = $lesson_date + 259200;

            if($from >= $to_dey || $before <= $to_dey){
                return redirect()->back()->with('failure', ["Урок можно редактировать за 48 часов и после 48 относительно даты занятия"]);
            } 
            //return redirect()->back();
        }

        $lesson_id = $request['lesson_id'];
        $group_id = $request['group_id'];
        $students = $request['studs'];
        $stud_all = $request['all'];

        $Lesson_students = new Lesson_students();
        Lesson_students::where('lesson_id', $lesson_id)->delete();

        if(is_array($students) == false)
        {

            foreach ($stud_all as $pres){

                $Lesson_students->presence($lesson_id, $pres, $group_id);
            }

            $log = new Event_log();
            $log->log($lesson_id, $group_id, 'Отметил/ла студентов на уроке №'.$lesson_id.'все присутствовали');

            return redirect()->back();
        }
        else
        {
            $presence = array_diff($stud_all, $students);

            foreach ($students as $student){

                $Lesson_students->missed($lesson_id, $student, $group_id);
            }

            foreach ($presence as $pres){

                $Lesson_students->presence($lesson_id, $pres, $group_id);
            }


            $log = new Event_log();
            $log->log($lesson_id, $group_id, 'Отметил/ла студентов на уроке №'.$lesson_id);

            return redirect()->back();
        }
    }

    public function show($id)
    {   
        $lesson = Lesson::find($id);
        $teacher = User::find($lesson->teacher_id);
        $room = Class_room::find($lesson->room);
        $group = Group::find($lesson->group_id);

        $Lesson_student = Lesson_students::where('lesson_id', $id)->get();
        $presence = $Lesson_student->where('status', "присутствовал")->where('lesson_id', $id);
        $missedd = $Lesson_student->where('status', "пропустил")->where('lesson_id', $id);



        $arr_presence = [];
        foreach ($presence as $key) {
            $arr_presence[] = Student::where('id', $key->student_id)->get();
        }



        $limit = count($arr_presence);


        $arr_presence1 = [];
        foreach ($missedd as $key) {
            $arr_presence1[] = Student::where('id', $key->student_id)->get();
        }

        $limit1 = count($arr_presence1);        

        $id = $lesson->group_id;
        // $group_stud = Group::where('id','=' ,$id)->with(
        // [
        //   'student' => function($query) use ($id){
        //     $query->with(['group'])->where('group_id', '=', $id);
        //   }
        // ])->get();

        $limit_ar = [
            'limit' => $limit,
            'limit1' => $limit1
        ];
        
        $back = back()->getTargetUrl();

        $group_stud = Group_students::all()->where('group_id', $id)->where('status_s', 'учится');
        //var_dump($group_stud);

        $student = [];
        foreach ($group_stud as $k) {
            $student[] = Student::where('id',$k->student_id)->get();
        }

        // echo $k->group_id;
        // foreach ($student as $stud){
        //     foreach ($stud as $k) {
        //         echo $k->id.' '.$k->name.' '.$k->surname; echo "<br>";
        //     }
        // }


        return view('admin.lesson.presence.index', compact('lesson','room','group', 'student', 'limit_ar','arr_presence', 'arr_presence1', 'back', 'teacher'));
    }

}
