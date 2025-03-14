<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * Response.
     */
    public function response($data, int $status): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => null
        ], $status);
    }
}
