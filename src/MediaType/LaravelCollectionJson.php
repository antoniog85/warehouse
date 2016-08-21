<?php

namespace Warehouse\MediaType;

use Illuminate\Http\Response;

class LaravelCollectionJson extends CollectionJson
{
    /**
     * @param Response $response
     */
    public function setError(Response $response)
    {
        if ($response->getStatusCode() > 299) {
            $this->error = [
                'data' => $response->getContent(),
                'code' =>  $response->getStatusCode(),
            ];
        }
    }

}