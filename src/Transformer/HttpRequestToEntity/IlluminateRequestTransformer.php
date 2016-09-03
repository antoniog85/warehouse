<?php

namespace Warehouse\Transformer\HttpRequestToEntity;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Warehouse\Entity\EntityInterface;
use Warehouse\Transformer\Exception\TransformerNotFoundException;

class IlluminateRequestTransformer implements HttpRequestTransformerInterface
{
    /**
     * @var HttpRequestTransformerInterface
     */
    private $strategy;

    public function __construct(Request $request, $model)
    {
        if ($model instanceof Warehouse) {
            $this->strategy = new WarehouseFromIlluminateToEntityTransformer($request);
        } else {
            throw new TransformerNotFoundException(
                sprintf("Http Transformer not found for the model of type \"%s\"", get_class($model))
            );
        }
    }

    public function transform(): EntityInterface
    {
        return $this->strategy->transform();
    }
}