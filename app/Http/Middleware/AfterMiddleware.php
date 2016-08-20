<?php

namespace App\Http\Middleware;

use Antoniog85\MediaType\CollectionJson;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AfterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);
        $response->headers->add([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Content-Type' => 'application/vnd.collection+json',
        ]);
        $collectionJson = new CollectionJson();
        $collectionJson->setVersion(getenv('API_VERSION'));
        $collectionJson->setHref($request->getUri());
        $collectionJson->setError($response);
//        $this->paginateFromLaravelToCollectionJson($collectionJson, $request, $response);
        $collectionJson->setItems($response);
        $response->setContent($collectionJson->render());
        return $response;
    }

    private function paginateFromLaravelToCollectionJson($collectionJson, $request, Response $response)
    {
        $items = json_decode($response->getContent(), true);
        $collectionJson->addLink($items['next_page_url'], 'next');
        $collectionJson->addLink($items['prev_page_url'], 'prev');
        $collectionJson->addLink($request->url(), 'first');
        $collectionJson->addLink($request->url() . "?page={$items['last_page']}", 'last');
        $response->setContent($items['data']);
    }
}
