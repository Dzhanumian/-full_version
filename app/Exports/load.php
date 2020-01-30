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

use App\TestLessonStudent;
use App\StudentTestLesson;

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
        $student_test_lessons = StudentTestLesson::where('created_at', '>=', $from)->where('created_at', '<=', $before)->get();

        $test_lesson_students = TestLessonStudent::where('created_at', '>=', $from)->where('created_at', '<=', $before)->get();

    	$collection = collect([]); // собираю эту колекцию для execl

    	foreach ($Lesson as $les) {
    		$id = $les->id;
    		$date = $les->lesson_date;
    		$statr_time = $les->lesson_time;
    		$end_time = $les->lesson_time_end; 
    		$teacher = $User->find($les->teacher_id)->surname.' '.$User->find($les->teacher_id)->name;
    		$room = $Room->find($les->room)->room_name;
            $group_name = 'отработка';
            //dd($les->group_id);
            if($les->group_id == 10001){
                $group_name = 'пробное занятие';
            }
            if($les->group_id == 10000){
                $group_name = 'тестирование';
            }
            if($les->group_id != 9999 and $les->group_id != 10000 and $les->group_id != 10001){
                $group_name = $Group->find($les->group_id)->group_name;
            } 
    		$status = $les->status;
            $type = $les->type;

    		$present = [];
    		$no_present = [];
            $planned = [];
    		// if($status == 'Проведён')
    		// {	
    			$list = $Lesson_students->where('lesson_id', $id);
    			foreach ($list as $l){
    				//$l->student_id;
    				if ($l->status == 'присутствовал'){
    					$present[] = $Student->find($l->student_id)->surname.' '.$Student->find($l->student_id)->name;
    				}
    				if ($l->status == 'пропустил'){
    					$no_present[] = $Student->find($l->student_id)->surname.' '.$Student->find($l->student_id)->name;
    				}
                    if ($l->status == 'планируемо'){
                        $planned[] = $Student->find($l->student_id)->surname.' '.$Student->find($l->student_id)->name;
                    }
    			}

                if($les->group_id == 10000)
                {  
                    $list = $test_lesson_students->where('lesson_id', $id);
                    foreach ($list as $l){
                        if ($l->status == 'присутствовал'){
                            $present[] = $l->fio;
                        }
                        if ($l->status == 'пропустил'){
                            $no_present[] = $l->fio;
                        }
                        if ($l->status == 'планируемо'){
                            $planned[] = $l->fio;
                        }
                    }   
                }
    		//}
    		if(count($present) == 0){
    			$present[] = 'пусто';
    		}

    		if(count($no_present) == 0){
    			$no_present[] = 'пусто';
    		}
            if(count($planned) == 0){
                $planned[] = 'пусто';
            }
    		$pr = implode(", ", $present);
    		$no_pr = implode(", ", $no_present);
            $pl = implode(", ", $planned);

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
                                        $type,
                                    	$pr,
                                        $no_pr,
                                        $pl
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
            'Тип',
            'Присутствовали',
            'Отсутствовали',
            'Планируемо'

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