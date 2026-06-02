<?php
/**
 * X Dairy Products Setup Script
 * Run once: http://localhost:8080/create_xdairy_products.php
 * DELETE this file after running.
 */

define('ROOTDIR', __DIR__);
require_once __DIR__ . '/init.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Clean up any previous partial run (group 67, products in that group)
Capsule::table('tblpricing')->whereIn('relid',
    Capsule::table('tblproducts')->where('gid', 67)->pluck('id')->toArray()
)->where('type','product')->delete();
Capsule::table('tblproducts')->where('gid', 67)->delete();
Capsule::table('tblproductgroups')->where('id', 67)->delete();

// ── 1. Create product group (category) ───────────────────────────────────────
$groupId = Capsule::table('tblproductgroups')->insertGetId([
    'name'        => 'X Dairy',
    'slug'        => 'x-dairy',
    'headline'    => 'All-in-One Dairy Farm Management System',
    'tagline'     => 'Automate your dairy farm with X-Dairy — built on Laravel.',
    'order'       => 99,
    'hidden'      => 0,
]);

echo "<p>✅ Product group created — ID: <strong>{$groupId}</strong></p>";

$currencyId = Capsule::table('tblcurrencies')->where('code', 'USD')->value('id') ?? 1;

// ── 2. X-Dairy Basic ($299 one-time) ─────────────────────────────────────────
$basicId = Capsule::table('tblproducts')->insertGetId([
    'type'        => 'other',
    'gid'         => $groupId,
    'name'        => 'X-Dairy Basic',
    'description' => "Ideal for small farms starting digital dairy management.\n\n✔ 1 Dairy Farm\n✔ Full Laravel Source Code\n✔ Installation Guide\n✘ No Server Setup Included\n✔ Lifetime Free Updates\n✔ 6 Month Support\n✔ Only Online Functionality\n✘ No Daily Backups\n\nSupport Renewal After 6 Months: \$50",
    'hidden'      => 0,
    'paytype'     => 'onetime',
    'autosetup'   => '',
    'order'       => 1,
    'created_at'  => date('Y-m-d H:i:s'),
    'updated_at'  => date('Y-m-d H:i:s'),
]);
// For paytype=onetime WHMCS stores price in monthly column
Capsule::table('tblpricing')->insert([
    'relid' => $basicId, 'type' => 'product', 'currency' => $currencyId,
    'msetupfee' => 0, 'qsetupfee' => 0, 'ssetupfee' => 0, 'asetupfee' => 0,
    'bsetupfee' => 0, 'tsetupfee' => 0,
    'monthly' => 299.00, 'quarterly' => -1, 'semiannually' => -1,
    'annually' => -1, 'biennially' => -1, 'triennially' => -1,
]);
echo "<p>✅ X-Dairy Basic created — ID: <strong>{$basicId}</strong></p>";

// ── 3. X-Dairy Professional ($599/yr, renews $150) ───────────────────────────
$proId = Capsule::table('tblproducts')->insertGetId([
    'type'        => 'other',
    'gid'         => $groupId,
    'name'        => 'X-Dairy Professional',
    'description' => "Ideal for growing farms needing advanced management.\n\n✔ 1 Dairy Farm\n✔ Full Laravel Source Code\n✔ Complete Installation Included\n✔ Server Setup Included\n✔ Lifetime Free Updates\n✔ Offline + Online Functionality\n✔ 6 Month Support\n✘ No Daily Backups\n\nSupport Renewal After 6 Months: \$50\nYou pay \$599 today. Renews at \$150/yr.",
    'hidden'      => 0,
    'paytype'     => 'recurring',
    'autosetup'   => '',
    'order'       => 2,
    'created_at'  => date('Y-m-d H:i:s'),
    'updated_at'  => date('Y-m-d H:i:s'),
]);
Capsule::table('tblpricing')->insert([
    'relid' => $proId, 'type' => 'product', 'currency' => $currencyId,
    'msetupfee' => 0, 'qsetupfee' => 0, 'ssetupfee' => 0, 'asetupfee' => 0,
    'bsetupfee' => 0, 'tsetupfee' => 0,
    'monthly' => -1, 'quarterly' => -1, 'semiannually' => -1,
    'annually' => 599.00, 'biennially' => -1, 'triennially' => -1,
]);
echo "<p>✅ X-Dairy Professional created — ID: <strong>{$proId}</strong></p>";

// ── 4. X-Dairy Enterprise ($1000 one-time) ───────────────────────────────────
$entId = Capsule::table('tblproducts')->insertGetId([
    'type'        => 'other',
    'gid'         => $groupId,
    'name'        => 'X-Dairy Enterprise',
    'description' => "Ideal for large farms needing complete automation.\n\n✔ 1 Dairy Farm\n✔ Full Laravel Source Code\n✔ Complete Installation Included\n✔ Server Setup Included\n✔ Lifetime Free Updates\n✔ Offline + Online Functionality\n✔ Daily Backups\n\nSupport Renewal After 6 Months: \$50\nStarting from \$1,000 — depending on customization.",
    'hidden'      => 0,
    'paytype'     => 'onetime',
    'autosetup'   => '',
    'order'       => 3,
    'created_at'  => date('Y-m-d H:i:s'),
    'updated_at'  => date('Y-m-d H:i:s'),
]);
Capsule::table('tblpricing')->insert([
    'relid' => $entId, 'type' => 'product', 'currency' => $currencyId,
    'msetupfee' => 0, 'qsetupfee' => 0, 'ssetupfee' => 0, 'asetupfee' => 0,
    'bsetupfee' => 0, 'tsetupfee' => 0,
    'monthly' => 1000.00, 'quarterly' => -1, 'semiannually' => -1,
    'annually' => -1, 'biennially' => -1, 'triennially' => -1,
]);
echo "<p>✅ X-Dairy Enterprise created — ID: <strong>{$entId}</strong></p>";

echo "<hr>";
echo "<p><strong>Product IDs:</strong> Basic={$basicId} | Pro={$proId} | Enterprise={$entId}</p>";
echo "<p style='color:red;font-weight:bold;'>⚠️ DELETE this file now: create_xdairy_products.php</p>";
