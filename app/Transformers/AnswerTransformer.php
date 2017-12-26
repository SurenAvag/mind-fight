<?php

namespace App\Transformers;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;

class AnswerTransformer extends Transformer
{
    public function storeTransform(Answer $answer): array
    {
        return array_merge($this->simpleTransform($answer), [
            //
        ]);
    }

    public function showTransform(Answer $answer): array
    {
        return array_merge($this->simpleTransform($answer), [
            //
        ]);
    }

    public function updateTransform(Answer $answer): array
    {
        return array_merge($this->simpleTransform($answer), [
            //
        ]);
    }

    public function simpleTransform(Model $item): array
    {
        return [
            'id'                => $item->id,
            'text'              => $item->text . $item->id,
            'question_id'       => $item->question_id,
            'is_true_answer'    => $item->is_true_answer
        ];
    }
}