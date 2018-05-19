<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\User\IndexRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends ApiController
{
    public function index(IndexRequest $request)
    {
        return $this->successResponse(
            UserTransformer::pagination(
                $request->prepareData()->getUsers(),
                'indexTransform'
            )
        );
    }

    public function show(User $user)
    {
        return $this->successResponse(
            UserTransformer::index(
                $user
            )
        );
    }
}
