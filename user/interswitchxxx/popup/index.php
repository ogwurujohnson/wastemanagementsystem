<html>
<head>
  <script type="text/javascript" src="http://sandbox.interswitchng.com/collections/public/webpay.js"></script>
</head>
<?php
	//$subpdtid = 6205; // your product ID is always constant
	
	//Form
	echo  '<form action="" method="post">';
	echo  	'First Name:<input type="text" name="first_name"/></br></br>';
	echo  	'Last Name:<input type="text" name="last_name"/></br></br>';
	echo  	'Amount:<input type="text" name="amount"/></br></br>';
	echo  '<input type="submit" name="submit"/>';
	echo  '</form>';
	//HTML Form
	
	if(!empty($_POST['submit'])) 
	{

		$product_id = 1076;
		$pay_item_id = 101;
		$customerName = $_POST["first_name"]." ".$_POST["last_name"];
		$cust_id = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) );
		$amount = $_POST["amount"] * 100;	//submitted amount (eg 8353349)
		$txn_ref = "JB"  . intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) ); // random(ish) 7 digit int
		$site_redirect_url = "http://localhost/NewWebPAYX/popup/index.php";
		$mac = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";
		
		$hashv  = $txn_ref . $product_id . $pay_item_id . $amount . $site_redirect_url . $mac;
		$hash  = hash('sha512',$hashv); 
	
?>
-------------------------------------------------------------------------</br>
		<b>Complete Response</b>:- </br><p id="response"></p>
-------------------------------------------------------------------------</br>
		Response Description:- <b><a id="ResponseDescription"></a></b></br>
		Response Code:- <b><a id="ResponseCode"></a></b></br>
		Redirect URL:- <b><a id="RedirectURL"></a></b></br>
		Transaction Ref:- <b><a id="TransactionRef"></a></b></br>
		Approved Amount:- <b><a id="ApprovedAmount"></a></b></br>
		Returned Reference:- <b><a id="ReturnedReference"></a></b></br>
		Card Number:- <b><a id="CardNumber"></a></b></br>
		MAC:- <b><a id="MAC"></a></b></br>
-------------------------------------------------------------------------
		<script>

		  $(document).ready(function (){
			var iswPay = new IswPay({
				  postUrl:"https://sandbox.interswitchng.com/collections/w/pay",
				  amount: <?php echo $amount; ?>,
				  productId: "<?php echo $product_id; ?>",
				  transRef: "<?php echo $txn_ref; ?>",
				  siteName: "test merchant site",
				  itemId: "<?php echo $pay_item_id; ?>",
				  customerId: "<?php echo $cust_id; ?>",
				  siteRedirectUrl: "<?php echo $site_redirect_url; ?>",
				  currency: "NGN",
				  hash: "<?php echo $hash; ?>",
				  onComplete : function (paymentResponse)
				  {
					  console.log(paymentResponse);MAC
					  
					  var myObject = JSON.stringify(paymentResponse);
					  document.getElementById("response").innerHTML = myObject;
					  
					  document.getElementById("ResponseDescription").innerHTML = paymentResponse.desc;
					  document.getElementById("ResponseCode").innerHTML = paymentResponse.resp;
					  document.getElementById("RedirectURL").innerHTML = paymentResponse.url;
					  document.getElementById("TransactionRef").innerHTML = paymentResponse.txnref;
					  document.getElementById("ApprovedAmount").innerHTML = paymentResponse.apprAmt;
					  document.getElementById("ReturnedReference").innerHTML = paymentResponse.retRef;
					  document.getElementById("CardNumber").innerHTML = paymentResponse.cardNum;
					  document.getElementById("MAC").innerHTML = paymentResponse.mac;
					  
				  }
			  });
			});
      </script>  
		
<?php
}

function print_r2($val)
{
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
}
?>

</body>
</html>