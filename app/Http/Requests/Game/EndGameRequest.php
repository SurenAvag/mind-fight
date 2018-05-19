<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;
use App\Managers\Game\FinishGameManager;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed answers
 * @property mixed game
 */
class EndGameRequest extends BaseRequest
{
    public function authorize()
    {
        return !$this->game->isFinished()
            && Auth::user()->games()->pluck('games.id')->contains($this->game->id)
            && Auth::user()->games()->where('game_id', $this->game->id)->where('finished_date', null)->exists()
            && $this->game->can_started;
    }

    public function rules()
    {
        return [
            'answers'   => 'present|array',
            'answers.*' => 'integer|exists:answers,id|nullable'
        ];
    }

    public function endGame()
    {
        return (new FinishGameManager($this->game, $this->answers))
            ->endGame()
            ->getMessage();
    }
}
