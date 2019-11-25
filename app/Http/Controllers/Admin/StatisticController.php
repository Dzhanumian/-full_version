<?php

namespace App\Http\Controllers\Admin;

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

class StatisticController extends Controller
{
    public function index()
    {	
    	////////////студенты
    	$last_day = date("t");
        $from = date("Y-m-01");
        $before = date("Y-m-$last_day");

    	$Student = Student::all();
        $Group_students = Group_students::all()
            ->where('updated_at', '>=', $from)
            ->where('updated_at', '<=', $before)
            ->where('status_s', 'выпустился');
        $all_stud = count($Student);
    	$new_stud = count($Student->where('status', 'новый студент'));
    	$new_activ = count($Student->where('status', 'Активный'));
        $graduated = count($Group_students);

        $Group_students_all = Group_students::all()->where('status_s', 'выпустился');
        $graduated_all = count($Group_students_all);

        $arr_stud = [
        	'0' => $all_stud,
        	'1' => $new_stud,
        	'2' => $new_activ,
        	'3' => $graduated_all,
        	'4' => $graduated
        ];

        ////////////уроки
        $lessons = Lesson::all()
            ->where('lesson_date', '>=', $from)
            ->where('lesson_date', '<=', $before);

        $les = Lesson::all();

        $all_les =  count($les);
        $all_reserved = count($les->where('status', 'Запланированный'));
       	$all_made = count($les->where('status', 'Проведён'));
       	$all_canceled = count($les->where('status', 'Отмененный'));
       	$all_late = count($les->where('status', 'Поздно отмененный'));

        $stat_all = count($lessons);
        $stat_reserved = count($lessons->where('status', 'Запланированный'));
        $stat_made = count($lessons->where('status', 'Проведён'));
        $stat_canceled = count($lessons->where('status', 'Отмененный'));
        $stat_late = count($lessons->where('status', 'Поздно отмененный'));

        $arr_stat = [
            '0' => $stat_all,
            '1' => $stat_reserved,
            '2' => $stat_made,
            '3' => $stat_canceled,
            '4' => $stat_late,
            '5' => $all_les,
            '6' => $all_reserved,
            '7' => $all_made,
            '8' => $all_canceled,
            '9' => $all_late
        ];

        //////Финансы
        $Group_students = Group_students::all()->where('status_s', 'учится');
        $Groups = Group::all()->where('status', 'активная');
        $result = 0;
        foreach ($Groups as $group){ 
          $id = $group->id;
          if($group->type != 'Индивидуальная')
          {  
        	 $sum = count($Group_students->where('group_id', $id));
        	 $result = ($sum * $group->rate) + ($result);
          }

          if($group->type == 'Индивидуальная')
          {
            $sum = $lessons->where('group_id', $id)->where('type', 'Урок по расписанию')->count();
            $result = ($sum * $group->rate) + ($result);
          }
        }
        $expected = $result; // ожидаймая прибыль

        $Finance = Finance::all();
        $this_month_finance = $Finance
        	->where('created_at', '>=', $from)
        	->where('created_at', '<=', $before);

        $result = 0;
       	foreach ($this_month_finance as $k){
       		$result = $k->invoice + $result;
       	}
       	$actual = $result;
        
        $actuall = $actual;
  
       	$difference = $expected - $actuall;
        if ($actuall < 0) {
          $actuall = -1 * $actuall;
          $difference = $expected + $actuall;
        }
       	$Account = Account::all()->where('account', '<', 0);
        $Finance_debt = Finance::where('type', 'В долг')->where('status','1')->get();
       	$debt = 0;
       	foreach ($Account as $stud){
       		$debt = $debt + $stud->account;
       	}
        foreach ($Finance_debt as $deb){
          $debt = $debt + (-1 * $deb->invoice);
        }
       	
       	$arr_finanse = [
       		'0' => $expected,
       		'1' => $actual,
       		'2' => $difference,
       		'3' => $debt
       	];

       	return view('admin.statistic.statistic', compact('arr_stud', 'arr_stat', 'arr_finanse'));
    }
}
