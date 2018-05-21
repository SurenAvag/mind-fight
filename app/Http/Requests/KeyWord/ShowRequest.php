<?php

namespace App\Http\Requests\KeyWord;

use App\Http\Requests\BaseRequest;

class ShowRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
