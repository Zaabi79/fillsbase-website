<?php
require_once('init.php');
use WHMCS\Database\Capsule;

$products = Capsule::table('tblproducts')
    ->select('id', 'name', 'gid')
    ->get();

header('Content-Type: application/json');
echo json_encode($products, JSON_PRETTY_PRINT);
