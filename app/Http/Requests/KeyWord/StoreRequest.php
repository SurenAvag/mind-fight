<?php

namespace App\Http\Requests\KeyWord;

use App\Models\KeyWord;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
