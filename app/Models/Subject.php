<?php

namespace App\Models;

use App\Graphs\DirectedGraph;

/**
 * @property mixed questions
 */
class Subject extends BaseModel
{
    const SUBJECT_NAMES = [
        'Մաթեմատիկական անալիզ',
        'Դիսկրետ մաթեմատիկա',
        'Բարձրագույն հանրահաշիվ',
        'Գրաֆների տեսություն',
        'Տվյալների կառուցվածք',
        'Մաթեմատիկական տրամաբանություն',
        'Ալգորիթմների տեսություն',
        'Օպտիմիզացիայի մեթոդներ'
    ];

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
