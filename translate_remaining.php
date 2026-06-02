<?php
$all_files = glob("*.html");
$core_files = ["hosting.html", "about.html", "vps.html", "dedicated.html", "domains.html", "footer.html", "index.html", "contact.html"];
$remaining_files = array_diff($all_files, $core_files);

$en_json = json_decode(file_get_contents("assets/locales/en-US/translations.json"), true);
$fr_json = json_decode(file_get_contents("assets/locales/fr-FR/translations.json"), true);

foreach ($remaining_files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    $page = str_replace(".html", "", $file);
    
    if (!isset($en_json[$page])) $en_json[$page] = [];
    if (!isset($fr_json[$page])) $fr_json[$page] = [];
    
    preg_match_all('/<(h[1-3]|p|span|div)[^>]*>(.*?)<\/\1>/is', $content, $matches);
    
    foreach ($matches[0] as $i => $full_tag) {
        $inner_text = trim(strip_tags($matches[2][$i]));
        if (strlen($inner_text) > 10 && !strpos($full_tag, 'data-i18n')) {
            $key = "txt_" . $i;
            $en_json[$page][$key] = $inner_text;
            $fr_json[$page][$key] = "[FR] " . $inner_text; 
            
            $new_tag = preg_replace('/<(h[1-3]|p|span|div)/i', '$0 data-i18n="' . $page . '.' . $key . '"', $full_tag);
            $content = str_replace($full_tag, $new_tag, $content);
        }
    }
    file_put_contents($file, $content);
}

file_put_contents("assets/locales/en-US/translations.json", json_encode($en_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents("assets/locales/fr-FR/translations.json", json_encode($fr_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "All remaining pages processed.\n";
