<?php

namespace App\Http\Requests\KeyWord;

use App\Http\Requests\BaseRequest;

/**
 * @property mixed childKeyWord
 * @property mixed parentKeyWord
 */
class AttachChildRequest extends BaseRequest
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

    public function persist(): self
    {
        $this->parentKeyWord->children()->syncWithoutDetaching($this->childKeyWord);

        return $this;
    }

    public function getMessage(): array
    {
        return [
            'Child key word has been attached'
        ];
    }
}
