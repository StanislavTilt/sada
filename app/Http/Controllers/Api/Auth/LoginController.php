<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\User\ProfileResource;

/**
 * Class LoginController
 * @package App\Http\Controllers\API\Auth
 */
class LoginController extends BaseApiController
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse|ProfileResource
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->getErrorResponse(__('auth.failed'), 401);
        }

        $user = Auth::user();

        if(isset($request->device_key))
        {
            $user->update(['device_key' => $request->device_key]);
        }

        return (new ProfileResource($user))->additional([
            'token' => $user->createToken($request->email)->plainTextToken
        ]);
    }
    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->user->currentAccessToken()->delete();

        return $this->getSuccessResponse(204);
    }

    /**
     * @return JsonResponse
     */
    public function refreshToken(): JsonResponse
    {
        $user = $this->user;

        $currentToken = $user->currentAccessToken();
        $newToken = $user->createToken($currentToken->name)->plainTextToken;
        $currentToken->delete();

        return $this->getResponse([
            'token' => $newToken
        ]);
    }
}
