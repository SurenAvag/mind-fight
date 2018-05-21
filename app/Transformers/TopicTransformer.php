<?php

namespace App\Transformers;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Model;

class TopicTransformer extends Transformer
{
    public function indexTransform(Topic $topic): array
    {
        return array_merge($this->simpleTransform($topic), [
            //
        ]);
    }

    public function storeTransform(Topic $topic): array
    {
        return array_merge($this->simpleTransform($topic), [
            //
        ]);
    }

    public function showTransform(Topic $topic): array
    {
        return array_merge($this->simpleTransform($topic), [
            //
        ]);
    }

    public function updateTransform(Topic $topic): array
    {
        return array_merge($this->simpleTransform($topic), [
            //
        ]);
    }

    public function simpleTransform(Model $item): array
    {
        return [
            'id'        => $item->id,
            'name'      => $item->name,
            'subject'   => SubjectTransformer::simple($item->subject)
        ];
    }
}