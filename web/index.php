<?php
define('ROOT', dirname(__DIR__));
require ROOT.'/app/App.php';
App::load();

if (isset($_GET['p'])) {
	$page = $_GET['p'];
}else{
	$page = "home";
}


ob_start();
if ($page==='home') {
	require ROOT.'/pages/home.php';
}elseif ($page==='add') {
	require ROOT.'/pages/add.php';
}
$content = ob_get_clean();
require ROOT.'/pages/templates/default.php'; 