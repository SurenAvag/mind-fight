<?php

namespace App\Models;

use App\Events\GameCreated;
use App\Events\GameDeleted;
use App\Events\GameDeteled;
use App\Models\Fragments\Game\Getters;
use App\Models\Fragments\Game\Relations;

/**
 * @property mixed questions
 * @property mixed for_two_player
 * @property mixed finished_date
 * @property mixed rating_changes
 */
class Game extends BaseModel
{
    use Relations, Getters;

    const GAMES_COUNT_FOR_WIN = 1;

    protected $fillable = [
        'winner_id',
        'loser_id',
        'for_two_player',
        'subject_id',
        'can_started'
    ];

    protected $dispatchesEvents = [
        'created' => GameCreated::class,
        'deleted' => GameDeleted::class,
    ];

    public function isFinished(): bool
    {
        if ($this->for_two_player) {
            return $this->users()->pluck('true_answers_count')->filter(function ($item) {

                    return isset($item);
                })->count() == 2;
        }

        return isset($this->users()->first()->pivot->true_answers_count);
    }

    public function scopeNotFinished($query)
    {
        return $query->where('created_at', '>', '2018-05-15 23:33:07');
    }

    public function forSinglePlayer(): bool
    {
        return !$this->for_two_player;
    }

    public function decideWinnerAndLoser()
    {
        if ($this->for_two_player) {
            $users = $this->users()->get();

            return $this->decideTwoPlayersRole($users->first(), $users->last());
        }

        if ($this->users()->first()->pivot->true_answers_count >= ($this->questions()->count() / 2)) {
            $winner = $this->users()->first();
            $loser = null;
        } else {
            $winner = null;
            $loser = $this->users()->first();
        }

        return [
            'winner'    => $winner,
            'loser'     => $loser
        ];
    }

    private function decideTwoPlayersRole(User $firstUser, User $secondUser)
    {
        if ($firstUser->pivot->true_answers_count == $secondUser->pivot->true_answers_count) {
            if ($firstUser->pivot->true_answers_count == 0) {
                return [
                    'winner'    => null,
                    'loser'     => null
                ];
            }
            if ($firstUser->pivot->finished_date < $secondUser->pivot->finished_date) {
                $winner = $firstUser;
                $loser = $secondUser;
            } else {
                $winner = $secondUser;
                $loser = $firstUser;
            }
        } else {
            if ($firstUser->pivot->true_answers_count < $secondUser->pivot->true_answers_count) {
                $winner = $secondUser;
                $loser = $firstUser;
            } else {
                $winner = $firstUser;
                $loser = $secondUser;
            }
        }

        return [
            'winner'    => $winner,
            'loser'     => $loser
        ];
    }
}
