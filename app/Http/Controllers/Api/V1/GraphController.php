<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Graph\GetKeyWordsGraphRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GraphController extends ApiController
{
    public function getKeyWordsGraph(GetKeyWordsGraphRequest $request, Subject $subject)
    {
        return $this->successResponse(
            $request->prepareData()->getGraph()
        );
    }
}
