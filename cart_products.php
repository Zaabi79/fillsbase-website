<?php
/**
 * Product catalogue API for panier.php
 * Returns product groups and their products with prices
 */
require_once __DIR__ . '/init.php';
header('Content-Type: application/json');

use WHMCS\Database\Capsule;

$currency = getCurrency();
$currencyId = (int)($currency['id'] ?? 1);
$prefix  = trim($currency['prefix'] ?? '');
$suffix  = trim($currency['suffix'] ?? '');

function fmt($amount, $prefix, $suffix) {
    if ($amount <= 0) return null;
    return trim(implode(' ', array_filter([$prefix, number_format($amount, 0, ',', ' '), $suffix])));
}

// Groups to show in each tab
$tabs = [
    'hosting'  => [1, 2],       // Hébergement Web + VPS
    'services' => [70, 8, 65, 66],  // X Dairy + Dédié + Dev + SEO
];

$tab = $_GET['tab'] ?? 'hosting';
$gids = $tabs[$tab] ?? $tabs['hosting'];

$groups = Capsule::table('tblproductgroups')
    ->whereIn('id', $gids)
    ->orderByRaw('FIELD(id, ' . implode(',', $gids) . ')')
    ->get(['id', 'name', 'tagline', 'headline']);

$result = [];

foreach ($groups as $group) {
    $products = Capsule::table('tblproducts')
        ->where('gid', $group->id)
        ->where('hidden', 0)
        ->whereNotNull('name')
        ->where('name', '!=', '')
        ->select('id','name','description','paytype')
        ->get();

    // Fetch pricing for all products in this group in one query
    $pids = $products->pluck('id')->toArray();
    $pricingMap = [];
    if ($pids) {
        $rows = Capsule::table('tblpricing')
            ->whereIn('relid', $pids)
            ->where('type', 'product')
            ->where('currency', $currencyId)
            ->get(['relid','monthly','quarterly','semiannually','annually']);
        foreach ($rows as $r) {
            $pricingMap[$r->relid] = $r;
        }
    }

    $items = [];
    foreach ($products as $p) {
        $pr = $pricingMap[$p->id] ?? null;
        $monthly   = ($pr && $pr->monthly > 0)        ? $pr->monthly        : null;
        $annually  = ($pr && $pr->annually > 0)       ? $pr->annually       : null;
        $quarterly = ($pr && $pr->quarterly > 0)      ? $pr->quarterly      : null;
        $semi      = ($pr && $pr->semiannually > 0)   ? $pr->semiannually   : null;

        $displayPrice = $monthly ?? $annually ?? $quarterly ?? $semi;
        $displayCycle = $monthly ? 'monthly' : ($annually ? 'annually' : ($quarterly ? 'quarterly' : 'semiannually'));

        $cycleLabel = ['monthly'=>'/mo','quarterly'=>'/3 mo','semiannually'=>'/6 mo','annually'=>'/yr'];

        // Parse features from description (newline separated)
        $features = [];
        if ($p->description) {
            foreach (preg_split('/\r?\n/', trim($p->description)) as $line) {
                $line = trim($line);
                if ($line) $features[] = $line;
            }
        }

        $items[] = [
            'id'          => $p->id,
            'name'        => $p->name,
            'features'    => array_slice($features, 0, 5),
            'price'       => $displayPrice ? fmt($displayPrice, $prefix, $suffix) : null,
            'price_raw'   => $displayPrice,
            'cycle'       => $displayCycle,
            'cycle_label' => $displayPrice ? ($cycleLabel[$displayCycle] ?? '') : null,
            'cycles'      => array_filter([
                'monthly'      => $monthly    ? ['price' => fmt($monthly, $prefix, $suffix),    'label' => '/mo']   : null,
                'quarterly'    => $quarterly  ? ['price' => fmt($quarterly, $prefix, $suffix),  'label' => '/3 mo'] : null,
                'semiannually' => $semi       ? ['price' => fmt($semi, $prefix, $suffix),       'label' => '/6 mo'] : null,
                'annually'     => $annually   ? ['price' => fmt($annually, $prefix, $suffix),   'label' => '/yr']     : null,
            ]),
            'free'        => ($p->paytype === 'free'),
        ];
    }

    if ($items) {
        $result[] = [
            'id'    => $group->id,
            'name'  => $group->name,
            'items' => $items,
        ];
    }
}

echo json_encode(['status' => 'success', 'groups' => $result]);
