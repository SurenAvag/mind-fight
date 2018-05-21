<?php

namespace App\Http\Requests\Topic;

use App\Models\Topic;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    private $topic;

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
        $this->topic = Topic::create(
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
