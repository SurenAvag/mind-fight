<?php

namespace App\Models;

class Question extends BaseModel
{
    public $timestamps = false;

    const LEVELS = [
        'easy'      => 1,
        'middle'    => 2,
        'high'      => 3
    ];
}
