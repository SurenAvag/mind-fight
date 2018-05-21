<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject_id' => 'required|exists:questions,subject_id'
        ];
    }
}
