<?php
/**
 * Direct domain-add endpoint for panier.php
 * Adds a domain registration directly to $_SESSION['cart']['domains']
 * bypassing the WHMCS hosting upsell redirect.
 */
require_once __DIR__ . '/init.php';

header('Content-Type: application/json');

use WHMCS\Database\Capsule;

$action = $_POST['action'] ?? '';

// ── ADD DOMAIN ───────────────────────────────────────────────────────────────
if ($action === 'add') {
    $domain = strtolower(trim($_POST['domain'] ?? ''));
    $domain = preg_replace('/[^a-z0-9.\-]/', '', $domain);

    if (!$domain || strpos($domain, '.') === false) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid domain']);
        exit;
    }

    $parts     = explode('.', $domain, 2);
    $sld       = $parts[0];
    $tld       = '.' . $parts[1];
    $regperiod = max(1, (int)($_POST['regperiod'] ?? 1));

    // Look up price
    $currency  = getCurrency();
    $prefix    = $currency['prefix'] ?? '';
    $suffix    = $currency['suffix'] ?? '';

    $price = 0;
    try {
        $row = Capsule::table('tbldomainpricing')
            ->join('tblpricing', 'tbldomainpricing.id', '=', 'tblpricing.relid')
            ->where('tbldomainpricing.extension', $tld)
            ->where('tblpricing.type', 'domainregister')
            ->where('tblpricing.currency', $currency['id'])
            ->select('tblpricing.msetupfee as price')
            ->first();
        if ($row) $price = (float)$row->price;
    } catch (\Exception $e) {}

    // Init cart structure if needed
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = ['user' => [], 'products' => [], 'domains' => [], 'locations' => []];
    }
    if (!isset($_SESSION['cart']['domains'])) {
        $_SESSION['cart']['domains'] = [];
    }

    // Check not already in cart
    foreach ($_SESSION['cart']['domains'] as $d) {
        if (strtolower($d['domain']) === $domain) {
            echo json_encode(['status' => 'exists', 'message' => 'Already in cart']);
            exit;
        }
    }

    $_SESSION['cart']['domains'][] = [
        'type'          => 'register',
        'domain'        => $domain,
        'regperiod'     => $regperiod,
        'dnsmanagement' => 0,
        'emailforwarding' => 0,
        'idprotection'  => 0,
    ];
    // Also clear cartdomain temp
    unset($_SESSION['cartdomain']);

    $parts = array_filter([$prefix, number_format($price, 0, ',', ' '), $suffix]);
    $fmt = implode(' ', $parts);
    echo json_encode(['status' => 'success', 'domain' => $domain, 'price' => $fmt]);
    exit;
}

// ── REMOVE DOMAIN ────────────────────────────────────────────────────────────
if ($action === 'remove') {
    $domain = strtolower(trim($_POST['domain'] ?? ''));
    if (isset($_SESSION['cart']['domains'])) {
        foreach ($_SESSION['cart']['domains'] as $i => $d) {
            if (strtolower($d['domain']) === $domain) {
                array_splice($_SESSION['cart']['domains'], $i, 1);
                break;
            }
        }
    }
    echo json_encode(['status' => 'success']);
    exit;
}

// ── ADD PRODUCT ──────────────────────────────────────────────────────────────
if ($action === 'add_product') {
    $pid          = (int)($_POST['pid'] ?? 0);
    $billingcycle = $_POST['billingcycle'] ?? 'monthly';
    $allowed      = ['monthly','quarterly','semiannually','annually','biennially','triennially'];
    if (!$pid || !in_array($billingcycle, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid product']);
        exit;
    }

    $product = Capsule::table('tblproducts')->where('id', $pid)->where('hidden', 0)->first();
    if (!$product) {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
        exit;
    }

    // Look up real price
    $currency = getCurrency();
    $price = 0;
    try {
        $pr = Capsule::table('tblpricing')
            ->where('type', 'product')
            ->where('relid', $pid)
            ->where('currency', $currency['id'])
            ->first();
        if ($pr && isset($pr->$billingcycle) && $pr->$billingcycle > 0) {
            $price = (float)$pr->$billingcycle;
        }
    } catch (\Exception $e) {}

    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = ['user' => [], 'products' => [], 'domains' => [], 'locations' => []];
    }
    if (!isset($_SESSION['cart']['products'])) {
        $_SESSION['cart']['products'] = [];
    }

    // Check not already in cart
    foreach ($_SESSION['cart']['products'] as $p) {
        if ((int)($p['pid'] ?? 0) === $pid && ($p['billingcycle'] ?? '') === $billingcycle) {
            echo json_encode(['status' => 'exists', 'message' => 'Already in cart']);
            exit;
        }
    }

    $_SESSION['cart']['products'][] = [
        'pid'          => $pid,
        'billingcycle' => $billingcycle,
        'price'        => $price,
        'configoptions'=> [],
        'customfields' => [],
        'addons'       => [],
    ];

    $prefix = trim($currency['prefix'] ?? '');
    $suffix = trim($currency['suffix'] ?? '');
    $parts  = array_filter([$prefix, number_format($price, 0, ',', ' '), $suffix]);
    echo json_encode(['status' => 'success', 'name' => $product->name, 'price' => implode(' ', $parts)]);
    exit;
}

// ── REMOVE PRODUCT ───────────────────────────────────────────────────────────
if ($action === 'remove_product') {
    $id = (int)($_POST['id'] ?? -1);
    if (isset($_SESSION['cart']['products'][$id])) {
        array_splice($_SESSION['cart']['products'], $id, 1);
    }
    echo json_encode(['status' => 'success']);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Unknown action']);
