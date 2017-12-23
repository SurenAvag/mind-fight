<?php

namespace App\Models;

class Question extends BaseModel
{
    protected $fillable = [
        'text',
        'subject_id',
        'topic_id',
        'level'
    ];

    const LEVELS = [
        'easy'      => 1,
        'middle'    => 2,
        'high'      => 3
    ];
}
