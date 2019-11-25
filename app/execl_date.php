<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class execl_date extends Model
{
    protected $fillable = [
        'date_from', 'date_befor', 'created_at', 'updated_at',
    ];

    /* первую запись создать вручную */
}
