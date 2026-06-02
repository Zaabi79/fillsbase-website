<?php
use WHMCS\Database\Capsule;

/**
 * Fillsbase Global Configuration
 */
define('FILLSBASE_BRAND_NAME', 'Fillsbase');
define('FILLSBASE_BRAND_DOMAIN', 'fillsbase.com');

/**
 * Get the default currency data from WHMCS
 */
function getFillsbaseCurrency() {
    static $currency = null;
    if ($currency === null) {
        $currency = Capsule::table('tblcurrencies')->where('default', 1)->first();
        if (!$currency) {
            // Fallback if no default found
            $currency = (object)[
                'code' => 'FCFA',
                'prefix' => '',
                'suffix' => ' FCFA',
                'format' => 1
            ];
        }
    }
    return $currency;
}

/**
 * Format a price with the default currency prefix/suffix
 */
function formatFillsbasePrice($amount, $currency = null) {
    if ($currency === null) {
        $currency = getFillsbaseCurrency();
    }

    // WHMCS format field: 1=1,234.56  2=1.234,56  3=1 234,56  4=1 234.56
    switch ((int)$currency->format) {
        case 2: $formatted = number_format($amount, 0, ',', '.'); break;
        case 3: $formatted = number_format($amount, 0, ',', "\xc2\xa0"); break; // non-breaking space
        case 4: $formatted = number_format($amount, 0, '.', "\xc2\xa0"); break;
        default: $formatted = number_format($amount, 0, '.', ','); break;
    }

    $prefix = $currency->prefix ? $currency->prefix . ' ' : '';
    return $prefix . $formatted . $currency->suffix;
}

/**
 * Get product registration price by ID and billing cycle
 */
function getFillsbaseProductPrice($pid, $cycle = 'annually') {
    $currency = getFillsbaseCurrency();
    $pricing = Capsule::table('tblpricing')
        ->where('type', 'product')
        ->where('relid', $pid)
        ->where('currency', $currency->id)
        ->first();
        
    if ($pricing && isset($pricing->$cycle) && $pricing->$cycle > 0) {
        return $pricing->$cycle;
    }
    return 0;
}

/**
 * Get TLD registration price
 */
function getFillsbaseTldPrice($tld) {
    $tld = ltrim($tld, '.');
    $currency = getFillsbaseCurrency();
    $pricing = Capsule::table('tbldomainpricing')
        ->where('extension', '.' . $tld)
        ->join('tblpricing', 'tbldomainpricing.id', '=', 'tblpricing.relid')
        ->where('tblpricing.type', 'domainregister')
        ->where('tblpricing.currency', $currency->id)
        ->select('tblpricing.msetupfee')
        ->first();

    return $pricing ? $pricing->msetupfee : 0;
}

/**
 * Get published announcements from WHMCS database
 */
function getFillsbaseAnnouncements($limit = 5) {
    try {
        if (Capsule::schema()->hasTable('tblannouncements')) {
            return Capsule::table('tblannouncements')
                ->where('published', 1)
                ->orderBy('date', 'desc')
                ->limit($limit)
                ->get();
        }
    } catch (\Exception $e) {
        // Fallback silently if DB error
    }
    return [];
}

