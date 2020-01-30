<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Lesson;
use App\Event_log;
use Carbon\Carbon;
use App\Class_room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentTestLesson;
use App\TestLessonStudent;

class LessonTestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::where('teaches', 'да')->get();
        $class_rooms = Class_room::all();

        return view('admin.lesson.lesson_test', compact('teachers', 'class_rooms'));
    }

    public function store(Request $request)
    {   
        $Lesson = new Lesson();
        $lesson_id = Lesson::max('id');

        $tests_stud = new StudentTestLesson;
        $stud_tests = new TestLessonStudent;
        $lastId = \DB::table('student_test_lessons')->max('id');

        for ($i=1; $i < 8; $i++){ 
            if($request->input('fio'.$i) != null)
            {
                $tests_stud->add(
                    $lesson_id+1, 
                    $request->input('fio'.$i), 
                    $request->input('phone'.$i), 
                    $request->input('comment'));

                $stud_tests->add(
                    $lesson_id+1, 
                    (int)$lastId,
                    $request->input('fio'.$i),  
                    'планируемо');
            }; //echo "<br>";
            $lastId = $lastId + $i;
        }
        //dd($request);
        $class_room = Class_room::find($request->input('class_room'));
        $sub = $class_room->subsidiaries_name;
        $room = $class_room->room_name;

        $teacher = User::find($request->input('teacher_id'));
        $data_lesson = $teacher->surname.' '.$teacher->name.'<br>'.'Тестирование'.'<br>'.$room.'<br>'.$sub;
        
        
        $Lesson->add(
            $lesson_id+1,
            $request->input('teacher_id'), 
            10000, 
            'Запланированный',  
            '#FFD700', 
            $request->input('lesson_date'),
            $request->input('lesson_time'),
            $request->input('class_room'),
            $data_lesson,
            $class_room->subsidiaries_id, 
            $request->input('lesson_time_end'), 
            'Тестирование'
        );
        
        return redirect('/dashboard/lesson_week');
        // dd(
        //     $request->input('teacher_id'), 
        //     10000, 
        //     'Запланированный',  
        //     '#FFD700', 
        //     $request->input('lesson_date'),
        //     $request->input('lesson_time'),
        //     $request->input('class_room'),
        //     $data_lesson,
        //     $class_room->subsidiaries_id, 
        //     $request->input('lesson_time_end'), 
        //     'Тестирование'
        // );
    }

}
