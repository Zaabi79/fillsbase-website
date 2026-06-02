<?php
require_once('init.php');
use WHMCS\Database\Capsule;

try {
    // 1. Create the Product Group
    $gid = Capsule::table('tblproductgroups')->insertGetId([
        'name' => 'Services SEO',
        'headline' => 'Améliorez votre visibilité en ligne',
        'tagline' => 'Optimisation professionnelle pour les moteurs de recherche',
        'orderfrmtpl' => 'standard_cart',
        'disabledgateways' => '',
        'order' => 10
    ]);

    // 2. Create the Products
    $products = [
        ['name' => 'Standard SEO', 'price' => 5000],
        ['name' => 'Enhanced SEO', 'price' => 15000],
        ['name' => 'Ultimate SEO', 'price' => 35000]
    ];

    $currency = Capsule::table('tblcurrencies')->where('default', 1)->first();
    $currencyId = $currency ? $currency->id : 1;

    foreach ($products as $p) {
        $pid = Capsule::table('tblproducts')->insertGetId([
            'type' => 'other',
            'gid' => $gid,
            'name' => $p['name'],
            'description' => 'Service SEO professionnel pour Fillsbase.com',
            'paytype' => 'recurring',
            'tax' => 1,
            'showdomainoptions' => 0,
            'retired' => 0,
            'hidden' => 0,
            'order' => 0
        ]);

        // Add pricing
        Capsule::table('tblpricing')->insert([
            'type' => 'product',
            'currency' => $currencyId,
            'relid' => $pid,
            'msetupfee' => 0,
            'qsetupfee' => 0,
            'ssetupfee' => 0,
            'asetupfee' => 0,
            'bsetupfee' => 0,
            'tsetupfee' => 0,
            'monthly' => $p['price'],
            'quarterly' => -1,
            'semiannually' => -1,
            'annually' => -1,
            'biennially' => -1,
            'triennially' => -1
        ]);
        
        echo "Created Product: {$p['name']} (ID: $pid)\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
