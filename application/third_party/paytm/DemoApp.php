<?php
    /**
     * Copyright (C) 2019 Paytm.
     */

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
  $amount_inr = '1.00';

  $custId = "CC1"; 
  $mobile = "7278476247"; 
  $email = "gourab.singha@yahoo.in"; 
  $fname = "Gourab"; 
  $lname = "Singha"; 

  $paytmParams = array();

$paytmParams["body"] = array(
    "requestType"   => "Payment",
    "mid"           => $mid,
    "websiteName"   => "DEFAULT",
    "orderId"       => $order_id,
    "callbackUrl"   => "Validatepayment.php",
    "txnAmount"     => array(
        "value"     => $amount_inr,
        "currency"  => "INR",
    ),
    "userInfo"      => array(
         "custId"    => $custId,
         "mobile"    => $mobile,
         "email"    =>  $email,
         "firstName"    => $fname,
         "lastName"    =>  $lname,
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
//$url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$order_id";

/* for Production */
 $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$order_id";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
$response = curl_exec($ch);

$json_object  = json_decode($response,true);
$txnToken  =  $json_object['body']['txnToken'];

     /* for Staging */
    $url = "https://securegw-stage.paytm.in//merchantpgpui/checkoutjs/merchants/$mid.js";

/* for Production */

 //$url = "https://securegw.paytm.in//merchantpgpui/checkoutjs/merchants/$mid.js";
   
   // $url = "https://securegw.paytm.in/theia/api/v1/showPaymentPage?mid=$mid&orderId=$order_id";



     ?>







    <link href="https://developer.paytm.com/demo//static/css/style.css?v=1.9" rel="stylesheet" />
    
        <script type="application/javascript" src="https://securegw.paytm.in//merchantpgpui/checkoutjs/merchants/<?php echo $mid; ?>.js"></script>
    
  <button class="button" id="paytmWithPaytm">Pay with Paytm</button>

<script type="text/javascript">

    document.getElementById("paytmWithPaytm").addEventListener("click", function(){
        onScriptLoad("<?php echo $txnToken; ?>","<?php echo $order_id; ?>","<?php echo $amount_inr; ?>");
    });
    function onScriptLoad(txnToken, orderId, amount) {
        var config = {
            "root": "",
            "flow": "DEFAULT",
            "merchant":{
                 "name":"Smart Teaching HUB",
                 "logo":"https://smartteachinghub.com/uploads/app/logo.png",
                 "redirect": false,
             },
             "style":{
                 "headerBackgroundColor":"#8dd8ff",
                 "headerColor":"#3f3f40"
            },
            "data": {
                "orderId": orderId,
                "token": txnToken,
                "tokenType": "TXN_TOKEN",
                "amount": amount
            },
            "handler":{
                 "notifyMerchant": function (eventName, data) {
                    if(eventName == 'SESSION_EXPIRED'){
                        alert("Your session has expired!!");
                        location.reload();
                    }
                 },

                 "transactionStatus":function(data){
                      console.log("payment status ", data);  
                       alert("Payment Recived"+data.STATUS);
                   } 
            }

        };

        if (window.Paytm && window.Paytm.CheckoutJS) {
            // initialze configuration using init method
            window.Paytm.CheckoutJS.init(config).then(function onSuccess() {
                console.log('Before JS Checkout invoke');
                // after successfully update configuration invoke checkoutjs
                window.Paytm.CheckoutJS.invoke();
            }).catch(function onError(error) {
                console.log("Error => ", error);
            });
        }
    }
</script>

<footer>
    <div class="footer-bottom">
      <div class="lightBlue"></div>
      <div class="darkBlue"></div>
      <div class="linksdiv">
      <ul class="footerlinks">
        <li><a href="https://paytm.com/about-us/our-policies/" target="_blank">Terms of Service</li></a></li>
        <li><a href="https://paytm.com/about-us/our-policies/" target="_blank">Privacy Policy</a></li>
      </ul>
      </div>
      <div class="copyright footerlinks">
        <ul><li>© 2020, One97 Communications Pvt. Ltd</li></ul>
      </div>
    </div>
  </footer>
</body>
</html>
