<?php

namespace App\Http\Requests\Topic;

use App\Models\Topic;
use App\Transformers\TopicTransformer;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed topic
 */
class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'sometimes|required',
            'subject_id'    => 'sometimes|required|exists:subjects,id',
        ];
    }

    public function persist(): self
    {
        $this->topic->update(
            $this->getProcessedData()
        );

        return $this;
    }

    public function getProcessedData(): array
    {
        return array_merge($this->all(),[
            //
        ]);
    }

    public function getTopic(): Topic
    {
        return $this->topic;
    }
}
