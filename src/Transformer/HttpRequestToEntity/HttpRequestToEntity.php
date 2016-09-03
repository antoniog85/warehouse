<?php

namespace Warehouse\Transformer\HttpRequestToEntity;

use Illuminate\Http\Request;
use Warehouse\Entity\EntityInterface;
use Warehouse\Transformer\Exception\TransformerNotFoundException;

class HttpRequestToEntity implements HttpRequestTransformerInterface
{
    /**
     * @var HttpRequestTransformerInterface
     */
    private $strategy;

    public function __construct($request, $model)
    {
        if ($request instanceof Request) {
            $this->strategy = new IlluminateRequestTransformer($request, $model);
        } else {
            throw new TransformerNotFoundException(
                sprintf("Http Transformer not found for the request of type \"%s\"", get_class($request))
            );
        }
    }

    public function transform(): EntityInterface
    {
        return $this->strategy->transform();
    }
}