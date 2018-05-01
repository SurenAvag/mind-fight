<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Graph\GetKeyWordsGraphRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GraphController extends ApiController
{
    public function getKeyWordsGraph(GetKeyWordsGraphRequest $request)
    {
        dd($request->prepareData()->getGraph()->asMatrix());
        return $this->successResponse(
            $request->prepareData()->getGraph()
        );
    }
}
