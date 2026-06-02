<?php
$files = ["hosting.html", "about.html", "vps.html", "dedicated.html", "domains.html", "footer.html"];
$translations = [];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    $page_key = str_replace(".html", "", $file);
    $translations[$page_key] = [];
    
    // Extract H1, H2, H3 and P tags (simplified)
    preg_match_all('/<(h[1-3]|p|span)[^>]*>(.*?)<\/\1>/is', $content, $matches);
    
    foreach ($matches[2] as $i => $text) {
        $text = trim(strip_tags($text));
        if (strlen($text) > 5 && !preg_match('/^\{.*\}$/', $text)) {
            $key = "text_" . $i;
            $translations[$page_key][$key] = $text;
        }
    }
}

echo json_encode($translations, JSON_PRETTY_PRINT);
