<?php

namespace App\Http\DataProviders;

use App\Events\UsersAttachedToGame;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameDataProvider
{
    private $game;

    public function prepareData(int $subjectId, bool $forTwoPlayer, int $secondPlayerId = null)
    {
        DB::statement("SET sql_mode = ''");

        $questionIds = $this->getRandomQuestionIds($subjectId);

        $this->game = Game::create([
            'subject_id'        => $subjectId,
            'for_two_player'    => $forTwoPlayer,
            'can_started'       => $forTwoPlayer ? false : true
        ]);

        $this->game->questions()->attach(array_pluck($questionIds, 'id'));


        $this->attachUsers($forTwoPlayer, $secondPlayerId);

        return $this;
    }

    private function attachUsers($forTwoPlayer, $secondPlayerId): void
    {
        $this->game->users()->syncWithoutDetaching([Auth::id(), !$forTwoPlayer ?: $secondPlayerId]);

        if($secondPlayerId) {
            event(new UsersAttachedToGame(Auth::user(), User::find($secondPlayerId), $this->game));
        }
    }

    private function getRandomQuestionIds(int $subjectId): array
    {
        return DB::select(
            "select id FROM 
                (SELECT id, text, topic_id FROM questions WHERE subject_id = $subjectId ORDER BY RAND())
            AS subquery GROUP BY topic_id limit 10"
        );
    }

    public function getGame()
    {
        return $this->game;
    }
}