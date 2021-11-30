<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait ApiResponse.
 */
trait ApiResponse
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function success($result, $message = '', $additional = []): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        if (count($additional)) {
            $response = array_merge($response, $additional);
        }

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * success response with pagination method.
     *
     * @return \Illuminate\Http\Response
     */
    public function successWithPagination(ResourceCollection $pagination, $message = '', $additional = [])
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (count($additional)) {
            $response = array_merge($response, $additional);
        }

        return $pagination->additional($response);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function error($error, $errorMessages = [], $code = Response::HTTP_BAD_REQUEST)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'code' => (int)$code
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
