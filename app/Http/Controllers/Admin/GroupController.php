<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Group;
use App\Course;
use App\Lesson;
use App\Event_log;
use Carbon\Carbon;
use App\Group_students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin_owner');
    }

    public function index()
    {   

        $Group = Group::all();
        $Group_students = Group_students::all();
        $from = date('Y-m-01');
        $before = date('Y-m-t');//
        $Lesson = Lesson::where('lesson_date', '>=', $from)->where('lesson_date', '<=', $before)->get();
        $collection = collect([ ]);
        $limit = $Group->count();

        $dey_week = 
        [
            '1' => 'пн ',
            '2' => 'вт ',
            '3' => 'ср ',
            '4' => 'чт ',
            '5' => 'пт ',
            '6' => 'сб ',
            '7' => 'вс ',
        ];

        foreach ($Group as $gr)
        {   
            $id = $gr->id;
            $teacher_name = $gr->teacher_name;
            $group_name = $gr->group_name;
            $course = $gr->course;
            $type = $gr->type;
            $rate = $gr->rate;
            $status = $gr->status;

            if ($gr->type == 'Стандартная'){
                $count = $Group_students->where('group_id', $gr->id)->count();
                $count = $count.'/4';
            }   
            if ($gr->type == 'Мини группа'){
                $count = $Group_students->where('group_id', $gr->id)->count();
                $count = $count.'/3';
            }
            if ($gr->type == 'Индивидуальная'){
                $count = $Group_students->where('group_id', $gr->id)->count();
                $count = $count.'/1'; 
            }
            $this_lesson_gr = $Lesson->where('group_id', $id);
            $date_lesson = [];
            foreach ($this_lesson_gr as $les){
                $time = strtotime($les->lesson_date);
                $date = date('N', $time);
                $date_lesson[] = $dey_week[$date].$les->lesson_time.' - '.$les->lesson_time_end;
            }
            $date_lesson = array_unique($date_lesson);
            $date_lesson = array_values($date_lesson);
            $day = implode('<br> ', $date_lesson);
            $collection[] = $arr = 
                                    [
                                        $id,
                                        $teacher_name,
                                        $group_name,
                                        $course,
                                        $type,
                                        $rate,
                                        $status,
                                        $count,
                                        $day,
                                    ];
            
            array_splice($date_lesson, 0);
        }

        return view('admin.group.index', compact('collection', 'limit'));
    }

    public function create()
    {	

    	$teachers = User::where('teaches', 'да')->get();
    	$courses = Course::all();

    	return view('admin.group.create', compact('teachers', 'courses'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'teacher_surname' => ['required', 'string', 'max:255'],
    		'group_name' => ['required', 'string', 'max:500'],
    		'cours' => ['required', 'string', 'max:500'],
    		'type' => ['required', 'string', 'max:500'],
            'rate' => ['required', 'numeric'],
		]);

		$Group = new Group();
    	$Group->add($request->input('teacher_surname'), $request->input('group_name'), $request->input('cours'), $request->input('type'),$request->input('rate'));

    	$lastUserId = \DB::table('courses')->max('id');
        $log = new Event_log();
        $log->log($request->input('subs_name'), $lastUserId, 'создал группу');

    	return redirect('/dashboard/group');
    }

    public function edit($id)
    {
    	$courses = Course::all();
    	$group = Group::find($id);
    	$teachers = User::where('teaches', 'да')->get();
    	
    	return view('admin.group.edit', compact('teachers', 'courses', 'group'));
    }

    public function update(Request $request, $id)
    {   

        $this->validate($request, [
            'teacher_surname' => ['required', 'string', 'max:255'],
    		'group_name' => ['required', 'string', 'max:500'],
    		'cours' => ['required', 'string', 'max:500'],
    		'type' => ['required', 'string', 'max:500'],
    		'status' => ['required', 'string', 'max:500'],
            'rate' => ['required', 'numeric'],
        ]);

        $group = Group::find($id);
        $dateTime = Carbon::now('Europe/Kiev');
        $pieces = explode(",", $request->input('teacher_surname'));
        
        $group->update([
            'teacher_id' => $pieces[0],
          	'teacher_name' => $pieces[1], 
	    	'group_name' => $request->input('group_name'), 
	    	'course' => $request->input('cours'),
	    	'type' => $request->input('type'), 
	    	'status' => $request->input('status'),
            'rate' => $request->input('rate'), 
	    	'updated_at' => $dateTime
        ]);

        $name = $group->group_name;
        $log = new Event_log();
        $log->log($name, $id, 'обновил группу');
        
        $lesson = Lesson::where('group_id', $group->id)->get();
        //dd($lesson);
        foreach ($lesson as $les) {
            $update_les = $lesson->find($les->id);
            $var = explode("<br>", $update_les->data_lesson); 
            $data_lesson = $pieces[1]."<br>".$var[1]."<br>".$var[2]."<br>".$var[3];

            $update_les->update([
                'teacher_id' => $pieces[0],
                'data_lesson' => $data_lesson,
                'updated_at' => $dateTime
            ]);

        }
        
        //return redirect()->back();
        echo "<script>window.close()</script>";
    }

    public function destroy($id)
    {
        $lesson = Lesson::all()->where('group_id', $id);
        count($lesson);

        $delSub = Group::find($id);

        if(count($lesson) != 0){
            return redirect()->back()->with('failure', ["Группу $delSub->group_name нельзя удалить"]);
        }   
    	
    	$log = new Event_log();
    	$log->log($delSub->group_name, $id, 'удалил группу');

    	Group::find($id)->delete();
        Group_students::where('group_id', $id)->delete();

        //return redirect()->back()->with('success', ["Группа $delSub->group_name удалена"]);   
    	// return redirect()->back();
        echo '<script>window.close()</script>';
    }
}
