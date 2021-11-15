<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Checkout extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    @session_start();
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");
    $this->load->database();
    $this->load->model('common_my_model');
    $this->load->library('pagination');
    $this->load->library('email');
    // $this->load->library('Stack_web_gateway_paytm_kit');
  }

  public function index()
  {

    $user_id = $this->session->userdata('user_session_id');

    if ($user_id == '') {
      redirect(base_url() . 'user-registation/checkout', 'refresh');
    }

    $cart = $this->cart->contents();

    if (count(@$cart) == 0) {
      redirect(base_url() . 'product-list', 'refresh');
    }


    // foreach ($cart as $k => $item) {
    //   $product_id = $item['id'];
    //   // echo number_format($curr_subtotal, 2);
    // }


    // echo($id_check);
    // print_obj($cart);die;

    // $data['product_list'] = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('status' => '1', 'product_id' => $product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


    // print_obj($data['product_list']);die;

    $data['user_billing_address_details'] =  $this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('user_id' => $user_id, 'default_billing' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['seo_content_details'] =  $this->common_my_model->common($table_name = 'seo_module', $field = array(), $where = array('seo_module_id' => '11'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    // $data['bil_country_list']=$this->common_my_model->common($table_name = 'country', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $data['bil_state_list'] = $this->common_my_model->common($table_name = 'states', $field = array(), $where = array('country_id' => '101'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


    $this->load->view('common/header', $data);
    $this->load->view('checkout_view', $data);
    $this->load->view('common/footer');
  }


  public function same_billing_address()
  {
    // $country_list=$this->common_my_model->common($table_name = 'country', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $state_list = $this->common_my_model->common($table_name = 'states', $field = array(), $where = array('country_id' => '101'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
?>

    <h4 class="mb-3">Shipping address</h4>
    <form class="needs-validation" novalidate="">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="firstName">Name</label>
          <input type="text" class="form-control" id="ship_name" name="ship_name" placeholder="Enter your Name" value="">
          <div class="invalid-feedback"> Valid first name is required.</div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="lastName">Email</label>
          <input type="text" class="form-control" id="ship_email" name="ship_email" placeholder="Enter your Email" value="">
          <div class="invalid-feedback">Valid last name is required.</div>
        </div>
      </div>
      <div class="mb-3">
        <label for="username">Contact No</label>
        <div class="input-group">
          <input type="text" class="form-control" id="ship_phone" name="ship_phone" placeholder="Enter your Contact No" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" value="">
          <div class="invalid-feedback" style="width: 100%;">Your username is required.</div>
        </div>
      </div>
      <div class="mb-3">
        <label for="email">Flat No <span class="text-muted">(Optional)</span></label>
        <input type="email" class="form-control" id="ship_flat_house_floor_building" name="ship_flat_house_floor_building" placeholder="Flat No" value="">
        <div class="invalid-feedback">Please enter a valid email address for shipping updates.</div>
      </div>
      <div class="mb-3">
        <label for="address">Locality </label>
        <textarea class="form-control" id="ship_locality" name="ship_locality" placeholder="Locality"></textarea>
        <div class="invalid-feedback"> Please enter your shipping address.</div>
      </div>
      <div class="mb-3">
        <label for="address2">Pincode </label>
        <input type="text" class="form-control" id="ship_pincode" name="ship_pincode" placeholder="Enter your Pincode" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" value="">
      </div>
      <div class="mb-3">
        <label for="address2">Address Type </label>
        <select class="custom-select d-block w-100" id="ship_address_type" name="ship_address_type">
          <option value="Home">Home</option>
          <option value="Office">Office</option>
        </select>
      </div>
      <div class="row">
        <div class="col-md-5 mb-3">
          <label for="country">Country</label>
          <select class="custom-select d-block w-100" id="ship_country" name="ship_country">
            <option value="">Select Country</option>
            <option value="India">India</option>
          </select>
          <div class="invalid-feedback">Please select a valid country.</div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="state">State</label>
          <!-- <input type="text" class="form-control" id="ship_state" name="ship_state" placeholder="Enter State" value="" > -->
          <select class="custom-select d-block w-100" id="ship_state" name="ship_state">
            <option value="">Select State</option>
            <?php foreach ($state_list as $row) { ?>
              <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
          </select>
          <div class="invalid-feedback">Please provide a valid state.</div>
        </div>
        <div class="col-md-3 mb-3">
          <label for="zip">City</label>
          <input type="text" class="form-control" id="ship_city" name="ship_city" placeholder="Enter City" value="">
          <div class="invalid-feedback">City required.</div>
        </div>
      </div>
      <?php
    }




    public function change_default_bill_address()
    {

      $default_bill_address = $this->input->post('default_bill_address');
      $user_id = $this->session->userdata('user_session_id');
      $state_list = $this->common_my_model->common($table_name = 'states', $field = array(), $where = array('country_id' => '101'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
      if ($default_bill_address == 'set_default') {

        $user_billing_address_details =  $this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('user_id' => $user_id, 'default_billing' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
      ?>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Name</label>
            <input type="text" class="form-control" id="bil_name" name="bil_name" placeholder="Enter your Name" value="<?php echo @$user_billing_address_details[0]->name; ?>" readonly>
            <div class="invalid-feedback"> Valid first name is required. </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Email</label>
            <input type="text" class="form-control" id="bil_email" name="bil_email" placeholder="Enter your Email" value="<?php echo @$user_billing_address_details[0]->email; ?>" readonly>
            <div class="invalid-feedback"> Valid last name is required. </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="username">Contact No</label>
          <div class="input-group">
            <input type="text" class="form-control" id="bil_phone" name="bil_phone" placeholder="Enter your Contact No" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" value="<?php echo @$user_billing_address_details[0]->phone; ?>" readonly>
            <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Flat No <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="bil_flat_house_floor_building" name="bil_flat_house_floor_building" placeholder="Flat No" value="<?php echo @$user_billing_address_details[0]->flat_house_floor_building; ?>" readonly>
          <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
        </div>
        <div class="mb-3">
          <label for="address">Locality </label>
          <textarea class="form-control" id="bil_locality" name="bil_locality" placeholder="Locality" readonly><?php echo @$user_billing_address_details[0]->locality; ?></textarea>
          <div class="invalid-feedback"> Please enter your shipping address. </div>
        </div>
        <div class="mb-3">
          <label for="address2">Pincode </label>
          <input type="text" class="form-control" id="bil_pincode" name="bil_pincode" placeholder="Enter your Pincode" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" value="<?php echo @$user_billing_address_details[0]->pincode; ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="address2">Address Type </label>

          <!-- <select class="custom-select d-block w-100" id="bil_address_type" name="bil_address_type" > 
                                     
                                      <option value="Home" >Home</option>
                                      <option value="Office" >Office</option>
                                </select> -->
          <input type="text" class="form-control" id="bil_address_type" name="bil_address_type" placeholder="Enter address type" value="<?php echo @$user_billing_address_details[0]->address_type; ?>" readonly>
        </div>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <!-- <select class="custom-select d-block w-100" id="bil_country" name="bil_country" >
                   <option value="">Select Country</option>
                    <option value="India" <?php if (@$user_billing_address_details[0]->country == 'India') {
                                            echo 'selected';
                                          } ?>   >India</option>
                </select> -->
            <input type="text" class="form-control" id="bil_country" name="bil_country" placeholder="Enter Country" value="<?php echo @$user_billing_address_details[0]->country; ?>" readonly>
            <div class="invalid-feedback"> Please select a valid country. </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>

            <!-- <select class="custom-select d-block w-100" id="bil_state" name="bil_state"  onchange="calculate_gst(this.value);" >
                   <option value="">Select State</option>
                        <?php foreach ($state_list as $row) { ?>
                                      <option value="<?php echo $row->name; ?>" <?php if (@$user_billing_address_details[0]->state == $row->name) {
                                                                                  echo 'selected';
                                                                                } ?>   ><?php echo $row->name; ?></option>
                      <?php } ?>
                </select>  -->

            <input type="text" class="form-control" id="bil_state" name="bil_state" placeholder="Enter State" value="<?php echo @$user_billing_address_details[0]->state; ?>" readonly>
            <div class="invalid-feedback"> Please provide a valid state. </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">City</label>
            <input type="text" class="form-control" id="bil_city" name="bil_city" placeholder="Enter City" value="<?php echo @$user_billing_address_details[0]->city; ?>" readonly>
            <div class="invalid-feedback"> City required. </div>
          </div>
        </div>
      <?php
      } else {
      ?>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Name</label>
            <input type="text" class="form-control" id="bil_name" name="bil_name" placeholder="Enter your Name" value="">
            <div class="invalid-feedback"> Valid first name is required. </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Email</label>
            <input type="text" class="form-control" id="bil_email" name="bil_email" placeholder="Enter your Email" value="">
            <div class="invalid-feedback"> Valid last name is required. </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="username">Contact No</label>
          <div class="input-group">
            <input type="text" class="form-control" id="bil_phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" name="bil_phone" placeholder="Enter your Contact No" value="">
            <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Flat No <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="bil_flat_house_floor_building" name="bil_flat_house_floor_building" placeholder="Flat No" value="">
          <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
        </div>
        <div class="mb-3">
          <label for="address">Locality </label>
          <textarea class="form-control" id="bil_locality" name="bil_locality" placeholder="Locality"></textarea>
          <div class="invalid-feedback"> Please enter your shipping address. </div>
        </div>
        <div class="mb-3">
          <label for="address2">Pincode </label>
          <input type="text" class="form-control" id="bil_pincode" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" name="bil_pincode" placeholder="Enter your Pincode" value="">
        </div>
        <div class="mb-3">
          <label for="address2">Address Type </label>
          <select class="custom-select d-block w-100" id="bil_address_type" name="bil_address_type">
            <option value="Home">Home</option>
            <option value="Office">Office</option>
          </select>
        </div>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" id="bil_country" name="bil_country">
              <option value="">Select Country</option>
              <option value="India">India</option>
            </select>
            <div class="invalid-feedback"> Please select a valid country. </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <!--  <input type="text" class="form-control" id="bil_state" name="bil_state" placeholder="Enter State" value="<?php echo @$user_billing_address_details[0]->state; ?>" > -->

            <select class="custom-select d-block w-100" id="bil_state" name="bil_state" onchange="calculate_gst(this.value);">
              <option value="">Select State</option>
              <?php foreach ($state_list as $row) { ?>
                <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
              <?php } ?>
            </select>
            <div class="invalid-feedback"> Please provide a valid state. </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">City</label>
            <input type="text" class="form-control" id="bil_city" name="bil_city" placeholder="Enter City" value="">
            <div class="invalid-feedback"> City required. </div>
          </div>
        </div>
      <?php
      }
    }


    function checkout_submit_data()
    {

      $user_id = $this->session->userdata('user_session_id');
      $payment_type = $this->session->userdata('payment_type_session_id');
      $checkbox_same_billing_out = $this->input->post('checkbox_same_billing_out');


      $mmy_wallet_pay = $this->session->userdata('session_wallet_pay');
      $wallet_pay_for_check = $this->session->userdata('session_wallet_pay_for_check');


      // print_obj($this->input->post());die;

      if ($checkbox_same_billing_out == 'same_not') {

        $name = $this->input->post('bil_name');
        $email = $this->input->post('bil_email');
        $phone = $this->input->post('bil_phone');

        // echo $name.$email.$phone.'<br/>';
        $locality = $this->input->post('bil_locality');
        $landmark = $this->input->post('bil_landmark');
        $city = $this->input->post('bil_city');
        $state = $this->input->post('bil_state');
        $country = $this->input->post('bil_country');
        $pincode = $this->input->post('bil_pincode');
        $address_type = $this->input->post('bil_address_type');
        $flat_house_floor_building = $this->input->post('bil_flat_house_floor_building');
        $additional_information = $this->session->userdata('additional_information_session_id');
        $current_date = date('Y-m-d H:i:s');

        $ship_name = $this->input->post('ship_name');
        $ship_email = $this->input->post('ship_email');
        $ship_phone = $this->input->post('ship_phone');
        $ship_locality = $this->input->post('ship_locality');
        $ship_landmark = $this->input->post('ship_landmark');
        $ship_city = $this->input->post('ship_city');
        $ship_state = $this->input->post('ship_state');
        $ship_country = $this->input->post('ship_country');
        $ship_pincode = $this->input->post('ship_pincode');
        $ship_address_type = $this->input->post('ship_address_type');
        $ship_flat_house_floor_building = $this->input->post('ship_flat_house_floor_building');
        $ship_additional_information = $this->session->userdata('additional_information_session_id');
        $ship_current_date = date('Y-m-d H:i:s');
      } else {

        $name = $this->input->post('bil_name');
        $email = $this->input->post('bil_email');
        $phone = $this->input->post('bil_phone');

        // echo $name.$email.$phone.'<br/>';
        $locality = $this->input->post('bil_locality');
        $landmark = $this->input->post('bil_landmark');
        $city = $this->input->post('bil_city');
        $state = $this->input->post('bil_state');
        $country = $this->input->post('bil_country');
        $pincode = $this->input->post('bil_pincode');
        $address_type = $this->input->post('bil_address_type');
        $flat_house_floor_building = $this->input->post('bil_flat_house_floor_building');
        $additional_information = $this->session->userdata('additional_information_session_id');
        $current_date = date('Y-m-d H:i:s');
      }

      // exit;

      // shiprocket
      $post['pickup_postcode'] = SHIPROCKET_PICKUP_PIN;
      $post['delivery_postcode'] = $pincode;
      $post['cod'] = 0;
      $post['weight'] = '0.5';
      $shipState = $this->shiprocket->serviceability($post);

      // print_obj($shipState);die;

      $user_billing_address_details =  $this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('user_id' => $user_id, 'default_billing' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      if ($checkbox_same_billing_out == 'same_not') {

        $data = array(

          'name' => $ship_name,
          'email' => $ship_email,
          'phone' => $ship_phone,
          'locality' => $ship_locality,
          'flat_house_floor_building' => $ship_flat_house_floor_building,
          'landmark' => $ship_landmark,
          'city' => $ship_city,
          'state' => $ship_state,
          'country' => $ship_country,
          'pincode' => $ship_pincode,
          'user_id' => $user_id,
          'address_type' => $ship_address_type,
          'additional_information' => $ship_additional_information,
          'create_dt' => $ship_current_date
        );  //echo '<pre>';	print_r($data); exit;

      } else {

        $data = array(

          'name' => $name,
          'email' => $email,
          'phone' => $phone,
          'locality' => $locality,
          'flat_house_floor_building' => $flat_house_floor_building,
          'landmark' => $landmark,
          'city' => $city,
          'state' => $state,
          'country' => $country,
          'pincode' => $pincode,
          'user_id' => $user_id,
          'address_type' => $address_type,
          'additional_information' => $additional_information,
          'create_dt' => $current_date
        );  //echo '<pre>';	print_r($data); exit;

      }


      $this->db->insert('user_shipping_address', $data);
      $shipping_address_id = $this->db->insert_id();

      /*----------billing data update-----------------*/

      $default_billing_data = array(

        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'locality' => $locality,
        'flat_house_floor_building' => $flat_house_floor_building,
        'landmark' => $landmark,
        'city' => $city,
        'state' => $state,
        'country' => $country,
        'pincode' => $pincode,
        // 'user_id'=>$user_id,
        'address_type' => $address_type,
        // 'additional_information'=>$additional_information,
        'create_dt' => $current_date
      );  //echo '<pre>';	print_r($data); exit;
      if (!empty($user_billing_address_details)) {
        $this->db->where('id', $user_billing_address_details[0]->id);
        $this->db->update('user_billing_address', $default_billing_data);
        /*----------billing data update-----------------*/
      }


      $order_cart = $this->cart->contents();
      $curr_subtotal = 0;
      $grand_total = 0;
      $cgst_total = 0;
      $sgst_total = 0;
      $shipping_cost = 0;

      foreach ($order_cart as $k => $item) {
        $curr_subtotal = ($item['price'] * $item['qty']) + $item['shipping_rate'];
        // echo number_format($curr_subtotal, 2);
        $grand_total = $grand_total + $curr_subtotal;
      }


      /*----- User Discount --------*/

      // $user_id = $this->session->userdata('user_session_id');
      $user_discount_details = $this->common_my_model->common($table_name = 'user_discount', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $userd_exp_date = @$user_discount_details[0]->exp_date;
      $userd_current_date = date('Y-m-d');
      $userd_current_date = strtotime($userd_current_date);
      $userd_exp_date = strtotime($userd_exp_date);
      $discount_hava = 0;
      $user_discount = 0;

      if (@$user_discount_details[0]->status == 1) {
        if ($userd_current_date <= $userd_exp_date) {

          if (@$user_discount_details[0]->total_use > 0) {
            if (@$user_discount_details[0]->discount_type == 'Persent') {
              $user_discount = (($grand_total * @$user_discount_details[0]->discount_amount) / 100);


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            } else {
              $user_discount = @$user_discount_details[0]->discount_amount;


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            }

            $data_user_discount = array('total_use' => @$user_discount_details[0]->total_use - 1);

            $this->db->where('user_id', $user_id);
            $this->db->update('user_discount', $data_user_discount);
          } else {
            $discount_hava = 0;
          }
        } else {
          $discount_hava = 0;
        }
      } else {
        $discount_hava = 0;
      }



      /*----- User Discount --------*/


      /*----- Coupon Discount --------*/

      $coupon_discount_hava = $this->session->userdata('coupon_discount_hava');
      $coupon_discount = $this->session->userdata('coupon_discount');

      $grand_total = $grand_total - $coupon_discount;

      /*----- Coupon Discount --------*/


      $upload_prescription = NULL;

      if (@$_FILES['upload_prescription']['name'] != "") {
        $new_name1 = str_replace(".", "", microtime());
        $new_name = str_replace(" ", "_", $new_name1);
        $file_tmp = $_FILES['upload_prescription']['tmp_name'];
        $file = $_FILES['upload_prescription']['name'];
        $ext = substr(strrchr($file, '.'), 1);

        move_uploaded_file($file_tmp, "./uploads/upload_prescription/" . $new_name . "." . $ext);

        $upload_prescription = $new_name . "." . $ext;
      }

      if ($payment_type == "cod") {


        if ($wallet_pay_for_check == "wallet_pay") {
          $chk_amt = $this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

          // echo @$chk_amt[0]->wallet_amount; exit;


          if (@$chk_amt[0]->wallet_amount > 0 || @$chk_amt[0]->wallet_amount != '') {

            if (@$chk_amt[0]->wallet_amount < @$grand_total) {

              $pay_wallet_amount = @$chk_amt[0]->wallet_amount;


              /*$data_amt=array('wallet_amount'=>0);

               $this->db->where('user_id',$user_id);
               $this->db->update('register_users',$data_amt);*/

              $order_data = array(

                'user_id' => $user_id,
                'order_total_value' => $grand_total,
                'user_discount' => $user_discount,
                'coupon_discount' => $coupon_discount,
                'pay_wallet_amount' => $pay_wallet_amount,
                'upload_prescription' => $upload_prescription,
                'order_status' => '1',
                'payment_status' => 'Unpaid',
                'payment_type' => $payment_type,
                'date' => date('Y-m-d H:i:s')

              );
            } else {



              /*$my_amt=@$chk_amt[0]->wallet_amount;

               $new_amt= $my_amt - $grand_total;

               $data_amt=array('wallet_amount'=>$new_amt);

               $this->db->where('user_id',$user_id);
               $this->db->update('register_users',$data_amt);*/

              $order_data = array(

                'user_id' => $user_id,
                'order_total_value' => $grand_total,
                'user_discount' => $user_discount,
                'coupon_discount' => $coupon_discount,
                'upload_prescription' => $upload_prescription,
                'order_status' => '1',
                'payment_status' => 'Paid',
                'payment_type' => $payment_type,
                'date' => date('Y-m-d H:i:s')

              );
            }
          } else {
            $order_data = array(

              'user_id' => $user_id,
              'order_total_value' => $grand_total,
              'user_discount' => $user_discount,
              'coupon_discount' => $coupon_discount,
              'upload_prescription' => $upload_prescription,
              'order_status' => '1',
              'payment_status' => 'Unpaid',
              'payment_type' => $payment_type,
              'date' => date('Y-m-d H:i:s')
            );
          }
        } else {

          $order_data = array(

            'user_id' => $user_id,
            'order_total_value' => $grand_total,
            'user_discount' => $user_discount,
            'coupon_discount' => $coupon_discount,
            'upload_prescription' => $upload_prescription,
            'order_status' => '1',
            'payment_status' => 'Unpaid',
            'payment_type' => $payment_type,
            'date' => date('Y-m-d H:i:s')

          );
        }
      }


      if ($payment_type == "online") {


        if ($wallet_pay_for_check == "wallet_pay") {
          $chk_amt = $this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

          // echo @$chk_amt[0]->wallet_amount; exit;


          if (@$chk_amt[0]->wallet_amount > 0 || @$chk_amt[0]->wallet_amount != '') {

            if (@$chk_amt[0]->wallet_amount < @$grand_total) {

              $pay_wallet_amount = @$chk_amt[0]->wallet_amount;




              /*$data_amt=array('wallet_amount'=>0);

               $this->db->where('user_id',$user_id);
               $this->db->update('register_users',$data_amt);*/

              $order_data = array(

                'user_id' => $user_id,
                'order_total_value' => $grand_total,
                'user_discount' => $user_discount,
                'coupon_discount' => $coupon_discount,
                'pay_wallet_amount' => $pay_wallet_amount,
                'upload_prescription' => $upload_prescription,
                'order_status' => '1',
                'payment_status' => 'Paid',
                'payment_type' => $payment_type,
                'date' => date('Y-m-d H:i:s')

              );
            } else {



              /*$my_amt=@$chk_amt[0]->wallet_amount;

               $new_amt= $my_amt - $grand_total;

               $data_amt=array('wallet_amount'=>$new_amt);

               $this->db->where('user_id',$user_id);
               $this->db->update('register_users',$data_amt);*/

              $order_data = array(

                'user_id' => $user_id,
                'order_total_value' => $grand_total,
                'user_discount' => $user_discount,
                'coupon_discount' => $coupon_discount,
                'upload_prescription' => $upload_prescription,
                'order_status' => '1',
                'payment_status' => 'Paid',
                'payment_type' => $payment_type,
                'date' => date('Y-m-d H:i:s')

              );
            }
          } else {
            $order_data = array(

              'user_id' => $user_id,
              'order_total_value' => $grand_total,
              'user_discount' => $user_discount,
              'coupon_discount' => $coupon_discount,
              'upload_prescription' => $upload_prescription,
              'order_status' => '1',
              'payment_status' => 'Paid',
              'payment_type' => $payment_type,
              'date' => date('Y-m-d H:i:s')
            );
          }
        } else {


          $order_data = array(

            'user_id' => $user_id,
            'order_total_value' => $grand_total,
            'user_discount' => $user_discount,
            'coupon_discount' => $coupon_discount,
            'upload_prescription' => $upload_prescription,
            'order_status' => '1',
            'payment_status' => 'Paid',
            'payment_type' => $payment_type,
            'date' => date('Y-m-d H:i:s')

          );
        }
      }

      if ($payment_type == "paytm") {


        if ($wallet_pay_for_check == "wallet_pay") {
          $chk_amt = $this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

          // echo @$chk_amt[0]->wallet_amount; exit;


          if (@$chk_amt[0]->wallet_amount > 0 || @$chk_amt[0]->wallet_amount != '') {

            if (@$chk_amt[0]->wallet_amount < @$grand_total) {

              $pay_wallet_amount = @$chk_amt[0]->wallet_amount;




              /*$data_amt=array('wallet_amount'=>0);

               $this->db->where('user_id',$user_id);
               $this->db->update('register_users',$data_amt);*/

              $order_data = array(

                'user_id' => $user_id,
                'order_total_value' => $grand_total,
                'user_discount' => $user_discount,
                'coupon_discount' => $coupon_discount,
                'pay_wallet_amount' => $pay_wallet_amount,
                'upload_prescription' => $upload_prescription,
                'order_status' => '1',
                'payment_status' => 'Paid',
                'payment_type' => $payment_type,
                'date' => date('Y-m-d H:i:s')

              );
            } else {



              /*$my_amt=@$chk_amt[0]->wallet_amount;

               $new_amt= $my_amt - $grand_total;

               $data_amt=array('wallet_amount'=>$new_amt);

               $this->db->where('user_id',$user_id);
               $this->db->update('register_users',$data_amt);*/

              $order_data = array(

                'user_id' => $user_id,
                'order_total_value' => $grand_total,
                'user_discount' => $user_discount,
                'coupon_discount' => $coupon_discount,
                'upload_prescription' => $upload_prescription,
                'order_status' => '1',
                'payment_status' => 'Paid',
                'payment_type' => $payment_type,
                'date' => date('Y-m-d H:i:s')

              );
            }
          } else {
            $order_data = array(

              'user_id' => $user_id,
              'order_total_value' => $grand_total,
              'user_discount' => $user_discount,
              'coupon_discount' => $coupon_discount,
              'upload_prescription' => $upload_prescription,
              'order_status' => '1',
              'payment_status' => 'Paid',
              'payment_type' => $payment_type,
              'date' => date('Y-m-d H:i:s')
            );
          }
        } else {


          $order_data = array(

            'user_id' => $user_id,
            'order_total_value' => $grand_total,
            'user_discount' => $user_discount,
            'coupon_discount' => $coupon_discount,
            'upload_prescription' => $upload_prescription,
            'order_status' => '1',
            'payment_status' => 'Unpaid',
            'payment_type' => $payment_type,
            'date' => date('Y-m-d H:i:s')

          );
        }
      }

      //echo $payment_type; die;


      /*if($payment_type=="wallet")
				{
					$chk_amt=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

					

		           $my_amt=@$chk_amt[0]->wallet_amount;

		           $new_amt= $my_amt - $grand_total;

		           $data_amt=array('wallet_amount'=>$new_amt);

		           $this->db->where('user_id',$user_id);
		           $this->db->update('register_users',$data_amt);

						$order_data= array(
									
						'user_id'=>$user_id,
						'order_total_value'=>$grand_total,
						'user_discount' =>$user_discount,
            'coupon_discount' =>$coupon_discount,
            'upload_prescription'=>$upload_prescription,
						'order_status'=>'1',
						'payment_status'=>'Paid',
						'payment_type'=>$payment_type,
						'date'=>date('Y-m-d H:i:s')
									
									);
				}*/




      // print_r($order_data); exit;




      $this->db->insert('orders_management', $order_data);
      $order_id = $this->db->insert_id();

      //$uni_code = date('Ymd') . rand(000, 999) . $order_id;

      $uni_code = generateRandomString(4) . '-'  . $order_id . '-' . DTIME2;

      //  For paytm payment
      if ($payment_type == "paytm") {

        /** Creating SDK level constant */
        //define('PROJECT', realpath((__DIR__) . '/vendor/paytm/paytm-pg'));

        // define('PROJECT', realpath((__DIR__)));
        include APPPATH . 'third_party/paytm/PaytmChecksum.php';

        $mid = PAYTM_MERCHANT_MID;
        $key = PAYTM_MERCHANT_KEY;


        $paytmParams = array();

        if (strpos($name, " ") !== false) {

          $splitstr = explode(" ", $name);
          $fname = $splitstr[0];
          $lname = trim($name, $splitstr[0]);
        } else {

          $fname = $name;
          $lname = '';
        }

        $paytmParams["body"] = array(
          "requestType"   => "Payment",
          "mid"           => $mid,
          "websiteName"   => PAYTM_MERCHANT_WEBSITE,
          "orderId"       => $uni_code,
          "callbackUrl"   => PAYTM_CALLBACK_URL,
          "txnAmount"     => array(
            "value"     => $grand_total,
            "currency"  => "INR",
          ),
          "userInfo"      => array(
            "custId"    => $user_id,
            "mobile"    => ($phone != '') ? $phone : "",
            "email"    => ($email != '') ? $email : "",
            "firstName"    => $fname,
            "lastName"    =>  $lname,
          )
        );


        /*
        * Generate checksum by parameters we have in body
        */
        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $key);

        $paytmParams["head"] = array(
          "signature"    => $checksum
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        /* for Staging */
        $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$uni_code";

        /* for Production */
        // $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$order_id";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);

        $json_object  = json_decode($response, true);
        $data['txnToken']  =  (!empty($json_object) && isset($json_object['body']['txnToken'])) ? $json_object['body']['txnToken'] : '';

        // print_obj($json_object);die;


        /* for Staging */
        $data['url'] = "https://securegw-stage.paytm.in/theia/api/v1/showPaymentPage?mid=$mid&orderId=$uni_code";

        // header("Location: $url");
        // exit;

        /* for Production */

        // $url = "https://securegw.paytm.in/theia/api/v1/showPaymentPage?mid=SJXLRj73095261468321&orderId=$uni_code";

        $data['order_id'] = $uni_code;

        // print_obj($paytmParams);
        // print_obj($data);die;

        $this->load->view('payby_paytm', $data);
        // redirect(base_url() . 'pay/paytm', 'refresh');
        //die;
      }


      // $string = str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNMqwertyuioplkjhgfdsazxcvbnm1234567890');
      // $uni_track_code = substr($string,-10);



      if ($wallet_pay_for_check == "wallet_pay") {
        $chk_amt = $this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        // echo @$chk_amt[0]->wallet_amount; exit;


        if (@$chk_amt[0]->wallet_amount > 0 || @$chk_amt[0]->wallet_amount != '') {

          if (@$chk_amt[0]->wallet_amount < @$grand_total) {
            $data_amt = array('wallet_amount' => 0);

            $this->db->where('user_id', $user_id);
            $this->db->update('register_users', $data_amt);
          } else {
            $my_amt = @$chk_amt[0]->wallet_amount;

            $new_amt = $my_amt - $grand_total;

            $data_amt = array('wallet_amount' => $new_amt);

            $this->db->where('user_id', $user_id);
            $this->db->update('register_users', $data_amt);
          }
        }
      }



      $order_update_data = array(
        'order_unique_id' => $uni_code,
        'shipping_address_id' => $shipping_address_id,


        'billing_name' => $name,
        'billing_email' => $email,
        'billing_phone' => $phone,
        'billing_locality' => $locality,
        'billing_flat_house_floor_building' => $flat_house_floor_building,
        // 'landmark'=>$landmark,
        'billing_city' => $city,
        'billing_state' => $state,
        'billing_country' => $country,
        'billing_pincode' => $pincode,
        // 'user_id'=>$user_id,
        // 'address_type' =>$address_type,



      );

      $this->db->where('order_id', $order_id);
      $this->db->update('orders_management', $order_update_data);




      $cart = $this->cart->contents();
      foreach ($cart as $k => $item) {

        $product_details =  $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


        $order_details_data = array(

          'order_id' => $order_id,
          'product_id' => $item['id'],
          'quantity' => $item['qty'],
          'price' => $item['price'],

        );

        $this->db->insert('order_detail', $order_details_data);




        $product_update_qty_data = array('stock_count' => @$product_details[0]->stock_count - $item['qty']);

        $this->db->where('product_id', $item['id']);
        $this->db->update('product', $product_update_qty_data);
      }

      /*-------------- Mail Template -----------------------*/

      $order_list = $this->common_my_model->common($table_name = 'orders_management', $field = array(), $where = array('order_unique_id' => $uni_code), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $order_details = $this->common_my_model->common($table_name = 'order_detail', $field = array(), $where = array('order_id' => @$order_list[0]->order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      // echo $order_unique_id;exit;

      $shipping_address_details = $this->common_my_model->common($table_name = 'user_shipping_address', $field = array(), $where = array('id' => @$order_list[0]->shipping_address_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $my_user_details = $this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


      $invoice_no = 'Burnett payment details-' . rand(000, 999) . '' . $order_list[0]->order_id;

      $mail_data = array(
        'order_list' => $order_list,

        'order_details' => $order_details,
        'shipping_address_details' => $shipping_address_details,


      );

      @$this->email->set_mailtype("html");

      $html_email_user = $this->load->view('order_details_invoice', $mail_data, true);


      // print_r($html_email_user);exit;
      // print_r($send_user_mail_html );exit;


      @$this->email->from('support@solutionsfinder.com');
      @$this->email->to($my_user_details[0]->email);
      @$this->email->subject('payment details from Burnett');
      @$this->email->message($html_email_user);
      @$reponse = @$this->email->send();



      /*-------------- Mail Template -----------------------*/
      $this->session->unset_userdata('session_wallet_pay');
      $this->session->unset_userdata('session_wallet_pay_for_check');

      $this->session->unset_userdata('additional_information_session_id');
      $this->session->unset_userdata('coupon_discount_hava');
      $this->session->unset_userdata('coupon_discount');
      $this->cart->destroy();




      $this->session->set_flashdata('succ', 'Your address successfully added.');
      if ($payment_type != "paytm") {
        redirect(base_url() . 'checkout/order_success', 'refresh');
      }
    }



    function change_payment_type()
    {
      $payment_type = $this->input->post('payment_type');
      $newData = array(
        'payment_type_session_id' => $payment_type,
      );
      $this->session->set_userdata($newData);
    }

    function change_additional_information()
    {
      $additional_information = $this->input->post('additional_information');
      $newData = array(
        'additional_information_session_id' => $additional_information,
      );
      $this->session->set_userdata($newData);
      //  echo  $this->session->userdata('additional_information_session_id');
    }

    function order_success()
    {

      $user_id = $this->session->userdata('user_session_id');

      if ($user_id == '') {
        redirect(base_url() . 'user-registation', 'refresh');
      }
      $data['seo_content_details'] =  $this->common_my_model->common($table_name = 'seo_module', $field = array(), $where = array('seo_module_id' => '12'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



      $this->load->view('common/header', $data);
      $this->load->view('order_success_view', $data);
      $this->load->view('common/footer');
    }


    function onGetOrderSuccessPaytm()
    {
      //snigdho

      $user_id = $this->session->userdata('user_session_id');

      if ($user_id == '') {
        redirect(base_url() . 'user-registation', 'refresh');
      }
      $data['seo_content_details'] =  $this->common_my_model->common($table_name = 'seo_module', $field = array(), $where = array('seo_module_id' => '12'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      include APPPATH . 'third_party/paytm/PaytmChecksum.php';

      $mid = PAYTM_MERCHANT_MID;
      $key = PAYTM_MERCHANT_KEY;

      $paytmParams = $_POST;
      if (!empty($paytmParams)) {

        // $user_order_id  = xss_clean($this->input->post('ORDERID'));
        // $payment_status  = xss_clean($this->input->post('STATUS'));
        // $paytmChecksum = xss_clean($this->input->post('CHECKSUMHASH'));

        $user_order_id  = $_POST['ORDERID'];
        $payment_status  = $_POST['STATUS'];
        $paytmChecksum = $_POST['CHECKSUMHASH'];
        unset($paytmParams['CHECKSUMHASH']);

        $verifySignature = PaytmChecksum::verifySignature($paytmParams, $key, $paytmChecksum);


        if ($verifySignature) {
          //echo "Checksum Matched";
          if ($payment_status == 'TXN_SUCCESS') {

            //echo "<br /> Payment successful ";

            $order_update_data = array(
              'payment_api_response' => $payment_status,
              'payment_status' => 'Paid',
              'payment_type' => 'online',
              'payment_method' => 'paytm'
            );

            $this->db->where('order_unique_id', $user_order_id);
            $this->db->update('orders_management', $order_update_data);
            $data['order_status'] = 1;
            $data['order_msg'] =  'Payment successful. Your Order has been Placed.';
            $data['img_icon_url'] = base_url() . 'assets/frontend/images/success-img.gif';
            $data['img_status_url'] = base_url() . 'assets/frontend/images/order-send.jpg';
          } else {

            //echo "<br /> Payment Failed ";

            $order_update_data = array(
              'payment_api_response' => $payment_status,
              'payment_status' => 'unpaid',
              'payment_type' => 'online',
              'payment_method' => 'paytm'
            );

            $this->db->where('order_unique_id', $user_order_id);
            $this->db->update('orders_management', $order_update_data);
            $data['order_status'] = 0;
            $data['order_msg'] =  'Payment Failed! Please retry.';
            $data['img_icon_url'] = '';
            $data['img_status_url'] = '';
          }
        } else {
          //echo "Checksum Mismatched";
          $data['order_status'] = 0;
          $data['order_msg'] =  'Payment unsuccessful! Please retry.';
          $data['img_icon_url'] = '';
          $data['img_status_url'] = '';
        }
      } else {
        $data['order_status'] = 0;
        $data['order_msg'] =  'Link Expired or Unauthorised Access!';
        $data['img_icon_url'] = '';
        $data['img_status_url'] = '';
      }





      $this->load->view('common/header', $data);
      $this->load->view('order_success_vw', $data);
      $this->load->view('common/footer');
    }


    function calculate_gst()
    {

      $state = $this->input->post('state');

      ?>
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


      foreach ($cart as $k => $item) {

        $product_details =  $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $curr_subtotal = $item['price'] * $item['qty'];
        // echo number_format($curr_subtotal, 2);
        $grand_total = $grand_total + $curr_subtotal;


      ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo @$product_details[0]->product_title . ' (' . $item['qty'] . ')'; ?></h6>
          </div>
          <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format(@$item['price'], 2); ?></span>
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


      /*----- User Discount --------*/

      $user_id = $this->session->userdata('user_session_id');
      $user_discount_details = $this->common_my_model->common($table_name = 'user_discount', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $userd_exp_date = @$user_discount_details[0]->exp_date;
      $userd_current_date = date('Y-m-d');
      $userd_current_date = strtotime($userd_current_date);
      $userd_exp_date = strtotime($userd_exp_date);
      $discount_hava = 0;

      if (@$user_discount_details[0]->status == 1) {
        if ($userd_current_date <= $userd_exp_date) {

          if (@$user_discount_details[0]->total_use > 0) {
            if (@$user_discount_details[0]->discount_type == 'Persent') {
              $user_discount = (($grand_total * @$user_discount_details[0]->discount_amount) / 100);


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            } else {
              $user_discount = @$user_discount_details[0]->discount_amount;


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            }
          } else {
            $discount_hava = 0;
          }
        } else {
          $discount_hava = 0;
        }
      } else {
        $discount_hava = 0;
      }



      /*----- User Discount --------*/


      /*----- Coupon Discount --------*/

      $coupon_discount_hava = $this->session->userdata('coupon_discount_hava');
      $coupon_discount = $this->session->userdata('coupon_discount');

      $grand_total = $grand_total - $coupon_discount;

      /*----- Coupon Discount --------*/







      // echo strtolower(str_replace(' ','',@$user_billing_address_details[0]->state));

      if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        $cgst_total = (($grand_total * $cgst) / 100);
        $sgst_total = (($grand_total * $sgst) / 100);

        $without_gst_total = ($grand_total - ($cgst_total + $sgst_total));
      } else {

        $igst_total = (($grand_total * $igst) / 100);

        $without_gst_total = ($grand_total - $igst_total);
      }

      ?>
      <?php if ($discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>User Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($user_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <?php if ($coupon_discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>Coupon Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($coupon_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Sub Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($without_gst_total, 2); ?></strong> </li>
      <?php if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        // $cgst_total= (($grand_total*$cgst)/100);
        //  $sgst_total= (($grand_total*$sgst)/100);    


      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>CGST (<?php echo $cgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($cgst_total, 2); ?></strong> </li>
        <li class="list-group-item d-flex justify-content-between"> <span>SGST (<?php echo $sgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($sgst_total, 2); ?></strong> </li>
      <?php } else {

        // $igst_total= (($grand_total*$igst)/100); 
      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>IGST (<?php echo $igst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($igst_total, 2); ?></strong> </li>
      <?php  } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i>
          <?php
          $alltotal =  $grand_total;
          echo number_format($alltotal, 2);
          ?>
        </strong> </li>
      <input type="hidden" class="form-control" name="dabit_amount" id="dabit_amount" value="<?php echo @$alltotal; ?>" placeholder="Enter Your Amount" />
    <?php
      $this->session->unset_userdata('session_wallet_pay');
      $this->session->unset_userdata('session_wallet_pay_for_check');
    }






    function coupon_discount_bk()
    {

      $state = $this->input->post('state');
      $coupon_code = $this->input->post('coupon_code');

    ?>
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


      foreach ($cart as $k => $item) {

        $product_details =  $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $curr_subtotal = $item['price'] * $item['qty'];
        // echo number_format($curr_subtotal, 2);
        $grand_total = $grand_total + $curr_subtotal;


      ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo @$product_details[0]->product_title . ' (' . $item['qty'] . ')'; ?></h6>
          </div>
          <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format(@$item['price'], 2); ?></span>
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


      /*----- User Discount --------*/

      $user_id = $this->session->userdata('user_session_id');
      $user_discount_details = $this->common_my_model->common($table_name = 'user_discount', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $userd_exp_date = @$user_discount_details[0]->exp_date;
      $userd_current_date = date('Y-m-d');
      $userd_current_date = strtotime($userd_current_date);
      $userd_exp_date = strtotime($userd_exp_date);
      $discount_hava = 0;

      if (@$user_discount_details[0]->status == 1) {
        if ($userd_current_date <= $userd_exp_date) {

          if (@$user_discount_details[0]->total_use > 0) {
            if (@$user_discount_details[0]->discount_type == 'Persent') {
              $user_discount = (($grand_total * @$user_discount_details[0]->discount_amount) / 100);


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            } else {
              $user_discount = @$user_discount_details[0]->discount_amount;


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            }
          } else {
            $discount_hava = 0;
          }
        } else {
          $discount_hava = 0;
        }
      } else {
        $discount_hava = 0;
      }



      /*----- User Discount --------*/



      /*----- Coupon Discount --------*/

      //  $user_id = $this->session->userdata('user_session_id');
      $coupon_discount_details = $this->common_my_model->common($table_name = 'coupon', $field = array(), $where = array('coupon_code' => $coupon_code), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $coupon_exp_date = @$coupon_discount_details[0]->coupon_end;
      $coupon_current_date = date('Y-m-d');
      $coupon_current_date = strtotime($coupon_current_date);
      $coupon_exp_date = strtotime($coupon_exp_date);
      $coupon_discount_hava = 0;
      $coupon_discount = 0;

      if (@$coupon_discount_details[0]->status == 1) {
        if (@$coupon_current_date <= @$coupon_exp_date) {

          if (@$coupon_discount_details[0]->total_use > 0) {
            if (@$coupon_discount_details[0]->coupon_discount_type == 'Persent') {
              $coupon_discount = (($grand_total * @$coupon_discount_details[0]->coupon_discount) / 100);


              $grand_total = $grand_total - $coupon_discount;
              $coupon_discount_hava = 1;
            } else {
              $coupon_discount = @$coupon_discount_details[0]->coupon_discount;


              $grand_total = $grand_total - $coupon_discount;
              $coupon_discount_hava = 1;
            }
          } else {
            $coupon_discount_hava = 0;
          }
        } else {
          $coupon_discount_hava = 0;
        }
      } else {
        $coupon_discount_hava = 0;
      }


      $coupon_sess_array = array(
        'coupon_discount_hava' => $coupon_discount_hava,
        'coupon_discount' => $coupon_discount,
      );
      $this->session->set_userdata($coupon_sess_array);



      /*----- Coupon Discount --------*/







      // echo strtolower(str_replace(' ','',@$user_billing_address_details[0]->state));

      if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        $cgst_total = (($grand_total * $cgst) / 100);
        $sgst_total = (($grand_total * $sgst) / 100);

        $without_gst_total = ($grand_total - ($cgst_total + $sgst_total));
      } else {

        $igst_total = (($grand_total * $igst) / 100);

        $without_gst_total = ($grand_total - $igst_total);
      }

      ?>
      <?php if ($discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>User Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($user_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <?php if ($coupon_discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>Cpoupon Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($coupon_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Sub Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($without_gst_total, 2); ?></strong> </li>
      <?php if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        // $cgst_total= (($grand_total*$cgst)/100);
        //  $sgst_total= (($grand_total*$sgst)/100);    


      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>CGST (<?php echo $cgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($cgst_total, 2); ?></strong> </li>
        <li class="list-group-item d-flex justify-content-between"> <span>SGST (<?php echo $sgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($sgst_total, 2); ?></strong> </li>
      <?php } else {

        // $igst_total= (($grand_total*$igst)/100); 
      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>IGST (<?php echo $igst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($igst_total, 2); ?></strong> </li>
      <?php  } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i>
          <?php
          $alltotal =  $grand_total;
          echo number_format($alltotal, 2);
          ?>
        </strong> </li>
    <?php

    }


    function coupon_discount()
    {
      $coupon_code = $this->input->post('coupon_code');



      $cart = $this->cart->contents();

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


      foreach ($cart as $k => $item) {

        $product_details =  $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $curr_subtotal = $item['price'] * $item['qty'];
        // echo number_format($curr_subtotal, 2);
        $grand_total = $grand_total + $curr_subtotal;
      }




      /*----- User Discount --------*/

      $user_id = $this->session->userdata('user_session_id');
      $user_discount_details = $this->common_my_model->common($table_name = 'user_discount', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $userd_exp_date = @$user_discount_details[0]->exp_date;
      $userd_current_date = date('Y-m-d');
      $userd_current_date = strtotime($userd_current_date);
      $userd_exp_date = strtotime($userd_exp_date);
      $discount_hava = 0;

      if (@$user_discount_details[0]->status == 1) {
        if ($userd_current_date <= $userd_exp_date) {

          if (@$user_discount_details[0]->total_use > 0) {
            if (@$user_discount_details[0]->discount_type == 'Persent') {
              $user_discount = (($grand_total * @$user_discount_details[0]->discount_amount) / 100);


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            } else {
              $user_discount = @$user_discount_details[0]->discount_amount;


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            }
          } else {
            $discount_hava = 0;
          }
        } else {
          $discount_hava = 0;
        }
      } else {
        $discount_hava = 0;
      }



      /*----- User Discount --------*/











      /*----- Coupon Discount --------*/

      //  $user_id = $this->session->userdata('user_session_id');
      $coupon_discount_details = $this->common_my_model->common($table_name = 'coupon', $field = array(), $where = array('coupon_code' => $coupon_code), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      if (count($coupon_discount_details) > 0) {

        $coupon_exp_date = @$coupon_discount_details[0]->coupon_end;
        $coupon_current_date = date('Y-m-d');
        $coupon_current_date = strtotime($coupon_current_date);
        $coupon_exp_date = strtotime($coupon_exp_date);
        $coupon_discount_hava = 0;
        $coupon_discount = 0;

        if (@$coupon_discount_details[0]->status == 1) {
          if (@$coupon_current_date <= @$coupon_exp_date) {

            if (@$coupon_discount_details[0]->total_use > 0) {
              if (@$coupon_discount_details[0]->coupon_discount_type == 'Persent') {
                $coupon_discount = (($grand_total * @$coupon_discount_details[0]->coupon_discount) / 100);


                $grand_total = $grand_total - $coupon_discount;
                $coupon_discount_hava = 1;

                $coupon_sess_array = array(
                  'coupon_discount_hava' => $coupon_discount_hava,
                  'coupon_discount' => $coupon_discount,
                );
                $this->session->set_userdata($coupon_sess_array);
              } else {
                $coupon_discount = @$coupon_discount_details[0]->coupon_discount;


                $grand_total = $grand_total - $coupon_discount;
                $coupon_discount_hava = 1;

                $coupon_sess_array = array(
                  'coupon_discount_hava' => $coupon_discount_hava,
                  'coupon_discount' => $coupon_discount,
                );
                $this->session->set_userdata($coupon_sess_array);
              }
            } else {
              $coupon_discount_hava = 0;
            }
          } else {
            $coupon_discount_hava = 2;
          }
        } else {
          $coupon_discount_hava = 0;
        }
      } else {
        $coupon_discount_hava = 0;
      }


      //  $this->session->unset_userdata('coupon_discount_hava');              
      // $this->session->unset_userdata('coupon_discount');

      echo json_encode(array('coupon_discount_hava' => $coupon_discount_hava));



      /*----- Coupon Discount --------*/
    }




    function change_my_wallet_pay_for_check()
    {

      $state = $this->input->post('state');



    ?>
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


      foreach ($cart as $k => $item) {

        $product_details =  $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $curr_subtotal = $item['price'] * $item['qty'];
        // echo number_format($curr_subtotal, 2);
        $grand_total = $grand_total + $curr_subtotal;


      ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo @$product_details[0]->product_title . ' (' . $item['qty'] . ')'; ?></h6>
          </div>
          <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format(@$item['price'], 2); ?></span>
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


      /*----- User Discount --------*/

      $user_id = $this->session->userdata('user_session_id');
      $user_discount_details = $this->common_my_model->common($table_name = 'user_discount', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $userd_exp_date = @$user_discount_details[0]->exp_date;
      $userd_current_date = date('Y-m-d');
      $userd_current_date = strtotime($userd_current_date);
      $userd_exp_date = strtotime($userd_exp_date);
      $discount_hava = 0;

      if (@$user_discount_details[0]->status == 1) {
        if ($userd_current_date <= $userd_exp_date) {

          if (@$user_discount_details[0]->total_use > 0) {
            if (@$user_discount_details[0]->discount_type == 'Persent') {
              $user_discount = (($grand_total * @$user_discount_details[0]->discount_amount) / 100);


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            } else {
              $user_discount = @$user_discount_details[0]->discount_amount;


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            }
          } else {
            $discount_hava = 0;
          }
        } else {
          $discount_hava = 0;
        }
      } else {
        $discount_hava = 0;
      }



      /*----- User Discount --------*/


      /*----- Coupon Discount --------*/

      $coupon_discount_hava = $this->session->userdata('coupon_discount_hava');
      $coupon_discount = $this->session->userdata('coupon_discount');

      $grand_total = $grand_total - $coupon_discount;

      /*----- Coupon Discount --------*/







      // echo strtolower(str_replace(' ','',@$user_billing_address_details[0]->state));

      if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        $cgst_total = (($grand_total * $cgst) / 100);
        $sgst_total = (($grand_total * $sgst) / 100);

        $without_gst_total = ($grand_total - ($cgst_total + $sgst_total));
      } else {

        $igst_total = (($grand_total * $igst) / 100);

        $without_gst_total = ($grand_total - $igst_total);
      }

      ?>
      <?php if ($discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>User Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($user_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <?php if ($coupon_discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>Coupon Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($coupon_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Sub Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($without_gst_total, 2); ?></strong> </li>
      <?php if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        // $cgst_total= (($grand_total*$cgst)/100);
        //  $sgst_total= (($grand_total*$sgst)/100);    


      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>CGST (<?php echo $cgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($cgst_total, 2); ?></strong> </li>
        <li class="list-group-item d-flex justify-content-between"> <span>SGST (<?php echo $sgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($sgst_total, 2); ?></strong> </li>
      <?php } else {

        // $igst_total= (($grand_total*$igst)/100); 
      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>IGST (<?php echo $igst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($igst_total, 2); ?></strong> </li>
      <?php  } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i>
          <?php
          $alltotal =  $grand_total;
          echo number_format($alltotal, 2);
          ?>
        </strong> </li>
      <?php $user_id = $this->session->userdata('user_session_id');
      $user_wallet_details = $this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



      if (@$user_wallet_details[0]->wallet_amount <= @$grand_total) {

        $pay_wallet_amount = @$user_wallet_details[0]->wallet_amount;
        $grand_total = @$grand_total - @$user_wallet_details[0]->wallet_amount;
      } else {

        $pay_wallet_amount = @$grand_total;
        $grand_total = 0;
      }


      ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Wallet Pay</span> <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i>
          <?php

          echo number_format($pay_wallet_amount, 2);
          ?>
        </strong> </li>
      <li class="list-group-item d-flex justify-content-between"> <span>Unpaid Amount</span> <strong><i class="fa fa-inr" aria-hidden="true"></i>
          <?php

          echo number_format($grand_total, 2);
          ?>
        </strong> </li>
      <input type="hidden" class="form-control" name="dabit_amount" id="dabit_amount" value="<?php echo @$grand_total; ?>" placeholder="Enter Your Amount" />
    <?php

      $newData5 = array(
        'session_wallet_pay' => @$pay_wallet_amount,
        'session_wallet_pay_for_check' => 'wallet_pay',

      );
      $this->session->set_userdata($newData5);
    }

    function change_my_wallet_pay_for_uncheck()
    {

      $state = $this->input->post('state');

    ?>
      <?php $cart = $this->cart->contents();

      $curr_subtotal = 0;
      $shipping_cost = 0;
      $grand_total = 0;
      $cgst = 9;
      $sgst = 9;
      $igst = 18;

      $cgst_total = 0;
      $sgst_total = 0;
      $igst_total = 0;

      $without_gst_total = 0;
      $all_total = 0;


      foreach ($cart as $k => $item) {

        $product_details =  $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $curr_subtotal = $item['price'] * $item['qty'];
        // echo number_format($curr_subtotal, 2);
        $shipping_cost += $item['shipping_rate'];
        $grand_total = $grand_total + $curr_subtotal + $shipping_cost;


      ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo @$product_details[0]->product_title . ' (' . $item['qty'] . ')'; ?></h6>
          </div>
          <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format(@$item['price'], 2); ?></span>
        </li>

        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Shipping Cost</h6>
          </div>
          <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format(@$item['shipping_rate'], 2); ?></span>
        </li>
      <?php
        $shipping_cost = 0;
      } ?>

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


      /*----- User Discount --------*/

      $user_id = $this->session->userdata('user_session_id');
      $user_discount_details = $this->common_my_model->common($table_name = 'user_discount', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $userd_exp_date = @$user_discount_details[0]->exp_date;
      $userd_current_date = date('Y-m-d');
      $userd_current_date = strtotime($userd_current_date);
      $userd_exp_date = strtotime($userd_exp_date);
      $discount_hava = 0;

      if (@$user_discount_details[0]->status == 1) {
        if ($userd_current_date <= $userd_exp_date) {

          if (@$user_discount_details[0]->total_use > 0) {
            if (@$user_discount_details[0]->discount_type == 'Persent') {
              $user_discount = (($grand_total * @$user_discount_details[0]->discount_amount) / 100);


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            } else {
              $user_discount = @$user_discount_details[0]->discount_amount;


              $grand_total = $grand_total - $user_discount;
              $discount_hava = 1;
            }
          } else {
            $discount_hava = 0;
          }
        } else {
          $discount_hava = 0;
        }
      } else {
        $discount_hava = 0;
      }



      /*----- User Discount --------*/


      /*----- Coupon Discount --------*/

      $coupon_discount_hava = $this->session->userdata('coupon_discount_hava');
      $coupon_discount = $this->session->userdata('coupon_discount');

      $grand_total = $grand_total - $coupon_discount;

      /*----- Coupon Discount --------*/







      // echo strtolower(str_replace(' ','',@$user_billing_address_details[0]->state));

      if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        $cgst_total = (($grand_total * $cgst) / 100);
        $sgst_total = (($grand_total * $sgst) / 100);

        $without_gst_total = ($grand_total - ($cgst_total + $sgst_total));
      } else {

        $igst_total = (($grand_total * $igst) / 100);

        $without_gst_total = ($grand_total - $igst_total);
      }

      ?>
      <?php if ($discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>User Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($user_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <?php if ($coupon_discount_hava == 1) { ?>
        <li class="list-group-item d-flex justify-content-between"> <span>Coupon Discount</span>
          <!-- <strong><span style="color:red;padding-left: 980px;">-</span> </strong>  -->
          <strong><i class="fa fa-minus" aria-hidden="true"></i> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($coupon_discount, 2); ?></strong>
        </li>
      <?php } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Sub Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($without_gst_total, 2); ?></strong> </li>
      <?php if (strtolower(str_replace(' ', '', @$state)) == 'westbengal') {

        // $cgst_total= (($grand_total*$cgst)/100);
        //  $sgst_total= (($grand_total*$sgst)/100);    


      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>CGST (<?php echo $cgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($cgst_total, 2); ?></strong> </li>
        <li class="list-group-item d-flex justify-content-between"> <span>SGST (<?php echo $sgst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($sgst_total, 2); ?></strong> </li>
      <?php } else {

        // $igst_total= (($grand_total*$igst)/100); 
      ?>
        <li class="list-group-item d-flex justify-content-between"> <span>IGST (<?php echo $igst; ?>%)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($igst_total, 2); ?></strong> </li>
      <?php  } ?>
      <li class="list-group-item d-flex justify-content-between"> <span>Total (INR)</span> <strong><i class="fa fa-inr" aria-hidden="true"></i>
          <?php
          $alltotal =  $grand_total;
          echo number_format($alltotal, 2);
          ?>
        </strong> </li>
      <input type="hidden" class="form-control" name="dabit_amount" id="dabit_amount" value="<?php echo @$alltotal; ?>" placeholder="Enter Your Amount" />
  <?php
      $this->session->unset_userdata('session_wallet_pay');
      $this->session->unset_userdata('session_wallet_pay_for_check');
    }
  }
  ?>