<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve login.html explicitly to prevent WHMCS login.php redirect loop
if ($uri === '/login') {
    include __DIR__ . '/login.html';
    return true;
}

// Knowledgebase → always use WHMCS native knowledgebase.php
if ($uri === '/knowledgebase-list' || $uri === '/knowledgebase') {
    include __DIR__ . '/knowledgebase.php';
    return true;
}

// dologin.php must be served as a standalone script, not through the router include context
if ($uri === '/dologin.php') {
    return false;
}




if ($uri === '/' || $uri === '/index.html' || $uri === '/index.php' || $uri === '/home') {
    if (file_exists(__DIR__ . '/index.php')) {
        include __DIR__ . '/index.php';
        return true;
    }
    if (file_exists(__DIR__ . '/index.html')) {
        include __DIR__ . '/index.html';
        return true;
    }
}

if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Fallback for non-extension URLs to .php or .html
if ($uri !== '' && $uri !== '/') {
    $cleanPath = ltrim($uri, '/');
    
    // 1. Check for exact file match
    if (file_exists(__DIR__ . '/' . $cleanPath) && !is_dir(__DIR__ . '/' . $cleanPath)) {
        return false; // Let the server handle the existing file
    }
    
    // 2. Check for .php extension
    if (file_exists(__DIR__ . '/' . $cleanPath . '.php')) {
        include __DIR__ . '/' . $cleanPath . '.php';
        return true;
    }
    
    // 3. Check for .html extension
    if (file_exists(__DIR__ . '/' . $cleanPath . '.html')) {
        include __DIR__ . '/' . $cleanPath . '.html';
        return true;
    }
}

return false;
