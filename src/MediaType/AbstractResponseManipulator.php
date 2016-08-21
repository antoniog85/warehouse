<?php

namespace Warehouse\MediaType;

abstract class AbstractResponseManipulator implements ResponseManipulatorInterface
{
    protected $request;

    protected $response;

    protected $collectionEntities;

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

    /**
     * @return void
     */
    abstract protected function buildHeader();

    /**
     * @return void
     */
    abstract protected function buildContent();

    /**
     * @return mixed
     */
    abstract protected function getError();
}