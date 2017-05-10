<?php
require_once 'config.php';


$dbh = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USERNAME, DB_PASSWORD);

$allProductsSQL = $dbh->prepare(<<<'SQL'
SELECT * FROM product
JOIN product_image ON product.id = product_image.product_id;
SQL
);

$addProductSQL = $dbh->prepare(<<<'SQL'
INSERT INTO product (name, price, description, uuid) VALUES (:name, :price, :description, :uuid);
SQL
);

$addProductImageSQL = $dbh->prepare(<<<'SQL'
INSERT INTO product_image (file_name, alt_text, product_id) VALUES (:fileName, :altText, :productId);
SQL
);

$selectProductSQL = $dbh->prepare(<<<'SQL'
SELECT id FROM product WHERE uuid = :uuid;
SQL
);

