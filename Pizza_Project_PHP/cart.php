<?php session_start(); 

if(isset($_POST['removeItem'])){
    $index = $_POST['removeIndex'];
   array_splice($_SESSION['cart'], $index, 1);
}
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Pizza Cart</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/pizza.css" type="text/css">

</head>
<body>
    <?php include 'headerLogin.html'; ?>

    <div class="cart_continer">
        <div class="welcome"><h2>Welcome, <?php echo $_SESSION['currentName']; ?></h2></div>

        <div class="order">
        <h2>Orders</h2>
        <table>
        <tr>
            <th>Pizza</th>
            <th>Description</th>
            <th>Pizza base price</th>
            <th>Crust Price</th>
            <th>Size Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th> 
        </tr> 
        <?php $grandTotal = 0.0;
        $cart = $_SESSION['cart'] ?? []; ?> 

        <?php foreach($cart as $index => $item){ /*https://stackoverflow.com/questions/8048157/finding-the-index-while-searching-from-an-array-using-in-array-in-php*/
            $grandTotal += $item['total']?>  
        <tr>
            <td><?php echo $item['pizza_name'] ?></td>
            <td><?php echo $item['description'] ?></td>
            <td><?php echo $item['pizza_basePrice'] ?></td>
            <td><?php echo $item['crustPrice'] ?></td>
            <td><?php echo $item['sizePrice'] ?></td>
            <td><?php echo $item['quantity'] ?></td>
            <td><?php echo number_format($item['total'],2) ?></td>
            <td>    
                <form method="post">
                    <input type="submit" name="removeItem" value="Remove" class="remove">
                    <input type="hidden" name="removeIndex" value="<?php echo $index ?>">
                </form>
            </td>
        </tr>
       <?php } ?>
        </table><br><br>
       
       <?php if ($grandTotal == 0) { ?>
       <h3><?php echo "Cart is empty"; ?></h3>
       
       <?php } else { ?>
       <h3><?php echo "Grand Total: " . number_format($grandTotal, 2); ?></h3>
       
       </div>
        <button class="checkoutButton"><a style="text-decoration: none; color:black;" href="payment.php">Check Out </a></button>
         
       <?php } ?>
       
       </div>
        
                
    </div>
        <?php $_SESSION['grandTotal'] = $grandTotal; ?>
  

    <?php include 'footer.html'; ?>
</body>
</html>