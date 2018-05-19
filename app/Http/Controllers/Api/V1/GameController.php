<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\GameCreated;
use App\Events\GameDeleted;
use App\Http\DataProviders\GameDataProvider;
use App\Http\Requests\Game\DestroyRequest;
use App\Http\Requests\Game\EndGameRequest;
use App\Http\Requests\Game\GetGameById;
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
                $dataProvider->prepareData($request->subjectId, $request->forTwoPlayer, $request->secondPlayerId)
                    ->getGame()
            )
        );
    }

    public function getGameById(GetGameById $request, Game $game)
    {
        return $this->successResponse(
            GameTransformer::show($game)
        );
    }

    public function endGame(EndGameRequest $request, Game $game)
    {
        return $this->successResponse($request->endGame());
    }

    public function joinToGame(JoinToGameRequest $request, Game $game)
    {
        return $this->successResponse($request->joinToGame()->getMessage());
    }

    public function destroy(DestroyRequest $request, Game $game)
    {
        event(new GameDeleted($game));

        Game::where('id', $game->id)->delete();

        return $this->successResponse([
            'game has been deleted'
        ]);
    }
}
