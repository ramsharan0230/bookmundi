<?php
namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ResponseHelper {
    static function responseHandling($data=null, $message, $status_code): JsonResponse
    {
        return response()->json(['payload'=> $data, 'message'=>$message, 'status_code'=>$status_code]);
    }
}