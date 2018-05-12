<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;

/**
 * @property mixed forTwoPlayer
 * @property mixed subjectId
 * @property mixed secondPlayerId
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
            'subjectId'         => 'required|exists:subjects,id',
            'forTwoPlayer'      => 'required|boolean',
            'secondPlayerId'    => 'required_if:forTwoPlayer,1|exists:users,id'
        ];
    }
}
