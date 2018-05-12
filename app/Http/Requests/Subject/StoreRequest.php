<?php

namespace App\Http\Requests\Subject;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    private $subject;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function persist()
    {
        $this->subject = Subject::create($this->getProcessedData());

        return $this;
    }

    private function getProcessedData()
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
