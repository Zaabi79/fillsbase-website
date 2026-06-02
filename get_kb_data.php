<?php
require("init.php");
header('Content-Type: application/json');

use WHMCS\Database\Capsule;

$action = isset($_GET['action']) ? $_GET['action'] : 'categories';

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

try {
    if ($action == 'categories') {
        $categories = Capsule::table('tblknowledgebasecats')
            ->where('parentid', 0)
            ->where('hidden', '')
            ->get();
            
        $result = [];
        foreach ($categories as $cat) {
            $count = Capsule::table('tblknowledgebaselinks')
                ->where('categoryid', $cat->id)
                ->count();
            
            $result[] = [
                'id' => $cat->id,
                'name' => $cat->name,
                'slug' => slugify($cat->name),
                'article_count' => $count
            ];
        }
        echo json_encode($result);
    } 
    elseif ($action == 'articles') {
        $catId = (int)$_GET['catid'];
        $articles = Capsule::table('tblknowledgebaselinks')
            ->join('tblknowledgebase', 'tblknowledgebaselinks.articleid', '=', 'tblknowledgebase.id')
            ->where('tblknowledgebaselinks.categoryid', $catId)
            ->select('tblknowledgebase.id', 'tblknowledgebase.title')
            ->get();
            
        foreach ($articles as $art) {
            $art->slug = slugify($art->title);
        }
        echo json_encode($articles);
    }
} catch (\Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
