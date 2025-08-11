<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Pizza Forna e Fuoco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/pizza.css" type="text/css">
   
    <?php
    require 'pdo_connection.php';
  
    $currentCustomerID = $_SESSION['currentID'];

$sql = "SELECT * FROM Customer WHERE customer_id = '$currentCustomerID'";
$result = $pdo->query($sql); 
$customer = $result->fetch();

$pdo = null;
?>

</head>
<body>
<?php include 'headerLogin.html'; ?>

    <div class="profile_continer">

    <div class="welcome"><h2>Welcome, <?php echo $_SESSION['currentName']; ?></h2></div>

        <div class="profile_back_img"></div>

        <div class="profile_form">
    
            <form action="deleteOrUpdateCustomer.php" method="post">
                <h2>Customer Details</h2>  
              
                <input type = "hidden" name= "customer_id" value = "<?= htmlspecialchars ($customer['customer_id']) ?>">

                <div class="row">
                    <div class="column">
                        <label>First Name:</label>
                        <input type="text" name="cfirstName" value="<?= htmlspecialchars($customer['first_name']) ?>">
                    </div>
                    <div class="column">
                        <label>Last Name:</label>
                        <input type="text" name="clastName" value="<?= htmlspecialchars($customer['last_name']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label>Email:</label>
                        <input type="email" name="cemail" value="<?= htmlspecialchars($customer['email']) ?>">
                    </div>
                    <div class="column">
                        <label>Phone Number:</label>
                        <input type="text" name="cphone" value="<?= htmlspecialchars($customer['phone_no']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label>Address:</label>
                        <input type="text" name="caddress" value="<?= htmlspecialchars($customer['address']) ?>">
                    </div>
                    <div class="column">
                        <label>County:</label>
                        <input type="text" name="ccounty" value="<?= htmlspecialchars($customer['county']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label>Town:</label>
                        <input type="text" name="ctown" value="<?= htmlspecialchars($customer['town']) ?>">
                    </div>
                    <div class="column">
                        <label>Eircode:</label>
                        <input type="text" name="ceircode" value="<?= htmlspecialchars($customer['eircode']) ?>">
                    </div>
                </div>

                <button type="submit" name="updateCustomer">Update Details</button> Or
                <button type="submit" name="delete">De-Register</button>

            </form>

        </div>

    </div>

    <?php include 'footer.html'; ?>

</body>
</html>