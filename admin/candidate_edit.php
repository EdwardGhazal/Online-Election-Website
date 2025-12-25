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



$stmt = $pdo->prepare("SELECT * FROM candidate WHERE Candidate_ID = :id");
$stmt->execute([':id' => $Candidate_ID]);
$candidate = $stmt->fetch(PDO::FETCH_ASSOC);

$List_ID = $candidate['List_ID'];

if (isset($_GET['Candidate_NAME']) && isset($_GET['Candidate_DOB']) &&
    isset($_GET['Candidate_SECT']) && isset($_GET['Candidate_PHOTO'])) {

    $name  = filter_var($_GET['Candidate_NAME'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dob   = filter_var($_GET['Candidate_DOB'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sect  = filter_var($_GET['Candidate_SECT'], FILTER_SANITIZE_SPECIAL_CHARS);
    $photo = filter_var($_GET['Candidate_PHOTO'], FILTER_SANITIZE_SPECIAL_CHARS);

    $update_candidate = $pdo->prepare("
        UPDATE candidate
        SET Candidate_NAME = :name, Candidate_DOB = :dob, Candidate_SECT = :sect, Candidate_PHOTO = :photo
        WHERE Candidate_ID = :id
    ");

    $update_candidate->execute([
        ':name'    => $name,
        ':dob'  => $dob,
        ':sect' => $sect,
        ':photo'=> $photo,
        ':id'   => $Candidate_ID
    ]);

    header("Location: candidate_view.php?id=" . $List_ID);
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Candidate</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<h1>Edit Candidate: <?php print($candidate['Candidate_NAME']) ?></h1>

<form method="GET" action="candidate_edit.php">

    <input type="hidden" name="id" value="<?php print($Candidate_ID) ?>">

    Name:
    <input name="Candidate_NAME" value="<?php print($candidate['Candidate_NAME']); ?>" required><br><br>

    Date of Birth:
    <input name="Candidate_DOB" value="<?php print($candidate['Candidate_DOB']); ?>" required><br><br>

    Sect:
    <input name="Candidate_SECT" value="<?php print($candidate['Candidate_SECT']); ?>" required><br><br>

    Photo Filename:
    <input name="Candidate_PHOTO" value="<?php print($candidate['Candidate_PHOTO']); ?>" placeholder="something.png"><br><br>

    <button style="background-color: green" type="submit">Save</button>
    <button type="button" onclick="location.href='candidate_view.php?id=<?php $List_ID ?>
