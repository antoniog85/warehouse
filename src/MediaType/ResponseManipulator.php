<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 03/09/16
 * Time: 10:20
 */

namespace Warehouse\MediaType;


use Illuminate\Http\Response;
use Warehouse\MediaType\CollectionJson\ResponseManipulator\LaravelResponseManipulator;

class ResponseManipulator implements ResponseManipulable
{
    /**
     * @var ResponseManipulable
     */
    private $strategy;

    public function __construct($request, $response)
    {
        if ($response instanceof Response) {
            $this->strategy = new LaravelResponseManipulator($request, $response);
        } else {
            throw new ResponseManipulatorNotFound();
        }
    }

    public function manipulate()
    {
        return $this->strategy->manipulate();
    }
}