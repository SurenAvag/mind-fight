<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\DataProviders\TopicDataProvider;
use App\Http\Requests\Topic\IndexRequest;
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

//    public function store(StoreRequest $request): JsonResponse
//    {
//        return $this->successResponse(
//            KeyWordTransformer::store(
//                $request->persist()->getKeyWord()
//            )
//        );
//    }
//
//    public function show(ShowRequest $request, KeyWord $keyWord): JsonResponse
//    {
//        return $this->successResponse(
//            KeyWordTransformer::show($keyWord)
//        );
//    }
//
//    public function update(UpdateRequest $request, KeyWord $keyWord): JsonResponse
//    {
//        return $this->successResponse(
//            KeyWordTransformer::update(
//                $request->persist()->getKeyWord()
//            )
//        );
//    }
//
//    public function destroy(DestroyRequest $request, KeyWord $keyWord): JsonResponse
//    {
//        $keyWord->delete();
//
//        return $this->successResponse([
//            'Key word has been deleted'
//        ]);
//    }
}
