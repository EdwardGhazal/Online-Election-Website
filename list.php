 <?php
function myautoload($filename) {
$filename = __DIR__ . '/' . str_replace('\\', '/', strtolower($filename)) . '.php';
if (file_exists($filename)) require_once($filename);
}

spl_autoload_register('myautoload');

$pdo = \config\dbconfig::getInstance()->getPdo();

            $List_ID = isset($_GET['List_ID']) ? $_GET['List_ID'] : null;

            if ($List_ID === null) {
                     die("Qaza_ID not provided.");
                }

            // Prepare and execute query
            $sql = "SELECT List_NAME FROM list WHERE List_ID = $List_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all rows as associative array
            $results = $stmt->fetch();
            $List_NAME = $results['List_NAME'];


            
?>

<DOCTYPE html>
    <html> 
        <head> 
            <title> <?php echo $List_NAME ?> </title>
            <meta charset = utf8>
    <link rel="stylesheet" href="admin/styling.css">

        </head>


        <body> 
            <div> 
               <h2> List Of Candidates: </h2> <br>
            </div>

            <div>
            <?php


                // Prepare and execute query
            $sql = "SELECT * FROM candidate WHERE List_ID = $List_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all rows as associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Loop through results
                foreach ($results as $entry) {
                print <<<HTHT
                ID: {$entry['Candidate_ID']} <br>
                Name: {$entry['Candidate_NAME']} <br>
                Date Of Birth: {$entry['Candidate_DOB']} <br>
                Sect: {$entry['Candidate_SECT']} <br>
                Photo: <img src="photos/{$entry['Candidate_PHOTO']}" alt="{$entry['Candidate_PHOTO']}" 
                height=150px width=150px> <br><br><br>
                HTHT;
                }
            ?>
            </div>

        </body>
    </html>



