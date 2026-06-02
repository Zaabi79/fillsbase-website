<?php
$requestUri = '/gaming';
$cleanPath = ltrim($requestUri, '/');
if ($cleanPath === 'gaming') {
    $cleanPath = 'food-grocery';
}
echo "Checking: " . __DIR__ . '/' . $cleanPath . ".html<br>";
if (file_exists(__DIR__ . '/' . $cleanPath . '.html')) {
    echo "EXISTS";
} else {
    echo "NOT FOUND";
}
?>
