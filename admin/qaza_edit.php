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

$stmt = $pdo->prepare("SELECT * FROM qaza WHERE Qaza_ID = :id");
$stmt->execute([':id' => $Qaza_ID]);
$selected_qaza = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['Qaza_NAME'])) {

    $name  = filter_var($_GET['Qaza_NAME'], FILTER_SANITIZE_SPECIAL_CHARS);

    $update_qaza= $pdo->prepare("UPDATE qaza SET Qaza_NAME = :name WHERE Qaza_ID = :id");
    $update_qaza->execute([':name' => $name, ':id' => $Qaza_ID]);

    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Qaza</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<h1>Edit Qaza <?php print($selected_qaza['Qaza_NAME']) ?> :</h1>

<form method="GET" action="qaza_edit.php">

    <input type="hidden" name="id" value="<?php print($Qaza_ID) ?>">

    Name:
    <input name="Qaza_NAME" value="<?php print ($selected_qaza['Qaza_NAME']) ?>" required><br><br>

    <button style="background-color: green" type="submit">Save</button>
    <button style="background-color: red" type="button" onclick="location.href='dashboard.php'">Cancel</button>
</form>

</body>
</html>


