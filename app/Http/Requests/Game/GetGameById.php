<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed game
 */
class GetGameById extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->game->isFinished()
            && Auth::user()->games()->pluck('games.id')->contains($this->game->id)
            && Auth::user()->games()->where('game_id', $this->game->id)->where('finished_date', null)->exists()
            && $this->game->can_started;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
