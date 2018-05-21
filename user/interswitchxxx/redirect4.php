<?php


function print_r2($val)
{
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
}

session_start();

echo "<u><b>SESSION DATA CARRIED OVER</b></u></br>";
echo "SESSION</br>";
print_r2($_SESSION);
echo "POST</br>";
print_r2($_POST);
echo '</br>------------------------------------------------------------------</br></br>';

$subpdtid = 1076; // SANDBOX
//$subpdtid = 7189; // GAMECODE KENYA
//$subpdtid = 6205; // your product ID
//$subpdtid = 800;	//QUICKTELLER
$submittedamt = $_SESSION["amount"];
$submittedref = $_POST["txnref"];

        $nhash = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F" ; // the mac key sent to you
        //$nhash = "B57380CE4A0E45C50F1EB4D8899D061735A7AFAB0C3BD3AE90CFF5A2117962C177DCFC319AC35F49E5CA06B0DFAD83EB2E321E44CD35B7C502EFF84E45458524" ; // the mac key sent to you
        //$nhash = "41ED947295B9C90FC4667DBD2CB89D84ABC2DDE70BC7873FCB6EBA47193973D1D19B4F9DC63BE26A5CDBFB049686175A5754A73EE4B34257B63A832D1E2A984C" ; // GAMECODE KENYA
        $hashv = $subpdtid.$submittedref.$nhash;  // concatenate the strings for hash again
		$thash = hash('sha512',$hashv); 

		$parami = array(
				"productid"=>$subpdtid,
				"transactionreference"=>$submittedref,
				"amount"=>$submittedamt
		);
		$ponmo = http_build_query($parami);

$url = "https://sandbox.interswitchng.com/collections/api/v1/gettransaction.json?$ponmo"; // json
//$url = "https://webpay.interswitchng.com/collections/api/v1/gettransaction.json?$ponmo"; // LIVE

//$host = "webpay.interswitchng.com";
$host = "sandbox.interswitchng.com";

//webpay.interswitchng.com
$headers = array(
        "GET /HTTP/1.1",
        "Host: $host",
        "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
        "Accept: */* ",
        //"Content-type:  multipart/form-data",
        //"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", 
        "Accept-Language: en-us,en;q=0.5",
        //"Accept-Encoding: gzip,deflate",
        //"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
        "Keep-Alive: 300",
        "Connection: keep-alive",
        "Hash: " . $thash
    );        
echo '</br>------------------------------------------------------------------</br>';
echo "<u><b>Headers of Payment/Purchase Request</b></u></br>";
print_r2($headers);
echo '</br>------------------------------------------------------------------</br>';


echo "<u><b>COMPLETE REQUERY URL</b></u></br>";
echo $url;
echo '</br>------------------------------------------------------------------</br>';

$ch = curl_init();  //INITIALIZE CURL///////////////////////////////
//               

curl_setopt($ch, CURLOPT_PROXYUSERPWD,'john.bello:VioladagambA1%');
curl_setopt($ch, CURLOPT_PROXY,'172.16.10.20:8080');

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

	curl_close($ch);    //END CURL SESSION///////////////////////////////

	print_r2($json);
	// loop through the array nicely for your UI
}

session_write_close();

?>
	</br></br></br><a href="http://localhost/NewWebPAYX/">Home</a>
  </body>
</html>
