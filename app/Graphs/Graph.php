<?php

namespace App\Graphs;


use App\Graphs\Interfaces\GraphContract;

class Graph implements GraphContract
{
    const DISPLAY_TYPES = [
        'matrix' => 1,
        'graphic' => 2
    ];

    private $nodes = [];
    private $lines = [];

    public function __construct(array $nodes = [], array $lines = [])
    {
        $this->setNodes(...$nodes);

        $this->setLines(...$lines);
    }

    public static function union(GraphContract ...$graphs): GraphContract
    {
        $unionGraph = new static();

        foreach ($graphs as $graph){

            $unionGraph->addLines(...$graph->getLines());
            $unionGraph->addNodes(...$graph->getNodes());
        }

        return $unionGraph;
    }

    public static function diff(GraphContract $baseGraph, GraphContract $subGraph): GraphContract
    {
        $diffGraph = new static();

        $diffGraph->setLines($baseGraph->diffLines(...$subGraph->getLines()));

        $diffGraph->setNodes($baseGraph->diffNodes($subGraph->getNodes()));

        return $diffGraph;
    }

    public function isEmpty(): bool
    {
        return count($this->nodes) === 0;
    }

    public function removeDependedNodes(GraphContract $graph): GraphContract
    {
        return $graph;
    }

    public function asMatrix(): array
    {
        $data = [];

        array_push($data, $this->getNodeNames());

        foreach ($this->nodes as $node){

            $nodeData = [$node->getName()];

            foreach ($this->nodes as $childNode) {

                $nodeData []= $this->hasLine($childNode->getId(), $node->getId()) ? 1 : 0;
            }

            $data [] = $nodeData;
        }

        return $data;
    }


    public function addNodes(Node ...$nodes): void
    {
        foreach ($nodes as $node){

            $this->setNode($node);
        }
    }

    public function addLines(Line ...$lines): void
    {
        foreach ($lines as $line){

            $this->setLine($line);
        }
    }

    public function setNode(Node $node): void
    {
        if(!$this->hasNode($node->getId())) {

            $this->nodes [] = $node;
        }
    }

    public function setNodes(Node ...$nodes): void
    {
        $this->nodes = [];

        $this->addNodes(...$nodes);
    }

    public function setLine(Line $line): void
    {
        if(!$this->hasLine($line->getParentId(), $line->getChildId())) {
            $this->lines[] = $line;
        }
    }

    public function setLines(Line ...$lines): void
    {
        $this->lines = [];

        $this->addLines(...$lines);
    }

    public function getNode(int $id): ?Node
    {
        foreach ($this->nodes as $node) {

            if($node->id == $id)  {

                return $node;
            }
        }

        return null;
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function getLine(int $parentId, int $childId): ?Line
    {
        foreach ($this->lines as $line) {

            if($line->getParentId() == $parentId && $line->getChildId() == $childId){

                return $line;
            }
        }

        return null;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    private function hasNode(int $id): bool
    {
        foreach ($this->nodes as $node) {

            if($node->getId() == $id){

                return true;
            }
        }

        return false;
    }

    private function hasLine(int $parentId, int $childId): bool
    {
        foreach ($this->lines as $line) {

            if($line->getParentId() == $parentId && $line->getChildId() == $childId){

                return true;
            }
        }

        return false;
    }

    private function getNodeNames()
    {
        $data = array_map(function (Node $node) {
            return $node->getName();
        }, $this->nodes);

        array_unshift($data, ' ');

        return $data;
    }
}