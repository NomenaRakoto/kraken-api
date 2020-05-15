<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class APIController extends Controller
{
    /**
     * success response method.
     * @method sendResponse
     * @param  array        $result  [description]
     * @param  string       $message [description]
     * @return \Illuminate\Http\Response                [description]
     */
    public function sendResponse($result, $message = null)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'status' => 200
        ];


        return response()->json($response, 200);
    }

    /**
     * return error response.
     * @method sendError
     * @param  string    $error         [description]
     * @param  array     $errorMessages [description]
     * @param  integer   $code          [description]
     * @return @return \Illuminate\Http\Response                  
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
            'status' => $code
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}