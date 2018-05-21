<?php

namespace App\Http\Requests\KeyWord;

use App\Http\Requests\BaseRequest;
use App\Models\KeyWord;

/**
 * @property mixed keyWord
 */
class UpdateRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'sometimes|required',
            'subject_id'    => 'sometimes|required|exists:subjects,id'
        ];
    }

    public function persist(): self
    {
        $this->keyWord->update(
            $this->getProcessedData()
        );

        return $this;
    }

    private function getProcessedData(): array
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
