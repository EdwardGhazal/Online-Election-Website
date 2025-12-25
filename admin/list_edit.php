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

$stmt = $pdo->prepare("SELECT * FROM list WHERE List_ID = :id");
$stmt->execute([':id' => $List_ID]);
$selected_list = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['List_NAME']) && isset($_GET['List_LOGO'])) {

    $name  = filter_var($_GET['List_NAME'], FILTER_SANITIZE_SPECIAL_CHARS);
    $logo  = filter_var($_GET['List_LOGO'], FILTER_SANITIZE_SPECIAL_CHARS);

    $update_list = $pdo->prepare("UPDATE list SET List_NAME = :name, List_LOGO = :logo WHERE List_ID = :id");
    $update_list->execute([
        ':name' => $name,
        ':logo' => $logo,
        ':id'   => $List_ID
    ]);

    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit List</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<h1>Edit List: <?php print($selected_list['List_NAME']); ?></h1>

<form method="GET" action="list_edit.php">

    <input type="hidden" name="id" value="<?php print($List_ID); ?>">

    List Name:
    <input name="List_NAME" value="<?php print($selected_list['List_NAME']); ?>" required><br><br>

    List LOGO:
    <input name="List_LOGO" value="<?php print($selected_list['List_LOGO']); ?>" placeholder="something.png"><br><br>

    <button style="background-color: green" type="submit">Save</button>
    <button style="background-color: red" type="button" onclick="location.href='dashboard.php'">Cancel</button>
</form>

</body>
</html>
