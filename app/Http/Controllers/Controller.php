<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $errors = false;
    /**
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    protected function jsonResponse(array $data, int $status): JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * @param string $message
     * @param array|null $resource
     * @return JsonResponse|null
     */
    protected function successResponse(string $message, $resource = null, int $status = 200): ?JsonResponse
    {
        $response = [
            'mensagem' => $message,
            'erros' => $this->errors,
            'data' => ''
        ];

        if(is_array($resource) && array_key_exists('data', $resource)) {
            $response['data'] = $resource['data'];
        } else {
            $response['data'] = $resource;
        }

        return $this->jsonResponse($response, $status);
    }

    /**
     * @param string $message
     * @param string|null $code
     * @param array|null $data
     * @return JsonResponse|null
     */
    protected function errorResponse(string $message, $data = null, string $code = null, $status = 400): ?JsonResponse
    {
        $response = [
            'mensagem' => $message,
            'erros' => true,
            'descrição' => $data,
        ];

        if ($code) {
            $response['code'] = $code;
            return $this->jsonResponse($response, $code);
        }

        return $this->jsonResponse($response, $status);
    }

}
