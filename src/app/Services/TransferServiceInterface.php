<?php

namespace App\Services;

interface TransferServiceInterface
{
    public function make(array $params): array;
}
