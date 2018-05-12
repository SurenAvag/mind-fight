<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\DataProviders\SubjectDataProvider;
use App\Http\Requests\Subject\DestroyRequest;
use App\Http\Requests\Subject\IndexRequest;
use App\Http\Requests\Subject\ShowRequest;
use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Models\Subject;
use App\Transformers\SubjectTransformer;
use Illuminate\Http\JsonResponse;

class SubjectController extends ApiController
{
    public function index(IndexRequest $request, SubjectDataProvider $provider): JsonResponse
    {
        return $this->successResponse(
            SubjectTransformer::pagination(
                $provider->getQuestions(),
                'indexTransform'
            )
        );
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->successResponse(
            SubjectTransformer::store(
                $request->persist()->getSubject()
            )
        );
    }

    public function show(ShowRequest $request, Subject $subject): JsonResponse
    {
        return $this->successResponse(
            SubjectTransformer::show($subject)
        );
    }

    public function update(UpdateRequest $request, Subject $subject): JsonResponse
    {
        return $this->successResponse(
            SubjectTransformer::update(
                $request->persist()->getSubject()
            )
        );
    }

    public function destroy(DestroyRequest $request, Subject $subject): JsonResponse
    {
        $subject->delete();

        return $this->successResponse([
            'Subject has been deleted'
        ]);
    }
}
