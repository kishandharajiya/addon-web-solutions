<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Generates a JSON response with the given data and status code.
     *
     * @param array $result The result data to be included in the response.
     * @param string $message The message to be included in the response.
     * @param int $status The status code of the response. Default is 200.
     */
    public function toJson($result= [],$message="",$status = 200){
        return response()->json(['result' => $result,'message' => $message],$status);
    }
}
