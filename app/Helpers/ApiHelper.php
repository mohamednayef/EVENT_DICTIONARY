<?php

namespace App\Helpers;

class ApiHelper
{
    public static function getResponse($status=200, $message=null, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}