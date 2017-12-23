<?php

namespace App\Http\Requests\Answer;

use App\Models\Answer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'text'              => 'max:100',
            'question_id'       => 'exists:questions,id',
            'is_true_answer'    => [Rule::in([0, 1])]
        ];
    }

    public function persist(): self
    {
        $this->answer->update(
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
