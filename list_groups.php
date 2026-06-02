<?php
require_once('init.php');
use WHMCS\Database\Capsule;

$groups = Capsule::table('tblproductgroups')
    ->select('id', 'name')
    ->get();

header('Content-Type: application/json');
echo json_encode($groups, JSON_PRETTY_PRINT);
