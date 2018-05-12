<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;

class GameTransformer extends Transformer
{
    public function simpleTransform(Model $item): array
    {
        return [
            'id'    => $item->id,
            'name'  => $item->name,
        ];
    }

    public function showTransform($game): array
    {
        return array_merge($this->simpleTransform($game), [
            'questions'     => QuestionTransformer::collection($game->questions, 'showTransform'),
            'time'          => $game->questions->sum('time'),
            'forTwoPlayer'  => $game->for_two_player
        ]);
    }
}