<?php

namespace App\Http\Requests\KeyWord;

use App\Http\Requests\BaseRequest;

/**
 * @property mixed parentKeyWord
 * @property mixed childKeyWord
 */
class AttachParentRequest extends BaseRequest
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
        $this->childKeyWord->parents()->syncWithoutDetaching($this->parentKeyWord);

        return $this;
    }

    public function getMessage(): array
    {
        return [
            'Parent key word has been attached'
        ];
    }
}
