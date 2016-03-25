<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class AfterMiddleware
{
    public function handle($request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);
        $response->headers->add([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Content-Type' => 'application/vnd.collection+json',
        ]);
        $originalContent = $response->getContent();
        $response->setContent(['data' => json_decode($originalContent, true)]);
        return $response;
    }
}
