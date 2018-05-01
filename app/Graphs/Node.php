<?php

namespace App\Graphs;


class Node
{
    private $id;
    private $name = '';
    private $parents = [];
    private $children = [];

    public function __construct(int $id, string $name = '', array $parents = [], array $children = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->parents = $parents;
        $this->children = $children;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParents(): array
    {
        return $this->parents;
    }

    public function getChildren(): array
    {
        return $this->children;
    }
}