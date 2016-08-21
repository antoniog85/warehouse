<?php

namespace App\Http\Middleware;

use Warehouse\Entity\CollectionEntities;
use Warehouse\MediaType\LaravelCollectionJson;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AfterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        /** @var CollectionEntities $collectionEntities */
        $collectionEntities = json_decode($response->getContent(), true);

        $response->headers->add([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Content-Type' => 'application/vnd.collection+json',
            'X-total-count' => $collectionEntities['total_items']
        ]);
        
        $collectionJson = new LaravelCollectionJson();
        $collectionJson
            ->setVersion(getenv('API_VERSION'))
            ->setHref($request->getUri())
            ->setError($response)
            ->setItems($collectionEntities['items'])
            ->setLinks($collectionEntities['links']);

        $response->setContent($collectionJson->render());
        return $response;
    }

//    private function paginateFromLaravelToCollectionJson($collectionJson, $request, Response $response)
//    {
//        $items = json_decode($response->getContent(), true);
//        $collectionJson->addLink($items['next_page_url'], 'next');
//        $collectionJson->addLink($items['prev_page_url'], 'prev');
//        $collectionJson->addLink($request->url(), 'first');
//        $collectionJson->addLink($request->url() . "?page={$items['last_page']}", 'last');
//        $response->setContent($items['data']);
//    }
}
