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
                <input type="hidden" name="mid" value="<?php echo PAYTM_MERCHANT_MID; ?>">
                <input type="hidden" name="orderId" value="<?php echo $order_id; ?>">
                <input type="hidden" name="txnToken" value="<?php echo $txnToken; ?>">
            </tbody>
        </table>
        <script type="text/javascript">
            document.paytm.submit();
        </script>
    </form>
</body>

</html>