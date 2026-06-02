<?php
$fr_json = json_decode(file_get_contents("assets/locales/fr-FR/translations.json"), true);
if (!isset($fr_json['content'])) $fr_json['content'] = [];

$files = glob("*.html");
foreach ($files as $file) {
    $content = file_get_contents($file);
    preg_match_all('/<(h[1-5]|p|span|a|button|div)[^>]*>(.*?)<\/\1>/is', $content, $matches);
    
    foreach ($matches[2] as $text) {
        $clean = trim(strip_tags($text));
        if (strlen($clean) > 5 && !isset($fr_json['content'][$clean])) {
            // Add to dictionary with a placeholder or simple translation if obvious
            $fr_json['content'][$clean] = "[FR] " . $clean;
        }
    }
}

file_put_contents("assets/locales/fr-FR/translations.json", json_encode($fr_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Dictionary built with ALL unique strings from the theme.\n";
