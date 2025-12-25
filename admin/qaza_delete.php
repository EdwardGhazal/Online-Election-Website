<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['error_message'] = "Please login to continue";
    header("Location: admin.php");
}

function myautoload($filename) {
$filename = '../' . str_replace('\\', '/', strtolower($filename)) . '.php';
if (file_exists($filename)) require_once($filename);
}

spl_autoload_register('myautoload');

$Qaza_ID = (int)$_GET['id'];

$pdo = \config\dbconfig::getInstance()->getPdo();

$del_qaza = $pdo->prepare("DELETE FROM qaza WHERE Qaza_ID = :id");
$del_qaza->execute([':id' => $Qaza_ID]);


header("Location: dashboard.php");

?>