<DOCTYPE html>
    <html> 
        <head> 
            <title> Lebanon Qazas</title>
            <meta charset = utf8>
        </head>


        <body> 
            <div> 
               <h2> List Of Qazas: </h2> <br>
            </div>

            <div>

            <?php

            $pdo = \config\dbconfig::getInstance()->getPdo();


            // Prepare and execute query
            $sql = "SELECT * FROM qaza";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all rows as associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Loop through results
            foreach ($results as $entry) {
            print <<<HTHT
            <a style="color:red; font-size: 20pt" href="qaza.php?Qaza_ID={$entry['Qaza_ID']}">
            <strong>{$entry['Qaza_NAME']}</strong>
            </a><br><br>
            HTHT;
}
?>
            </div>

        </body>
    </html>

