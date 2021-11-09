<?php $this->load->view('common/header');
$cart = $this->cart->contents();
//echo '<pre>'; print_r($cart); echo '</pre>'; 
?>
<div class="container-fluid pt-4 pb-4">
<div class="container pt-4 pb-4">
<?php
$signup_success = $this->session->flashdata('cart_info');
if($signup_success!=""){ ?>
<div class="alert top-alert-success">
<?php echo $signup_success;?> </div>
<?php }	?>
    <h1>Cart</h1>
      <div class="row">
    
    </div>
<?php if(empty($cart)) { ?>
<div class="row">
<div class="col-sm-12 col-md-8 col-lg-12 no-cart">
   <div class="bg-col row">
	  <h4 class=""><i class="fas fa-shopping-cart"></i> No item in your cart!</h4>
   </div>
</div>
</div>
<?php } else { ?>
 <div class="row">
        <div class="col-12">
            <div class="table-responsive cart-main">
            <?php echo form_open('cart/update_cart', 'id="frmupdatecart"'); ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th width="8%" scope="col"> </th>
                            <th scope="col" colspan="2">Product</th>  
                            <th scope="col" class="text-right">Price</th>                         
                            <th scope="col" class="text-left">Quantity</th>
                            <th scope="col" class="text-right">Total</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
						$curr_subtotal = 0;
						$grand_total = 0;
						$cgst_total = 0;
						$sgst_total = 0;
						$shipping_cost = 0;
						foreach ($cart as $k=>$item):
						if($this->product_model->is_product($item['id'])>0)
						{
                        $product_details = $this->product_model->product_details_by_id($item['id']);
                        echo form_hidden('cart[' . $item['rowid'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['rowid'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['rowid'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['rowid'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['rowid'] . '][qty]', $item['qty']);
						//echo '<pre>'; print_r($product_details); echo '</pre>'; 
                        ?>
                        <tr>
                            <td class="product_cart_img"><img src="<?php echo base_url().'uploads/product/small/'.$product_details[0]->product_image;?>" /> </td>
                            <td colspan="2"><?php echo $product_details[0]->product_title; ?>
                            <?php if(isset($item['size']) && $item['size'] != ''){?>
                            <br /><strong>Size: <?php echo $item['size'];?></strong>
                            <?php } ?>
                            </td> 
                            <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($item['price'], 2);?></td>                          
                            <td class="product-count"><div class="display-flex">
							    <div class="qtyminus" id="qtyminus_<?php echo $item['rowid'];?>">-</div>
							    <input type="text" name="cart[<?php echo $item['rowid']?>][qty]" value="<?php echo $item['qty'];?>" class="qty" id="qty_<?php echo $item['rowid'];?>">
							    <div class="qtyplus" id="qtyplus_<?php echo $item['rowid'];?>">+</div>
							</div></td>
                            <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php 
							$curr_subtotal = $item['price']*$item['qty']; 
							echo number_format($curr_subtotal, 2);
							$grand_total = $grand_total + $curr_subtotal;
							?>
                            </td>
                            <td class="text-right"><a href="<?php echo base_url()?>cart/remove/<?=$item['rowid']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php
						}
						else
						{
							$this->cart->remove($k);
						}
						endforeach;
						?>
                        
                        
                        <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($grand_total, 2);?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td>Shipping</td>
                            <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($shipping_cost, 2);?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong><i class="fa fa-inr" aria-hidden="true"></i> <?php 
							$alltotal =  $grand_total + $shipping_cost + $sgst_total + $cgst_total;
							echo number_format($alltotal, 2);
							?></strong></td>
                        </tr>
                    </tbody>
                </table>
            <?php echo form_close(); ?>
            </div>
        </div>
        <div class="col mb-2">
         <div class="row">
            <div class="col-sm-12  col-md-3">
                  &nbsp;
                </div>
                <div class="col-sm-12  col-md-3">
                  &nbsp;
                </div>
                <div class="col-sm-12  col-md-3">
                    &nbsp;
                </div>
                <div class="col-sm-12 col-md-3 text-right">
                    <button class="btn btn-lg btn-block round-black-btn text-uppercase" id="btnupdatecart">Update cart</button>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-12  col-md-3">
                    <button class="btn btn-block btn-light round-black-btn">Continue Shopping</button>
                </div>
            <div class="col-sm-12  col-md-3">
                  &nbsp;
                </div>
                <div class="col-sm-12  col-md-3">
                  &nbsp;
                </div>
                
                <div class="col-sm-12 col-md-3 text-right">
                   <!--  <button class="btn btn-lg btn-block round-black-btn text-uppercase">Checkout</button> -->

                     <button class="btn btn-lg btn-block round-black-btn text-uppercase" onclick="go_to_checkout();" >Checkout</button>

                   


                </div>
            </div>
        </div>
    </div>
<?php } ?>

  
</div>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
$(document).ready(function() {
	$("#btnupdatecart").on("click",function(){
		$("#frmupdatecart").submit();
	});
	<?php foreach ($cart as $k=>$item){?>
	$("#qtyminus_<?php echo $item['rowid'];?>").on("click",function(){
		var now = $("#qty_<?php echo $item['rowid'];?>").val();
		if ($.isNumeric(now)){
			if (parseInt(now) -1> 0)
			{ now--;}
			$("#qty_<?php echo $item['rowid'];?>").val(now);
		}
	})            
	$("#qtyplus_<?php echo $item['rowid'];?>").on("click",function(){
		var now = $("#qty_<?php echo $item['rowid'];?>").val();
		if ($.isNumeric(now)){
			$("#qty_<?php echo $item['rowid'];?>").val(parseInt(now)+1);
		}
	});
	<?php }?>
});
</script>



<script type="text/javascript">
    
    function go_to_checkout(){
        window.location.href="<?php echo base_url();?>checkout";
    }
</script>