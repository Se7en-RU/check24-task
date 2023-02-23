<?php

namespace App\Infrastructure\Database;

use stdClass;

interface DatabaseInterface
{
    public function query(string $query, array $params = [], $class = stdClass::class): array;
}