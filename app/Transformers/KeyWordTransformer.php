<?php

namespace App\Transformers;

use App\Models\KeyWord;
use Illuminate\Database\Eloquent\Model;

class KeyWordTransformer extends Transformer
{
    public function indexTransform(KeyWord $keyWord): array
    {
        return array_merge($this->simpleTransform($keyWord), [
            //
        ]);
    }

    public function storeTransform(KeyWord $keyWord): array
    {
        return array_merge($this->simpleTransform($keyWord), [
            //
        ]);
    }

    public function showTransform(KeyWord $keyWord): array
    {
        return array_merge($this->simpleTransform($keyWord), [
            //
        ]);
    }

    public function updateTransform(KeyWord $keyWord): array
    {
        return array_merge($this->simpleTransform($keyWord), [
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