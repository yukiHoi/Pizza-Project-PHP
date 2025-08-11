<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Payment</title>
    <link rel="stylesheet" href="style/pizza.css" type="text/css">
</head>
<body>
<div class="background">
    <div class="payment_continer">
        <a href="cart.php" class="back-button">← Back to Cart</a>
            <h1> Pizza Forna e Fuoco</h1>
            <?php if (isset($_SESSION['grandTotal'])){ ?>
            <h3>TOTAL TO PAY €<?php echo $_SESSION['grandTotal']; ?> </h3>
            <?php }?>
            <hr>
            <form method="post" action="placeOrder.php">
            <input type="hidden" name="customerID" value=" <?php echo $_SESSION['currentName'];?>">
            <input type="text" name="dAddress" placeholder="Delivery Address">
            <input type="text" name="eCode" placeholder="eircode">
            <input type="text" name="pNo" placeholder="Phone Number">
            <input type="text" name="fName" placeholder="First Name">
            <input type="text" name="lName"placeholder="Last Name">
            <input type="text" name="cardNo"placeholder="card number">
            <input type="text" name="cvv" placeholder="cvv">
            <input type="text" name="date" placeholder="MM / YY">
             <button type="submit" name="placeOrder">Place Order</button>
             </form>
    </div>
</dov>

 
</body>
</html>