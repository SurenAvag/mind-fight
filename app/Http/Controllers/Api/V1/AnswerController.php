<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Answer\ShowRequest;
use App\Http\Requests\Answer\StoreRequest;
use App\Http\Requests\Answer\UpdateRequest;
use App\Http\Requests\Question\DestroyRequest;
use App\Models\Answer;
use App\Transformers\AnswerTransformer;
use Illuminate\Http\JsonResponse;

class AnswerController extends ApiController
{
    public function store(StoreRequest $request): JsonResponse
    {
        return $this->successResponse(
            AnswerTransformer::store(
                $request->persist()->getAnswer()
            )
        );
    }

    public function show(ShowRequest $request, Answer $answer): JsonResponse
    {
        return $this->successResponse(
            AnswerTransformer::show(
                $answer
            )
        );
    }

    public function update(UpdateRequest $request, Answer $answer): JsonResponse
    {
        return $this->successResponse(
            AnswerTransformer::update(
                $request->persist()->getAnswer()
            )
        );
    }

    public function destroy(DestroyRequest $request, Answer $answer): JsonResponse
    {
        $answer->delete();

        return $this->successResponse([
            'Answer has been deleted'
        ]);
    }
}
