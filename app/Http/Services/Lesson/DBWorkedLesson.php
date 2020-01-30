<?php

namespace App\Http\Services\Lesson;

use App\User;
use App\Student;
use App\Lesson;
use App\Class_room;
use App\Event_log;
use Illuminate\Support\Facades\DB;


class DBWorkedLesson
{	
    /*
        Функция getDataCreate, берет все необходимые данные из БД, для дальнейшего вывода в форму создания пробного урока
    */
	public function getDataCreate()
    {   
        $teachers = DB::table('users')->select('id','name', 'surname')->where('teaches', 'да')->get();
    	$students = DB::table('students')->select('id','name', 'surname')->where('status', 'Активный')->get();
    	$class_rooms = DB::table('class_rooms')
    	->select(
    		'id',
    		'subsidiaries_id',
    		'subsidiaries_name',
    		'room_name',
    		'seating_capacity')
    	->get();
       
    	return compact('teachers', 'students', 'class_rooms');
    }

    /*
        Метод GetDataStore получает дополнительные данные для формирования данных для сохранения
    */
    public function getDataStore($id/*, $arr_stud*/)
    {	
    	$Users = new User();
        $Teacher = $Users->userFindId($id);

        //$Student = Student::all()->whereIN('id', $arr_stud)->values();

        $lesson_id = Lesson::max('id');

    	return compact('Teacher', 'Student', 'lesson_id');
    }

    /*
        Создаёт и логирует урок
    */
    public function createLesson($dataLesson)
    {   
        DB::table('lessons')->insert([$dataLesson]);

        $log = new Event_log();
        $log->log(null, null, 'добавил отработку');
    }
}


?>