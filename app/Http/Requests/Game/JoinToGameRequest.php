<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed game
 */
class JoinToGameRequest extends BaseRequest
{
    public function authorize()
    {
        return $this->game->for_two_player && $this->game->users()->count() != 2 && !Auth::user()->games->pluck('games.id')->contains($this->game->id);
    }

    public function rules()
    {
        return [
            //
        ];
    }

    public function joinToGame()
    {
        $this->game->users()->syncWithoutDetaching(Auth::user());

        return $this;
    }

    public function getMessage()
    {
        return [
            'You joined to game.'
        ];
    }
}