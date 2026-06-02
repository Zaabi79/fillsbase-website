<?php
/**
 * Fillsbase Cart Summary AJAX API
 */
require_once('init.php');

header('Content-Type: application/json');

use WHMCS\Database\Capsule;

$items         = [];
$cartItemsCount = 0;
$subtotal      = 0;
$discount      = 0;

$currency = getCurrency();
$prefix   = trim($currency['prefix'] ?? '');
$suffix   = trim($currency['suffix'] ?? '');

// Format a raw number with French-style space thousands separator
function fmtPrice($amount, $prefix, $suffix) {
    $formatted = number_format((float)$amount, 0, ',', ' ');
    $parts = [];
    if ($prefix) $parts[] = $prefix;
    $parts[] = $formatted;
    if ($suffix) $parts[] = $suffix;
    return implode(' ', $parts);
}

// Fetch domain price from DB
function domainPrice($tld, $currencyId) {
    try {
        $row = Capsule::table('tbldomainpricing')
            ->join('tblpricing', 'tbldomainpricing.id', '=', 'tblpricing.relid')
            ->where('tbldomainpricing.extension', $tld)
            ->where('tblpricing.type', 'domainregister')
            ->where('tblpricing.currency', $currencyId)
            ->select('tblpricing.msetupfee as price')
            ->first();
        return $row ? (float)$row->price : 0;
    } catch (\Exception $e) {
        return 0;
    }
}

$cartData = $_SESSION['cart'] ?? [];

// ── Products ──────────────────────────────────────────────────────────────────
if (!empty($cartData['products'])) {
    foreach ($cartData['products'] as $i => $p) {
        $product = Capsule::table('tblproducts')->where('id', $p['pid'])->first();
        if (!$product) continue;

        // Try to look up the real recurring price for this billing cycle
        $billingcycle = $p['billingcycle'] ?? 'monthly';
        $price = (float)($p['price'] ?? 0);

        if ($price == 0) {
            $cycleMap = [
                'monthly' => 'monthly', 'quarterly' => 'quarterly',
                'semiannually' => 'semiannually', 'annually' => 'annually',
                'biennially' => 'biennially', 'triennially' => 'triennially',
            ];
            $col = $cycleMap[$billingcycle] ?? 'monthly';
            try {
                $pricing = Capsule::table('tblpricing')
                    ->where('type', 'product')
                    ->where('currency', $currency['id'])
                    ->where('relid', $p['pid'])
                    ->first();
                if ($pricing && isset($pricing->$col)) $price = (float)$pricing->$col;
            } catch (\Exception $e) {}
        }

        $cycleLabels = [
            'monthly' => '/mo', 'quarterly' => '/3 mo',
            'semiannually' => '/6 mo', 'annually' => '/yr',
            'biennially' => '/2 yr', 'triennially' => '/3 yr',
        ];

        $items[] = [
            'type'    => 'product',
            'id'      => $i,
            'name'    => $product->name,
            'price'   => fmtPrice($price, $prefix, $suffix),
            'period'  => $cycleLabels[$billingcycle] ?? '/mois',
            'raw'     => $price,
        ];
        $subtotal += $price;
        $cartItemsCount++;
    }
}

// ── Domains ───────────────────────────────────────────────────────────────────
if (!empty($cartData['domains'])) {
    foreach ($cartData['domains'] as $i => $d) {
        $domainName = strtolower(trim($d['domain']));
        $parts = explode('.', $domainName);
        $tld   = '.' . implode('.', array_slice($parts, 1));

        $price = domainPrice($tld, $currency['id']);

        $addons = [];
        if (!empty($d['dnsmanagement']))  $addons[] = 'DNS';
        if (!empty($d['emailforwarding'])) $addons[] = 'Email';
        if (!empty($d['idprotection']))   $addons[] = 'Protection ID';

        $items[] = [
            'type'    => 'domain',
            'id'      => $i,
            'name'    => $domainName,
            'price'   => fmtPrice($price, $prefix, $suffix),
            'period'  => ($d['regperiod'] ?? 1) . ' an',
            'addons'  => $addons,
            'raw'     => $price,
        ];
        $subtotal += $price;
        $cartItemsCount++;
    }
}

// ── Pending domain (from WHMCS domainregister upsell flow) ───────────────────
if (!empty($_SESSION['cartdomain']['sld']) && !empty($_SESSION['cartdomain']['tld'])) {
    $pSld    = $_SESSION['cartdomain']['sld'];
    $pTld    = $_SESSION['cartdomain']['tld'];
    $pDomain = strtolower($pSld . $pTld);
    $exists  = false;
    foreach ($items as $it) {
        if (isset($it['name']) && strtolower($it['name']) === $pDomain) { $exists = true; break; }
    }
    if (!$exists) {
        $price = domainPrice($pTld, $currency['id']);
        $items[] = [
            'type'    => 'domain',
            'id'      => 'pending',
            'name'    => $pDomain,
            'price'   => fmtPrice($price, $prefix, $suffix),
            'period'  => '1 an',
            'pending' => true,
            'raw'     => $price,
        ];
        $subtotal += $price;
        $cartItemsCount++;
    }
}

// ── Promo / Discount ──────────────────────────────────────────────────────────
$promoCode = $cartData['promo'] ?? '';
$promoLabel = '';
$promoType  = '';
$promoValue = 0;
if ($promoCode) {
    try {
        $promo = Capsule::table('tblpromotions')->where('code', $promoCode)->first();
        if ($promo) {
            $promoLabel = $promo->notes ?: $promoCode;
            $promoType  = $promo->type ?? '';
            $promoValue = (float)($promo->value ?? 0);
            if ($promoType === 'Percentage') {
                $discount = round($subtotal * $promoValue / 100);
            } elseif ($promoType === 'Fixed Amount') {
                $discount = min($promoValue, $subtotal);
            }
        }
    } catch (\Exception $e) {}
}

$total = max(0, $subtotal - $discount);

echo json_encode([
    'status'   => 'success',
    'count'    => $cartItemsCount,
    'items'    => $items,
    'subtotal' => fmtPrice($subtotal, $prefix, $suffix),
    'discount' => $discount > 0 ? fmtPrice($discount, $prefix, $suffix) : null,
    'total'    => fmtPrice($total, $prefix, $suffix),
    'currency' => ['prefix' => $prefix, 'suffix' => $suffix],
    'promo'    => ['code' => $promoCode, 'label' => $promoLabel],
    'checkout_url' => '/cart.php?a=checkout&e=false',
]);
