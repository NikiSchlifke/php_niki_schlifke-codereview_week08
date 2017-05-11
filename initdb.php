<?php
require_once 'config.php';


$dbh = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USERNAME, DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/**
 * @param PDOStatement $getQuery
 * @param PDOStatement $addQuery
 * @param array $getParams
 * @param array $addParams
 */
function getFirstOrAddRecord(PDOStatement $getQuery, PDOStatement $addQuery, $getParams, $addParams=null) {
    try {
        return getFirstRecord($getQuery, $getParams);
    } catch (OutOfBoundsException $exception) {
        if (is_null($addParams)) {
            $addParams = $getParams;
        }
        return addRecord($addQuery, $addParams);
    }
}

function getFirstRecord(PDOStatement $getQuery, $getParams) {
    global $dbh;
    if (!$getQuery->execute($getParams)) {
        throw new UnexpectedValueException('Get id failed: '.json_encode($dbh->errorInfo()));
    }

    $getResult = $getQuery->fetch();
    if (!isset($getResult['id'])) {
        throw new OutOfBoundsException('Id not found.');
    }
    return $getResult['id'];
}

function addRecord(PDOStatement $addQuery, $addParams) {
    global $dbh;
    if (!$addQuery->execute($addParams)){
        throw new UnexpectedValueException('Add record failed: '.json_encode($dbh->errorInfo()));
    }
    return $dbh->lastInsertId();
}

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
INSERT INTO cart (customer_id) VALUES (:customerId)
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

$addAddressSQL = $dbh->prepare(<<<'SQL'
INSERT INTO address (street, region_id) VALUES (:street, :regionId)
;
SQL
);


$addUserSQL = $dbh->prepare(<<<'SQL'
INSERT INTO user (email, password, customer_id) VALUES (:eMail, :password, :customerId)
;
SQL
);

$addCustomerSQL = $dbh->prepare(<<<'SQL'
INSERT INTO customer (address_id, first_name, last_name) VALUES (:addressId, :firstName, :lastName)
;
SQL
);

/**
 * SQL Getters, return Id
 */


$getRegionSQL = $dbh->prepare(<<<'SQL'
SELECT id FROM region WHERE nation = :nation AND country = :country AND city = :city AND zip = :zip
;
SQL
);

$getAddressSQL = $dbh->prepare(<<<'SQL'
SELECT id FROM address WHERE street = :street AND region_id = :regionId
;
SQL
);


$getUserSQL = $dbh->prepare(<<<'SQL'
SELECT id FROM user WHERE email = :eMail
;
SQL
);

$getCustomerSQL = $dbh->prepare(<<<'SQL'
SELECT id FROM customer WHERE address_id = :addressId AND first_name = :firstName AND last_name = :lastName
;
SQL
);

