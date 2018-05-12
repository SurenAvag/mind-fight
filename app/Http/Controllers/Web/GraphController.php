<?php

namespace App\Http\Controllers\Web;

use App\Graphs\Graph;
use App\Http\Requests\Graph\GetKeyWordsGraphRequest;
use App\Http\Controllers\Controller;

class GraphController extends Controller
{
    public function getKeyWordsGraph(GetKeyWordsGraphRequest $request)
    {
        return view('graphs.base', [
            'graph' => $request->prepareData()->getGraph(),
            'display_type' => $request->display_type ?: Graph::DISPLAY_TYPES['matrix']
        ]);
    }
}
