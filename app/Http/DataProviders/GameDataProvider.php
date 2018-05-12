<?php

namespace App\Http\DataProviders;

use App\Models\Game;
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
            'for_two_player'    => $forTwoPlayer
        ]);

        $this->game->questions()->attach(array_pluck($questionIds, 'id'));

        if ($secondPlayerId) {
            $this->game->users()->syncWithoutDetaching([Auth::user(), $secondPlayerId]);
        } else {
            $this->game->users()->syncWithoutDetaching(Auth::user());
        }

        return $this;
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