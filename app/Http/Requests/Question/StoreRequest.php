<?php

namespace App\Http\Requests\Question;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    private $question;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'text'          => 'required|max:300',
            'subject_id'    => 'exists:subjects,id',
            'topic_id'      => 'exists:topics,id',
            'level'         => ['required', Rule::in(Question::LEVELS)]
        ];
    }

    public function persist(): self
    {
        $this->question = Question::create(
            $this->getProcessedData()
        );

        return $this;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    private function getProcessedData(): array
    {
        return array_merge($this->all(), [
            //
        ]);
    }
}
