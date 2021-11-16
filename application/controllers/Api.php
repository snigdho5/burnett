<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('api_model');
		$this->load->model('common_my_model');
	}

	public function user_login()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$username = $this->input->get('email');
		$password = $this->input->get('password');
		$login_ip = $this->input->ip_address();
		$login_time = date('Y-m-d H:i:s');
		if (!empty($username) && !empty($password)) {
			$return = $this->api_model->validate_login($username, $password, $login_ip, $login_time);
			if ($return == 'not_found') {
				$data['status'] = 'failed';
				$data['message'] = 'user not found';
				$data['userdata'] = '';
			} elseif ($return == 'password_incorrect') {
				$data['status'] = 'failed';
				$data['message'] = 'password incorrect';
				$data['userdata'] = '';
			} elseif ($return == 'inactive') {
				$data['status'] = 'failed';
				$data['message'] = 'user inactive';
				$data['userdata'] = '';
			} elseif ($return == 'cannot_validate') {
				$data['status'] = 'failed';
				$data['message'] = 'cannot login now';
				$data['userdata'] = '';
			} else {
				$data['status'] = 'success';
				$data['message'] = '';
				$data['userdata'] = $return;
			}
			$json = json_encode($data);
			echo $json;
		}
	}


	public function user_registration()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_type = $this->input->get('user_type');
		$firstname = $this->input->get('firstname');
		$lastname = $this->input->get('lastname');
		$phone = $this->input->get('phone');
		$whatsapp = $this->input->get('whatsapp');

		$have_registration_no = $this->input->get('have_registration_no');
		$registration_no = $this->input->get('registration_no');

		$firmname = $this->input->get('firmname');
		$drug_license_no = $this->input->get('drug_license_no');
		$gst_pan_no_firm = $this->input->get('gst_pan_no_firm');
		$address = $this->input->get('address');
		$area_of_work = $this->input->get('area_of_work');
		$prev_any_delarship = $this->input->get('prev_any_delarship');
		$name_of_company = $this->input->get('name_of_company');
		$target_of_business = $this->input->get('target_of_business');
		$year_of_experience = $this->input->get('year_of_experience');
		$chember_picture = $this->input->get('chember_picture');


		$email = $this->input->get('email');
		$password = md5($this->input->get('password'));
		$created_on = date('Y-m-d H:i:s');

		$mobile_check = array();
		$email_check = $this->api_model->common($table_name = 'register_users', $field = array(), $where = array('email' => $email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		if (isset($phone) && $phone != '') {
			$mobile_check = $this->api_model->common($table_name = 'register_users', $field = array(), $where = array('phone' => $phone), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		}

		if (count($email_check) > 0) {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Your Email Is Already Used.';
			$data['user_data'] = $email_check;
		} elseif (count($mobile_check) > 0 && !empty($mobile_check)) {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Your Phone no is Already Used.';
			$data['user_data'] = $mobile_check;
		} else {
			if ($user_type == 'CU') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'phone' => $phone,
					'whatsapp' => $whatsapp,
					'email' => $email,
					'password' => $password,
					'create_date' => $created_on

				);
			}
			if ($user_type == 'DR') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'phone' => $phone,
					'whatsapp' => $whatsapp,
					'have_registration_no' => $have_registration_no,
					'registration_no' => $registration_no,
					'chember_picture' => $chember_picture,
					'email' => $email,
					'password' => $password,
					'create_date' => $created_on
				);
			}
			if ($user_type == 'DI') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'phone' => $phone,
					'whatsapp' => $whatsapp,
					'activate' => '0',
					'firmname' => $firmname,
					'drug_license_no' => $drug_license_no,
					'gst_pan_no_firm' => $gst_pan_no_firm,
					'address' => $address,
					'area_of_work' => $area_of_work,
					'prev_any_delarship' => $prev_any_delarship,
					'name_of_company' => $name_of_company,
					'target_of_business' => $target_of_business,
					'year_of_experience' => $year_of_experience,
					'email' => $email,
					'password' => $password,
					'create_date' => $created_on

				);
			}
			if ($user_type == 'ST') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'phone' => $phone,
					'whatsapp' => $whatsapp,
					'activate' => '0',
					'firmname' => $firmname,
					'drug_license_no' => $drug_license_no,
					'gst_pan_no_firm' => $gst_pan_no_firm,
					'address' => $address,
					'area_of_work' => $area_of_work,
					'prev_any_delarship' => $prev_any_delarship,
					'name_of_company' => $name_of_company,
					'target_of_business' => $target_of_business,
					'email' => $email,
					'password' => $password,
					'create_date' => $created_on

				);
			}

			$this->db->insert('register_users', $data);
			$data['user_id'] = strval($this->db->insert_id());
			if ($email != '') {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Your registration successfully...Please Login';
			}
		}

		$json = json_encode($data);
		echo $json;
	}


	public function categorylist()
	{
		$return = $this->api_model->getcategories();
		if ($return == 'no data found') {
			$data['status'] = 'failed';
			$data['message'] = 'categories not found';
			$data['categorydata'] = '';
		} else {
			$data['status'] = 'success';
			$data['message'] = '';
			$data['categorydata'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}


	public function productlist()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		//$email = $this->input->get('email');

		$return = $this->api_model->getproducts();

		if ($return == 'no data found') {
			$data['status'] = 'failed';
			$data['message'] = 'Product not found';
			$data['productdata'] = '';
		} else {
			$data['status'] = 'success';
			$data['message'] = '';
			$data['productdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}


	public function productlist_by_keyword()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$keyword = $this->input->get('key');

		$return = $this->api_model->getproducts_by_keyword($keyword);
		if ($return == 'no data found') {
			$data['status'] = 'failed';
			$data['message'] = 'Product not found';
			$data['productdata'] = '';
		} else {
			$data['status'] = 'success';
			$data['message'] = '';
			$data['productdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}

	public function search_productlist()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$keyword = $this->input->get('keyword');

		$return = $this->api_model->search_productlist_by_keyword($keyword);
		if ($return == 'no data found') {
			$data['status'] = 'failed';
			$data['message'] = 'Product not found';
			$data['productdata'] = '';
		} else {

			$data['status'] = 'success';
			$data['message'] = '';
			$data['productdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}

	public function productlist_by_category()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$catId = $this->input->get('cat_id');

		$return = $this->api_model->getproducts_by_cat($catId);
		if ($return == 'no data found') {
			$data['status'] = 'failed';
			$data['message'] = 'Product not found';
			$data['productdata'] = '';
		} else {
			$data['status'] = 'success';
			$data['message'] = '';
			$data['productdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}

	public function productDetails()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$product_id = $this->input->get('product_id');

		$return = $this->api_model->getproducts_details_by_id($product_id);

		if ($return == 'no data found') {
			$data['status'] = 'failed';
			$data['message'] = 'Product not found';
			$data['productdata'] = '';
		} else {
			$return[0]['related_product_list'] = $this->common_my_model->related_product($product_id);
			$return[0]['product_review'] = $this->common_my_model->common($table_name = 'product_review', $field = array(), $where = array('product_id' => $return[0]['unique_key']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			$return[0]['base_url'] = base_url() . 'uploads/product/';
			$return[0]['share_url'] = base_url() . 'product-details/' . $return[0]['unique_key'];

			$data['status'] = 'success';
			$data['message'] = '';
			$data['productdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}

	public function add_to_cart()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_id = $this->input->get('user_id');
		$product_id = $this->input->get('product_id');
		$final_qty  = $this->input->get('quantity');
		$size  = $this->input->get('size');
		$data = array(
			'user_id' => $user_id,
			'product_id' => $product_id,
			'name' => $this->input->get('name'),
			'price' => $this->input->get('price'),
			'qty' => $final_qty,
			'size' => $size,
		);

		if ($this->db->insert('users_cart', $data)) {
			$data['row_id'] = $this->db->insert_id();
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Item added to Cart.';
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = '';
		}

		$json = json_encode($data);
		echo $json;
	}

	public function update_cart()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$row_id = $this->input->get('row_id');
		$quantity = $this->input->get('quantity');
		if (!empty($row_id)) {
			$return = $this->api_model->update_cart_info($row_id, $quantity);
			if ($return == 'record_not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'record not found';
				$data['cart_details'] = '';
			} elseif ($return == 'cannot_update') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Error in update';
				$data['cart_details'] = '';
			} else {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Cart update successfully.';
				$data['cart_details'] = $return;
			}
			$json = json_encode($data);
			echo $json;
		}
	}

	public function delete_cart()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$row_id = $this->input->get('row_id');
		if (!empty($row_id)) {
			$return = $this->api_model->remove_cart_info_by_row($row_id);
			if ($return == 'record_not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'record not found';
				$data['cart_details'] = '';
			} elseif ($return == 'cannot_update') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Error in update';
				$data['cart_details'] = '';
			} else {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Cart removed successfully.';
				$data['cart_details'] = $return;
			}
			$json = json_encode($data);
			echo $json;
		}
	}

	public function view_cart()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_id = $this->input->get('user_id');
		$return = $this->api_model->getcartdata_by_userid($user_id);

		if ($return == 'no data found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Product not found';
			$data['productdata'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['productdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}

	public function add_to_wishlist()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_id = $this->input->get('user_id');
		$product_id = $this->input->get('product_id');
		$action  = $this->input->get('action');
		$data = array(
			'user_id' => $user_id,
			'product_id' => $product_id
		);

		if ($action == 'add') {
			if ($this->db->insert('wishlist', $data)) {
				$data['row_id'] = $this->db->insert_id();
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Item added to Wishlist.';
			} else {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = '';
			}
		} else {
			$return = $this->api_model->remove_wishlist($user_id, $product_id);
			if ($return == 'record_not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'record not found';
			} else {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Wishlist removed successfully.';
			}
		}

		$json = json_encode($data);
		echo $json;
	}

	public function user_wishlist_products()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id = $this->input->get('user_id');

		$return = $this->api_model->get_wishlist_products_by_uid($user_id);
		if ($return == 'no data found') {
			$data['status'] = 'failed';
			$data['message'] = 'Product not found';
			$data['productdata'] = '';
		} else {
			$data['status'] = 'success';
			$data['message'] = '';
			$data['productdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}

	public function user_add_new_address()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_id = $this->input->get('user_id');
		$default_billing = $this->input->get('default_billing');
		if (!empty($this->input->get('name')) && $this->input->get('name') != '') {
			$name  = $this->input->get('name');
		} else {
			$name  = '';
		}
		if (!empty($this->input->get('phone')) && $this->input->get('phone') != '') {
			$phone  = $this->input->get('phone');
		} else {
			$phone  = '';
		}
		if (!empty($this->input->get('email')) && $this->input->get('email') != '') {
			$email  = $this->input->get('email');
		} else {
			$email  = '';
		}
		$pincode  = $this->input->get('pincode');
		$flat_house_floor_building  = $this->input->get('flat_house_floor_building');
		$locality  = $this->input->get('locality');
		$landmark  = $this->input->get('landmark');
		$city  = $this->input->get('city');
		$state  = $this->input->get('state');
		$country  = $this->input->get('country');
		$address_type  = $this->input->get('address_type');

		$data = array(
			'user_id' => $user_id,
			'default_billing' => $default_billing,
			'name' => $name,
			'phone' => $phone,
			'email' => $email,
			'pincode' => $pincode,
			'flat_house_floor_building' => $flat_house_floor_building,
			'locality' => $locality,
			'landmark' => $landmark,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'address_type' => $address_type
		);

		if ($this->db->insert('user_billing_address', $data)) {
			$data['row_id'] = $this->db->insert_id();
			if ($this->db->insert_id() > 0) {
				$arrWhere['id !='] = $this->db->insert_id();
				$arrWhere['user_id'] = $user_id;
				$arrUpdateData['default_billing'] = 0;
				$updateDefault = $this->api_model->updateData('user_billing_address', $arrWhere, $arrUpdateData);
			}
			$whereLastAddress['id'] = $data['row_id'];
			$arrAddress = $this->api_model->fetchData('user_billing_address', "*", $whereLastAddress);


			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'New address added.';
			$data['last_added_address'] = $arrAddress;
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = '';
			$data['last_added_address'] = array();
		}

		$json = json_encode($data);
		echo $json;
	}

	public function users_addresslist()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id = $this->input->get('user_id');

		$return = $this->api_model->getaddress_by_userid($user_id);
		if ($return == 'record_not_found') {
			$data['status'] = 'failed';
			$data['message'] = 'address not found';
			$data['userdata'] = '';
		} else {
			$data['status'] = 'success';
			$data['message'] = '';
			$data['userdata'] = $return;
		}


		$json = json_encode($data);
		echo $json;
	}

	public function updateDefaultAddress()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$addressId = $this->input->get('address_id');
		$userId = $this->input->get('user_id');
		if (is_numeric($addressId) && $addressId > 0) {
			$arrWhere['id !='] = $addressId;
			$arrWhere['user_id'] = $userId;
			$arrUpdateData['default_billing'] = 0;
			$updateDefaultUnset = $this->api_model->updateData('user_billing_address', $arrWhere, $arrUpdateData);
			$arrWhereSet['id'] = $addressId;
			$arrWhereSet['user_id'] = $userId;
			$arrUpdateDataSet['default_billing'] = 1;
			$updateDefaultSet = $this->api_model->updateData('user_billing_address', $arrWhereSet, $arrUpdateDataSet);
			if ($updateDefaultSet > 0) {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Address set to default';
			} else {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Unable to change default address';
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Invalid request';
		}
		echo json_encode($data);
		die;
	}

	public function deleteAddress()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$userId = $this->input->get('user_id');
		$addressId = $this->input->get('address_id');

		$deleteAddress = $this->api_model->deleteAddress($addressId, $userId);
		if ($deleteAddress > 0) {
			$data['status'] = 'success';
			$data['message'] = 'Address deleted successfully';
		} else {
			$data['status'] = 'failed';
			$data['message'] = 'Address was not deleted';
		}
		echo json_encode($data);
		die;
	}

	public function placeOrder()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$userId = $this->input->get('user_id');
		$addressId = $this->input->get('address_id');
		$totalAmount = $this->input->get('total_amount');
		$coupon_amount = $this->input->get('coupon_amount');
		$couponUsed = $this->input->get('coupon_id');
		$subTotalAmount = $this->input->get('subtotal_value');
		$shippingCost = $this->input->get('shipping_cost');
		$paymentStatus = $this->input->get('payment_status') != "" ? $this->input->get('payment_type') : "Unpaid";
		$payment_type = $this->input->get('payment_type') != "" ? $this->input->get('payment_type') : "";
		$payment_method = $this->input->get('payment_method') != "" ? $this->input->get('payment_method') : "";

		if (!is_numeric($coupon_amount) && $coupon_amount < 0) {
			$coupon_amount = 0;
		}

		// $totalAmount = 200.02;
		$arrWhereCart['user_id'] = $userId;
		$arrCartData = $this->api_model->fetchData('users_cart', "*", $arrWhereCart);

		$arrWhereUser['user_id'] = $userId;
		$arrUserData = $this->api_model->fetchData('register_users', "*", $arrWhereUser);
		//echo $this->db->last_query();
		$arrWhereAddress['id'] = $addressId;
		$arrBillingAddress = $this->api_model->fetchData('user_billing_address', "*", $arrWhereAddress);

		$currentDateTime = date("Y-m-d H:i:s");

		$arrOrder['user_id'] = $userId;
		$arrOrder['order_unique_id'] = date("YmdHis", strtotime($currentDateTime));
		$arrOrder['order_total_value'] = $totalAmount;
		$arrOrder['order_subtotal_value'] = $subTotalAmount;
		// $arrOrder['user_discount'] = 10;
		// $arrOrder['coupon_discount'] = 20;
		$arrOrder['date'] = $currentDateTime;
		$arrOrder['order_currency_sign'] = '&#8377;';
		$arrOrder['order_currency'] = 'INR';
		$arrOrder['coupon_id'] = $couponUsed;
		$arrOrder['coupon_discount'] = $coupon_amount;

		if (!empty($arrBillingAddress)) {
			$arrOrder['billing_name'] = $arrBillingAddress[0]->name;
			$arrOrder['billing_email'] = $arrBillingAddress[0]->email;
			$arrOrder['billing_phone'] = $arrBillingAddress[0]->phone;
			$arrOrder['billing_flat_house_floor_building'] = $arrBillingAddress[0]->flat_house_floor_building;
			$arrOrder['billing_locality'] = $arrBillingAddress[0]->locality;
			$arrOrder['billing_landmark'] = $arrBillingAddress[0]->landmark;
			$arrOrder['billing_city'] = $arrBillingAddress[0]->city;
			$arrOrder['billing_state'] = $arrBillingAddress[0]->state;
			$arrOrder['billing_pincode'] = $arrBillingAddress[0]->pincode;
			$arrOrder['billing_state'] = $arrBillingAddress[0]->state;
			$arrOrder['billing_country'] = $arrBillingAddress[0]->country;

			//=========== SHIPPING ADDRESS =================

			$arrOrder['shipping_name'] = $arrBillingAddress[0]->name;
			// $arrOrder['billing_email'] = $arrBillingAddress[0]->email;
			$arrOrder['shipping_phone'] = $arrBillingAddress[0]->phone;
			$arrOrder['shipping_flat_house_floor_building'] = $arrBillingAddress[0]->flat_house_floor_building;
			$arrOrder['shipping_locality'] = $arrBillingAddress[0]->locality;
			$arrOrder['shipping_landmark'] = $arrBillingAddress[0]->landmark;
			$arrOrder['shipping_city'] = $arrBillingAddress[0]->city;
			$arrOrder['shipping_pincode'] = $arrBillingAddress[0]->pincode;
			$arrOrder['shipping_state'] = $arrBillingAddress[0]->pincode;
			$arrOrder['shipping_country'] = $arrBillingAddress[0]->country;
			$arrOrder['shipping_address_type'] = $arrBillingAddress[0]->address_type;
		}
		$arrOrder['billing_address_id'] = $addressId;
		$arrOrder['shipping_cost'] = $shippingCost;
		$arrOrder['shipping_address_id'] = $addressId;
		$arrOrder['payment_status'] = $paymentStatus; // Unpaid OR Paid
		$arrOrder['payment_method'] = $payment_method;
		$arrOrder['payment_type'] = $payment_type;
		$arrOrder['order_status'] = 1;
		$arrOrder['order_status_text'] = "Processing";

		// print_r($arrOrder);die;

		$insertOrder = $this->api_model->insertData("orders_management", $arrOrder);
		if ($insertOrder > 0) {
			/*if ($payment_type == "Credit") {
				//$totalAmount = 
				$arrWhereUser['user_id'] = $userId;
				$arrUserCredit = $this->api_model->fetchDataAsArray('register_users', "credit_limit", $arrWhereUser);
				if (count($arrUserCredit) > 0 && $arrUserCredit[0]['credit_limit'] > 0) {
					$creditLimit = $arrUserCredit[0]['credit_limit'];
					$creditLimit = $creditLimit - $totalAmount;
					$arrUpdateCredit['credit_limit'] = $creditLimit;
					$updateCreditLimit = $this->api_model->updateData('register_users', $arrWhereUser, $arrUpdateCredit);
				}
			}*/
			foreach ($arrCartData as $valueCart) {
				$arrInsertOrderDetails['order_id'] = $insertOrder;
				$arrInsertOrderDetails['product_id'] = $valueCart->product_id;
				$arrInsertOrderDetails['quantity'] = $valueCart->qty;
				$arrInsertOrderDetails['price'] = $valueCart->price;
				$insertOrderDetails = $this->api_model->insertData("order_detail", $arrInsertOrderDetails);
				$this->db->where('row_id', $valueCart->row_id);
				if ($this->db->delete('users_cart')) {
					$returnedRows 	=	$this->db->affected_rows();
				}
			}
			$data['status'] = 'success';
			$data['message'] = 'Order placed successfully';
			$data['order_id'] = $insertOrder;
			$data['order_data'] = $arrOrder;
		} else {
			$data['status'] = 'failed';
			$data['message'] = 'Order was not placed';
			$data['order_id'] = 0;
			$data['order_data'] = array();
		}
		$json = json_encode($data);
		echo $json;
	}

	public function getAllOrders()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$userId = $this->input->get('user_id');
		$arrWhereOrder['user_id'] = $userId;
		$arrOrderData = $this->api_model->fetchDataAsArray('orders_management', "*", $arrWhereOrder, "", "order_id", "DESC");
		if (!empty($arrOrderData)) {
			foreach ($arrOrderData as $key => $results) {
				$orderId = $results['order_id'];

				// $orderDate = date("M d, Y, h:i a", strtotime($results['order_date']));
				$orderDate = date("M d, Y", strtotime($results['date']));

				$arrOrderData[$key] = $results;
				$arrOrderData[$key]['order_date_str'] = $orderDate;

				//============= GET Order Details ===================
				$this->db->select('OD.*, P.product_title, P.product_image ');
				$this->db->from('order_detail OD');
				$this->db->join('product P', 'P.product_id = OD.product_id');
				$this->db->where('order_id', $orderId);
				$query = $this->db->get();
				$resultOrderDetails = $query->result_array();
				//print_r($resultOrderDetails);
				//$arrOrderData[$key]['my_order_details'] = $resultOrderDetails;
				//$arrOrderData[$key]['my_order_details'][0]['product_image'] = $this->config->item('base_url') . "uploads/product/" . $resultOrderDetails[$key]['product_image'];
				if (!empty($resultOrderDetails)) {
					$arrOrderData[$key]['my_order_details'] = array(
						'order_detail_id' => $resultOrderDetails[0]['order_detail_id'],
						'order_id' => $resultOrderDetails[0]['order_id'],
						'product_id' => $resultOrderDetails[0]['product_id'],
						'quantity' => $resultOrderDetails[0]['quantity'],
						'price' => $resultOrderDetails[0]['price'],
						'cgst' => $resultOrderDetails[0]['cgst'],
						'cgst_title' => $resultOrderDetails[0]['cgst_title'],
						'sgst' => $resultOrderDetails[0]['sgst'],
						'sgst_title' => $resultOrderDetails[0]['sgst_title'],
						'is_managed' => $resultOrderDetails[0]['is_managed'],
						'product_title' => $resultOrderDetails[0]['product_title'],
						'product_image' => $this->config->item('base_url') . "uploads/product/" . $resultOrderDetails[0]['product_image'],
					);
				} else {
					$arrOrderData[$key]['my_order_details'] = array();
				}
				//============= GET Order Details ===================
			}
		}
		if (count($arrOrderData) > 0) {
			$data['status'] = 'success';
			$data['message'] = '';
			$data['order_data'] = $arrOrderData;
		} else {
			$data['status'] = 'failed';
			$data['message'] = 'No orders found';
			$data['order_data'] = array();
		}
		$json = json_encode($data);
		echo $json;
	}


	public function add_review()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_id = $this->input->get('user_id');
		$product_id = $this->input->get('product_id'); //uid
		$name  = $this->input->get('name');
		$email_id  = $this->input->get('email_id');
		$message  = $this->input->get('message');
		$data = array(
			'user_id' => $user_id,
			'product_id' => $product_id,
			'name' => $name,
			'email_id' => $email_id,
			'message' => $message,
			'date_added' => date('Y-m-d H:i:s')
		);

		if ($this->db->insert('product_review', $data)) {
			$data['row_id'] = $this->db->insert_id();
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Review added.';
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = '';
		}

		$json = json_encode($data);
		echo $json;
	}


	public function review_list()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_id   = xss_clean(($this->input->get('user_id') != '') ? $this->input->get('user_id') : ''); //uid

		if ($user_id != '') {

			$arrReviewData = $this->api_model->getReviewData(array('user_id' => $user_id), TRUE);

			// print_obj($arrReviewData);die;

			if (!empty($arrReviewData)) {

				foreach ($arrReviewData as $key => $value) {
					$resp[] = array(
						'review_id' => $value['review_id'],
						'user_id' => $value['user_id'],
						'product_id' => $value['product_id'],
						'product_title' => $value['product_title'],
						'name' => $value['name'],
						'email_id' => $value['email_id'],
						'message' => $value['message'],
						'date_added' => $value['date_added'],
					);
				}

				if (!empty($resp)) {
					$data['respData'] = $resp;
					$data['code'] = '200';
					$data['status'] = 'success';
					$data['message'] = 'Review added.';
				} else {
					$data['code'] = '201';
					$data['status'] = 'failed';
					$data['message'] = '';
				}
			} else {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'No review found!';
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Validation Failure!';
		}



		$json = json_encode($data);
		echo $json;
	}


	public function privacy_policy()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$seo_content_details =  $this->common_my_model->common($table_name = 'seo_module', $field = array(), $where = array('seo_module_id' => '15'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// print_obj($seo_content_details);die;

		if (!empty($seo_content_details)) {


			$resp[] = array(
				'description' => $seo_content_details[0]->meta_description,
				// 'keyword' => $seo_content_details[0]->meta_keyword
			);

			$data['respData'] = $resp;
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Data Found!';
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Data not found!';
		}

		$json = json_encode($data);
		echo $json;
	}


	public function blog_list()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');


		$blog_id   = xss_clean(($this->input->get('blog_id') != '') ? $this->input->get('blog_id') : ''); //uid

		if ($blog_id != '') {
			$blogs =  $this->common_my_model->common($table_name = 'blog', $field = array(), $where = array('status' => '1', 'blog_id' => $blog_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		} else {
			$blogs =  $this->common_my_model->common($table_name = 'blog', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		}

		// print_obj($blogs);die;

		if (!empty($blogs)) {

			foreach ($blogs as $key => $value) {
				$resp[] = array(
					'blog_id' => $value->blog_id,
					'blog_title' => $value->blog_title,
					'blog_slug' => $value->blog_slug,
					'category_id' => $value->category_id,
					'image' => ($value->image != '') ? base_url() . 'uploads/blog/' . $value->image : '',
					'meta_title' => $value->meta_title,
					'meta_keyword' => $value->meta_keyword,
					'meta_description' => $value->meta_description,
					'added_date' => $value->added_date,
					'status' => $value->status
				);
			}

			if ($blog_id != '') {
				$data['respData'] = $resp[0];
			} else {
				$data['respData'] = $resp;
			}

			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Data Found!';
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Data not found!';
		}


		$json = json_encode($data);
		echo $json;
	}
}
