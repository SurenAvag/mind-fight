<?php

namespace App\Models;

class Subject extends BaseModel
{
    public $timestamps = false;

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
