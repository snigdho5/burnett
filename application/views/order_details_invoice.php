<html>
<title>Invoice</title>
<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="width:670px;margin:20px auto 10px;background-color:#fff;padding:20px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #FE0000;">
    <thead>
      <tr>
        <th style="text-align:left;"><a href="#"><img style="max-width: 250px;" src="<?php echo base_url();?>assets/frontend/images/logo04.png" alt="Burnett Research Laboratory"></a></th>
        <th style="text-align:right;font-weight:400;"><strong><?php echo date('j M, Y', strtotime(@$order_list[0]->date));?></strong></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2" style="font-size:16px; padding:15px;">
          You have recived an order from Client Name. The is as follows:          
        </td>
        </tr>
        <tr>
        <td colspan="2" style="font-size:16px; padding:0 0 15px 15px;">
        <strong style="color:#FE0000;">Order #<?php echo @$order_list[0]->order_unique_id;?> (<?php echo date('M j, Y', strtotime(@$order_list[0]->date));?>)</strong>
        </td>        
      </tr>
      <tr>
        <td colspan="2" style="font-size:18px;padding:0 15px 0 15px;"><strong>Items</strong></td>
      </tr>
      <tr>
        <td colspan="2" style="padding:15px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="8" style="text-align:left; border-bottom:solid 1px #828282;  border-left:solid 1px #828282; font-size:14px;">
  <tr>
    <th style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">Product</th>
    <th style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">Quantity</th>
    <th style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">Price</th>
  </tr>
  
 <?php 

            $curr_subtotal = 0;
            $grand_total = 0;
            $cgst = 9;
            $sgst = 9;
            $igst = 18;

            $cgst_total = 0;
            $sgst_total = 0;
            $igst_total = 0;

            $without_gst_total = 0;
            $all_total = 0;

 foreach($order_details as $row){

 $product_details=  $this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

              $curr_subtotal = @$row->price* @$row->quantity; 
             // echo number_format($curr_subtotal, 2);
              $grand_total = $grand_total + $curr_subtotal;
 ?>
  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo @$product_details[0]->product_title;?></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo @$row->quantity;?></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo @$row->price;?></td>
  </tr>
  <?php } ?>
  <!-- <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">Product</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">2</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">400</td>
  </tr>-->

   <?php                            
                           $grand_total = $grand_total-@$order_list[0]->user_discount; 
                          $grand_total = $grand_total-@$order_list[0]->coupon_discount;

            

             if(strtolower(str_replace(' ','',@$order_list[0]->billing_state))== 'westbengal'){ 

                 $cgst_total= (($grand_total*$cgst)/100);
                 $sgst_total= (($grand_total*$sgst)/100);

                 $without_gst_total= ($grand_total-($cgst_total+$sgst_total));

                 } else{

                  $igst_total= (($grand_total*$igst)/100);

                  $without_gst_total= ($grand_total-$igst_total);


                 }   

                     ?>



<?php if(@$order_list[0]->user_discount !=0){?>
        <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>User Discount:</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo number_format(@$order_list[0]->user_discount, 2);?></td>
  </tr>

  <?php } ?>
   <?php if(@$order_list[0]->coupon_discount !=""){?>

  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>Coupon Discount:</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo number_format(@$order_list[0]->coupon_discount, 2);?></td>
  </tr>
  <?php } ?>





  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>Subtotal:</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo number_format($without_gst_total, 2);?></td>
  </tr>

   <?php if(strtolower(str_replace(' ','',@$order_list[0]->billing_state))== 'westbengal'){ 
   
           ?>




  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>CGST (<?php echo $cgst;?>%):</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo number_format($cgst_total, 2);?></td>
  </tr>
  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>SGST (<?php echo $sgst;?>%):</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo number_format($sgst_total, 2);?></td>
  </tr>

  <?php } else{
 
            ?>


  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>IGST (<?php echo $igst;?>%):</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php echo number_format($igst_total, 2);?></td>
  </tr>

  <?php  } ?>



  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>Total:</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php 
              $alltotal =  $grand_total;
              echo number_format($alltotal, 2);
              ?></td>
  </tr> 
<?php if(@$order_list[0]->pay_wallet_amount >0  ){ ?>
  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>Wallet Pay:</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php 
              
              echo number_format(@$order_list[0]->pay_wallet_amount, 2);
              ?></td>
  </tr> 

  <tr>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><strong>Due Amount:</strong></td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;">&nbsp;</td>
    <td style="border-top:solid 1px #828282;  border-right:solid 1px #828282;"><?php 
              $alltotal =  $grand_total;
              echo number_format(@$alltotal-@$order_list[0]->pay_wallet_amount, 2);
              ?></td>
  </tr> 

   <?php }?>


</table>

        </td>
      </tr>
    </tbody>
    <tfooter>
      <tr>
        <td style="font-size:12px; padding:30px 15px 0 15px;">
         <strong style="font-size:14px;">Address</strong><br>
         <?php echo $order_list[0]->billing_name;?><br><?php echo $order_list[0]->billing_city;?><br><?php echo $order_list[0]->billing_state;?><br><?php echo $order_list[0]->billing_country;?><br><?php echo $order_list[0]->billing_pincode;?><br>
        <?php echo $order_list[0]->billing_phone;?><br>
        <?php echo $order_list[0]->billing_email;?>
        </td>
        <td style="font-size:12px; padding:30px 15px 0 15px;">
         <strong style="font-size:14px;">Shipping Address</strong><br>
         <?php echo $shipping_address_details[0]->name;?><br><?php echo $shipping_address_details[0]->city;?><br><?php echo $shipping_address_details[0]->state;?><br><?php echo  $shipping_address_details[0]->country;?><br><?php echo  $shipping_address_details[0]->pincode;?><br>
        <?php echo $shipping_address_details[0]->phone;?><br>
        <?php echo $shipping_address_details[0]->email;?>
        </td>
      </tr>
      <tr>
      <td align="center" colspan="2" style="font-size:16px;padding:20px 15px 20px 15px;"> <strong>Congratulations on the sale</strong> </td>
      </tr>
    </tfooter>
  </table>
</body>

</html>