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

$list = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare("SELECT * FROM candidate WHERE List_ID = :id");
$stmt2->execute([':id' => $List_ID]);

$candidates = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View List</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<h1>List: <?php print($list['List_NAME'])?></h1>

<img src="../logos/<?php print($list['List_LOGO']) ?>" width="200">

<br><br>

<a href="candidate_add.php?list_id=<?php print($List_ID)?>">
    <button style="background-color: hotpink">Add New Candidate</button>
</a>

<hr>

<h2>Candidates in this list:</h2>

<?php
foreach ($candidates as $cand) {

    print <<<HTHT
    <div>
        <img src="../photos/{$cand['Candidate_PHOTO']}" height=150px width=200px alt="{$cand['Candidate_NAME']}"></br> 
   Name: {$cand['Candidate_NAME']} </br>
   DOB: {$cand['Candidate_DOB']}</br>
   Sect: {$cand['Candidate_SECT']}</br>
   <br>

        <a href="candidate_edit.php?id={$cand['Candidate_ID']}"><button style="background-color: orange">Edit Candidate</button></a>
        <a href="candidate_delete.php?id={$cand['Candidate_ID']}"><button style="background-color: red">Delete Candidate</button></a>

        <hr>
    </div>
HTHT;

}
?>

<button style="background-color:black; color: white; font-size: 20pt" onclick="location.href='dashboard.php'">Back to Dashboard</button>

</body>
</html>