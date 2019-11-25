<?php

namespace App\Http\Controllers\Admin;


use App\Group;
use App\Student;
use App\Event_log;
use App\Group_students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupStudentsController extends Controller
{	
	public function __construct()
    {
        $this->middleware('admin_owner');
    }

	public function show($id) //Используется как create
    {	
    	$id_g = $id;

        $Group_students = Group_students::where('group_id', $id)->get();
    	$studs_g = Student::all();
        foreach ($Group_students as $stud){
            $studs_g = $studs_g->where('id', '!=', $stud->student_id);
        }

    	return view('admin.group.group_student.create', ['id_g'=>$id_g], compact('studs_g'));
    }

    public function store(Request $request)
    {

        //dd($request);
        $group_id = $request->input('group_id');
        $arr_stud = $request->input('studs');
        $length_arr_stud = count($arr_stud);

		$log = new Event_log();
		$Gr_stud = new Group_students();

		for ($i=0; $i < $length_arr_stud; $i++) { 

			$Gr_stud->add($group_id, $arr_stud[$i]);

            $stud = Student::find($arr_stud[$i]);
            $stud->update([
                'status' => 'Активный', 
            ]);	
		}

        $group = Group::find($group_id);
        $group->update([
            'status' => 'активная', 
        ]);
		
        $log->log($group->group_name, $group_id, 'Добавил студентов в группу');
        return redirect("/dashboard/group_students/$group_id/edit");		
    }

    /*
    	$name = $sub->name;
        $log = new Event_log();
        $log->log($name, $id, 'обновил филиал');
    */


    public function edit($id)//Используется как index 
    {	

    	$group_stud = Group::where('id', $id)->with(
    	[

    		'student' => function($query) use ($id){
    			$query->with(['group'])->where('group_id', '=', $id);
    		}

    	])->get();
    	
    	//echo $group_stud;


    	return view('admin.group.group_student.show', compact('group_stud'));
    }

    public function update(Request $request, $id)
    {

        //echo $request->input('group_studs');

        $stud_gr = Group_students::find($id);
        $id_g = $stud_gr->group_id;

        $stud_gr->update([
            'status_s' => $request->input('group_studs'), 
        ]);

        return redirect("dashboard/group_students/$id_g/edit");
    }


    public function destroy($id)
    {
    	//echo $id;echo "<br>";

		$pieces = explode(" ", $id);
		$del = $pieces[0];  
		$id_return = $pieces[1];


		echo $id_return;
    	Group_students::findOrFail($del)->delete();

    	return redirect()->back();
    }

    public function graduation($id)
    {   

        $group_studs = Group_students::find($id);

        return view('admin.group.group_student.edit', compact('group_studs'));

        //echo $id;
    }
}
