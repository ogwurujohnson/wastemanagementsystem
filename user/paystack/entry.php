<?php
	require('db.php');
	$amount = $_GET['amount'];
	$user_id = $_GET['user_id'];
	
	
	$query = "INSERT into tblpayments (Amount,User_Id) VALUES ('$amount','$user_id')";
	$insert_v = mysqli_query($conn,$query);

    $query = "UPDATE tblwallet SET balance = balance + $amount WHERE user_id = $user_id ";
    $insert_v = mysqli_query($conn,$query);
	if ($insert_v){
		header('Location: http://localhost/gafista/user/uvwallet.html');
	}
?>