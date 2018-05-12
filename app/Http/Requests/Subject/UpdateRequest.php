<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed subject
 */
class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required'
        ];
    }

    public function persist()
    {
        $this->subject->update(
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

    public function getSubject()
    {
        return $this->subject;
    }
}
