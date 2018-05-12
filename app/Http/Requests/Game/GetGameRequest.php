<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;

/**
 * @property mixed forTwoPlayer
 * @property mixed subjectId
 */
class GetGameRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subjectId'     => 'required|exists:subjects,id',
            'forTwoPlayer'  => 'required|boolean'
        ];
    }
}
