<?php

namespace App\Models\Fragments\User;

use App\Models\Game;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Relations
{
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_users')->withPivot('finished_date', 'true_answers_count');
    }
}