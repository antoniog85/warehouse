<?php

namespace Warehouse\Entity;

interface EntityInterface
{
    public function getId();

    public function getLinks(): Links;

    public function toArray(): array;
}