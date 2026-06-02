<?php
define('ROOTDIR', __DIR__);
require __DIR__ . '/init.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'displayarticle' && !empty($_GET['id'])) {
    $controller = new WHMCS\Knowledgebase\Controller\Article();
    $view = $controller->view((int)$_GET['id'], '');
} elseif ($action === 'displaycat' && !empty($_GET['id'])) {
    $controller = new WHMCS\Knowledgebase\Controller\Category();
    $view = $controller->view((int)$_GET['id'], '');
} elseif ($action === 'search' || isset($_POST['search']) || isset($_GET['search'])) {
    $controller = new WHMCS\Knowledgebase\Controller\Knowledgebase();
    $view = $controller->search();
} else {
    $controller = new WHMCS\Knowledgebase\Controller\Knowledgebase();
    $view = $controller->index();
}

$view->output();
