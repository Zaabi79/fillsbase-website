<?php
$files = ["hosting.html", "about.html", "vps.html", "dedicated.html", "domains.html", "footer.html"];
$en_json = json_decode(file_get_contents("assets/locales/en-US/translations.json"), true);
$fr_json = json_decode(file_get_contents("assets/locales/fr-FR/translations.json"), true);

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    $page = str_replace(".html", "", $file);
    
    if (!isset($en_json[$page])) $en_json[$page] = [];
    if (!isset($fr_json[$page])) $fr_json[$page] = [];
    
    // Extract H1-H3 and P tags
    preg_match_all('/<(h[1-3]|p|span|div)[^>]*>(.*?)<\/\1>/is', $content, $matches);
    
    foreach ($matches[0] as $i => $full_tag) {
        $inner_text = strip_tags($matches[2][$i]);
        if (strlen(trim($inner_text)) > 10 && !strpos($full_tag, 'data-i18n')) {
            $key = "txt_" . $i;
            $en_text = trim($inner_text);
            $en_json[$page][$key] = $en_text;
            // Simplified: place English in French file too for now, to be translated
            $fr_json[$page][$key] = "[FR] " . $en_text; 
            
            // Inject data-i18n into the tag
            $new_tag = preg_replace('/<(h[1-3]|p|span|div)/i', '$0 data-i18n="' . $page . '.' . $key . '"', $full_tag);
            $content = str_replace($full_tag, $new_tag, $content);
        }
    }
    file_put_contents($file, $content);
}

file_put_contents("assets/locales/en-US/translations.json", json_encode($en_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents("assets/locales/fr-FR/translations.json", json_encode($fr_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Bulk extraction and injection complete.\n";
