<?php
session_start();
require 'pdo_connection.php';

if (isset($_POST["login"])){

    $email = $_POST["cemail"];
    $password = $_POST["cpassword"];

    if($email == "" || $password == ""){
		echo "<h1 style='color: red;'>Email or Password cannot be empty! <a href='loginPage.php'>here</a> to go back</h1>";
		exit;
	}
    if(!strstr($email,"@") || !strstr($email,".")){
    echo "<h1 style='color: red;'>Email is invalid <a href='signupPage.php'>here</a> Go back</h1> ";
    exit;
    }

     $sql = "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";

    $result = $pdo->prepare($sql);
    $result->execute();

    if ($result->fetchColumn() > 0) { 


        $sql = "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";

        $result = $pdo->prepare($sql);
        $result->execute();
                                      
        while ($row = $result->fetch()) { 
          if($row['email'] == $email && $row['password'] == $password){

          $_SESSION['currentName'] = $row['first_name'];
          $_SESSION['currentID'] = $row['customer_id'];
        
              header('location: menu.php');
          }
        }
    } else {
       print "<h1 style='color: red;'>Email or Password do not match! Click <a href='loginPage.php'>here</a> to go back</h1>";
        }
}
$pdo = null;
?>