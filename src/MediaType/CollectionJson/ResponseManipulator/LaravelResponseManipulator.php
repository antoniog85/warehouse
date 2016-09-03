<?php

namespace Warehouse\MediaType\CollectionJson\ResponseManipulator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Warehouse\MediaType\CollectionJson\CollectionJson;
use Warehouse\MediaType\ResponseManipulable;

class LaravelResponseManipulator implements ResponseManipulable
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var CollectionJson
     */
    private $collectionJson;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $collectionJsonArray = json_decode($this->response->getContent(), true);
        $this->collectionJson = new CollectionJson($collectionJsonArray);
    }

    /**
     * Get the Request and Response objects from the framework, and return the
     * modified Response object to match the mediatype
     *
     * @return mixed
     */
    public function manipulate()
    {
        $this->buildHeader();

        $this->buildContent();

        return $this->response;
    }

    private function buildHeader()
    {
        $this->response->headers->add([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Content-Type' => 'application/vnd.collection+json',
            'X-total-count' => $this->collectionJson->getTotalItems(),
        ]);
    }

    private function buildContent()
    {
        $this->collectionJson
            ->setVersion(getenv('API_VERSION'))
            ->setHref($this->request->getUri())
            ->setError($this->getError());

        $this->response->setContent($this->collectionJson->render());
    }

    /**
     * @return array|string
     */
    private function getError()
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
}