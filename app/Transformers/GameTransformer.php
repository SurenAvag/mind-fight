<?php

namespace App\Transformers;

use App\Models\Answer;
use App\Models\Game;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

class GameTransformer extends Transformer
{
    public function simpleTransform(Model $item): array
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
        ];
    }

    public function showTransform($game): array
    {
        return array_merge($this->simpleTransform($game), [
            'questions' => QuestionTransformer::collection($game->questions, 'showTransform'),
            'time' => $game->questions->sum('time')
        ]);
    }
}