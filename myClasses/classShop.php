<?php

declare(strict_types=1);

namespace myClasses;

class Shop extends Database
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'shop');
    }
}