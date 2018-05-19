<?php

namespace App\Models;

use App\Graphs\DirectedGraph;

/**
 * @property mixed questions
 */
class Subject extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getQuestionsAsGraph(): DirectedGraph
    {
        $graphs = [];

        foreach ($this->questions as $question) {

            $graphs []= $question->asGraph();
        }

        return DirectedGraph::union(...$graphs);
    }
}
