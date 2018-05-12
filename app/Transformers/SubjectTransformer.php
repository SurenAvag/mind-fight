<?php

namespace App\Transformers;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class SubjectTransformer extends Transformer
{
    public function indexTransform(Subject $subject): array
    {
        return array_merge($this->simpleTransform($subject), [
            //
        ]);
    }

    public function storeTransform(Subject $subject): array
    {
        return array_merge($this->simpleTransform($subject), [
            //
        ]);
    }

    public function showTransform(Subject $subject): array
    {
        return array_merge($this->simpleTransform($subject), [
            //
        ]);
    }

    public function updateTransform(Subject $subject): array
    {
        return array_merge($this->simpleTransform($subject), [
            //
        ]);
    }

    public function simpleTransform(Model $item): array
    {
        return [
            'id'                => $item->id,
            'name'              => $item->name,
        ];
    }
}