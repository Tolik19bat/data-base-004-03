<?php

declare(strict_types=1);

spl_autoload_register(function ($class) {
    // Преобразуем пространство имен в путь к файлу
    $classPath = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($classPath)) {
        require_once $classPath;
    } else {
        echo "Класс или интерфейс $class не найден по пути $classPath";
    }
});