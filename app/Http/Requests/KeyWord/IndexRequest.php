<?php

namespace App\Http\Requests\KeyWord;

use App\Http\Requests\BaseRequest;

class IndexRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject_id' => 'required|exists:key_words,subject_id'
        ];
    }
}
