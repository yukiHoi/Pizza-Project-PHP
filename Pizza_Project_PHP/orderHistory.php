<?php session_start();  ?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style/pizza.css" type="text/css">
    <title>Order History</title>

<?php
    require 'pdo_connection.php';
  
    $currentCustomerID = $_SESSION['currentID'];

$detailsSql = "SELECT p.pizza_name, c.crust_type, ps.pizza_size, od.quantity, od.line_total_price, co.order_status
               FROM OrderDetails od
               JOIN CustomerOrders co ON od.order_id = co.order_id
               JOIN Pizza p ON od.pizza_id = p.pizza_id
               JOIN CrustType c ON od.crust_id = c.crust_id
               JOIN PizzaSize ps ON od.size_id = ps.size_id
               WHERE co.customer_id = '$currentCustomerID'
               AND co.order_status != 'Cancelled'";

$result = $pdo->query($detailsSql); 


$pdo = null;
?>
</head>
<body>
<?php include 'headerLogin.html';?>


<div class="welcome"><h2>Welcome, <?php echo $_SESSION['currentName']; ?></h2></div>
<h1> Order History</h1>
<div class="orderHistory_continer">
<table>
     <tr>
         <th>Pizza</th>
         <th>Crust Type</th>
         <th>Size</th>
         <th>Qty</th>
         <th>Total</th>
         <th>Order Status</th>
     </tr> 
     <?php while ($orderHistory = $result->fetch()) {?>
     <tr>
         <td><?= htmlspecialchars ($orderHistory['pizza_name']) ?></td>
         <td><?= htmlspecialchars ($orderHistory['crust_type']) ?></td>
         <td><?= htmlspecialchars ($orderHistory['pizza_size']) ?></td>
         <td><?= htmlspecialchars ($orderHistory['quantity']) ?></td>
         <td><?= htmlspecialchars ($orderHistory['line_total_price']) ?></td>
         <td><?= htmlspecialchars ($orderHistory['order_status']) ?></td>
     </tr>
     <?php } ?>
</table>
</div>
 <?php include 'footer.html'; ?>
</body>
</html>