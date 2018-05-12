<?php

namespace App\Models;

use App\Graphs\DirectedGraph;
use App\Graphs\Line;
use App\Graphs\Node;
use App\Models\Fragments\Question\Relations;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property mixed level
 * @property mixed text
 */
class Question extends BaseModel
{
    use Relations;

    const POINT = 3;
    const MINUTE_COEFFICIENT = 0.05;

    protected $fillable = [
        'text',
        'subject_id',
        'topic_id',
        'level',
        'time'
    ];

    const LEVELS = [
        'easy'      => 1,
        'middle'    => 2,
        'high'      => 3
    ];

    const LEVEL_COEFFICIENT = [
        self::LEVELS['easy'] => 0.8,
        self::LEVELS['middle'] => 1,
        self::LEVELS['high'] => 1.2
    ];

    public function asGraph()
    {
        $keyWords = KeyWord::where(function ($query) {

            foreach (explode(' ', $this->text) as $word) {
                $query->orWhere('name', 'like', "%$word%");
            }
        })->get();

        $nodes = $this->nodesFromKeyWords($keyWords);
        $lines = $this->linesFromKeyWords($keyWords);

        return new DirectedGraph($nodes, $lines);
    }

    private function nodesFromKeyWords(Collection $keyWords): array
    {
        $nodes = [];

        foreach ($keyWords as $keyWord) {
            $nodes [] = new Node(
                $keyWord->id,
                $keyWord->name,
                $keyWord->parents->pluck('id')->toArray(),
                $keyWord->children->pluck('id')->toArray()
            );
        }

        return $nodes;
    }

    private function linesFromKeyWords(Collection $keyWords): array
    {
        $lines = [];

        foreach ($keyWords as $keyWord) {

            foreach ($keyWord->parents as $parent){

                if($keyWords->where('id', $parent->id)->isNotEmpty()){
                    $lines [] = new Line(
                        $parent->id,
                        $keyWord->id
                    );
                }
            }

            foreach ($keyWord->children as $child){

                if($keyWords->where('id', $child->id)->isNotEmpty()){

                    $lines [] = new Line(
                        $keyWord->id,
                        $child->id
                    );
                }
            }
        }

        return $lines;
    }
}
