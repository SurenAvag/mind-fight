<?php

namespace App\Http\Requests\Graph;

use App\Graphs\Graph;
use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * @property mixed display_type
 */
class GetKeyWordsGraphRequest extends BaseRequest
{
    private $graph;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'display_type' => ['nullable', Rule::in(Graph::DISPLAY_TYPES)],
        ];
    }

    public function prepareData()
    {
        $this->graph = Auth::user()->getAnsweredQuestionsKeyWordsGraph();

        return $this;
    }

    public function getGraph()
    {
        return $this->graph;
    }
}
