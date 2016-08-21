<?php

namespace Warehouse\Entity;

interface EntityInterface
{
    public function getId(): int;

    public function toArray(): array;

    public function getLinks(): array;
}