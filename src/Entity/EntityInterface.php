<?php

namespace Warehouse\Entity;

interface EntityInterface
{
    public function getId();

    public function toArray(): array;
}