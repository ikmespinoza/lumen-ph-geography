<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Traits\ConverterTrait;

class Controller extends BaseController
{
    use ConverterTrait;

    /**
     * Returns a json formatted successful response
     *
     * @return json
     */
    public function successResponse($response, $code = 200 ) {
        return response()->json([
        	'success'	    => true,
            'response'      => $response,
            'code'		    => $code,
            'memory_usage'  => $this->convertBytes( memory_get_peak_usage(true) )
        ]);
    }

    /**
     * Returns a json formatted error response
     *
     * @return json
     */
    public function errorResponse($response, $code = '') {
        return response()->json([
        	'success'	    => false,
            'response'      => $response,
        	'code'		    => $code,
            'memory_usage'  => $this->convertBytes( memory_get_peak_usage(true) )
        ]);
    }
}
