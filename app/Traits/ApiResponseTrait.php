<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected $error_message = ['error' => true];

    /**
     * Return json data with status code 200 
     * It is returning object without appending data as key
     */
    protected function success($data, $code = 200)
    {
        return response()->json($data, $code);
    }

    /**
     * Return json data with status code 200 
     * This is to follow API standard code. Appending data as a key 
     */
    protected function customResponse($data, $code = 200)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * This is for returning not valid or error data
     * Return json data with status code 400 
     */
    protected function error($error, $code = 400)
    {
        return response()->json(['errors' => $error], $code);
    }

    
}
