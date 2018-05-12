<?php

namespace App\Models;

use App\Models\Fragments\Question\Relations;

/**
 * @property mixed level
 */
class Question extends BaseModel
{
    use Relations;

    const POINT = 3;
    const MINUTE_COEFFICIENT = 0.05;

    protected $fillable = [
        'text',
        'subject_id',
        'topic_id',
        'level',
        'time'
    ];

    const LEVELS = [
        'easy'      => 1,
        'middle'    => 2,
        'high'      => 3
    ];

    const LEVEL_COEFFICIENT = [
        self::LEVELS['easy'] => 0.8,
        self::LEVELS['middle'] => 1,
        self::LEVELS['high'] => 1.2
    ];
}
