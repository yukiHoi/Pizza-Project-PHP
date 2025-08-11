<?php
require 'pdo_connection.php';

if (isset($_POST['signup'])) {

$firstName = trim($_POST['cfirstName']);
$lastName = trim($_POST['clastName']);
$email = trim($_POST['cemail']);
$phone_no = trim($_POST['cphone_no']);
$address = trim($_POST['caddress']);
$county = trim($_POST['ccounty']);
$town = trim($_POST['ctown']);
$eircode = trim($_POST['ceircode']);
$password = trim($_POST['cpassword']);
$confirmPassword = trim($_POST['cconfirmPassword']);

if ($firstName == '' && $lastName == '' && $email == '' && $phone_no == '' && $address == '' or
    $county == '' && $town == '' && $eircode == '' && $password =='' && $confirmPassword == ''){  
        
    echo "<h1 style='color: red;'>You did not complete the form correctly <a href='signupPage.php'>here</a> Go back</h1>";
exit;
}
if(strlen($phone_no) < 10 || !is_numeric($phone_no) ){
    	echo "<h1 style='color: red;'>Phone number is invalid <a href='signupPage.php'>here</a> Go back</h1>";
	exit;

}
if($phone_no[0] != 0){
    	echo "<h1 style='color: red;'>Phone number must start with 0 <a href='signupPage.php'>here</a> Go back</h1>";
	exit;

}
if(!strstr($email,"@") || !strstr($email,".")){
    echo "<h1 style='color: red;'>Email is invalid <a href='signupPage.php'>here</a> Go back</h1> ";
    exit;
}
if($password != $confirmPassword){
    echo("<h1 style='color: red;'>Passwords do not match <a href='signupPage.php'>here</a> Go back</h1>");
    exit;
}


$exitsEmail = "SELECT email FROM customer WHERE email = :cemail";
$stmt = $pdo->prepare($exitsEmail);
$stmt->bindValue(':cemail', $email);
$stmt->execute();

if($stmt->fetchColumn() > 0){
    print "<h1 style='color: red;'>Email already exists ! Click <a href='signupPage.php'>here</a> to go back</h1><br>";

}

else{

$sql =  "INSERT INTO customer (first_name, last_name, email, phone_no, address, county, town, eircode, password) 
         VALUES (:cfirstName, :clastName, :cemail, :cphone_no, :caddress, :ccounty, :ctown, :ceircode, :cpassword)";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':cfirstName', $firstName);
$stmt->bindValue(':clastName', $lastName);
$stmt->bindValue(':cemail', $email);
$stmt->bindValue(':cphone_no', $phone_no);
$stmt->bindValue(':caddress', $address);
$stmt->bindValue(':ccounty', $county);
$stmt->bindValue(':ctown', $town);
$stmt->bindValue(':ceircode', $eircode);
$stmt->bindValue(':cpassword', $password);

$stmt->execute();

echo "<h1 style='color: green;'>User Registered Successfully!</h1>";
header('Location: loginpage.php'); //https://stackoverflow.com/questions/17157685/php-redirect-to-another-page-after-form-submit
}

}

$pdo = null;

?>