<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\DataProviders\GameDataProvider;
use App\Http\Requests\Game\EndGameRequest;
use App\Http\Requests\Game\GetGameRequest;
use App\Http\Requests\Game\JoinToGameRequest;
use App\Models\Game;
use App\Transformers\GameTransformer;

class GameController extends ApiController
{
    public function getGame(GetGameRequest $request, GameDataProvider $dataProvider)
    {
        return $this->successResponse(
            GameTransformer::show(
                $dataProvider->prepareData($request->subjectId, $request->forTwoPlayer)->getGame()
            )
        );
    }

    public function endGame(EndGameRequest $request, Game $game)
    {
        return $this->successResponse($request->endGame()->getMessage());
    }

    public function joinToGame(JoinToGameRequest $request, Game $game)
    {
        return $this->successResponse($request->joinToGame()->getMessage());
    }
}
