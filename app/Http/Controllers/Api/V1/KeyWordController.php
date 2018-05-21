<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\DataProviders\KeyWordDataProvider;
use App\Http\Requests\KeyWord\AttachChildRequest;
use App\Http\Requests\KeyWord\AttachParentRequest;
use App\Http\Requests\KeyWord\DestroyRequest;
use App\Http\Requests\KeyWord\IndexRequest;
use App\Http\Requests\KeyWord\ShowRequest;
use App\Http\Requests\KeyWord\StoreRequest;
use App\Http\Requests\KeyWord\UpdateRequest;
use App\Models\KeyWord;
use App\Transformers\KeyWordTransformer;
use Illuminate\Http\JsonResponse;

class KeyWordController extends ApiController
{
    public function index(IndexRequest $request, KeyWordDataProvider $provider): JsonResponse
    {
        return $this->successResponse(
            KeyWordTransformer::pagination(
                $provider->getKeyWords(),
                'indexTransform'
            )
        );
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->successResponse(
            KeyWordTransformer::store(
                $request->persist()->getKeyWord()
            )
        );
    }

    public function show(ShowRequest $request, KeyWord $keyWord): JsonResponse
    {
        return $this->successResponse(
            KeyWordTransformer::show($keyWord)
        );
    }

    public function update(UpdateRequest $request, KeyWord $keyWord): JsonResponse
    {
        return $this->successResponse(
            KeyWordTransformer::update(
                $request->persist()->getKeyWord()
            )
        );
    }

    public function destroy(DestroyRequest $request, KeyWord $keyWord): JsonResponse
    {
        $keyWord->delete();

        return $this->successResponse([
            'Key word has been deleted'
        ]);
    }

    public function attachChild(AttachChildRequest $request, KeyWord $parentKeyWord, KeyWord $childKeyWord): JsonResponse
    {
        return $this->successResponse(
            $request->persist()->getMessage()
        );
    }

    public function attachParent(AttachParentRequest $request, KeyWord $childKeyWord, KeyWord $parentKeyWord): JsonResponse
    {
        return $this->successResponse(
            $request->persist()->getMessage()
        );
    }
}
