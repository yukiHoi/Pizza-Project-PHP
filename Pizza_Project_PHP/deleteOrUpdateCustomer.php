<?php
session_start();
require 'pdo_connection.php';

If(isset($_POST['updateCustomer']) || isset($_POST['delete'])){
		
		if(isset($_POST['updateCustomer'])){
		 $currentCustomerID = $_SESSION['currentID'];

		$sql = "update customer set first_name=:cfirst_name, last_name=:clast_name, email=:cemail, phone_no=:cphone, address= :caddress, county=:ccounty, town=:ctown, eircode=:ceircode 
				WHERE customer_id = '$currentCustomerID'";

		$result = $pdo->prepare($sql);
		
		$result->bindValue(':cfirst_name', $_POST['cfirstName']); 
		$result->bindValue(':clast_name', $_POST['clastName']);
		$result->bindValue(':cemail', $_POST['cemail']);
		$result->bindValue(':cphone', $_POST['cphone']);
		$result->bindValue(':caddress', $_POST['caddress']);
		$result->bindValue(':ccounty', $_POST['ccounty']);
		$result->bindValue(':ctown', $_POST['ctown']);
		$result->bindValue(':ceircode', $_POST['ceircode']);

		$result->execute();
		$count = $result->rowCount(); 

		if ($count > 0)
		{
			 print "<h2 style='color: green;'>Update successfully Click <a href='myProfile.php'>here</a> to go back</h1>";
		}
		else
		{
			echo "nothing updated";
		}
		}
		if(isset($_POST['delete'])){
			 $currentCustomerID = $_SESSION['currentID'];

			 $sql1= "SELECT order_id FROM customerOrders WHERE customer_id = '$currentCustomerID' ";
			 $result1 = $pdo->prepare($sql1);
			 $result1->execute();
			 $orderID = $result1->fetchAll(PDO::FETCH_COLUMN, 0); // Fetch all order IDs as an array)

			foreach ($orderID as $id){
				$sql2 = "DELETE FROM orderDetails WHERE order_id = '$id'";
				$result2 = $pdo->prepare($sql2);
				$result2->execute();
			} 
			 $sql3= "DELETE FROM customerOrders WHERE customer_id = '$currentCustomerID'";
			 $result3 = $pdo->prepare($sql3);
			 $result3->execute();

			$sql4 = "DELETE FROM customer WHERE customer_id = '$currentCustomerID'";
			$result4 = $pdo->prepare($sql4);
			$result4->execute();
			$count = $result4->rowCount();
			if ($count > 0)
			{
				print "<h2 style='color: green;'>Delete successfully Click <a href='index.php'>here</a> to go back Home Page</h1>";
				
			}
			else
			{
				echo "nothing deleted";
			}
		}
}

$pdo = null;
?>

