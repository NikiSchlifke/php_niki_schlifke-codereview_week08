<?php
require_once 'initdb.php';


header('Content-type: application/json');

$allProductsSQL->execute();
$products = $allProductsSQL->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);

