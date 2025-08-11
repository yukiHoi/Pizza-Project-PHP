<?php
session_start();
require 'pdo_connection.php';

if (isset($_POST['placeOrder'])) {
    $eAdddress = $_POST['dAddress'];
    $eCode = $_POST['eCode'];
    $pNo = $_POST['pNo'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $cardNo = $_POST['cardNo'];
    $cvv = $_POST['cvv'];
    $date = $_POST['date'];

    if($eAddress =="" && $eCode=="" && $pNo=="" && fName == "" && $lName== "" && $cardNo == "" && $cvv == "" && $date == ""){
        echo "<h1 style='color: red;'>You did not complete the form correctly <a href='payment.php'>Go back</a></h1> ";
        exit;
    }
    if(strlen($eCode) != 7 ){
		echo "<h1 style='color: red;'>Eircode is invalid <a href='payment.php'>Go back</a></h1> ";
		exit;
	}
    if(strlen($pNo) != 10 || !is_numeric($pNo) ){
		echo "<h1 style='color: red;'>Phone Number is invalid <a href='payment.php'>Go back</a></h1> ";
		exit;
	}
    if($pNo[0] != 0){
    	echo "<h1 style='color: red;'>Phone number must start with 0 <a href='signupPage.php'>here</a> Go back</h1>";
	exit;

}
    if(strlen($cvv) != 3 || !is_numeric($cvv)){
        echo "<h1 style='color: red;'>CVV is invalid <a href='payment.php'>Go back</a></h1> ";
        exit;
    }
    if (strlen($cardNo) != 16 || !is_numeric($cardNo)){
        echo "<h1 style='color: red;'>Card Number is invalid <a href='payment.php'>Go back</a></h1>";
        exit;
    }
    if(strlen($date) == 5 && $date[2] == '/' ){

        $m1 = $date[0];
        $m2 = $date[1];
        $y1 = $date[3];
        $y2 = $date[4];

        if(is_numeric($m1) && is_numeric($m2) && is_numeric($y1) && is_numeric($y2)) {

        $month = $m1.$m2;
        $year = $y1.$y2;

        }  
        else{
            echo "<h1 style='color: red;'>Month and Year must be digit only <a href='payment.php'>Go back</a></h1>";
            exit;
        }
    }
    else{
        echo "<h1 style='color: red;'>Date must be in MM/YY format <a href='payment.php'>Go back</a></h1>";
        exit;
    }       
    if($month < 1 || $month > 31 || $year < 25){
            echo "<h1 style='color: red;'>Date is invalid <a href='payment.php'>Go back</a></h1>";
            exit;
        }
        
            $customerID = $_SESSION['currentID'];
            $grandTotal = $_SESSION['grandTotal'];
            $payment_status = "Y";
            $order_status = "Success";

            $sql = "INSERT INTO CustomerOrders (total_price,customer_id, payment_status, order_status)
                    VALUES ('$grandTotal', '$customerID', '$payment_status', '$order_status')";
                   
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                                           
            $order_id = $pdo->lastInsertId();

            $cart = $_SESSION['cart'];
            foreach ($cart as $item) {
				$pizzaID = $item['pizzaID'];
                $crustID = $item['crustID'];
                $sizeID = $item['sizeID'];
				$quantity = $item['quantity'];
				$line_total = $item['total'];

				$detailsSql = "INSERT INTO OrderDetails (order_id, pizza_id, crust_id,size_id,quantity, line_total_price)
						VALUES ('$order_id', '$pizzaID','$crustID','$sizeID','$quantity', '$line_total')";
				$stmt = $pdo->prepare($detailsSql);
				$stmt->execute();

                 header('Location:  orderConfirm.php');

            }
                 unset($_SESSION['cart']);
                 unset($_SESSION['grandTotal']);
			

        exit;

 }

?>