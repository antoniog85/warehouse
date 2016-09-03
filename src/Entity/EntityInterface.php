<?php

namespace Warehouse\Entity;

interface EntityInterface
{
    public function getId();

    /**
     * Return the links that refer to the resource
     *
     * @return Link[]
     */
    public function getLinks();

    /**
     * Return the name of the resource, used in the url, without any slash
     *
     * @return string
     */
    public function getUrlPath(): string;

    public function toArray(): array;
}