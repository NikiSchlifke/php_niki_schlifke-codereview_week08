<?php
require_once 'initdb.php';
require_once 'vendor/autoload.php';

$faker = \Faker\Factory::create();

for ($i = 1 ; $i <= 12; $i++) {
    $addProductSQL->execute([
        'name' => implode(' ', $faker->words(2)),
        'price' => $faker->randomFloat(2, 10, 1000),
        'description' => $faker->realText(),
        'uuid' => $faker->uuid
    ]);
    $productId = $dbh->lastInsertId();
    $addProductImageSQL->execute([
        'fileName' => $faker->imageUrl(),
        'altText' => $faker->realText('30'),
        'productId' => $productId
    ]);
}

