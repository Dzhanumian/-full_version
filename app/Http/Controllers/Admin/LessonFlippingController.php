<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Group;
use App\Lesson;
use App\Event_log;
use Carbon\Carbon;
use App\Class_room;
use App\Lesson_students;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LessonFlippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function one_day_next($date)
    {
        $days_t = (int) 86400;

        $timestamp = strtotime($date);
        $timestamp = $timestamp + $days_t;

        $year_t = idate('Y', $timestamp);
        $month_t = idate('m', $timestamp);
        if ($month_t < 10) {
            $month_t = '0'.$month_t;
        }
        $day_t = idate('d', $timestamp);

        $tomorrow = $year_t.'-'.$month_t.'-'.$day_t;

        $timestamp = strtotime($tomorrow);
        $timestamp = $timestamp - 172800;

        $year_y = idate('Y', $timestamp);
        $month_y = idate('m', $timestamp);
        if ($month_y < 10) {
            $month_y = '0'.$month_y;
        }
        $day_y = idate('d', $timestamp);

        $yesterday = $year_y.'-'.$month_y.'-'.$day_y;

        $lessons = Lesson::all()->where('lesson_date', '=', $date)->sortByDesc('lesson_time');

        return view('admin.lesson.index', compact('lessons', 'date', 'yesterday', 'tomorrow'));  
    }

    public function week($week=null, $teacher = null, $group = null, $room = null)
    {   

        if ($week == null) {
            $week = time();
        }

        $data = $week;

        $from = date("Y-m-d", $week - (date("N")-1) * 24*60*60); 
        $before = date("Y-m-d", $week - (-6 + date("N")-1)*24*60*60);
        /* * */


        if ($teacher == 0) {
            $teacher = null;
        }
        if ($group == 0) {
            $group = null;
        }
        if ($room == 0) {
            $room = null;
        }

        $teachers = User::all()->where('teaches', 'да');
        $groups = Group::all()->where('status', 'активная');
        $Room = Class_room::all();

        $lessons = Lesson::all()
            ->where('lesson_date', '>=', $from)
            ->where('lesson_date', '<=', $before)->sortBy('lesson_date');
        $lessons_for = 'Все уроки';
        
        $user_t = 0;
        if ($teacher != null) {
            $lessons = $lessons->where('teacher_id', $teacher);

            $for_user = $teachers->where('id', $teacher);

            foreach ($for_user as $user) {
                $surname = $user->surname;
                $name = $user->name;
            }
            $user_t = $surname.' '.$name;
        }

        $group_name = 0; 
        if ($group != null) {
            $lessons = $lessons->where('group_id', $group);

            $group_filter = $groups->where('id', $group);

            foreach ($group_filter as $gr) {
                $group_name = $gr->group_name;
            }
        }

        $room_name = 0; 
        if ($room != null) {
            $lessons = $lessons->where('room', $room); 

            $room_filter = $Room->where('id', $room);

            foreach ($room_filter as $ro) {
                $room_name = $ro->room_name;
            }
        }



        /* * */
        $week_day = [];
        $I = date("d.m.Y", $week - (date("N")-1) * 24*60*60);
        for ($i=0; $i < 7; $i++){ 

            $time = strtotime("$I +$i day");
            $date_aut = date("Y-m-d", $time);
            $index = date("l", $time);
            $day_w = date("Y-m-d", $time);


            if ($index == 'Monday'){
                $Monday = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                $week_day[] = $day_w;
            }
            if ($index == 'Tuesday'){
                $Tuesday = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                $week_day[] = $day_w;               
            }
            if ($index == 'Wednesday'){
                $Wednesday = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                $week_day[] = $day_w;
            }
            if ($index == 'Thursday'){
                $Thursday = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                $week_day[] = $day_w;
            }
            if ($index == 'Friday'){
                $Friday = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                $week_day[] = $day_w;
            }
            if ($index == 'Saturday'){
                $Saturday = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                $week_day[] = $day_w;
            }
            if ($index == 'Sunday'){
                $Sunday = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                $week_day[] = $day_w;
            }
        }

        $week_next = (int)7 * (int)86400 + (int)$week;
        $week_before = (int)-7 * (int)86400 + (int)$week;

        $count = [
            'data' => $data,
            'for' => $teacher,
            'id' => $teacher
        ];

        if ($teacher == null) {
            $teacher = 0;
        }
        if ($group == null) {
            $group = 0;
        }
        if ($room == null) {
            $room = 0;
        }

        $filter = [
            'teacher_id' => $teacher,
            'teacher_name' => $user_t,
            'group_id' => $group,
            'group_name' => $group_name,
            'room_id' => $room,
            'room_name' => $room_name
        ];

        return view('admin.lesson.week', compact(
            'Monday', 
            'Tuesday', 
            'Wednesday', 
            'Thursday', 
            'Friday', 
            'Saturday', 
            'Sunday',
            'week_before',
            'week_next',
            'from',
            'before',
            'count',
            'week_day',
            'teachers',
            'groups',
            'Room',
            'filter'
        ));
    }

    public function month($data = null, $teacher = null, $group = null, $room = null)
    {
        if ($teacher == 0) {
            $teacher = null;
        }
        if ($group == 0) {
            $group = null;
        }
        if ($room == 0) {
            $room = null;
        }

        $teachers = User::all()->where('teaches', 'да');
        $groups = Group::all()->where('status', 'активная');
        $Room = Class_room::all();

        if ($data == null) {
            $dat = date('Y-m-01');
            $data = strtotime($dat);
        }

        $var = date('Y-m-01', $data);
        $data = strtotime($var);

        $befor_month = strtotime("$var -1 day");

        $datetime = date("Y-m-d", $data);
        $limit = $datetime = date("t", $data);
        $from = $datetime = date("Y-m-01", $data);
        $date_from = strtotime($from);
        $before = $datetime = date("Y-m-$limit", $data);
        $limit = date("n", $data);

        $lessons = Lesson::all()
            ->where('lesson_date', '>=', $from)
            ->where('lesson_date', '<=', $before)->sortBy('lesson_date');
        $lessons_for = 'Все уроки';
        
        $user_t = 0;
        if ($teacher != null) {
            $lessons = $lessons->where('teacher_id', $teacher);

            $for_user = $teachers->where('id', $teacher);

            foreach ($for_user as $user) {
                $surname = $user->surname;
                $name = $user->name;
            }
            $user_t = $surname.' '.$name;
        }

        $group_name = 0; 
        if ($group != null) {
            $lessons = $lessons->where('group_id', $group);

            $group_filter = $groups->where('id', $group);

            foreach ($group_filter as $gr) {
                $group_name = $gr->group_name;
            }
        }

        $room_name = 0; 
        if ($room != null) {
            $lessons = $lessons->where('room', $room); 

            $room_filter = $Room->where('id', $room);

            foreach ($room_filter as $ro) {
                $room_name = $ro->room_name;
            }
        }

        $stat_all = count($lessons);
        $stat_reserved = count($lessons->where('status', 'Запланированный'));
        $stat_made = count($lessons->where('status', 'Проведён'));
        $stat_canceled = count($lessons->where('status', 'Отмененный'));
        $stat_late = count($lessons->where('status', 'Поздно отмененный'));


        $as = date("N", $data);

        if ($as == 1) {
           $mon = $var;
        }else{
            $as = $as - 2;
        }

        $mon = date("d.m.Y", $data - date("N") -$as * (int) 86400);
        
        $date_1_week = [];
        for ($i=0; $i < 8; $i++){ 

            $time = strtotime("$mon +$i day");
            $day_w = date("Y-m-d", $time);

            $date_1_week[] = date("d", $time);

            if ($i == 0){
                $Monday_1 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }
            if ($i == 1){
                $Tuesday_1 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');                
            }
            if ($i == 2){
                $Wednesday_1 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 3){
                $Thursday_1 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 4){
                $Friday_1 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 5){
                $Saturday_1 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 6){
                $Sunday_1 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }
            $next_week = $day_w;
        } 

        $date_2_week = [];
        $mon = $next_week;
        for ($i=0; $i < 8; $i++){ 

            $time = strtotime("$mon +$i day");
            $date_aut = date("Y-m-d", $time);
            $index = date("l", $time);
            $day_w = date("Y-m-d", $time);

            $date_2_week[] = date("d", $time);

            if ($i == 0){
                $Monday_2 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }
            if ($i == 1){
                $Tuesday_2 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');                
            }
            if ($i == 2){
                $Wednesday_2 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 3){
                $Thursday_2 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 4){
                $Friday_2 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 5){
                $Saturday_2 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 6){
                $Sunday_2 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }

            $next_week = $day_w;
        }

        $date_3_week = [];
        $mon = $next_week;
        for ($i=0; $i < 8; $i++){ 

            $time = strtotime("$mon +$i day");
            $date_aut = date("Y-m-d", $time);
            $index = date("l", $time);
            $day_w = date("Y-m-d", $time);

            $date_3_week[] = date("d", $time);

            if ($i == 0){
                $Monday_3 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }
            if ($i == 1){
                $Tuesday_3 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');                
            }
            if ($i == 2){
                $Wednesday_3 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 3){
                $Thursday_3 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 4){
                $Friday_3 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 5){
                $Saturday_3 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 6){
                $Sunday_3 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }

            $next_week = $day_w;
        }

        $date_4_week = [];
        $mon = $next_week;
        for ($i=0; $i < 8; $i++){ 

            $time = strtotime("$mon +$i day");
            $date_aut = date("Y-m-d", $time);
            $index = date("l", $time);
            $day_w = date("Y-m-d", $time);
            $date_4_week[] = date("d", $time);

            if ($i == 0){
                $Monday_4 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }
            if ($i == 1){
                $Tuesday_4 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');                
            }
            if ($i == 2){
                $Wednesday_4 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 3){
                $Thursday_4 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 4){
                $Friday_4 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 5){
                $Saturday_4 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
            }
            if ($i == 6){
                $Sunday_4 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
            }

            $last_day = date("n", $time);

            $next_week = $day_w;
        }


        $date_5_week = [];
        $week5 = false;
        if ($last_day === $limit) {
            $week5 = true;
            $mon = $next_week;
            for ($i=0; $i < 8; $i++){ 

                $time = strtotime("$mon +$i day");
                $date_aut = date("Y-m-d", $time);
                $index = date("l", $time);
                $day_w = date("Y-m-d", $time);
                $date_5_week[] = date("d", $time);

                if ($i == 0){
                    $Monday_5 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
                }
                if ($i == 1){
                    $Tuesday_5 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');                
                }
                if ($i == 2){
                    $Wednesday_5 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 3){
                    $Thursday_5 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 4){
                    $Friday_5 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 5){
                    $Saturday_5 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 6){
                    $Sunday_5 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
                }

                $last_day = date("n", $time);

                $next_week = $day_w;
            }
        }

        $date_6_week = [];
        $week6 = false;
        if ($last_day === $limit) {
            $week6 = true;
            $mon = $next_week;

            for ($i=0; $i < 8; $i++){ 

                $time = strtotime("$mon +$i day");
                $date_aut = date("Y-m-d", $time);
                $index = date("l", $time);
                $day_w = date("Y-m-d", $time);
                $date_6_week[] = date("d", $time);

                if ($i == 0){
                    $Monday_6 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
                }
                if ($i == 1){
                    $Tuesday_6 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');                
                }
                if ($i == 2){
                    $Wednesday_6 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 3){
                    $Thursday_6 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 4){
                    $Friday_6 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 5){
                    $Saturday_6 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time');
                }
                if ($i == 6){
                    $Sunday_6 = $lessons->where('lesson_date', $day_w)->sortBy('lesson_time'); 
                }

                $next_week = $day_w;
            }
        }

        // $week_month = strtotime($next_week);
        // if ($next_week < $week_month) {
        //            // }

        
        $first_week = [
            'monday' => $Monday_1,
            'tuesday' => $Tuesday_1,
            'wednesday' => $Wednesday_1,
            'thursday' => $Thursday_1,
            'friday' => $Friday_1,
            'saturday' => $Saturday_1,
            'sunday' => $Sunday_1,
            'date_week' => $date_1_week
        ];

        //var_dump($first_week['monday']);

        $second_week = [
            'monday' => $Monday_2,
            'tuesday' => $Tuesday_2,
            'wednesday' => $Wednesday_2,
            'thursday' => $Thursday_2,
            'friday' => $Friday_2,
            'saturday' => $Saturday_2,
            'sunday' => $Sunday_2,
            'date_week' => $date_2_week
        ];

        $third_week = [
            'monday' => $Monday_3,
            'tuesday' => $Tuesday_3,
            'wednesday' => $Wednesday_3,
            'thursday' => $Thursday_3,
            'friday' => $Friday_3,
            'saturday' => $Saturday_3,
            'sunday' => $Sunday_3,
            'date_week' => $date_3_week
        ];

        $fourth_week = [
            'monday' => $Monday_4,
            'tuesday' => $Tuesday_4,
            'wednesday' => $Wednesday_4,
            'thursday' => $Thursday_4,
            'friday' => $Friday_4,
            'saturday' => $Saturday_4,
            'sunday' => $Sunday_4,
            'date_week' => $date_4_week
        ];

        if($week5 == true)
        {
            $fifth_week = [
                'monday' => $Monday_5,
                'tuesday' => $Tuesday_5,
                'wednesday' => $Wednesday_5,
                'thursday' => $Thursday_5,
                'friday' => $Friday_5,
                'saturday' => $Saturday_5,
                'sunday' => $Sunday_5,
                'date_week' => $date_5_week
            ];
        }

        if($week6 == true)
        {
            $sixth_week = [
                'monday' => $Monday_6,
                'tuesday' => $Tuesday_6,
                'wednesday' => $Wednesday_6,
                'thursday' => $Thursday_6,
                'friday' => $Friday_6,
                'saturday' => $Saturday_6,
                'sunday' => $Sunday_6,
                'date_week' => $date_6_week
            ];
        }



        //var_dump($date_1_week);
        //var_dump($date_2_week);

        // foreach ($first_week["monday"] as $k) {

        //    son_date   

        // }

        $all_month = [
            '1'  => 'Январь',
            '2'  => 'Февраль',
            '3'  => 'Март',
            '4'  => 'Апрель',
            '5'  => 'Май',
            '6'  => 'Июнь',
            '7'  => 'Июль',
            '8'  => 'Август',
            '9'  => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь'
        ];

        $month_index = date('n', $data);

        $this_month = $all_month[$month_index];


        $next_month = strtotime($next_week);

        $count = [
            'week5' => $week5,
            'week6' => $week6,
            'month' => $this_month,
            'befor_month' => $befor_month,
            'next_month' => $next_month,
            'data' => $data,
            'for' => null,
            'id' => null
        ];

        if ($teacher == null) {
            $teacher = 0;
        }
        if ($group == null) {
            $group = 0;
        }
        if ($room == null) {
            $room = 0;
        }


        $filter = [
            'teacher_id' => $teacher,
            'teacher_name' => $user_t,
            'group_id' => $group,
            'group_name' => $group_name,
            'room_id' => $room,
            'room_name' => $room_name
        ];

        $arr_stat = [
            '0' => $stat_all,
            '1' => $stat_reserved,
            '2' => $stat_made,
            '3' => $stat_canceled,
            '4' => $stat_late,
        ];

                
        if ($week6 == true) {

            return view('admin.lesson.month', compact(
                'first_week', 
                'second_week', 
                'third_week', 
                'fourth_week',
                'fifth_week',
                'sixth_week',
                'count',
                'teachers',
                'groups',
                'Room',
                'filter',
                'arr_stat'
            )); 
        }

        if ($week5 == true) {

            return view('admin.lesson.month', compact(
                'first_week', 
                'second_week', 
                'third_week', 
                'fourth_week',
                'fifth_week',
                'count',
                'teachers',
                'groups',
                'Room',
                'filter',
                'arr_stat'
            ));  
        }else{

            return view('admin.lesson.month', compact(
                'first_week', 
                'second_week', 
                'third_week', 
                'fourth_week',
                'count',
                'teachers',
                'groups',
                'Room',
                'filter',
                'arr_stat'              
            ));         
        }
    }


    public function filters(Request $request)
    {
        $teacher = $request->input('teacher');
        $group = $request->input('group');
        $room = $request->input('room');

        if ($teacher == 'Все учителя') {
            $teacher = 0;
        }
        if ($group == 'Все группы') {
            $group = 0;
        }
        if ($room == 'Все кабинеты') {
            $room = 0;
        }

        $date = $request->input('date');
        return redirect('/dashboard/lesson_month/'.$date.'/'.$teacher.'/'.$group.'/'.$room);
    }

    public function filtersW(Request $request)
    {
        $teacher = $request->input('teacher');
        $group = $request->input('group');
        $room = $request->input('room');

        if ($teacher == 'Все учителя') {
            $teacher = 0;
        }
        if ($group == 'Все группы') {
            $group = 0;
        }
        if ($room == 'Все кабинеты') {
            $room = 0;
        }

        $date = $request->input('date');
        return redirect('/dashboard/lesson_week/'.$date.'/'.$teacher.'/'.$group.'/'.$room);
    }
}
