<?php

namespace App\Traits;

use Throwable;
use Illuminate\Http\Response;

trait RestResponse
{
	public function success ($data, $code = Response::HTTP_OK) {
		return response()->json(['result' => $data], $code);
	}

	public function error ($path, Throwable $exception, $message, $code) {
        return response()->json([
            'timestamps' => date('Y-m-d H:i:s'),
            'path' => $path,
            'exception' =>  basename(str_replace('\\', '/', get_class($exception))),
            'detail' => $message,
            'code' => $code
        ], $code);
	}
}
