<?php

namespace App\Http\Controllers\lesson;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Interface
use App\Http\Services\Lesson\iWorkedLesson;

//Validate
use App\Http\Requests\WorkedLessonRequests;

/*
    Класс реализует: отоброжение формы создания урока с типом "отработка" и сохранение его в БД.
    Использую инъекцию зависимостей, связал интерфейс с сервисом в сервис провайдере.
*/

class LessonWorkedController extends Controller
{
	private $worked_lesson;

    public function __construct(iWorkedLesson $worked_lesson)
    {
        $this->worked_lesson = $worked_lesson;
    }

    public function create()
    {	
    	$dataFoLesson = $this->worked_lesson->getDataCreate();
        
    	return view('admin.lesson.lesson_worked_create', compact('dataFoLesson'));    	
    }

    public function store(WorkedLessonRequests $request)
    {	
    	$dataFoLesson = $this->worked_lesson->storeWorkedLesson($request);
    	
    	return redirect()->route('week');
    }
}

