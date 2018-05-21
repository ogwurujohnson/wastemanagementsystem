<?php
	$subpdtid = 1076; // your product ID is always constant
	
	//Form
	echo  '<form action="" method="post">';
	echo  	'Transaction Reference:<input type="text" name="txn_ref"/></br></br>';
	echo  	'Transaction Amount (N):<input type="text" name="amount"/></br></br>';
	echo  '<input type="submit" name="submit"/>';
	echo  '</form>';
	//HTML Form
	
	if(!empty($_POST['submit'])) 
	{
		$submittedamt = $_POST["amount"] * 100;	//submitted amount (eg 8353349)
		$submittedref = $_POST["txn_ref"];	//submitted transaction reference (eg 250OID100000164)
	  
		//Calculate HASH
		$mac = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F" ; // the mac key sent to you. Always constant.
		$string_to_hash = $subpdtid.$submittedref.$mac;  // concatenate the strings ("Prod_ID"."txn_ref"."mac") for hash again
        $hash = hash('sha512',$string_to_hash); 	//hash to be passed in header
		
		$query_elements = array(
			"productid"=>$subpdtid,
			"amount"=>$submittedamt,
			"transactionreference"=>$submittedref
			
		);
		$link_query_values = http_build_query($query_elements);
		
		$url = "https://sandbox.interswitchng.com/collections/api/v1/gettransaction.json?" . $link_query_values; // json
		
		
		echo '</br>------------------------------------------------------------------</br>';
		echo "<u><b>COMPLETE REQUERY URL</b></u></br>";
		echo $url;
		echo '</br>------------------------------------------------------------------</br>';

		
		//header details. Put hash here
		$headers = array(
						"GET /HTTP/1.1",
						"Host: sandbox.interswitchng.com",
						"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
						//"Content-type:  multipart/form-data",
						//"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", 
						"Accept-Language: en-us,en;q=0.5",
						//"Accept-Encoding: gzip,deflate",
						//"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
						"Keep-Alive: 300",
						"Connection: keep-alive",
						"Hash: $hash"	//hash value
                    );        
	   //print_r2($headers);
		$ch = curl_init();  //INITIALIZE CURL///////////////////////////////
//               

		//curl_setopt($ch, CURLOPT_PROXYUSERPWD,'john.bello:VioladagambA1%');
		//curl_setopt($ch, CURLOPT_PROXY,'172.16.10.20:8080');

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
		curl_setopt($ch, CURLOPT_POST, false );
//
		$data = curl_exec($ch);  //EXECUTE CURL STATEMENT///////////////////////////////
		$json = null;
		if (curl_errno($ch)) 
		{ 
			print "Error: " . curl_error($ch) . "</br></br>";
			
			$errno = curl_errno($ch);
			$error_message = curl_strerror($errno);
			print $error_message . "</br></br>";;
			
			print_r($headers);
		}
		else 
		{  
			// Show me the result
			$json = json_decode($data, TRUE);
			print_r2($json);
			curl_close($ch);    //END CURL SESSION///////////////////////////////
			
			//print_r(array_values($json));
			
/* 			// Display Array Elements///////////////
			echo "Transaction Amount: ".$json["Amount"]."</br>";
			echo "Card Number: ".$json["CardNumber"]."</br>";
			echo "Transaction Reference: ".$json["MerchantReference"]."</br>";
			echo "Payment Reference: ".$json["PaymentReference"]."</br>";
			echo "Retrieval Reference Number: ".$json["RetrievalReferenceNumber"]."</br>";
			echo "Lead Bank CBN Code:".$json["LeadBankCbnCode"]."</br>";
			//echo "Lead Bank Name: ".$json["LeadBankName"]."</br>";
			//echo "Split Accounts: ".$json["SplitAccounts"]."</br>";
			echo "Transaction Date: ".$json["TransactionDate"]."</br>";
			echo "Response Code: ".$json["ResponseCode"]."</br>";
			echo "Response Description: ".$json["ResponseDescription"]."</br>";	
			// //////Display Array Elements//////////// */
		}
                
		session_write_close();
	}
	else               
	{
		// Display the Form and the Submit Button
		echo "NO POST DATA";
	}	
	
	function print_r2($val)
{
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
}
?>
</br></br></br><a href="http://localhost/demopay4/">Home</a>