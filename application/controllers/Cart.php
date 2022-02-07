<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//load model
		$this->load->model('product_model');
		$this->load->library('cart');
		//$this->load->model('user_model');
		//$this->load->model('billing_model');
		//$this->load->library('paypal_lib');
		//$this->load->model('gst_model');
		$this->load->model('product_category_model');
		$this->load->model('common_my_model');
	}
	public function index()
	{
		$data['seo_content_details'] =  $this->common_my_model->common($table_name = 'seo_module', $field = array(), $where = array('seo_module_id' => '10'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$data['products'] = '';
		$this->load->view('cart', $data);
	}

	public function add()
	{
		if (isset($_POST['hiddprotype']) && $_POST['hiddprotype'] == 'variable_product') {
			//echo '<pre>'; print_r($_POST); echo '</pre>'; die;
		}

		if ($this->input->post('ddlsize') != '') {
			$size = $this->input->post('ddlsize');
		}

		if ($this->input->post('variable_attribute_id') != '') {
			$variable_attribute_id = $this->input->post('variable_attribute_id');
		}

		$product_id = $this->input->post('id');
		$product_details = $this->product_model->product_details_by_id($product_id);
		$final_qty  = $this->input->post('quantity');
		$chkpack  = ($this->input->post('chkpack') != '') ? $this->input->post('chkpack') : '';
		$view_type  = $this->input->post('view_type');

		//echo 'product_id: ' . $product_id;
		// print_obj($this->input->post());
		// print_obj($product_details);


		if (!empty($product_details)) {
			if ($product_details[0]->product_type == 'simple') {
				$product_price = $product_details[0]->product_price;
				$size = '';

				if (count($this->cart->contents()) > 0) {
					foreach ($this->cart->contents() as $item) {
						//var_dump($item);echo '<br>';
						//echo $item['options']['Size'].'<==>'.$size;
						if ($item['id'] == $product_id && $item['options']['Size'] == $size) {
							//echo 'AAAAAAAAAAAAAA';
							$final_qty = $final_qty + $item['qty'];
							$array = array('rowid' => $item['rowid'], 'qty' => $final_qty);
							if ($final_qty <= $product_details[0]->stock_count) {
								$this->cart->update($array);
							}
						}
					}
				}

				if ($final_qty <= $product_details[0]->stock_count) {
					$insert_data = array(
						'id' => $this->input->post('id'),
						'name' => $this->input->post('name'),
						'price' => $product_price,
						'size' => $size,
						'qty' => (int)$final_qty,
						'shipping_rate'     => '',
						'options' => array('Size' => $size)
					);

					//echo $final_qty.'<br>';		
					//var_dump($this->cart->insert($insert_data));die;	

					if ($this->cart->insert($insert_data)) {
						$this->session->set_flashdata('cart_info', '<div class="alert alert-success"><strong></strong>Product successfully added to cart <a href=' . base_url('cart') . ' class="btn btn-success btn-sm">View Cart</a></div>');
					} else {
						$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Something went wrong11. Please try later</div>');
					}
					//$cat_details = $this->product_category_model->category_details_by_id($this->input->post('category_id'));
					//var_dump($cat_details);
					//redirect('product-details/'.$product_details[0]->product_id.'/'.$product_details[0]->unique_key);
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Product stock not available. Current stock is ' . $product_details[0]->stock_count . ' ' . $product_details[0]->product_unit . '  </div>');
				}
			} else if ($product_details[0]->product_type == 'variable') {
				//echo 'snigdho';die;


				if (count($this->cart->contents()) > 0) {
					foreach ($this->cart->contents() as $item) {
						//var_dump($item);echo '<br>';
						//echo $item['options']['Size'].'<==>'.$size;
						if ($item['id'] == $product_id && $item['options']['Size'] == $size) {
							//echo 'AAAAAAAAAAAAAA';
							$final_qty = $final_qty + $item['qty'];
							$array = array('rowid' => $item['rowid'], 'qty' => $final_qty);
							if ($final_qty <= $product_details[0]->stock_count) {
								$this->cart->update($array);
							}
						}
					}
				}
				$chkpack = array_filter($chkpack);
				if (!empty($chkpack)) {
					foreach ($chkpack as $key => $value) {

						$final_qty  = $this->input->post('txtqty_' . $value);
						if ($final_qty <= $product_details[0]->stock_count) {

							$get_variable_product_price = $this->product_model->get_variable_product_price($value);
							$product_price = (!empty($get_variable_product_price)) ? $get_variable_product_price[0]->product_price : '0';

							if (!empty($get_variable_product_price)) {
								$product_att_val =  $this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('product_attribute_id' => $get_variable_product_price[0]->variation_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
							} else {
								$product_att_val = '';
							}

							// print_obj($get_variable_product_price);
							// print_obj($product_att_val);

							if (!empty($product_att_val)) {

								$fqty = (int)$final_qty;

								if ($view_type == 'detail_view') {
									$insert_data = array(
										'id' => $this->input->post('id'),
										'name' => $product_att_val[0]->name,
										'price' => $product_price,
										'size' => $product_att_val[0]->name,
										'qty' => ($fqty > 0) ? $fqty : '1',
										'shipping_rate'     => '',
										'options' => array('size' => $product_att_val[0]->name)
									);
								} else {
									$insert_data = array(
										'id' => $this->input->post('id'),
										'name' => $this->input->post('name'),
										'price' => $product_price,
										'size' => $product_att_val[0]->name,
										'qty' => ($fqty > 0) ? $fqty : '1',
										'shipping_rate'     => '',
										'options' => array('size' => $product_att_val[0]->name)
									);
								}




								// print_obj($insert_data);die;


								if ($this->cart->insert($insert_data)) {
									$this->session->set_flashdata('cart_info', '<div class="alert alert-success"><strong></strong>Product successfully added to cart <a href=' . base_url('cart') . ' class="btn btn-success btn-sm">View Cart</a></div>');
								} else {
									$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Something went wrong1. Please try later</div>');
								}
							} else {
								$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Not added to cart!!</div>');
							}


							//$cat_details = $this->product_category_model->category_details_by_id($this->input->post('category_id'));
							//var_dump($cat_details);
							//redirect('product-details/'.$product_details[0]->product_id.'/'.$product_details[0]->unique_key);
							header('Location: ' . $_SERVER['HTTP_REFERER']);
						} else {
							$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Product stock not available. Current stock is ' . $product_details[0]->stock_count . ' ' . $product_details[0]->product_unit . '  </div>');
						}
					}
				} else {
					$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Something went wrong. Please check with admin!!</div>');
				}
			} else {
				$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Error:  Current stock is ' . $product_details[0]->stock_count . ' ' . $product_details[0]->product_unit . '  </div>');
			}

			// print_obj($this->cart->contents());
			// echo '===>>' . count($this->cart->contents());
			// die;

		} else {
			$this->session->set_flashdata('cart_info', '<div class="alert alert-danger"><strong>Error</strong> Something went wrong3!  </div>');
		}


		//var_dump($this->cart->contents());exit;
		//redirect('cart');
		//redirect('product-details/'.$product_details[0]->product_id.'/'.$product_details[0]->unique_key);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function ajax_add()
	{

		$product_id = $this->input->post('id');
		$final_qty  = $this->input->post('quantity');
		if (count($this->cart->contents()) > 0) {
			foreach ($this->cart->contents() as $item) {
				if ($item['id'] == $product_id) {
					$final_qty = $final_qty + $item['qty'];
				}
			}
		}
		$insert_data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'qty' => $final_qty,
			'shipping_rate'     => '',
		);

		if ($this->cart->insert($insert_data)) {
			echo '1';
		} else {
			echo '0';
		}
		exit;
	}
	public function remove($rowid)
	{
		if ($rowid === "all") {
			$this->cart->destroy();
		} else {
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);

			$this->cart->update($data);
		}
		$this->session->set_flashdata('cart_info', '<div class="alert alert-success"><strong></strong>Cart updated successfully.</div>');
		redirect('cart');
	}
	public function update_cart()
	{
		$cart_info =  $_POST['cart'];
		$redirect =  $_POST['redirect'];
		$shipping_rate =  $_POST['shipping_rate'];
		// print_obj($_POST); die;
		foreach ($cart_info as $id => $cart) {
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];
			// $shipping_rate = $cart['shipping_rate'];
			$product_details = $this->product_model->product_details_by_id($cart['id']);
			//echo $product_details[0]->stock_count;exit;
			if ($qty <= $product_details[0]->stock_count) {
				$data = array(
					'rowid'   => $rowid,
					'price'   => $price,
					'amount' =>  $amount,
					'shipping_rate'     => $shipping_rate,
					'qty'     => $qty
				);
			} else {
				$data = array(
					'rowid'   => $rowid,
					'qty'     => $product_details[0]->stock_count
				);
			}
			$this->cart->update($data);
		}
		$this->session->set_flashdata('cart_info', '<div class="alert alert-success"><strong></strong>Cart updated successfully.</div>');

		redirect($redirect);
	}

	public function billing_view()
	{

		if ($cart = $this->cart->contents()) {

			$this->session->set_userdata('redirect', array(
				'value' => 'cart/billing_view'
			));
			if ($this->session->userdata('is_frontuser_login')) {
				$this->session->unset_userdata('redirect');
				$front_user = $this->session->userdata('is_frontuser_login');
				//var_dump($front_user)	;	
				$front_user_data = $this->user_model->user_details_by_id($front_user['user_id']);

				// echo "<pre>";print_r($front_user_data);die;
				$arr['front_user_data'] = $front_user_data;

				$this->load->view('billing_view', $arr);
			} else {
				// echo "Login Page";die;
				redirect('login');
			}
		} else {
			redirect('cart');
		}
	}

	public function save_order()
	{
		$this->session->unset_userdata('redirect');
		$front_user = $this->session->userdata('is_frontuser_login');
		$unique_no = time() . rand(1, 100);
		$order = array(
			'billing_member_name' 	=> $this->input->post('billing_member_name'),
			'billing_email_id' 		=> $this->input->post('billing_email_id'),
			'billing_mobile_no' 	=> $this->input->post('billing_mobile_no'),
			'billing_address' 		=> $this->input->post('billing_address'),
			'billing_country' 		=> $this->input->post('billing_country'),
			'billing_city' 			=> $this->input->post('billing_city'),
			'billing_pincode' 		=> $this->input->post('billing_pincode'),
			'same_shipping' 		=> $this->input->post('same_shipping'),
			'shipping_member_name' 	=> $this->input->post('shipping_member_name'),
			'shipping_email_id' 	=> $this->input->post('shipping_email_id'),
			'shipping_mobile_no' 	=> $this->input->post('shipping_mobile_no'),
			'shipping_address' 		=> $this->input->post('shipping_address'),
			'shipping_country' 		=> $this->input->post('shipping_country'),
			'shipping_city' 		=> $this->input->post('shipping_city'),
			'shipping_pincode' 		=> $this->input->post('shipping_pincode'),
			'member_id'				=> $front_user['user_id'],
			'order_unique_id' 		=> $unique_no,
			'order_status'			=> '0',
			'date' 					=> time(),
		);

		$cust_id = $front_user['user_id'];

		$ord_id = $this->billing_model->insert_order($order);

		$cart = $this->cart->contents();
		print_r($cart);die;
		$totalval = 0;
		if ($cart = $this->cart->contents()) :
			foreach ($cart as $item) :
				$order_detail = array(
					'order_id' 		=> $ord_id,
					'product_id' 	=> $item['id'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price']
				);

				$totalval  =    $totalval +  ($item['qty'] * $item['price']);
				$cust_id = $this->billing_model->insert_order_detail($order_detail);
			endforeach;
		endif;

		$order_update = array(
			'order_total_value' 	=> $totalval,
		);
		$this->billing_model->update_order($ord_id, $order_update);

		$returnURL = base_url() . 'paypal/success'; //payment success url
		$cancelURL = base_url() . 'paypal/cancel'; //payment cancel url
		$notifyURL = base_url() . 'paypal/ipn'; //ipn url
		//get particular product data

		$logo = base_url() . 'assets/images/codexworld-logo.png';

		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', $unique_no);
		$this->paypal_lib->add_field('item_number',  $ord_id);
		$this->paypal_lib->add_field('amount',  $totalval);
		$this->paypal_lib->image($logo);

		$this->paypal_lib->paypal_auto_form();
		//echo $this->paypal_lib->paypal_form();
		//$this->cart->destroy();
		//$arr['location_modules'] = $this->location_modules_model->fetch_location_modules();	
		// $this->load->view('billing_success');
	}
}
