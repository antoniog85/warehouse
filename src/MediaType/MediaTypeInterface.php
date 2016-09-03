<?php

namespace Warehouse\MediaType;

interface MediaTypeInterface
{
    public function toArray(): array;

    /**
     * This method return the data how they should be represented to the browser
     *
     * @return array
     */
    public function render(): array;
}