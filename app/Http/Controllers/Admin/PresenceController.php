<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Group;
use App\Lesson;
use App\Student;
use App\Event_log;
use Carbon\Carbon;
use App\TrialLesson;
use App\Class_room;
use App\Group_students;
use App\Lesson_students;
use App\StudentTestLesson;
use App\TestLessonStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

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

        if($controll->type == 'Тестирование'){
            $Lesson_students = new TestLessonStudent();
            TestLessonStudent::where('lesson_id', $lesson_id)->delete();
            $student_all = StudentTestLesson::all();
            //
            if(is_array($students) == false)
            {

                foreach ($stud_all as $pres){
                    $fio = $student_all->find($pres);
                    $Lesson_students->add($lesson_id, $pres, $fio->fio, 'присутствовал');
                }

                $log = new Event_log();
                $log->log($lesson_id, $group_id, 'Отметил/ла студентов на уроке №'.$lesson_id.'все присутствовали');

                return redirect()->back();
            }
            else
            {
                $presence = array_diff($stud_all, $students);

                foreach ($students as $student){
                    $fio = $student_all->find($student);
                    $Lesson_students->add($lesson_id, $student, $fio->fio, 'присутствовал');
                }

                foreach ($presence as $student){
                    $fio = $student_all->find($student);
                    $Lesson_students->add($lesson_id, $student, $fio->fio, 'пропустил');
                }


                // $log = new Event_log();
                // $log->log($lesson_id, 'Тестирование', 'Отметил/ла студентов на уроке №'.$lesson_id);

                return redirect()->back();
            }
        }
        //

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

        if ($lesson->type == 'Тестирование'){
            $Lesson_student = TestLessonStudent::where('lesson_id', $id)->get();
            $presence = $Lesson_student->where('status', "присутствовал")->where('lesson_id', $id);
            $missedd = $Lesson_student->where('status', "пропустил")->where('lesson_id', $id);
            $student = StudentTestLesson::where('lesson_id', $id)->get();

            $back = back()->getTargetUrl();
            //dd($presence, $missedd);
            return view('admin.lesson.presence.test', compact('lesson','room', 'student', 'presence', 'missedd', 'back', 'teacher'));
        }

        $group = 'Отработка';
        
        if($lesson->type != 'Урок отработка'){
            $group_a = Group::find($lesson->group_id);
            $group = $group_a;
        }
        //dd($group_a);
        $Lesson_student = Lesson_students::where('lesson_id', $id)->get();
        $presence = $Lesson_student->where('status', "присутствовал")->where('lesson_id', $id);
        $missedd = $Lesson_student->where('status', "пропустил")->where('lesson_id', $id);
        $planed = $Lesson_student->where('status', "планируемо")->where('lesson_id', $id);


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


        $arr_planed = [];
        foreach ($planed as $key) {
            $arr_planed[] = Student::where('id', $key->student_id)->get();
        }
        $limit2 = count($arr_planed); 


        $limit_ar = [
            'limit' => $limit,
            'limit1' => $limit1,
            'limit2' => $limit2
        ];
        
        $back = back()->getTargetUrl();

        $allStud = array_merge($arr_presence, $arr_presence1, $arr_planed);
        $Students = array_unique($allStud);

        if($lesson->type != 'Урок по расписанию')
        {
            $student = [];
            foreach ($Students as $k) {
                //dd($k[0]->id);
                $student[] = Student::find($k[0]->id);
            }
        }

        //dd($lesson, $room, $group, $student, $limit_ar, $arr_presence, $arr_presence1, $back, $teacher);
        if($lesson->type == 'Урок отработка'){
            return view('admin.lesson.presence.working', compact('lesson','room','group', 'student', 'limit_ar','arr_presence', 'arr_presence1', 'back', 'teacher'));
        }

        $lesson = Lesson::find($id);

        $group_stud = Group_students::all()->where('group_id', $lesson->group_id)->where('status_s', 'учится');
        //var_dump($group_stud);

        $student = [];
        foreach ($group_stud as $k) {
            $student[] = Student::where('id',$k->student_id)->get();
        }


        $except = DB::table('trial_lessons')->where('lesson_id', $id)->pluck('user_id');
        //dd($except);
        //$arrayName = array('1' => 1);
        $all_student = Student::where('status', '!=', 'Не активный')->where('status', '!=', 'Закончил обучение')->whereNOTIN('id',$except->toArray())->get();
        //dd($all_student);
        //$TrialLesson = TrialLesson::where('lesson_id', $lesson->id)->get();

        $TrialLesson = DB::table('students')
            ->join('trial_lessons', 'students.id', '=', 'trial_lessons.user_id')
            ->select('students.id', 'students.name', 'students.surname', 'students.patronymic', 'trial_lessons.user_id')
            ->where('lesson_id', $id)
            ->get();

        //dd($TrialLesson);
        return view('admin.lesson.presence.index', compact('lesson','room','group', 'student', 'all_student', 'limit_ar','arr_presence', 'arr_presence1', 'back', 'teacher', 'TrialLesson'));
    }
}
