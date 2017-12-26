<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;

class UserTransformer extends Transformer
{
    public function simpleTransform(Model $item): array
    {
        return [
            'id'    => $item->id,
            'email'  => $item->email
        ];
    }

    public function indexTransform(Model $item): array
    {
        return array_merge($this->simpleTransform($item), [
            'firstName'  => $item->first_name,
            'lastName'  => $item->last_name,
            'point'  => $item->point,
            'type'  => $item->type,
        ]);
    }

    public function loginTransform(Model $item): array
    {
        return array_merge($this->meTransform($item), [
            'apiToken' => $item->api_token
         ]);
    }

    public function meTransform(Model $item): array
    {
        return array_merge($this->simpleTransform($item), [
            'firstName'  => $item->first_name,
            'lastName'  => $item->last_name,
            'point'  => $item->point,
            'type'  => $item->type,
        ]);
    }
}