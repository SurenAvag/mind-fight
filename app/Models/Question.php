<?php

namespace App\Models;

use App\Models\Fragments\Question\Relations;

class Question extends BaseModel
{
    use Relations;

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
