<?php

namespace App\Http\DataProviders;

use App\Models\Game;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class GameDataProvider
{
    private $game;

    public function prepareData(): self
    {
        DB::statement("SET sql_mode = ''");
        $questionIds = DB::select("select id FROM (SELECT id, text, topic_id FROM questions ORDER BY RAND()) AS subquery GROUP BY topic_id");

        $this->game = Game::create([])->fresh();
        $this->game->questions()->attach(array_pluck($questionIds, 'id'));

        $this->game->load('questions.answers');

        return $this;
    }

    public function getGame()
    {
        return $this->game;
    }
}