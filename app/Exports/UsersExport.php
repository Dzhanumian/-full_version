<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\StudentController;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return Student::all();
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