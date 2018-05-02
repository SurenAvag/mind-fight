<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed answers
 * @property mixed game
 * @property static endTime
 */
class EndGameRequest extends BaseRequest
{
    private $questions;
    private $points;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function endGame()
    {
        $this->endTime = Carbon::now();

        $this->filterAnswers();

        $this->questions = Question::with('trueAnswer')->find(array_keys($this->answers));

        $trueAnswers = 0;

        foreach ($this->questions as $question){
            if($question->trueAnswer->id == $this->answers[$question->id]){

                Auth::user()->answeredQuestion()->syncWithoutDetaching($question->id);

                $trueAnswers++;
                $this->points += $this->getQuestionPoint($question);

            }
        }


        if($this->game->questions->count() > $trueAnswers * 2){
            $this->points = 0;
        }

        Auth::user()->update(['point' => Auth::user()->point + ($this->points = (int)$this->points)]);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    private function filterAnswers()
    {
        $this->answers = array_filter($this->answers, function ($val){
            return $val != 'null' && $val;
        });
    }

    private function getQuestionPoint(Question $question)
    {
        $point = Question::POINT * Question::LEVEL_COEFFICIENT[$question->level];

        $point *= Auth::user()->pointCoefficient;

        $point += $this->point  * $this->endTime->diffInMinutes($this->game->created_at) * Question::MINUTE_COEFFICIENT;

        return $point;
    }

}
