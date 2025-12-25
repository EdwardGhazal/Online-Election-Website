<?php
session_start();
?>

<!DOCTYPE html>
    <html> 
        <head> 
            <title> Login Page </title>
            <meta charset = utf8>
            <link rel="stylesheet" href="styling.css">
        </head>

    <body> 
        <div id="login">
         
        <form action="login.php" method="POST"> 
       
        <label> Username: <input type="text" name="username" style="font-size: 16pt" required> </label> </br>
        <label> Password: <input type="password" name="password" style="font-size: 16pt" required> </label> </br>
        <input type="submit" value="Login" id="loginbutton"> </br> </br> 
      


<div id="errormessage">
        <?php
        if(isset($_SESSION['error_message'])) {
            $error = $_SESSION['error_message'];
            print "{$error}";
            $_SESSION['error_message'] = null;
        }
        ?>
</div>
        </form>
           
</div>
    
    </body>
     
    </html>