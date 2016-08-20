<?php

namespace Warehouse\Repository;

interface RepositoryInterface
{
    public function get(int $number): array;
}