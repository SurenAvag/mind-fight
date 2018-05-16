<?php

namespace App\Http\Requests\Auth;

use App\Events\GameDeleted;
use App\Http\Requests\BaseRequest;
use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DisconnectedRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function handleDisconnecting()
    {
        foreach (Auth::user()->games()->notFinished()->get() as $game){
            event(new GameDeleted($game));
        }

        Auth::user()->games()->notFinished()->delete();

        return $this;
    }

    public function getResponseMessage()
    {
        return [
            'disconnect process has been finished'
        ];
    }

}
