<?php

namespace App\Services;

class ResponseService
{
    public function created($data, $message = null, $code = 201)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error($message, $code = 400)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}
