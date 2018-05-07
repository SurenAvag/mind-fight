<?php

namespace App\Models;

use App\Graphs\DirectedGraph;
use App\Graphs\Graph;
use App\Graphs\Interfaces\GraphContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed answeredQuestions
 * @property mixed point
 */
class User extends Authenticatable
{
    use Notifiable;

    const NORM_POINT = 700;
    const TYPES = [
        'student'   => 1,
        'lecturer'  => 2
    ];

    private $usedKeyWordsGraph;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'type',
        'email',
        'password',
        'point',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function updateToken()
    {
        $this->update(['api_token' => str_random(50)]);

        return $this;
    }

    public function logout()
    {
        $this->updateToken();
    }

    public function getPointCoefficientAttribute()
    {
        return self::NORM_POINT / $this->point;
    }

    public function answeredQuestions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function getAnsweredQuestionsKeyWordsGraph(): GraphContract
    {
        $graphs = [];

        foreach ($this->answeredQuestions as $question) {

            $graphs []= $question->asGraph();
        }

        return DirectedGraph::union(...$graphs);
    }

    public function getNotUsedKeyWordsAsGraph()
    {
        $usedKeyWordsGraph = $this->getAnsweredQuestionsKeyWordsGraph();

        $subjectKeyWordsGraph = (new Subject())->getQuestionsAsGraph();

        $graphDiff = DirectedGraph::diff($subjectKeyWordsGraph, $usedKeyWordsGraph);

        $this->usedKeyWordsGraph = $usedKeyWordsGraph;

        return $graphDiff;
    }

    private function removeDependedKeyWordsFromGraph($graph): GraphContract
    {
        $graph->removeDependedNodes($this->usedKeyWordsGraph);
    }

    public function analyzeKeyWords(bool $strict = false)
    {
        $graph = $this->getNotUsedKeyWordsAsGraph();

        if($graph->isEmpty()){
            return true;
        }

        if($strict){

            return $graph->asGraphicData();
        }

        $newGraph = $this->removeDependedKeyWordsFromGraph($graph);

        if($newGraph->isEmpty()){

            return true;
        }

        return $newGraph->asGraphicData();
    }
}
