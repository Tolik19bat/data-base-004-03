<?php

declare(strict_types=1);

require_once 'autoload.php';

try {
    // Устанавливаем соединение с базой данных SQLite
    $pdo = new PDO('sqlite:myDataBase.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Работаем с таблицей "shop"
    $shop = new Shop($pdo);

    // Вставка новой записи в таблицу "shop"
    $newShop = $shop->insert(['name', 'address'], ['Магазин 1', 'Улица 123']);
    print_r($newShop);

    // Обновление записи в таблице "shop"
    $updatedShop = $shop->update($newShop['id'], ['name' => 'Новый Магазин']);
    print_r($updatedShop);

    // Поиск записи по ID
    $foundShop = $shop->find($newShop['id']);
    print_r($foundShop);

    // Удаление записи
    $shop->delete($newShop['id']);
    echo "Запись удалена\n";

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
