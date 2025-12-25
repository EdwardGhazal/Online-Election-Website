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

$Candidate_ID = (int)$_GET['id'];
$pdo = \config\dbconfig::getInstance()->getPdo();



$stmt = $pdo->prepare("SELECT List_ID FROM candidate WHERE Candidate_ID = :id");
$stmt->execute([':id' => $Candidate_ID]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$List_ID = $row['List_ID'];

$del_candidate = $pdo->prepare("DELETE FROM candidate WHERE Candidate_ID = :id");
$del_candidate->execute([':id' => $Candidate_ID]);

header("Location: candidate_view.php?id=" . $List_ID);

?>
