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

$List_ID = (int)$_GET['list_id'];
$pdo = \config\dbconfig::getInstance()->getPdo();


$stmt = $pdo->prepare("SELECT List_NAME FROM list WHERE List_ID = :list_id");
$stmt->execute([':list_id' => $List_ID]);
$list = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['Candidate_NAME']) && isset($_GET['Candidate_DOB']) && isset($_GET['Candidate_SECT']) && isset($_GET['Candidate_PHOTO'])) {

    $name  = filter_var($_GET['Candidate_NAME'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dob   = filter_var($_GET['Candidate_DOB'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sect  = filter_var($_GET['Candidate_SECT'], FILTER_SANITIZE_SPECIAL_CHARS);
    $photo = filter_var($_GET['Candidate_PHOTO'], FILTER_SANITIZE_SPECIAL_CHARS);

   

        $add_candidate = $pdo->prepare("
            INSERT INTO candidate (Candidate_NAME, Candidate_DOB, Candidate_SECT, List_ID, Candidate_PHOTO)
            VALUES (:n, :d, :s, :lid, :p)
        ");
        $add_candidate->execute([
            ':n'   => $name,
            ':d'   => $dob,
            ':s'   => $sect,
            ':lid' => $List_ID,
            ':p'   => $photo
        ]);

        header("Location: candidate_view.php?id=" . $List_ID);
       
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Candidate</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<h1>Add Candidate to List: <?php print($list['List_NAME']) ?></h1>

<form method="GET" action="candidate_add.php">

    <input type="hidden" name="list_id" value="<?= $List_ID ?>">

    Candidate Name:
    <input name="Candidate_NAME" required><br><br>

    Date of Birth:
    <input name="Candidate_DOB" placeholder="YYYY-MM-DD" required><br><br>

    Sect:
    <input name="Candidate_SECT" required><br><br>

    Photo Filename:
    <input name="Candidate_PHOTO" placeholder="something.png"><br><br>

    <button style="background-color: green" type="submit">Save</button>
    <button style="background-color: red" type="button" onclick="location.href='candidate_view.php?id=<?= $List_ID ?>'">Cancel</button>

</form>

</body>
</html>
