<?php

namespace App\Transformers;

use App\Models\Answer;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class SubjectTransformer extends Transformer
{
    public function simpleTransform(Model $item): array
    {
        return [
            'id'                => $item->id,
            'name'              => $item->name,
        ];
    }
}