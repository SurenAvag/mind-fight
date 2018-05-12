<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;

/**
 * @property mixed game
 */
class JoinToGameRequest extends BaseRequest
{
    public function authorize()
    {
        return $this->game->for_two_player && $this->game->users()->count() == 2 && !$this->game->can_started;
    }

    public function rules()
    {
        return [
            //
        ];
    }

    public function joinToGame()
    {
        $this->game->update([
            'can_started' => true
        ]);

        return $this;
    }

    public function getMessage()
    {
        return [
            'Game started.'
        ];
    }
}