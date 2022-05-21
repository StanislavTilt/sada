<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Trait BaseRestTrait
 * @package App\Traits
 */
trait BaseRestTrait
{
    /**
     * Get the JSON response.
     *
     * @param array $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public function getResponse(array $data, int $httpCode = 200): JsonResponse
    {
        return Response::json($data, $httpCode);
    }

    /**
     * @param string $message
     * @param int $httpCode
     * @param array $errors
     * @return JsonResponse
     */
    public function getErrorResponse(string $message, int $httpCode = 400, array $errors = []): JsonResponse
    {
        return $this->getResponse($this->generateResponseBody($message, $errors), $httpCode);
    }

    /**
     * @param int $httpStatus
     * @return JsonResponse
     */
    public function getSuccessResponse(int $httpStatus = 200): JsonResponse
    {
        return $this->getResponse(['message' => 'success'], $httpStatus);
    }

    /**
     * @param string $message
     * @param $errors
     * @return array
     */
    public function generateResponseBody(string $message, $errors): array
    {
        if (empty($errors)) {
            $errors = ['error' => [$message]];
        }
        return [
            "message" => $message,
            "errors" => $errors
        ];
    }
}
