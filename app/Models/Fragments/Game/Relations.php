<?php

namespace App\Models\Fragments\Game;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Relations
{
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'game_questions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'game_users')->withPivot('true_answers_count', 'rating_changes', 'finished_date');
    }
}