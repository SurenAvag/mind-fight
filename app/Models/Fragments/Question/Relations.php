<?php

namespace App\Models\Fragments\Question;

use App\Models\Answer;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait Relations
{
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function trueAnswer(): HasOne
    {
        return $this->hasOne(Answer::class)->where('is_true_answer', 1);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function answeredByUser()
    {
        return $this->belongsToMany(User::class);
    }
}