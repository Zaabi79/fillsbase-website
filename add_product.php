<?php
/**
 * Custom add-to-cart for "other" type products (e.g. X-Dairy).
 * Usage: add_product.php?pid=317&billingcycle=monthly
 */
require_once('init.php');

use WHMCS\Database\Capsule;

$pid          = (int)($_GET['pid'] ?? 0);
$billingcycle = $_GET['billingcycle'] ?? 'monthly';

$allowed = ['monthly','quarterly','semiannually','annually','biennially','triennially'];
if (!in_array($billingcycle, $allowed)) $billingcycle = 'monthly';

if ($pid > 0) {
    $product = Capsule::table('tblproducts')->where('id', $pid)->where('hidden', 0)->first();
    if ($product) {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        if (!isset($_SESSION['cart']['products'])) $_SESSION['cart']['products'] = [];

        // Check if already in cart — if same pid exists, replace
        $found = false;
        foreach ($_SESSION['cart']['products'] as &$item) {
            if (isset($item['pid']) && (int)$item['pid'] === $pid) {
                $item['billingcycle'] = $billingcycle;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $_SESSION['cart']['products'][] = [
                'pid'          => $pid,
                'billingcycle' => $billingcycle,
                'configoptions' => [],
                'customfields'  => [],
                'addons'        => [],
            ];
        }
    }
}

header('Location: /panier.php');
exit;
