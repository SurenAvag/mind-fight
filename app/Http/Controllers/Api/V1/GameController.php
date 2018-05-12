<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\DataProviders\GameDataProvider;
use App\Http\Requests\Game\EndGameRequest;
use App\Http\Requests\Game\GetGameRequest;
use App\Models\Game;
use App\Transformers\GameTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return $this->successResponse([
            'points' => $request->endGame()->getPoints(),
        ]);
    }
}
