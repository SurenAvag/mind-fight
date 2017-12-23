<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function errorResponse(string $errorMessage = 'Not Found', int $status = 404) : JsonResponse
    {
        return response()->json($errorMessage, $status);
    }

    public function successResponse(array $res, int $status = 200) : JsonResponse
    {
        return response()->json($res, $status);
    }
}
