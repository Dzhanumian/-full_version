<?php

namespace App\Http\Services\Lesson;

// services
use App\Http\Services\RenderFunction\RenderLessonData;
use Carbon\Carbon;

// model
use App\Lesson_students;

// interface
use App\Http\Services\Lesson\iWorkedLesson;

class WorkedLesson extends DBWorkedLesson implements iWorkedLesson
{	
	private $renderLessonData;
	private $lessonStudents;

    public function __construct(RenderLessonData $renderLessonData, Lesson_students $lessonStudents)
    {
        $this->renderLessonData = $renderLessonData; 
        $this->lessonStudents = $lessonStudents;
    }
	/*
		Метод storeWorkedLesson получает данные с формы, формирует массив и передает его в функцию сохранения урока.
		Записывает всех студентов, которые должны прийти на урок.
	*/
	public function storeWorkedLesson($request)
	{	
		// думаю выносить explode в отдельный метод будет избыточным решением
  		$status = explode(",", $request->input('status'));
  		$idRoomSubsidiaries = explode("/", $request->input('class_room'));
  		$nameRoomSubsidiaries = explode("@", $request->input('class_room'));

  		$arr_students = $request->input('students');
        $DataLesson = $this->getDataStore($request->input('teacher_id'));
        $teacher = $DataLesson['Teacher'];
        $id = $DataLesson['lesson_id'] + 1;

		// Формирую HTML код. Передаю во вью данные, формирую из них необходимый текст с тегами и рендорю
		$lessonDataHTML = $this->renderLessonData->getRenderLessonData($teacher, 'Отработка', $nameRoomSubsidiaries[2], $nameRoomSubsidiaries[1]);	

		$dateTime = Carbon::now('Europe/Kiev');

		// формирую массив для сохранения
		$lessonData = [
			'id' => $id,
			'teacher_id' => $request->input('teacher_id'), 
			'group_id' => 9999,
			'status' => $status[0],
			'type' => $request->input('type'),
			'room' => $idRoomSubsidiaries[0],
			'subsidiaries' => $idRoomSubsidiaries[1],
			'color' => $status[1],
			'lesson_date' => $request->input('lesson_date'),
			'lesson_time' => $request->input('lesson_time'),
			'lesson_time_end'=>$request->input('lesson_time_end'),
			'data_lesson' => $lessonDataHTML,
			'created_at' => $dateTime
		];

		$this->createLesson($lessonData);

		// В цикле сохраняю записи про то, что на этот урок должен прийти стдуент из массива $arr_stud
		foreach ($arr_students as $student){
			$this->lessonStudents->plannedVisitLesson($id, $student);
		}
	}
}

?>