<?php
session_start();

if(!isset($_SESSION['username'])){
    $_SESSION['error_message'] = "Please login to continue";
    header("Location: admin.php");
}


function myautoload($filename) {
$filename = '../' . str_replace('\\', '/', strtolower($filename)) . '.php';
if (file_exists($filename)) require_once($filename);
}

spl_autoload_register('myautoload');

$List_ID = (int)$_GET['id'];
$pdo = \config\dbconfig::getInstance()->getPdo();

$del_list = $pdo->prepare("DELETE FROM list WHERE List_ID = :id");
$del_list->execute([':id' => $List_ID]);

header("Location: dashboard.php");


?>