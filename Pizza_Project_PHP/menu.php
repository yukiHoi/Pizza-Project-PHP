<?php session_start();  ?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Menu</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/pizza.css" type="text/css">

    <?php

    require 'pdo_connection.php';

    $allPizzas = "SELECT pizza_name FROM Pizza";
    $stmt = $pdo->prepare($allPizzas);
    $stmt->execute();

    ?>
</head>
<body>
    <?php include 'headerLogin.html';?>
    
    <div class="menuback"></div>

    <div class="welcome"><h2>Welcome, <?php echo $_SESSION['currentName']; ?></h2></div>

    <div class="menu_container">
        <h2>ALL AVAILABLE PIZZA</h2>

        <form action="pizzaDetails.php" method="post">
            <div class="menu_row1">
                     <?php while ($row = $stmt->fetch()): ?>
                    <div class='menu_item'>
                        <img src='images/<?php echo $row['pizza_name']; ?>.jpg' alt='<?php echo $row['pizza_name']; ?>'>
                        <p><?php echo $row['pizza_name']; ?></p>
                        <button type='submit' name='pizzaName' value='<?php echo $row['pizza_name']; ?>'>Details</button>
                    </div>
                <?php endwhile; ?>        
            </div>
            </div>
        </form>
    </div>

   <?php include 'footer.html'; ?>
</body>
</html>