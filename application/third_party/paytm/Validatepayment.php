<?php
require_once("./PaytmChecksum.php");

$mid = "SET IT";
$key = "SET IT";

$paytmParams = $_POST;
$user_order_id  = $_POST['ORDERID']; 
$payment_status  = $_POST['STATUS']; 
$paytmChecksum = $_POST['CHECKSUMHASH'];
unset($paytmParams['CHECKSUMHASH']);
$verifySignature = PaytmChecksum::verifySignature( $paytmParams , $key, $paytmChecksum);
//echo sprintf("generateSignature Returns: %s\n", $paytmChecksum);
//echo "<br />";
//echo sprintf("verifySignature Returns: %b\n\n", $verifySignature);

if($verifySignature) {
    echo "Checksum Matched";
    if($payment_status=='TXN_SUCCESS'){

  echo "<br /> Payment scuccess ";
    }else{

       echo "<br /> Payment Failed "; 
    }

} else {
   echo "Checksum Mismatched";
}
exit;

