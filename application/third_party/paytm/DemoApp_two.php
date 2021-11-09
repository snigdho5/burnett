<?php
    

    /** Enable error reporting */
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');

   // echo (__DIR__);
    //exit;

    /** Creating SDK level constant */
    //define('PROJECT', realpath((__DIR__) . '/vendor/paytm/paytm-pg'));

    define('PROJECT', realpath((__DIR__)));

 

    require_once("./PaytmChecksum.php");

      function generateRandomString($count)
        {

            $ALPHA_NUMERIC_STRING = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $charactersLength = strlen($ALPHA_NUMERIC_STRING);
            $rand = '';
            for ($i = 0; $i < $count; $i++) {
                $rand .= $ALPHA_NUMERIC_STRING[rand(0, $charactersLength - 1)];
            }
            return $rand;
        }


   $mid = "SET IT";
   $key = "SET IT";

  $order_id =  generateRandomString(4);
  $order_id = "ORDERID_".$order_id;

  $paytmParams = array();

$paytmParams["body"] = array(
    "requestType"   => "Payment",
    "mid"           => $mid,
    "websiteName"   => "WEBSTAGING",
    "orderId"       => $order_id,
    "callbackUrl"   => "https://orionedutech.co.in/zoom_web_demo/paytm/Validatepayment.php",
    "txnAmount"     => array(
        "value"     => "1.00",
        "currency"  => "INR",
    ),
    "userInfo"      => array(
        "custId"    => "CUST_001",
    ),
);

/*
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $key);

$paytmParams["head"] = array(
    "signature"    => $checksum
);

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$order_id";

/* for Production */
// $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$order_id";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
$response = curl_exec($ch);

$json_object  = json_decode($response,true);
$txnToken  =  $json_object['body']['txnToken'];

/*
 echo "<pre>";
   print_r($json_object);
   echo "</pre>";

   */
 

     /* for Staging */
    $url = "https://securegw-stage.paytm.in/theia/api/v1/showPaymentPage?mid=$mid&orderId=$order_id";

   // header("Location: $url");
   // exit;

/* for Production */
   
   // $url = "https://securegw.paytm.in/theia/api/v1/showPaymentPage?mid=SJXLRj73095261468321&orderId=$order_id";



     ?>

       <html>
   <head>
      <title>Show Payment Page</title>
   </head>
   <body>
      <center>
         <h1>Please do not refresh this page...</h1>
      </center>
      <form method="post" action="<?php echo $url; ?>" name="paytm">
         <table border="1">
            <tbody>
               <input type="hidden" name="mid" value="<?php echo $mid; ?>">
               <input type="hidden" name="orderId" value="<?php echo $order_id; ?>">
               <input type="hidden" name="txnToken" value="<?php echo $txnToken; ?>">
            </tbody>
         </table>
         <script type="text/javascript"> document.paytm.submit(); </script>
      </form>
   </body>
</html>
