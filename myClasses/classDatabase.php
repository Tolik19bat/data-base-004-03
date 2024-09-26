<?php

namespace myClasses;

use myInterface\DatabaseWrapper;

class Database implements DatabaseWrapper
{
    protected $pdo;
    protected $table;

    public function __construct(PDO $pdo, string $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    // Вставляет новую запись в таблицу
    public function insert(array $tableColumns, array $values): array
    {
        $columns = implode(', ', $tableColumns);
        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);

        $lastInsertId = $this->pdo->lastInsertId();
        return $this->find($lastInsertId);
    }

    // Обновляет запись по ID
    public function update(int $id, array $values): array
    {
        $setClause = implode(', ', array_map(fn($key) => "$key = ?", array_keys($values)));

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($values + ['id' => $id]));

        return $this->find($id);
    }

    // Находит запись по ID
    public function find(int $id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Удаляет запись по ID
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
