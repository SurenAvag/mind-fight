<?php

namespace App\Http\Requests\Auth;

use App\Events\GameDeleted;
use App\Http\Requests\BaseRequest;
use App\Managers\Game\FinishGameManager;
use Illuminate\Support\Facades\Auth;

class DisconnectedRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }

    public function handleDisconnecting()
    {
        $this->deleteNotStaredGame();

        $this->finishStartedAndNotFinishedGames();

        return $this;
    }

    private function deleteNotStaredGame()
    {
        foreach (Auth::user()->games()->notStarted()->get() as $game) {
            event(new GameDeleted($game));
        }

        Auth::user()->games()->notStarted()->delete();
    }

    private function finishStartedAndNotFinishedGames()
    {
        foreach (Auth::user()->games()->notFinished()->get() as $game) {
            (new FinishGameManager($game, []))->endGame();
        }
    }

    public function getResponseMessage()
    {
        return [
            'disconnect process has been finished'
        ];
    }
}
