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

$Qaza_ID = (int)$_GET['id'];
$pdo = \config\dbconfig::getInstance()->getPdo();

$stmt = $pdo->prepare("SELECT Qaza_NAME FROM qaza WHERE Qaza_ID = :id");
$stmt->execute([':id' => $Qaza_ID]);
$qaza = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['List_NAME']) && isset($_GET['List_LOGO'])) {

    $name = filter_var($_GET['List_NAME'], FILTER_SANITIZE_SPECIAL_CHARS);
    $logo = filter_var($_GET['List_LOGO'], FILTER_SANITIZE_SPECIAL_CHARS);

   
        $add_list = $pdo->prepare("INSERT INTO list (List_NAME, Qaza_ID, List_LOGO) 
                                 VALUES (:name, :qid, :logo)");
        $add_list->execute([
            ':name' => $name,
            ':qid'  => $Qaza_ID,
            ':logo' => $logo
        ]);

        header("Location: dashboard.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add List</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<h1>Add New List to <?= htmlspecialchars($qaza['Qaza_NAME']) ?></h1>

<form method="GET" action="list_add.php">

    <input type="hidden" name="id" value="<?php print($Qaza_ID) ?>">

    List Name:
    <input name="List_NAME" required><br><br>

    Logo Filename:
    <input name="List_LOGO" placeholder="something.png"><br><br>

    <button style="background-color: green" type="submit">Save</button>
    <button style="background-color: red" type="button" onclick="location.href='dashboard.php'">Cancel</button>

</form>

</body>
</html>
