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

$pdo = \config\dbconfig::getInstance()->getPdo();
?>



<DOCTYPE html>
    <html> 
        <head> 
            <title> Admin Dashboard </title>
            <meta charset = utf8>
           <link rel="stylesheet" href="styling.css">
        </head>

    <body> 
        <div>
        <h3 style="color:red"> <ins>This Dashboard is for Username: <?php print $_SESSION['username']?> </ins></h3> </br>

        <h2>Manage Qazas</h2> 
        <a href="qaza_add.php"><button style="background-color:hotpink">Add New Qaza</button></a><br><br></br></br>
        
        <?php

            // Prepare and execute query
            $sql = "SELECT * FROM qaza";
            $stmt1 = $pdo->prepare($sql);
            $stmt1->execute();

            // Fetch all rows as associative array
            $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
print "<hr>";
            foreach($results1 as $entry1){ 

 print<<<HTHT

 <div>
                
   <h2 style="color:darkorchid"> <ins>{$entry1['Qaza_NAME']}:</ins></h2> 
   <a href="qaza_edit.php?id={$entry1['Qaza_ID']}"> <button style="background-color: orange"> Edit Qaza </button> </a>
   <a href="qaza_delete.php?id={$entry1['Qaza_ID']}"> <button style="background-color: red"> Delete Qaza </button> </a>
   <a href="list_add.php?id={$entry1['Qaza_ID']}"> <button style="background-color:hotpink"> Add New List </button> </a>
 </div>  
   
 HTHT;

    $stmt2 = $pdo->prepare("SELECT * FROM list WHERE Qaza_ID = :id");
    $stmt2->execute([':id' => $entry1['Qaza_ID']]);
    $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    print("<h3> <ins> Lists: </ins> </h3>");
    foreach ($results2 as $entry2) {

        print <<<HTHT
        <div>
            <img height="150px" width="150px" src="../logos/{$entry2['List_LOGO']}" alt="{$entry2['List_NAME']}"> {$entry2['List_NAME']}
            <a href="list_edit.php?id={$entry2['List_ID']}"><button style="background-color: orange">Edit List</button></a>
            <a href="list_delete.php?id={$entry2['List_ID']}"><button style="background-color: red">Delete List</button></a>
            <a href="candidate_view.php?id={$entry2['List_ID']}"><button style="background-color: lightgreen">View Candidates</button></a>
            <div>
        HTHT;
    }

    print "<hr>";
 }
        ?>


</div>
        <div>
         
        <form action="logout.php" method="POST"> 
        <input style="background-color: red; font-size: 18px" type="submit" value="Logout"> </br> </br> 

       

        </form>
           
</div>
    
    </body>
     
    </html>