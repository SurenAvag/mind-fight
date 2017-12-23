<?php

namespace App\Transformers;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class QuestionTransformer extends Transformer
{
    public function indexTransform(Question $question): array
    {
        return array_merge($this->simpleTransform($question), [
            'subject_id'    => $question->subject_id,
            'topic_id'      => $question->topic_id,
            'level'         => $question->level
        ]);
    }

    public function storeTransform(Question $question): array
    {
        return [
            array_merge($this->simpleTransform($question), [
                'subject_id'    => $question->subject_id,
                'topic_id'      => $question->topic_id,
                'level'         => $question->level
            ])
        ];
    }

    public function showTransform(Question $question): array
    {
        return [
            array_merge($this->simpleTransform($question), [
                'subject_id'    => $question->subject_id,
                'topic_id'      => $question->topic_id,
                'level'         => $question->level
            ])
        ];
    }

    public function updateTransform(Question $question): array
    {
        return [
            array_merge($this->simpleTransform($question), [
                'subject_id'    => $question->subject_id,
                'topic_id'      => $question->topic_id,
                'level'         => $question->level
            ])
        ];
    }

    public function simpleTransform(Model $item): array
    {
        return [
            'id'    => $item->id,
            'text'  => $item->text
        ];
    }
}