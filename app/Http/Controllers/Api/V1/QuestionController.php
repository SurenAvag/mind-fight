<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\DataProviders\QuestionsDataProvider;
use App\Http\Requests\Question\DestroyRequest;
use App\Http\Requests\Question\IndexRequest;
use App\Http\Requests\Question\ShowRequest;
use App\Http\Requests\Question\StoreRequest;
use App\Http\Requests\Question\UpdateRequest;
use App\Models\Game;
use App\Models\Question;
use App\Transformers\QuestionTransformer;
use Illuminate\Http\JsonResponse;

class QuestionController extends ApiController
{
    private $transformer;

    public function __construct(QuestionTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function index(IndexRequest $request, QuestionsDataProvider $provider): JsonResponse
    {
        return $this->successResponse(
            $this->transformer->transformPagination(
                $provider->getQuestions(),
                'indexTransform'
            )
        );
    }

    public function store(StoreRequest $request)
    {
        return $this->successResponse(
            QuestionTransformer::store(
                $request->persist()->getQuestion()
            )
        );
    }

    public function show(ShowRequest $request, Question $question): JsonResponse
    {
        return $this->successResponse(
            QuestionTransformer::show(
                $question
            )
        );
    }

    public function update(UpdateRequest $request, Question $question): JsonResponse
    {
        return $this->successResponse(
            QuestionTransformer::update(
                $request->persist()->getQuestion()
            )
        );
    }

    public function destroy(DestroyRequest $request, Question $question): JsonResponse
    {
        $question->delete();

        return $this->successResponse([
            'Question has been deleted'
        ]);
    }
}
