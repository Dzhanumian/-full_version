<?php

namespace App\Exports;

use App\User;
use App\Student;
use App\Group;
use App\Lesson;
use App\execl_date;
use App\Class_room;
use App\Lesson_students;
use App\Group_students;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class load implements FromCollection, WithHeadings
{
    public function collection()
    {	
    	$date = execl_date::find(1); // период из бд
    	$User = User::all();
    	$Group = Group::all();
    	$Room = Class_room::all();
    	$Group_students = Group_students::all();
    	$Student = Student::all();
    	$Lesson = Lesson::where('lesson_date', '>=', $date->date_from)->where('lesson_date', '<=', $date->date_befor)->get();


    	// все отмеченные студенты на уроках +/- 1 месяц относительно дат from/befor
        $from = date('Y-m-d', strtotime($date->date_from)  - 1500000);
        $before = date('Y-m-d', strtotime($date->date_befor) + 1500000);
    	$Lesson_students = Lesson_students::where('created_at', '>=', $from)->where('created_at', '<=', $before)->get();

    	$collection = collect([]); // собираю эту колекцию для execl

    	foreach ($Lesson as $les) {
    		$id = $les->id;
    		$date = $les->lesson_date;
    		$statr_time = $les->lesson_time;
    		$end_time = $les->lesson_time_end; 
    		$teacher = $User->find($les->teacher_id)->surname.' '.$User->find($les->teacher_id)->name;
    		$room = $Room->find($les->room)->room_name;
    		$group_name = $Group->find($les->group_id)->group_name; 
    		$status = $les->status;

    		$present = [];
    		$no_present = [];
    		if($status == 'Проведён')
    		{	
    			$list = $Lesson_students->where('lesson_id', $id);
    			foreach ($list as $l){
    				//$l->student_id;
    				if ($l->status == 'присутствовал'){
    					$present[] = $Student->find($l->student_id)->surname.' '.$Student->find($l->student_id)->name;
    				}
    				if ($l->status == 'пропустил'){
    					$no_present[] = $Student->find($l->student_id)->surname.' '.$Student->find($l->student_id)->name;
    				}
    			}
    		}
    		if(count($present) == 0){
    			$present[] = 'пусто';
    		}

    		if(count($no_present) == 0){
    			$no_present[] = 'пусто';
    		}
    		$pr = implode(", ", $present);
    		$no_pr = implode(", ", $no_present);

    		$collection[] = $arr = 
                                    [
                                    	$id,
                                    	$date,
                                    	$statr_time,
                                    	$end_time,
                                    	$group_name,
                                    	$teacher,
                                    	$room,
                                    	$status,
                                    	$pr,
                                        $no_pr
                                    ];
    	}
    	/*
		номер урока (id?)
		дата
		время (начало и конец)
		группа
		преподаватель
		кабинет
		статус урока
		(если урок проведен - студенты, которые были на занятии (из журнала при отметке урока “проведен”)

    	*/


    	// dd($collection);
    	// echo "<br>";echo "<br>";echo "<br>";echo "<br>";
    	return $collection;
    	//$collection[] = $arr = ['product_id' => 1, 'name' => 'Desk'];
    	//return $collection;
    }

    public function headings(): array
    {
        return [
            'Ид',
            'Дата',
            'Начало урока',
            'Конец урока',
            'Группа',
            'Преподаватель',
            'Кабинет',
            'Статус',
            'Присутствовали',
            'Отсутствовали'

        ];
    }
}

/*
namespace App\Exports;

use App\Student;
use App\Group;
use App\Lesson;
use App\Lesson_students;
use App\Group_students;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{

    public function collection()
    {
    	$collection = collect([]) ;

        //return $collection
    }

    public function headings(): array
    {
        return [
            'User',
            'Date',
        ];
    }
}
*/
/*

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $collection = collect([ 
                                $arr = collect( ['product_id' => 1, 'name' => 'Desk']), 
                                $arr = collect( ['product_id' => 4, 'name' => 'Desk']),
                                $arr = collect( ['product_id' => 3, 'name' => 'Desk']),
                                $arr = collect( ['product_id' => 1, 'name' => 'Desk']), 
                            ]) ;

        $collection[0]->put('price', 100);
       
      
        //dd($collection[0], User::all()[0]);

        return $collection->sortBy('product_id');
    }

    public function headings(): array
    {
        return [
            'User',
            'Date',
        ];
    }
}
*/