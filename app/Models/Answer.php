<?php

namespace App\Models;

class Answer extends BaseModel
{
    protected $fillable = [
        'text',
        'question_id',
        'is_true_answer'
    ];
}
