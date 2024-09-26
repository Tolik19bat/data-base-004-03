<?php

declare(strict_types=1);

namespace myClasses;

use myClasses\Database;

class Product extends Database
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'product');
    }
}
