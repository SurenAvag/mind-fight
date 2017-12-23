<?php

namespace App\Http\Requests\Answer;

use App\Models\Answer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    private $answer;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'text'              => 'required|max:100',
            'question_id'       => 'required|exists:questions,id',
            'is_true_answer'    => ['required', Rule::in([0,1])]
        ];
    }

    public function persist(): self
    {
        $this->answer = Answer::create(
            $this->getProcessedData()
        );

        return $this;
    }

    private function getProcessedData(): array
    {
        return array_merge($this->all(), [
            //
        ]);
    }

    public function getAnswer(): Answer
    {
        return $this->answer;
    }
}
