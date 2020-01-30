<?php

namespace App\Http\Services\RenderFunction;

/*
    На сайте реализованно 5 типов уроков и все они будут использовать эту функцию.
*/

class RenderLessonData
{
    public function getRenderLessonData($Teacher, $tupeLesspn, $room, $subsidiaries, $studentList = null)
    {	    
    	return view('renders.renderDataLesson', compact('Teacher', 'tupeLesspn', 'room', 'subsidiaries', 'studentList'))->render();    	
    }
}

