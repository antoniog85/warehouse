<?php

namespace App\Http\Middleware;

use Warehouse\MediaType\CollectionJson\LaravelResponseManipulator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AfterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $responseManipulator = new LaravelResponseManipulator($request, $response);

        return $responseManipulator->manipulate();
    }
}
