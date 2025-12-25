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


if (isset($_GET['Qaza_NAME'])) {

    $name = filter_var($_GET['Qaza_NAME'], FILTER_SANITIZE_SPECIAL_CHARS);

        $pdo = \config\dbconfig::getInstance()->getPdo();

        $add_qaza = $pdo->prepare("INSERT INTO qaza (Qaza_NAME) VALUES (?)");
        $add_qaza->execute([$name]);

        header("Location: dashboard.php");
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Qaza</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<h1>Add Qaza</h1>

<form method="GET" action="qaza_add.php">
    Name: <input name="Qaza_NAME" required><br><br>

    <button style="background-color: green" type="submit">Save</button>
    <button style="background-color: red" type="button" onclick="location.href='dashboard.php'">Cancel</button>
</form>

</body>
</html>