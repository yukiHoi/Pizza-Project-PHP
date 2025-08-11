<?php session_start();?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Display Pizza Details</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/pizza.css" type="text/css">


</head>
<body>
    
    <?php 
    include 'headerLogin.html';
    require 'pdo_connection.php';

    if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    }

    $totalCost = 0.0;
    $added = " ";

    if (isset($_POST["addToCart"])) {
    $base = $_POST["base_price"];
    $qty = $_POST["quantity"];

    $hasCrust = isset($_POST['crustPrice']);
    $hasSize = isset($_POST['sizePrice']);

    if (!$hasCrust) {
        echo "<h2 style='color: red; font-weight: bold;'>Please select a crust type</h2>";
    }
    if (!$hasSize) {
        echo "<h2 style='color: red; font-weight: bold;'>Please select a pizza size</h2>";
    }

    if ($hasCrust && $hasSize) {
       
            $crustPrice = $_POST['crustPrice'];

            $sizePrice = $_POST['sizePrice'];

            $crustID = strstr($crustPrice,"$",true);
            $crustPrice = substr(strstr($crustPrice,"$"),1);
            
            $sizeID = strstr($sizePrice,"$",true);
            $sizePrice = substr(strstr($sizePrice,"$"),1);
           
            $totalCost = ($base + $crustPrice + $sizePrice) * $qty;
            $added = "Pizza added to cart";

            $cartItem = [
                'pizzaID' => $_POST['pizza_id'],
                'pizza_name' => $_POST['pizzaName'],          
                'description' => $_POST['description'],
                'pizza_basePrice' => $base,
                'crustPrice' => $crustPrice,
                'crustID' => $crustID,
                'sizePrice' => $sizePrice,
                'sizeID' => $sizeID,
                'quantity' => $qty,
                'total' => $totalCost,
            ];
            $_SESSION['cart'][] = $cartItem;
         
    }
}
if (isset($_POST["pizzaName"])) {
    $pizzaName = $_POST["pizzaName"];

    $sql = "SELECT p.pizza_id, p.pizza_name, p.description, c.category_name, p.base_price
            FROM pizza p 
            JOIN category c ON p.category_id = c.category_id
            WHERE p.pizza_name = '$pizzaName'";

    $result = $pdo->prepare($sql);
    $result->execute();

    if ($result->fetchColumn() > 0) {
        $result = $pdo->prepare($sql);
        $result->execute();

        $crustSQL = "SELECT * FROM CrustType";
        $crustResult = $pdo->prepare($crustSQL);
        $crustResult->execute();

        $sizeSQL = "SELECT * FROM PizzaSize";
        $sizeResult = $pdo->prepare($sizeSQL);
        $sizeResult->execute();

?>

<h2 class="welcome">Welcome, <?php echo $_SESSION['currentName']; ?></h2>

    <form method="post" >

    <?php while ($row = $result->fetch()): ?>
        <h1><?php echo $row['pizza_name']; ?> Details</h1>
        <div class="pizzaContainer">
            <div class="pizzaImg">
                <img src="images/<?php echo $row['pizza_name']; ?>.jpg" alt="<?php echo $row['pizza_name']; ?>">
            </div>
            <div class="pizzaDetails">
                <p>Pizza ID: <?php echo $row['pizza_id']; ?></p>
                <p>Pizza Name: <?php echo $row['pizza_name']; ?></p>
                <input type="hidden" name="pizzaName" value="<?php echo $row['pizza_name']; ?>">
                <input type="hidden" name="pizza_id" value="<?php echo $row['pizza_id']; ?>">
                <p>Description: <?php echo $row['description']; ?></p>
                <input type="hidden" name="description" value="<?php echo $row['description']; ?>">
                <input type="hidden" name="base_price" value="<?php echo $row['base_price']; ?>">
                <p>Base Price: €<?php echo $row['base_price']; ?></p>
            </div>
        </div>
    <?php endwhile; ?>

    <div class="choiceWrapper">
        <div class="pizzaCrust">
            <h3>Select your Crust Type</h3>
            <?php while ($row = $crustResult->fetch()){ ?> 
                <label>                                  
                    <input type="radio" name="crustPrice" value="<?php echo $row['crust_id'].'$'. $row['crust_price']; ?>">
                    
                    <?php echo $row['crust_type'] . ' €' . $row['crust_price']; ?>
                </label><br>
            <?php }?>
        </div>

        <div class="pizzaSize">
            <h3>Select your Pizza Size</h3>
            <?php while ($row = $sizeResult->fetch()){ ?>
                <label>
                    <input type="radio" name="sizePrice" value="<?php echo $row['size_id']. '$' .$row['size_price']; ?>">
                        <?php echo $row['pizza_size'] . ' €' . $row['size_price']; ?>
                </label><br>
            <?php } ?>
        </div>

         <div class="totalCost">
        Quantity: <input type="number" name="quantity" value="1" min="1" max="5" >
        <input type="submit" name="addToCart" value="Add to Cart" id="addToCart">
        <p>Total Cost is: <?php echo number_format($totalCost,2); ?></P>
         <input type="hidden" name="totalCost" value="<?php echo  number_format($totalCost,2); ?>">
        <p><?php echo $added ?></p>
    </div>
    </div>

</form>

<?php 
    } 
}
?>
<?php include 'footer.html'; ?>
</body>

</html>



