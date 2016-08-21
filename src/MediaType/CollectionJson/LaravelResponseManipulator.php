<?php

namespace Warehouse\MediaType\CollectionJson;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Warehouse\MediaType\AbstractResponseManipulator;

class LaravelResponseManipulator extends AbstractResponseManipulator
{
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->collectionEntities = json_decode($this->response->getContent(), true);
    }

    protected function buildHeader()
    {
        $this->response->headers->add([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Content-Type' => 'application/vnd.collection+json',
            'X-total-count' => $this->collectionEntities['total_items']
        ]);
    }

    protected function buildContent()
    {
        $collectionJson = new CollectionJson();
        $collectionJson
            ->setVersion(getenv('API_VERSION'))
            ->setHref($this->request->getUri())
            ->setError($this->getError());

        // if there has not been an error during the request
        if (!empty($this->collectionEntities)) {
            // build the list of items
            foreach ($this->collectionEntities['items'] as $item) {
                $collectionJsonItem = new CollectionJsonItem();
                $collectionJsonItem
                    ->setData($item)
                    ->setLinks([])
                    ->setHref($this->request->getSchemeAndHttpHost() . $this->request->getPathInfo() . '/' . $item['id']);
                $collectionJson->addItem($collectionJsonItem);
            }

            $collectionJson->setLinks($this->collectionEntities['links']);
        }

        $this->response->setContent($collectionJson->render());
    }

    /**
     * @return array|string
     */
    protected function getError()
    {
        $error = '';

        if ($this->response->getStatusCode() > 299) {
            $error = [
                'data' => $this->response->getContent(),
                'code' =>  $this->response->getStatusCode(),
            ];
        }

        return $error;
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