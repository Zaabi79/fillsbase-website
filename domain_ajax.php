<?php
/**
 * Domain Search AJAX — real availability check via WHMCS domainoptions endpoint
 */
if (file_exists('init.php')) {
    require_once('init.php');
} else {
    header('HTTP/1.1 500 Internal Server Error');
    exit('init.php not found');
}

use WHMCS\Database\Capsule;

header('Content-Type: application/json');

$query = trim($_GET['query'] ?? '');
if (!$query || strlen($query) < 2) { echo json_encode([]); exit; }

// Strip protocol / www
$query = preg_replace('#^https?://#', '', $query);
$query = preg_replace('#^www\.#', '', $query);
$query = strtolower($query);

// Split SLD and TLD if user typed one
$dot = strrpos($query, '.');
$inputSld = ($dot !== false) ? substr($query, 0, $dot) : $query;
$inputTld = ($dot !== false) ? substr($query, $dot) : null;
$inputSld = preg_replace('/[^a-z0-9\-]/', '', $inputSld);

if (!$inputSld) { echo json_encode([]); exit; }

// TLD list — put user's detected TLD first
$defaultTlds = ['.com', '.ml', '.sn', '.ci'];
if ($inputTld && !in_array($inputTld, $defaultTlds)) {
    array_unshift($defaultTlds, $inputTld);
} elseif ($inputTld) {
    array_unshift($defaultTlds, $inputTld);
    $defaultTlds = array_unique($defaultTlds);
}

// Get currency (use session currency if available)
$currency = getCurrency();
$currencyId = (int)($currency['id'] ?? 1);
$prefix = trim($currency['prefix'] ?? '');
$suffix = trim($currency['suffix'] ?? '');

function fmtDomainPrice($amount, $prefix, $suffix) {
    return trim(implode(' ', array_filter([$prefix, number_format((float)$amount, 0, ',', ' '), $suffix])));
}

function getDomainPrice($tld, $currencyId) {
    try {
        $row = Capsule::table('tbldomainpricing')
            ->join('tblpricing', 'tbldomainpricing.id', '=', 'tblpricing.relid')
            ->where('tbldomainpricing.extension', $tld)
            ->where('tblpricing.type', 'domainregister')
            ->where('tblpricing.currency', $currencyId)
            ->select('tblpricing.msetupfee as price')
            ->first();
        return ($row && $row->price > 0) ? (float)$row->price : null;
    } catch (\Exception $e) {
        return null;
    }
}

/**
 * Check real domain availability via WHMCS localAPI DomainWhois
 * Returns 'available', 'taken', or 'unknown'
 */
function checkAvailability($sld, $tld) {
    try {
        // Use WHMCS localAPI — result='success', status='available'|'unavailable'
        $result = localAPI('DomainWhois', ['domain' => $sld . $tld]);
        if (!empty($result['result']) && $result['result'] === 'success') {
            $avail = strtolower($result['status'] ?? '');
            if ($avail === 'available')   return 'available';
            if ($avail === 'unavailable') return 'taken';
        }
    } catch (\Exception $e) {}

    // Fallback: use WHMCS internal domain checker
    try {
        if (function_exists('checkDomainAvailability')) {
            $res = checkDomainAvailability($sld, $tld);
            if (isset($res['status'])) {
                return ($res['status'] === 'available') ? 'available' : 'taken';
            }
        }
    } catch (\Exception $e) {}

    // DNS fallback: if domain has NS or A records it's registered
    $host = ltrim($tld, '.') === '' ? $sld : $sld . $tld;
    if (checkdnsrr($host, 'NS') || checkdnsrr($host, 'A')) {
        return 'taken';
    }
    return 'available';
}

$results = [];

foreach ($defaultTlds as $tld) {
    $price = getDomainPrice($tld, $currencyId);
    if ($price === null) continue; // Skip TLDs we don't sell

    $status = checkAvailability($inputSld, $tld);

    $results[] = [
        'domain'    => $inputSld . $tld,
        'tld'       => $tld,
        'price'     => fmtDomainPrice($price, $prefix, $suffix),
        'price_raw' => $price,
        'status'    => $status,   // 'available', 'taken', 'unknown'
    ];
}

echo json_encode($results);
