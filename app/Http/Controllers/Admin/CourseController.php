<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event_log;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_owner');
    }
        
    public function index()
    {
    	return view('admin.cours.index', 
        [
          'course' => Course::orderBy('created_at', 'asc')->paginate(1000)
        ]);
    }

    public function create()
    {
    	return view('admin.cours.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'course_name' => ['unique:courses,course_name', 'required', 'string', 'max:255'],
    		'category' => ['required', 'string', 'max:500'],
    		'level' => ['required', 'string', 'max:500']
		]);

		$Cours = new Course();
    	$Cours->add($request->input('course_name'), $request->input('category'), $request->input('level'));

    	$lastUserId = \DB::table('courses')->max('id');
        $log = new Event_log();
        $log->log($request->input('course_name'), $lastUserId, 'создал курс');

    	return redirect('/dashboard/course');
    }

    
    public function edit($id)
    {
    	$cours = Course::find($id);
    	return view('admin.cours.edit', ['cours'=>$cours]);
    }
	
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'course_name' => ['required', 'string', 'max:255'],
    		'category' => ['required', 'string', 'max:500'],
    		'level' => ['required', 'string', 'max:500']
        ]);

        $course = Course::find($id);
        $dateTime = Carbon::now('Europe/Kiev');

        $course->update([
          	'course_name' => $request->input('course_name'),
            'category' => $request->input('category'), 
            'level' => $request->input('level'), 
            'language' => 'english',
            'status' => 'active',
            'updated_at' => $dateTime,
        ]);

        $name = $course->course_name;
        $log = new Event_log();
        $log->log($name, $id, 'обновил курс');

        // return redirect('/dashboard/course');
        echo "<script>window.close()</script>";
    }

    public function destroy($id)
    {

    	$delSub = Course::find($id);

    	$log = new Event_log();
    	$log->log($delSub->course_name , $id, 'удалил курс');

    	Course::find($id)->delete();

    	return redirect('/dashboard/course');
    }
    
}

