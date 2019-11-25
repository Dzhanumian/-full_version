<?php

namespace App\Exports;


use App\Finance;
use App\execl_date;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class Finance_execl implements FromCollection, WithHeadings
{

    public function collection()
    {	
    	$date = execl_date::find(1); // период из бд
    	$Finance = Finance::where('created_at', '>=', $date->date_from)->where('created_at', '<=', $date->date_befor)->get();
        return $Finance;
    }

    public function headings(): array
    {
        return [
            'Ид',
            'Ид студента',
            'Ид группы',
            'Имя группы',
            'Сумма',
            'За месяц',
            'Кол-во уроков',
            'Ид оформившего',
            'Комментарий',
            'Создано',
            'Обновлено',
            'Тариф',
            'Баланс',
            'Инициалы',
            'Тип',
            'Статус'
        ];
    }
}

