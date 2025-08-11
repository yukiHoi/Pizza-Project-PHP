<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Sign Up</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/pizza.css" type="text/css">
</head>
<body>
    <?php include 'headerNotLogin.html'; ?>
    <div class="signup_container">

        <form action="signupCustomer.php" method="post">
            <p>Sign Up to Order Online:</p>

            <label>First Name*:</label>
            <input type="text" name="cfirstName" value=""><br />

            <label>Last Name*:</label>
            <input type="text" name="clastName" value=""><br />

            <label>Email*:</label>
            <input type="email" name="cemail" value=""><br />

            <label>Phone No:</label>
            <input type="text" name="cphone_no" value=""><br />

            <label>Address*:</label>
            <input type="text" name="caddress" value=""><br />

            <label>County*:</label>
            <input type="text" name="ccounty" value=""><br />

            <label>Town*:</label>
            <input type="text" name="ctown" value=""><br />

            <label>Eircode*:</label>
            <input type="text" name="ceircode" value=""><br />

            <label>Password:</label>
            <input type="password" name="cpassword" value=""><br />

            <label>Confirm Password:</label>
            <input type="password" name="cconfirmPassword" value=""><br />
       
            <input style="background-color: #ffcc00; color: #000;" type="submit" name="signup" value="Sign Up" >
            
        </form>

    </div>
     <?php include 'footer.html'; ?>

</body>
</html>