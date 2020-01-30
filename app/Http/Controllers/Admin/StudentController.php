<?php        

namespace App\Http\Controllers\Admin;

use App\User;
use App\Test;
use App\Lesson;
use App\Group;
use App\Event_log;
use App\Student;
use App\Account;
use App\Finance;
use App\Group_students;
use App\Lesson_students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{   

    public function index()
    {   
        $collection = collect([ ]);

        $student = Student::all();
        $Group = Group::all();

        $arr_name_id = [];
        $arr_name_nema = [];

        foreach ($Group as $group) {
            //$arr_name_group[] = $group->id => $group->group_name; 
            array_push($arr_name_id, $group->id);
            array_push($arr_name_nema, $group->group_name);
        }

        $arr_name_group = array_combine($arr_name_id, $arr_name_nema);
        //dd($arr_name_group[0]);

        $Group_students = Group_students::all();
        $wqe = 0;
        foreach ($student as $k){
            $id_s = $k->id;
            $surname = $k->surname;
            $name = $k->name;
            $phone_number = $k->phone_number;
            $status = $k->status;
            $payouts = $k->payouts;
            $created_at = substr($k->created_at, 0,10);
            $Group_fo_this_stud = $Group_students->where('student_id', $id_s);

            if($Group_fo_this_stud->count() != 0){
                $Gr_this_stud = [];
                foreach ($Group_fo_this_stud as $g_s) {
                    $Gr_this_stud[] = $g_s->group_id;
                }  
                $count = count($Gr_this_stud);
                //$Gr_this_stud =  array_flip($Gr_this_stud);
                $arr_gr_st = [];
                for ($i=0; $i < $count; $i++){ 
                    $q = $Gr_this_stud[$i];   
                    $arr_gr_st[] = $arr_name_group[$q]; 
                }
                $list_group = implode(", ", $arr_gr_st);
                $wqe = $wqe + 1;
                //dd($arr_name_group, $Gr_this_stud, $arr_gr_st);
            }

            if($Group_fo_this_stud->count() == 0){
                $list_group = 'нигде не состоит';
            }
           
            $collection[] = $arr = 
                                [ 
                                    $id_s,
                                    $surname,
                                    $name,
                                    $phone_number,
                                    $status,
                                    $created_at,
                                    $list_group,
                                    $payouts,
                                ];
        }

        //dd($collection);
        $limit = $student->count();
        return view('admin.student.index',  compact('collection', 'limit'));
    }

    



    public function create()
    {
        return view('admin.student.create');
    }



    public function store(Request $request)
    {   
            
        $this->validate($request, [
            'date_of_birth_s' => ['required', 'date', 'size:10']
        ]);
        
        $age = strtotime($request->input('date_of_birth_s'));    
        $AgeControll = strtotime('-16 year');

        // $this->validate($request, [
        //     //'field_of_activity_s.*' => ['required', 'string'],

        // ]);
        // dd($request);


        if ($age <= $AgeControll) {

            $this->validate($request, [
                'surname_s' => ['required', 'string', 'max:255'],
                'name_s' => ['required', 'string', 'max:255'],
                'patronymic_s' => ['required', 'max:255'],
                'date_of_birth_s' => ['required', 'date', 'size:10'],
                'phone_number_s' => ['required', 'numeric'],
                'email_s' => ['nullable', 'unique:students', 'email', 'max:200'],
                'field_of_activity_s.*' => ['required', 'string', 'max:200'],
                'education' => ['required', 'string', 'max:200'],
                'meaning.*' => ['required','string', 'max:1000'],
                'about_us.*' => ['required','string', 'max:1000'],
                'studied.*' => ['required','string', 'max:1000'],
                'relations_s' => ['nullable', 'string', 'max:200'],
                'surname_r' => ['nullable', 'string', 'max:200'],
                'name_r' => ['nullable', 'string', 'max:200'],
                'patronymic_r' => ['nullable', 'string', 'max:200'],
                'date_of_birth_r' => ['nullable', 'date', 'size:10'],
                'phone_number_r' => ['nullable', 'numeric'],
                'activity' => ['nullable', 'string', 'max:1000'],
                'education1' => ['nullable', 'string', 'max:1000'],
                'meaning1' => ['nullable', 'string', 'max:1000'],
                'about_us1' => ['nullable', 'string', 'max:1000'],
                'studied1' => ['nullable', 'string', 'max:1000'],
                'email_r' => ['nullable', 'email', 'max:200'],
                'comment' => ['nullable', 'string', 'max:1000'],
            ]);
        }else{

            $this->validate($request, [
                'surname_s' => ['required', 'string', 'max:255'],
                'name_s' => ['required', 'string', 'max:255'],
                'patronymic_s' => ['required', 'max:255'],
                'date_of_birth_s' => ['required', 'date', 'size:10'],
                'phone_number_s' => ['required', 'numeric'],
                'email_s' => ['unique:students', 'nullable', 'email', 'max:200'],
                'field_of_activity_s.*' => ['required', 'string', 'max:200'],
                'education' => ['required', 'string', 'max:200'],
                'meaning.*' => ['required','string', 'max:1000'],
                'about_us.*' => ['required','string', 'max:1000'],
                'studied.*' => ['required','string', 'max:1000'],
                'relations_s' => ['required', 'string', 'max:200'],
                'surname_r' => ['required', 'string', 'max:200'],
                'name_r' => ['required', 'string', 'max:200'],
                'patronymic_r' => ['required', 'string', 'max:200'],
                'date_of_birth_r' => ['required', 'date', 'size:10'],
                'phone_number_r' => ['required', 'numeric'],
                'activity' => ['nullable', 'string', 'max:1000'],
                'education1' => ['nullable', 'string', 'max:1000'],
                'meaning1' => ['nullable', 'string', 'max:1000'],
                'about_us1' => ['nullable', 'string', 'max:1000'],
                'studied1' => ['nullable', 'string', 'max:1000'],
                'email_r' => ['nullable', 'email', 'max:200'],
                'comment' => ['nullable', 'string', 'max:1000'],
            ]);
        }   
            //////////////////////////////////////////////////
            $activity_s = $request->input('field_of_activity_s');
            $activity_s_diff = array_diff($activity_s, array('Другое (укажите ->)'));
            $activity_s_string = implode(",", $activity_s_diff);
            $activity = $activity_s_string.','.$request->input('activity');
            //////////////////////////////////////////////////
            $meaning = $request->input('meaning');
            $studied_diff = array_diff($meaning, array('Другое (укажите ->)'));
            $meaning_string = implode(",", $studied_diff);
            $meaning = $meaning_string.','.$request->input('meaning1'); 
            //////////////////////////////////////////////////
            $about_us = $request->input('about_us');
            $studied_diff = array_diff($about_us, array('Другое (укажите ->)'));
            $about_us_string = implode(",", $studied_diff);
            $about_us = $about_us_string.','.$request->input('about_us1');
            //////////////////////////////////////////////////
            $studied = $request->input('studied');
            $studied_diff = array_diff($studied, array('Другое (укажите ->)'));
            $studied_string = implode(",", $studied_diff);
            $studied = $studied_string.','.$request->input('studied1');
            //////////////////////////////////////////////////
           

        $Stud = new Student();
        if ($age <= $AgeControll){
            $Stud->add(
                $request->input('name_s'), 
                $request->input('surname_s'),
                $request->input('patronymic_s'),
                $request->input('date_of_birth_s'), 
                $request->input('phone_number_s'),
                $request->input('email_s'),
                'NULL',
                'Сам за себя ответственный', 
                $activity,
                $request->input('education'),
                $meaning, 
                $about_us,
                $request->input('surname_s'),
                $request->input('name_s'),
                $request->input('patronymic_s'),
                $request->input('date_of_birth_s'),
                $request->input('phone_number_s'), 
                $studied,
                $request->input('email_s'),
                $request->input('comment')
            );
        }else{
            $Stud->add(
                $request->input('name_s'), 
                $request->input('surname_s'),
                $request->input('patronymic_s'),
                $request->input('date_of_birth_s'), 
                $request->input('phone_number_s'),
                $request->input('email_s'),
                'NULL',
                $request->input('relations_s'), 
                $activity,
                $request->input('education'),
                $meaning, 
                $about_us,
                $request->input('surname_r'),
                $request->input('name_r'),
                $request->input('patronymic_r'),
                $request->input('date_of_birth_r'),
                $request->input('phone_number_r'),
                $studied,
                $request->input('email_r'),
                $request->input('comment')
            );
        }

        
        $account = new Account();
        $account->add();

        $Event_log = new Event_log();
        $Event_log->logStud($request->input('surname_s').' '.$request->input('name_s'));

        $id = Student::max('id');

        //return view('test.create', compact('userName', 'userEmail'));
        if (Auth::check()) {
            return redirect('/dashboard/students');
        }
        return redirect('/test/'.$id);
    }

    public function edit($id)
    {
        $stud = Student::find($id);
        return view('admin.student.edit', ['stud'=>$stud]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'surname_s' => ['required', 'string', 'max:255'],
            'name_s' => ['required', 'string', 'max:255'],
            'patronymic_s' => ['required', 'max:255'],
            'date_of_birth_s' => ['required', 'date', 'size:10'],
            'phone_number_s' => ['required', 'numeric'],
            'email_s' => ['nullable', 'email', 'max:200'],
            'field_of_activity_s' => ['required', 'string', 'max:200'],
            'education' => ['required', 'string', 'max:200'],
            'meaning' => ['required', 'string', 'max:200'],
            'about_us' => ['required', 'string', 'max:200'],
            'studied' => ['required','string', 'max:200'],
            'relations_s' => ['required', 'string', 'max:200'],
            'surname_r' => ['required', 'string', 'max:200'],
            'name_r' => ['required', 'string', 'max:200'],
            'patronymic_r' => ['required', 'string', 'max:200'],
            'date_of_birth_r' => ['date', 'size:10'],
            'phone_number_r' => ['required', 'numeric'],
            'email_r' => ['nullable', 'email', 'max:200'],
            'comment'  => ['nullable', 'string', 'max:1000'],
        ]);

        $stud_up = Student::find($id);
        $dateTime = Carbon::now('Europe/Kiev');

        $stud_up->update([
            'name' => $request->input('name_s'), 
            'surname' => $request->input('surname_s'),
            'patronymic' => $request->input('patronymic_s'),
            'date_of_birth' => $request->input('date_of_birth_s'),
            'phone_number' => $request->input('phone_number_s'), 
            'email_s' => $request->input('email_s'), 
            'relations' => $request->input('relations_s'), 
            'field_of_activity' => $request->input('field_of_activity_s'), 
            'education' => $request->input('education'), 
            'meaning' => $request->input('meaning'),
            'about_us' => $request->input('about_us'),
            'surname_r' =>  $request->input('surname_r'),
            'name_r' => $request->input('name_r'),
            'patronymic_r' => $request->input('patronymic_r'),
            'date_of_birth_r' => $request->input('date_of_birth_r'),
            'phone_number_r' => $request->input('phone_number_r'),
            'studied_or_studying_r' => $request->input('studied_or_studying_r'),
            'status' => $request->input('status'), 
            'updated_at' => $dateTime,
            'studied' => $request->input('studied'),
            'email_r'  => $request->input('email_r'),
            'comment' => $request->input('comment'),
        ]); 

            
        $name = $request->input('surname_s').' '.$request->input('name_s');
        $log = new Event_log();
        $log->log($name, $id, 'обновил данные студента');

        //return redirect()->back();
        echo '<script>window.close()</script>';
    }

    public function destroy($id)
    {

        $delSub = Student::find($id);

        $log = new Event_log();
        $log->log($delSub->surname.' '.$delSub->name, $id, 'удалил студента');
        Group_students::all()->where('student_id', $id);
        Student::find($id)->delete();
        Account::find($id)->delete();

        //return redirect()->back();
        echo '<script>window.close()</script>';
    }

    public function info($id)
    {
        $student = Student::findOrFail($id);
        $balans = Account::findOrFail($id);

        $group_ar = Group_students::where('student_id', $id);
        $groups = $group_ar->where('status_s', 'учится')->get();
        $groups_end = $group_ar->where('status_s', 'выпустился')->get();
        $groups_else = $group_ar->where('status_s', '!=', 'выпустился')->where('status_s', '!=', 'учится')->get();

        $ar_group = []; // id групп в кот состоит студ
        foreach ($groups as $k){
            $ar_group[] = $k->group_id;
        }

        $count_goup = count($ar_group);

        $Group_inf = []; // группы в которых состоит пользователь
        for ($i=0; $i < $count_goup; $i++){ 

            $Group_inf[] = Group::find($ar_group[$i]);
        }

        // foreach ($Group_inf as $k){
        //     echo $k->group_name;
        // }
 
        //$group_s = Group_students::all()->where('student_id', $id)->where('status_s', 'учится');


        $arr_group = [];

        $next_month = date("Y-m-01", strtotime("+1 month"));    
        $lesson_next_month = Finance::all()
            ->where('month', $next_month)
            ->where('student_id', $id);


        $this_month = date('Y-m-01');   
        $lesson = Finance::all()
            ->where('month', $this_month)
            ->where('student_id', $id);
        $all_les = count($lesson);    

        foreach ($groups as $key) {
            $group = Group::find($key->group_id);
            $arr_group[] = $group->id;
            $arr_group[] = $group->group_name;
            $arr_group[] = $group->rate;

            $this_mont = $lesson->where('group_id', $group->id)->count();
            $next_month1 = $lesson_next_month->where('group_id', $group->id)->count();

            if ($this_mont !=0) {
                $this_m = "#ADFF2F";
            }
            else{
                $this_m = "#FFD700";
            }
            if ($next_month1 !=0) {
                $next_m = "#ADFF2F";
            }
            else{
                $next_m = "#FFD700";
            }
            $next_m;

            $arr_group[] = $this_m;
            $arr_group[] = $next_m;
        }
        
        $arr_with = count($arr_group);
        $arr_with = $arr_with / 5;
        array_unshift($arr_group, $arr_with); 
        
        //$ar_group
        //count_goup where('group_id', $ar_group)->

        $t = date('t');
        $befor = date("Y-m-$t");

        $planned = Lesson::all()->where('lesson_date', '>=', $this_month)
                             ->where('lesson_date', '<=', $befor)
                             ->where('status', 'Запланированный');

        $completed = Lesson::all()->where('lesson_date', '>=', $this_month)
                             ->where('lesson_date', '<=', $befor)
                             ->where('status', 'Проведён');


        // журнал                    
        //$archive = Lesson_students::orderBy('created_at', 'desc')->where('student_id', $id)->get(); 

        $archive = DB::table('lessons')
            ->join('lesson_students', 'lessons.id', '=', 'lesson_students.lesson_id')
            ->select('lessons.id', 'lessons.lesson_date', 'lesson_students.lesson_id', 'lesson_students.group_id', 'lesson_students.status')->where('student_id', $id)->orderBy('id', 'desc')
            ->get();
        //dd($archive);

        
        $ar_group1 = []; // id групп в кот состоит студ
        foreach ($group_ar as $k){
            $ar_group1[] = $k->group_id;
        }

        $count_goup1 = count($ar_group1);

        $Group_inf1 = []; // группы в которых состоит пользователь
        for ($i=0; $i < $count_goup1; $i++){ 

            $Group_inf1[] = Group::find($ar_group1[$i]);
        }


        $arr_group1 = [];

        $next_month = date("Y-m-01", strtotime("+1 month"));    
        $lesson_next_month = Finance::all()
            ->where('month', $next_month)
            ->where('student_id', $id);


        $this_month = date('Y-m-01');   
        $lesson = Finance::all()
            ->where('month', $this_month)
            ->where('student_id', $id);
        $all_les = count($lesson);

        $var = Group_students::all();    
        $var1 = $var->where('student_id', $id);
        foreach ($var1 as $key) {
            $group = Group::find($key->group_id);
            $arr_group1[] = $group->id;
            $arr_group1[] = $group->group_name;
            $arr_group1[] = $group->rate;

            $this_mont = $lesson->where('group_id', $group->id)->count();
            $next_month1 = $lesson_next_month->where('group_id', $group->id)->count();

            $Group_studentssss = Group_students::where('student_id', $id)->where('group_id', $group->id)->first();

            (string)$this_m = $Group_studentssss->created_at;

            (string)$next_m = $Group_studentssss->updated_at;

            $statuss = $Group_studentssss->status_s;

            $arr_group1[] = $this_m;
            $arr_group1[] = $next_m;
            $arr_group1[] = $statuss;
        }
        
        $arr_with = count($arr_group1);
        $arr_with = $arr_with / 5;
        array_unshift($arr_group1, $arr_with);

        $test1 = Test::where('student_id', $id)->where('test_id', 1)->first();
        $test2 = Test::where('student_id', $id)->where('test_id', 2)->first();

        $Finance = Finance::all()->where('student_id', $id)->where('status', 0);

        return view('admin.student.info', compact(
            'student', 
            'balans', 
            'Group_inf', 
            'arr_group',
            'archive',
            'arr_group1',
            'Finance'       
        ));  
    }

    public function debtor_search(){
        $Students = Student::all();
        $Finance = Finance::all()->where('status', 0);
        $Accounts = Account::all()->where('account', '<', 0);
        $dateTime = Carbon::now('Europe/Kiev');

        foreach ($Finance as $debt){
           
            $student = $Students->find($debt->student_id);

            $student->id.' счёт '.$debt->id;
            $student->update([
                'payouts' => '#F08080', 
            ]); 
        }

        foreach ($Accounts as $debt){
           
            $student = $Students->find($debt->id);

            $student->id.' баланс';
            $student->update([
                'payouts' => '#F08080', 
            ]);
        }     
        return redirect()->back();
        //return redirect('/dashboard/students');
    }

    public function excel(){
        return Excel::download(new UsersExport(), 'student.xlsx');
    }
}



         