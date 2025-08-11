<?php session_start(); 

$orderCode = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,6);
/*https://stackoverflow.com/questions/6101956/generating-a-random-password-in-php 33*/

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Order Confirm</title>
    <link rel="stylesheet" href="style/pizza.css" type="text/css">
</head>
<body>
<?php include 'headerLogin.html'; ?>

<div class="confirm_container">
   <div class="back_img"></div>
   <div class="orderConfirm">
       <div class="info">
           <h1>Thank you for your order <?php echo $_SESSION['currentName']; ?></h1>
           <h3>A confirmation has been sent to your email</h3>
           <h3>Order code is: <?php echo $orderCode ?> </h3>
       </div> 
   </div>
</div>

<?php include 'footer.html'; ?>
</body>
</html>