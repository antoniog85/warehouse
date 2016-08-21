<?php

namespace Warehouse\MediaType;

/**
 * Interface for the classes responsible for manipulating the http response, before sending it to the browser
 */
interface ResponseManipulatorInterface
{
    public function manipulate();
}