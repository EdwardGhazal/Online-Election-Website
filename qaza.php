 <?php
function myautoload($filename) {
$filename = __DIR__ . '/' . str_replace('\\', '/', strtolower($filename)) . '.php';
if (file_exists($filename)) require_once($filename);
}

spl_autoload_register('myautoload');

$pdo = \config\dbconfig::getInstance()->getPdo();

            $Qaza_ID = isset($_GET['Qaza_ID']) ? $_GET['Qaza_ID'] : null;

            if ($Qaza_ID === null) {
                     die("Qaza_ID not provided.");
                }

           // Prepare and execute query
            $sql = "SELECT Qaza_NAME FROM qaza WHERE Qaza_ID = $Qaza_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all rows as associative array
            $results = $stmt->fetch();
            $Qaza_NAME = $results['Qaza_NAME'];
?>

<DOCTYPE html>
    <html> 
        <head> 
            <title> <?php echo $Qaza_NAME; ?> </title>
            <meta charset = utf8>
    <link rel="stylesheet" href="admin/styling.css">

        </head>


        <body> 
            <div> 
               <h2> List Of Lists: </h2> <br>
            </div>

            <div>
            <?php

            // Prepare and execute query
            $sql = "SELECT * FROM list WHERE Qaza_ID = $Qaza_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all rows as associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Loop through results
                foreach ($results as $entry) {
                print <<<HTHT
                <a style="color: red; font-size:20pt" href="list.php?List_ID={$entry['List_ID']}">
                <img src="logos/{$entry['List_LOGO']}" alt="{$entry['List_LOGO']}" height=150px width=150px>
                <strong>{$entry['List_NAME']}</strong>
                </a><br><br>
                HTHT;
                }
            ?>
            </div>

        </body>
    </html>



