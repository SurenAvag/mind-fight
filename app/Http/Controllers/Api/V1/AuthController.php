<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\MeRequest;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function login(LoginRequest $request)
    {
        abort_unless(Auth::attempt($request->only(['email', 'password'])), 403, 'Wrong Email or Password');

        return $this->successResponse(
            UserTransformer::login(
                Auth::user()->updateToken()
            )
        );
    }

    public function logout(LogoutRequest $request)
    {
        Auth::user()->logout();

        return $this->successResponse([
            'user has been logged out'
        ]);
    }

    public function me(MeRequest $request)
    {
        return $this->successResponse(
            UserTransformer::login(
                Auth::user()
            )
        );
    }
}
