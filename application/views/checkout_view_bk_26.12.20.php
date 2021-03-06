<div class="container-fluid pt-4 pb-4">
<div class="container pt-4 pb-4">
    <h1>Checkout</h1>
      <div class="row">
    
    </div>

 <div class="row">        
        <div class="col-md-6 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form name="checkout_form_id" id="checkout_form_id" action="<?php echo base_url();?>checkout/checkout_submit_data" method="post"  class="needs-validation" novalidate="">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Name</label>
                <input type="text" class="form-control" id="bil_name" name="bil_name" placeholder="Enter your Name" value="<?php echo @$user_billing_address_details[0]->name; ?>" >
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Email</label>
                <input type="text" class="form-control" id="bil_email" name="bil_email" placeholder="Enter your Email" value="<?php echo @$user_billing_address_details[0]->email; ?>" >
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Contact No</label>
              <div class="input-group">                
                <input type="text" class="form-control" id="bil_phone" name="bil_phone" placeholder="Enter your Contact No" value="<?php echo @$user_billing_address_details[0]->phone; ?>" >
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Flat No <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="bil_flat_house_floor_building" name="bil_flat_house_floor_building" placeholder="Flat No" value="<?php echo @$user_billing_address_details[0]->flat_house_floor_building; ?>">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Locality </label>
              <textarea class="form-control" id="bil_locality" name="bil_locality" placeholder="Locality"><?php echo @$user_billing_address_details[0]->locality; ?></textarea>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Pincode </label>
              <input type="text" class="form-control" id="bil_pincode" name="bil_pincode" placeholder="Enter your Contact No" value="<?php echo @$user_billing_address_details[0]->pincode; ?>" >
            </div>

            <div class="mb-3"><label for="address2">Address Type </label><select class="custom-select d-block w-100" id="bil_address_type" name="bil_address_type" > 
                                     
                                      <option value="Home" >Home</option>
                                      <option value="Office" >Office</option>
                                </select></div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="bil_country" name="bil_country" >
                   <option value="">Select Country</option>
                                     
                                      <option value="India" <?php 

                                      if(@$user_billing_address_details[0]->country=='India'){echo 'selected';}?>   >India</option>
                                    
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <!--  <input type="text" class="form-control" id="bil_state" name="bil_state" placeholder="Enter State" value="<?php echo @$user_billing_address_details[0]->state; ?>" > -->

                 <select class="custom-select d-block w-100" id="bil_state" name="bil_state"  onchange="calculate_gst(this.value);" >
                   <option value="">Select State</option>
                                     <?php foreach($bil_state_list as $row){?>
                                      <option value="<?php echo $row->name; ?>" <?php 

                                      if(@$user_billing_address_details[0]->state==$row->name){echo 'selected';}?>   ><?php echo $row->name; ?></option>
                                    <?php } ?>
                </select>


                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">City</label>
                 <input type="text" class="form-control" id="bil_city" name="bil_city" placeholder="Enter your City" value="<?php echo @$user_billing_address_details[0]->city; ?>" >
                <div class="invalid-feedback">
                  City required.
                </div>
              </div>
              </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" onclick="same_billing_address();" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Shipping address is not the same as my billing address</label>
            </div>
            <!-- <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div> -->
            <hr class="mb-4">
                    
                    <input type="hidden" class="form-control" id="checkbox_same_billing_out" name="checkbox_same_billing_out" placeholder="Enter State" value="" >

               <div id="show_shipping_address" ></div>
          
         
          </form>
        </div>

        <!--  <div class="col-md-6 order-md-1" id="show_shipping_address" ></div> -->


        <div class="col-md-6 order-md-2">
        <h4 class="mb-3">Additional information</h4>
        <div class="mb-3">
              <label for="order-notes">Order notes (optional)</label>
              <textarea class="form-control" id="order-notes" name="additional_information" onkeyup="change_additional_information();" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
        </div>



    </div>    
         <div class="row"> 
        <div class="col-md-12 order-md-1 mb-4 ">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
           Your order         
          </h4>
          <ul class="list-group mb-3" id="change_state_gst">

            <?php $cart = $this->cart->contents();

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


            foreach ($cart as $k=>$item){

              $product_details=  $this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

              $curr_subtotal = $item['price']*$item['qty']; 
             // echo number_format($curr_subtotal, 2);
              $grand_total = $grand_total + $curr_subtotal;


             ?>
           
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo @$product_details[0]->product_title .' ('.$item['qty'].')';?></h6>
              </div>
              <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format(@$item['price'], 2);?></span>
            </li>

          <?php } ?>

           <!--  <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Second product</h6>
              </div>
              <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> 80</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Third item</h6>
              </div>
              <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> 20</span>
            </li> -->
            <!--<li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>-->

             <?php 

            // echo strtolower(str_replace(' ','',@$user_billing_address_details[0]->state));

             if(strtolower(str_replace(' ','',@$user_billing_address_details[0]->state))== 'westbengal'){ 

                 $cgst_total= (($grand_total*$cgst)/100);
                 $sgst_total= (($grand_total*$sgst)/100);

                 $without_gst_total= ($grand_total-($cgst_total+$sgst_total));

                 } else{

                  $igst_total= (($grand_total*$igst)/100);

                  $without_gst_total= ($grand_total-$igst_total);


                 }   

                     ?>



             <li class="list-group-item d-flex justify-content-between">
              <span>Sub Total (INR)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($without_gst_total, 2);?></strong>
            </li>


          <?php if(strtolower(str_replace(' ','',@$user_billing_address_details[0]->state))== 'westbengal'){ 

                // $cgst_total= (($grand_total*$cgst)/100);
               //  $sgst_total= (($grand_total*$sgst)/100);    


           ?>

            <li class="list-group-item d-flex justify-content-between">
              <span>CGST (<?php echo $cgst;?>%)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($cgst_total, 2);?></strong>
            </li>

             <li class="list-group-item d-flex justify-content-between">
              <span>SGST (<?php echo $sgst;?>%)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($sgst_total, 2);?></strong>
            </li>

          <?php } else{

         // $igst_total= (($grand_total*$igst)/100); 
            ?>

            <li class="list-group-item d-flex justify-content-between">
              <span>IGST (<?php echo $igst;?>%)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($igst_total, 2);?></strong>
            </li>

          <?php  } ?>




            <li class="list-group-item d-flex justify-content-between">
              <span>Total (INR)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php 
              $alltotal =  $grand_total;
              echo number_format($alltotal, 2);
              ?></strong>
            </li>
          </ul>

          <!--<form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>-->

          <?php  $user_id = $this->session->userdata('user_session_id');

              $chk_user_wallet=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

               ?>


          <input type="hidden" class="form-control" name="dabit_amount" id="dabit_amount" value="<?php echo @$alltotal;?>"   placeholder="Enter Your Amount" />

           <input type="hidden" name="wallet_login_email" id="wallet_login_email" value="<?php echo @$chk_user_wallet[0]->email;?>">

          <input type="hidden" name="wallet_login_mobile" id="wallet_login_mobile" value="<?php echo @$chk_user_wallet[0]->phone;?>">



        </div>
        </div>
         <div class="row"> 
        <div class="col-md-12">
          <div class="col-md-6">
          <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">

               <div class="custom-control custom-radio">
                <input id="paypal" name="payment_type" value="cod" onclick="change_payment_type();" type="radio" class="custom-control-input" checked="" required="">
                <label class="custom-control-label" for="paypal">Cash On Delivery</label>
              </div>


              <div class="custom-control custom-radio">
                <input id="credit" name="payment_type" type="radio" value="online" onclick="change_payment_type();" class="custom-control-input"  required="">
                <label class="custom-control-label" for="credit">Debit/Credit card</label>
              </div>


              <?php 

               $my_amt=@$chk_user_wallet[0]->wallet_amount;
               if($my_amt<$alltotal){



                ?>

              <div class="custom-control custom-radio">
                <input id="debit2" name="payment_type" onclick="change_payment_type();" type="radio" value="wallet" class="custom-control-input" required="">
                <label class="custom-control-label" for="debit">Wallet</label>
              </div>

            <?php } else{?>

              <div class="custom-control custom-radio">
                <input id="debit" name="payment_type" onclick="change_payment_type();" type="radio" value="wallet" class="custom-control-input" required="">
                <label class="custom-control-label" for="debit">Wallet</label>
              </div>

            <?php } ?>


             
            </div>
          
            <!-- <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>  -->

                     
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12  col-md-3">
                <button class="btn btn-lg btn-block round-black-btn" onclick="Submit_checkout();" type="submit">Continue to checkout</button>
                </div>
                <div class="col-sm-12  col-md-3">
                  &nbsp;
                </div>
                <div class="col-sm-12  col-md-3">
                 &nbsp;
                </div>
                <hr class="mb-4">
                <div class="col-sm-12 col-md-3">
                  &nbsp;   
                </div>
            </div>

  
</div>
</div>


<script type="text/javascript">
function same_billing_address(){

 
        if($("#same-address").is(":checked"))
        {
          $("#checkbox_same_billing_out").val('same_not');

          $.ajax({
                type: "POST",
                dataType:'html',
                url:"<?php echo base_url(); ?>checkout/same_billing_address",
                data:{},
                success: function(data)
                {
                    $("#show_shipping_address").html(data);
      
                 }
             });
 
              

           // alert('okk');  
        } 
        else
        { 
           $("#checkbox_same_billing_out").val(''); 
           $("#show_shipping_address").html('');

        }

          }


      </script>
   

     <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

      <script type="text/javascript">
        
    



     function checkout_data_Submit_fm()
{

      

         var checkbox_same_billing_out=$("#checkbox_same_billing_out").val();       
        if (checkbox_same_billing_out=="")  
        {



        var bil_name=$("#bil_name").val();       
        if (bil_name=="") 
        {
            $('#bil_name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_name').removeClass('red_border').addClass('black_border');               
        }

        
        var bil_phone=$("#bil_phone").val();       
        if (bil_phone=="" || bil_phone.length<10) 
        {
            $('#bil_phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_phone').removeClass('red_border').addClass('black_border');               
        }
          var bil_email=$("#bil_email").val();       
        
         if (!isEmail(bil_email))
        {
            $('#bil_email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_email').removeClass('red_border').addClass('black_border');               
        }

         var bil_locality=$("#bil_locality").val();       
        if (bil_locality=="") 
        {
            $('#bil_locality').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_locality').removeClass('red_border').addClass('black_border');               
        }

         var bil_flat_house_floor_building=$("#bil_flat_house_floor_building").val();       
        if (bil_flat_house_floor_building=="") 
        {
            $('#bil_flat_house_floor_building').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_flat_house_floor_building').removeClass('red_border').addClass('black_border');               
        }

        var bil_pincode=$("#bil_pincode").val();       
        if (bil_pincode=="") 
        {
            $('#bil_pincode').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_pincode').removeClass('red_border').addClass('black_border');               
        }

         var bil_country=$("#bil_country").val();       
        if (bil_country=="") 
        {
            $('#bil_country').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_country').removeClass('red_border').addClass('black_border');               
        }

        var bil_state=$("#bil_state").val();       
        if (bil_state=="") 
        {
            $('#bil_state').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_state').removeClass('red_border').addClass('black_border');               
        }

         var bil_city=$("#bil_city").val();       
        if (bil_city=="") 
        {
            $('#bil_city').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#bil_city').removeClass('red_border').addClass('black_border');               
        }




         } 
        else 
        {


              var ship_name=$("#ship_name").val();       
        if (ship_name=="") 
        {
            $('#ship_name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_name').removeClass('red_border').addClass('black_border');               
        }

        
        var ship_phone=$("#ship_phone").val();       
        if (ship_phone=="" || ship_phone.length<10) 
        {
            $('#ship_phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_phone').removeClass('red_border').addClass('black_border');               
        }
          var ship_email=$("#ship_email").val();       
        
         if (!isEmail(ship_email))
        {
            $('#ship_email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_email').removeClass('red_border').addClass('black_border');               
        }

         var ship_locality=$("#ship_locality").val();       
        if (ship_locality=="") 
        {
            $('#ship_locality').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_locality').removeClass('red_border').addClass('black_border');               
        }

         var ship_flat_house_floor_building=$("#ship_flat_house_floor_building").val();       
        if (ship_flat_house_floor_building=="") 
        {
            $('#ship_flat_house_floor_building').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_flat_house_floor_building').removeClass('red_border').addClass('black_border');               
        }

        var ship_pincode=$("#ship_pincode").val();       
        if (ship_pincode=="") 
        {
            $('#ship_pincode').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_pincode').removeClass('red_border').addClass('black_border');               
        }

         var ship_country=$("#ship_country").val();       
        if (ship_country=="") 
        {
            $('#ship_country').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_country').removeClass('red_border').addClass('black_border');               
        }

        var ship_state=$("#ship_state").val();       
        if (ship_state=="") 
        {
            $('#ship_state').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_state').removeClass('red_border').addClass('black_border');               
        }

         var ship_city=$("#ship_city").val();       
        if (ship_city=="") 
        {
            $('#ship_city').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ship_city').removeClass('red_border').addClass('black_border');               
        }


                           
        }







}

function Submit_checkout()
  {

    var payment_type=  $("input[type='radio'][name='payment_type']:checked").val();
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#checkout_form_id').attr('onchange', 'checkout_data_Submit_fm()');
        $('#checkout_form_id').attr('onkeypress', 'checkout_data_Submit_fm()');

        checkout_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#checkout_form_id .red_border').length > 0)
        {

            $('#checkout_form_id .red_border:first').focus();
            $('#checkout_form_id .alert-error').show();
            return false;
        }


       else if (payment_type=='online'){
// var payment_method= ($('#paymethod').val());
var final_price=$('#dabit_amount').val();

  var amount = parseInt(final_price);
    var total = parseInt(amount*100);
    // var order_unique_id= ($('#order_id').val());
    var phone = ($('#wallet_login_mobile').val());
    var email = ($('#wallet_login_email').val());

   // alert(phone);
   //  alert(email);

var options = {
    "key": "rzp_live_LEAUu6VbaSlEZy",
    "amount": total,
   //  "currency": 'USD',
  //  "display_currency": 'USD', 
   //  "display_amount": final_price,    // 2000 paise = INR 20
    "name": "onlySpare ",
    "description": 'Wallet Credit Amount',

    "image": "<?php echo base_url();?>assets/frontend/images/ogo04.png",
    "handler": function (response){



            $("#checkout_form_id").submit();

    },
    "prefill": {
        "contact": phone,
        "email": email
    },
    
};


var rzp1 = new Razorpay(options);
$('#proceed_pay').html('Proceed to pay ');
                         rzp1.open();
                       //  e.preventDefault();
 


   

/*}
if(payment_method=='paypal'){

  $("#final_payment_form").submit();
  
    }*/


}




        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#checkout_form_id").submit();
      } 
  }





      </script>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">

  $(document).ready(function() { 

   

 change_payment_type();
   





});



function change_payment_type(){

 var payment_type=  $("input[type='radio'][name='payment_type']:checked").val();
 
 var base_url='<?php echo base_url(); ?>';

       $.ajax({
              
             url:base_url+'checkout/change_payment_type',
             data:{payment_type:payment_type},
              dataType: "html",
                type: "POST",

             success: function(data){

            //  alert(data);
              }
             });

 // alert('ok');

}

function change_additional_information(){

 var additional_information=  $("#order-notes").val();
 
 var base_url='<?php echo base_url(); ?>';

       $.ajax({
              
             url:base_url+'checkout/change_additional_information',
             data:{additional_information:additional_information},
              dataType: "html",
                type: "POST",

             success: function(data){

            //  alert(data);
              }
             });

 // alert('ok');

}

</script>



<script type="text/javascript">
  

  function calculate_gst(state){


 
 var base_url='<?php echo base_url(); ?>';

       $.ajax({
              
             url:base_url+'checkout/calculate_gst',
             data:{state:state},
              dataType: "html",
                type: "POST",

             success: function(data){

            $("#change_state_gst").html(data);
              }
             });

 // alert('ok');

}
</script>




     