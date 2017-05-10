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

$addBillSQL = $dbh->prepare(<<<'SQL'
INSERT INTO bill (credit_card_number, payment_status, cart_id) VALUES (:creditCardNumber, 'unverified', :cartId)
;
SQL
);


$addCartSQL = $dbh->prepare(<<<'SQL'
INSERT INTO cart (customer_id, bill_id) VALUES (:customerId, :billId)
;
SQL
);

$addCartCompositionSQL = $dbh->prepare(<<<'SQL'
INSERT INTO cart_composition (product_id, product_count, cart_id) VALUES (:productId, :productCount, :cartId)
;
SQL
);

$addRegionSQL = $dbh->prepare(<<<'SQL'
INSERT INTO region (nation, country, city, zip) VALUES (:nation, :country, :city, :zip)
;
SQL
);


$addCustomerSQL = $dbh->prepare(<<<'SQL'
INSERT INTO customer (address_id, first_name, last_name) VALUES (:addressId, :firstName, :lastName)
;
SQL
);
