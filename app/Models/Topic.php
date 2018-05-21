<?php

namespace App\Models;

use App\Models\Fragments\Topic\Relations;

class Topic extends BaseModel
{
    use Relations;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'subject_id'
    ];
}
