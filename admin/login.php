<?php
function myautoload($filename) {
$filename = '../' . str_replace('\\', '/', strtolower($filename)) . '.php';
if (file_exists($filename)) require_once($filename);
}

spl_autoload_register('myautoload');

session_start();
$username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
$password = sha1(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));


$pdo = \config\dbconfig::getInstance()->getPdo();

            // Prepare and execute query
            $sql = "SELECT * FROM admins";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all rows as associative array
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $admin_username = $results['Username'];
            $admin_password = $results['Password'];

            if(($username == $admin_username) && ($password == $admin_password)){
                $_SESSION['username'] = $admin_username;
                header("Location: dashboard.php");
            } else {
                $_SESSION['error_message'] = "Your Username or Password are not valid.";
                header("Location:admin.php");
            }



?>
