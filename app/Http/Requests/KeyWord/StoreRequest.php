<?php

namespace App\Http\Requests\KeyWord;

use App\Http\Requests\BaseRequest;
use App\Models\KeyWord;

class StoreRequest extends BaseRequest
{
    private $keyWord;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'required',
            'subject_id'    => 'required|exists:subjects,id'
        ];
    }

    public function persist(): self
    {
        $this->keyWord = KeyWord::create($this->getProcessedData());

        return $this;
    }

    private function getProcessedData()
    {
        return array_merge($this->all(), [
            //
        ]);
    }

    public function getKeyWord(): KeyWord
    {
        return $this->keyWord;
    }
}
