<?php

namespace App\Http\Services\Finance;

use App\Student;

use App\Http\Services\Finance\FinanceInterface;

class FinanceServices extends DBFinance implements FinanceInterface
{	
	public function getPayerStudents()
    {
    	return (new Student)->getAllActivStudent();
    }

    public function studentPaidGroup($student_id)
    {
    	$StudentPaidGroup = $this->studentGroup($student_id);

    	return $StudentPaidGroup;
    }
}