<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Warehouse\MediaType\ResponseManipulator;

class AfterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $responseManipulator = new ResponseManipulator($request, $response);

        return $responseManipulator->manipulate();
    }
}
