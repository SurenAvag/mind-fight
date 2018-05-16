<?php

namespace App\Models\Fragments\Game;

use App\Models\Question;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function loser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'loser_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}