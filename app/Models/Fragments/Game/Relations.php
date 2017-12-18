<?php

namespace App\Models\Fragments\Game;

use App\Models\Question;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Relations
{
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'game_questions');
    }
}