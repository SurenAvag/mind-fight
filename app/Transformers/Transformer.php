<?php

namespace App\Transformers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class Transformer
{
    public static function __callStatic($name, $arguments): array
    {
        $instance = new static();

        if(method_exists($instance, 'transform' . ucfirst($name))){

            return $instance->{'transform' . ucfirst($name)}(...$arguments);
        }

        return $instance->{$name . 'Transform'}(...$arguments);
    }

    public function transformPagination(LengthAwarePaginator $paginator, string $method = 'simpleTransform', ...$args) : array
    {
        return [
            'total' => $paginator->total(),
            'items' => $this->transformArray($paginator->items(), $method, ...$args)
        ];
    }

    public function transformCollection(\ArrayAccess $items, string $method = 'simpleTransform', ...$args) : array
    {
        return $items->map(function ($item) use ($method,$args) {
            return $this->{$method}($item, ...$args);
        })->toArray();
    }

    public function transformArray(array $items, string $method = 'simpleTransform', ...$args) : array
    {
        return array_map(function($item) use ($method,$args) {
            return $this->{$method}($item, ...$args);
        },$items);
    }

    abstract public function simpleTransform(Model $item): array;
}