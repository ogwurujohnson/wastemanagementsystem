<?php
	require('db.php');
	$amount = $_GET['amount'];
	$user_id = $_GET['user_id'];
	
	
	$query = "INSERT into tblpayments (Amount,User_Id) VALUES ('$amount','$user_id')";
	$insert_v = mysqli_query($conn,$query);

    $query = "UPDATE tblwallet SET balance = balance + $amount WHERE user_id = $user_id ";
    $insert_v = mysqli_query($conn,$query);
    $sql1 = "INSERT into tblcreditdebit (user_id,transaction_description,transaction_type,amount) VALUES ('$user_id','Wallet Funding','credit','$amount')";
    $res1 = mysqli_query($conn,$sql1);
	if ($insert_v){
		header('Location: http://localhost/gafista/user/uvwallet.html');
	}
?>