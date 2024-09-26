<?php

declare(strict_types=1);

namespace myInterface;

interface DatabaseWrapper
{
    public function insert(array $tableColumns, array $values): array;
    public function update(int $id, array $values): array;
    public function find(int $id): array;
    public function delete(int $id): bool;
}
