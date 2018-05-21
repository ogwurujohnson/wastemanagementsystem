<?php

function print_r2($val)
{
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
}
    session_start();

    echo "Post Details:";	print_r2($_POST);	echo "</br>";
    echo "Session Details:";	print_r2($_SESSION);	
	
	//$product_id = 6333;
	//$product_id = 1335;
	//$product_id = 6204;
	
	
	$pay_item_id = 101;
	
	$site_redirect_url = "http://localhost/NewWebPAYX/redirect4.php";
    //$txn_ref = "JB4005559";
    $txn_ref = "JB"  . intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) ); // random(ish) 7 digit int
    $_SESSION["txn_ref"] = $txn_ref;	
    //$mac    = "";
    
	//WebPAY DEMO MErchant
	//$product_id = 6713;	//JAMB LIVE
	//$product_id = 6713;
	$product_id = 1076;		//SANDBOX
	//$product_id = 7189;	//GAMECODE 
	//$mac    = "23E9657CA37675EDAE2F6A59EB3B729557E3241AB3AFFDC136017C95ABECA4AB36D20F205479E42CEC10ACBFF834F0CC2CA2759355B70598F24033716F257242";	//JAMB LIVE 6713
	$mac    = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";	//SANDBOX
	//$mac    = "41ED947295B9C90FC4667DBD2CB89D84ABC2DDE70BC7873FCB6EBA47193973D1D19B4F9DC63BE26A5CDBFB049686175A5754A73EE4B34257B63A832D1E2A984C";	//GAMECODE KENYA
    
	//QUICKTELLER
	//$product_id = 800;	//QUICKTELLER
	//$mac    = "B57380CE4A0E45C50F1EB4D8899D061735A7AFAB0C3BD3AE90CFF5A2117962C177DCFC319AC35F49E5CA06B0DFAD83EB2E321E44CD35B7C502EFF84E45458524";
    
	$amount = $_POST["amount"] * 100;
    $cust_id = $_POST["cust_id"];
    $hashv  = $txn_ref . $product_id . $pay_item_id . $amount . $site_redirect_url . $mac;
    $customerName = $_POST["FirstName"]." ".$_POST["LastName"];
    $hash  = hash('sha512',$hashv);       
    $_SESSION["amount"] = $amount;
	
	
	
	$url = "https://sandbox.interswitchng.com/collections/w/pay"; // SANDBOX
	//$url = "https://webpay.interswitchng.com/collections/w/pay"; // LIVE
    
?>

	<form method="post" action="<?php echo $url; ?>"> 
    <!-- REQUIRED HIDDEN FIELDS -->
    <input name="product_id" type="hidden" value="<?php echo $product_id; ?>" />
    <input name="cust_id" type="hidden" value="<?php echo $cust_id; ?>"/>
    <input name="cust_name" type="hidden" value="<?php echo $customerName; ?>" />
    <input name="pay_item_id" type="hidden" value="<?php echo $pay_item_id; ?>" />
    <input name="amount" type="hidden" value="<?php echo $amount; ?>" />
    <input name="currency" type="hidden" value="566" />
    <input name="site_redirect_url" type="hidden" value="<?php echo $site_redirect_url; ?>" />
    <input name="txn_ref" type="hidden" value="<?php echo $txn_ref; ?>" />
    <input name="hash" type="hidden" id="hash" value="<?php echo $hash;  ?>" />
	<!-- <input name="channel_provider" type="hidden" value="BBM" /> -->
    </br></br>
    <a href="http://localhost/demopay4/">Back</a>
    <input type="submit" value="Make Payment"></input>
</form> 