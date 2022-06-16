<?php


namespace App\Response;


class ApiResponse
{
    static function render($message = "",$data = [],$successful = true,$status = 200): \Illuminate\Http\JsonResponse
    {
        $response = [
            "successful" => $successful,
            "message" => $message,
        ];
        return response()->json(array_merge($response,$data),$status);
    }
}
