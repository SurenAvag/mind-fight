<?php

namespace App\Graphs\Interfaces;


use App\Graphs\Line;
use App\Graphs\Node;

interface GraphContract
{
    public static function union(GraphContract ...$graphs);

    public function asMatrix(): array;

    public function addNodes(Node ...$nodes): void;

    public function addLines(Line ...$lines): void;

    public function setNode(Node $node): void;

    public function setNodes(Node ...$nodes): void;

    public function setLine(Line $line): void;

    public function setLines(Line ...$lines): void;

    public function getNode(int $id): ?Node;

    public function getNodes(): array;

    public function getLine(int $parentId, int $childId): ?Line;

    public function getLines(): array;
}