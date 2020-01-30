<?php 

namespace App\Http\Services\Finance;

use Illuminate\Support\Facades\DB;

class DBFinance
{	
	public function allInvoice()
	{
		$invoices = DB::table('invoices')
		->join('students', 'invoices.student_id', '=', 'students.id')
		->join('groups', 'invoices.group_id', '=', 'groups.id')
		->join('users', 'invoices.user_id', '=', 'users.id')
		->select(
				'invoices.id', 
				'students.surname as student_surname',
				'students.name as student_name',
				'students.patronymic as student_patronymic',
				'groups.group_name as group_name',  
				'invoice', 
				'month',
				'invoices.created_at',
				'invoices.updated_at'
			)
		->get();

		return $invoices;
	}

	public function studentGroup($student_id)
	{	
		$group_student = DB::table('group_student')
		->leftJoin('groups', 'group_student.group_id', '=', 'groups.id')
		->where('group_student.student_id', $student_id)
		->select(
			'groups.id as groups_id',
			'group_student.group_id as student_id'
		)
		->get();

		return $group_student;
	}
}	