<?php
// echo $transactionURL;
// print_obj($paytmParams);
// die;
?>
<html>

<head>
    <title>Merchant Checkout Page</title>
</head>

<body>
    <center>
        <h1>Please do not refresh this page...</h1>
    </center>
    <form method='post' action='<?php echo $transactionURL; ?>' name='f1'>
        <?php
        foreach ($paytmParams as $name => $value) {
            echo '<input type="text" name="' . $name . '" value="' . $value . '">';
        }
        ?>
    </form>
    <script type="text/javascript">
        //document.f1.submit();
    </script>
</body>

</html>