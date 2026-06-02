<?php
$files = glob("*.html");
$audit = [];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Check for i18n markers
    $has_i18n = strpos($content, 'data-i18n=') !== false;
    
    // Check for hardcoded English patterns (basic check)
    $has_english = preg_match('/[a-zA-Z]{5,}/', strip_tags($content));
    
    $status = "Hardcoded";
    if ($has_i18n) {
        $status = "Partially Translated";
        // If it has many i18n tags, mark as fully
        if (substr_count($content, 'data-i18n=') > 10) {
            $status = "Translated";
        }
    }

    $audit[] = [
        "file" => $file,
        "status" => $status,
        "size" => filesize($file)
    ];
}

echo json_encode($audit, JSON_PRETTY_PRINT);
