<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin/styling.css">
</head>
<body>
    
</body>
</html>

<?php
function myautoload($filename) {
$filename = __DIR__ . '/' . str_replace('\\', '/', strtolower($filename)) . '.php';
if (file_exists($filename)) require_once($filename);
}

spl_autoload_register('myautoload');


$parser = new \parser\csv();
$parser->readfile('seeder.csv');

include_once('bootstrap.php');



?>