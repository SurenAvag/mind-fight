<?php

namespace App\Graphs;


class Line
{
    private $parentId;
    private $childId;

    public function __construct(int $parentId, int $childId)
    {
        $this->parentId = $parentId;
        $this->childId = $childId;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function getChildId(): int
    {
        return $this->childId;
    }
}