<?php
/**
 * Domain Checker - Custom wrapper for Fillsbase
 * Handles domain search and redirects to WHMCS cart
 */

// If domain query posted, redirect to WHMCS cart
$domain  = trim($_GET['query'] ?? $_GET['domain'] ?? $_POST['domain'] ?? '');
$sld     = trim($_GET['sld'] ?? '');
$tld     = trim($_GET['tld'] ?? '');

if ($sld && $tld) {
    $domain = $sld . $tld;
}

if ($domain) {
    $domain = preg_replace('#^https?://#', '', $domain);
    $domain = preg_replace('#^www\.#', '', $domain);
    $domain = strtolower(trim($domain, '/'));
    header("Location: /cart.php?a=add&domain=register&query=" . urlencode($domain));
    exit;
}

// No domain - redirect to homepage (domain search is there)
header("Location: /");
exit;
