<?php

namespace App\Models\Fragments\Topic;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Relations
{
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}