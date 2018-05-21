<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\DataProviders\TopicDataProvider;
use App\Http\Requests\Topic\DestroyRequest;
use App\Http\Requests\Topic\IndexRequest;
use App\Http\Requests\Topic\ShowRequest;
use App\Http\Requests\Topic\StoreRequest;
use App\Http\Requests\Topic\UpdateRequest;
use App\Models\Topic;
use App\Transformers\TopicTransformer;
use Illuminate\Http\JsonResponse;

class TopicController extends ApiController
{
    public function index(IndexRequest $request, TopicDataProvider $provider): JsonResponse
    {
        return $this->successResponse(
            TopicTransformer::pagination(
                $provider->getTopics(),
                'indexTransform'
            )
        );
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->successResponse(
            TopicTransformer::store(
                $request->persist()->getTopic()
            )
        );
    }

    public function show(ShowRequest $request, Topic $topic): JsonResponse
    {
        return $this->successResponse(
            TopicTransformer::show($topic)
        );
    }

    public function update(UpdateRequest $request, Topic $topic): JsonResponse
    {
        return $this->successResponse(
            TopicTransformer::update(
                $request->persist()->getTopic()
            )
        );
    }

    public function destroy(DestroyRequest $request, Topic $topic): JsonResponse
    {
        $topic->delete();

        return $this->successResponse([
            'Topic has been deleted'
        ]);
    }
}
