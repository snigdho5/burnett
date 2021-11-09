<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
	private $_uploaded;
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_admin_login')) {
			redirect('admin');
			exit();
		}
		$this->load->library('form_validation');
		$this->load->model('product_model');
		$this->load->model('common_my_model');
		$this->load->model('orders_model');
		$this->load->model('billing_model');
		$this->load->model('myaccountmodel');

		@$this->load->library('dompdf_gen');
		@$this->load->helper('download');
	}

	public function index()
	{

		$data = array();
		$data['orders'] = $this->orders_model->fetch_orders();
		$this->load->view('controll_admin/order_list', $data);
	}


	public function ajax_change()
	{
		$data['action'] = $this->input->post('action');
		if ($data['action'] == 'delete_section') {


			$this->product_model->delete_section($this->input->post('id'));
		} elseif ($data['action'] == 'modify_section') {

			$section_details['product_section_id'] = $this->input->post('id');
			$section_details['product_section_content'] = $this->input->post('product_section_content');
			$this->product_model->modify_product_content($section_details);
		}
	}
	public function view_details($uid)
	{
		if ($uid != '') {
			$myorder = $this->orders_model->get_order_modules_by_unique($uid);
			// print_obj($myorder);die;	
			$order_details = $this->orders_model->get_order_modules_item_by_unique($uid);

			if (!empty($myorder) && !empty($order_details)) {
				$arr['myorder'] = $myorder;
				$arr['order_details'] = $order_details;
			}else if (!empty($myorder) && empty($order_details)) {
				$arr['myorder'] = $myorder;
				$arr['order_details'] = '';
			} else {
				$arr['myorder'] = '';
				$arr['order_details'] = '';
			}
		} else {
			$arr['myorder'] = '';
			$arr['order_details'] = '';
		}

			// print_obj($myorder);die;	

		$this->load->view('controll_admin/order_details', $arr);
	}

	public function update()
	{
		$nowstatus = $this->input->post('order_status');
		$order_id = $this->input->post('order_id');

		if ($order_id != '' && $nowstatus != '') {

			$getOrder = $this->billing_model->get_orderN(array('order_id' => $order_id));

			// print_obj($getOrder);die;

			if (!empty($getOrder)) {

				//update
				if ($nowstatus == '2') {

					//shiprocket starts
					$billing_address = $getOrder->billing_flat_house_floor_building . ' ' . $getOrder->billing_locality;
					$shipping_address = $getOrder->shipping_flat_house_floor_building . ' ' . $getOrder->shipping_locality;
					$postData = array(
						"order_id" => $getOrder->order_unique_id,
						"order_date" => $getOrder->date,
						"pickup_location" => SHIPROCKET_PICKUP_LOCATION,
						"channel_id" => SHIPROCKET_CHANNEL_ID,
						"comment" => "Reseller: M/s Burnett",
						"billing_customer_name" => $getOrder->billing_name,
						"billing_last_name" => "",
						"billing_address" => $billing_address,
						"billing_address_2" => $getOrder->billing_landmark,
						"billing_city" => $getOrder->billing_city,
						"billing_pincode" => $getOrder->billing_pincode,
						"billing_state" => $getOrder->billing_state,
						"billing_country" => $getOrder->billing_country,
						"billing_email" => $getOrder->billing_email,
						"billing_phone" => $getOrder->billing_phone,
						"shipping_is_billing" => true,
						"shipping_customer_name" => "",
						"shipping_last_name" => "",
						"shipping_address" => $shipping_address,
						"shipping_address_2" => $getOrder->billing_landmark,
						"shipping_city" => $getOrder->shipping_city,
						"shipping_pincode" => $getOrder->shipping_pincode,
						"shipping_country" => $getOrder->shipping_country,
						"shipping_state" => $getOrder->shipping_state,
						"shipping_email" => $getOrder->billing_email,
						"shipping_phone" => $getOrder->billing_phone,
						"order_items" => array(
							array(
								"name" => $getOrder->billing_name,
								"sku" => "chakra123",
								"units" => 10,
								"selling_price" => $getOrder->order_total_value,
								"discount" => "",
								"tax" => "",
								"hsn" => 441122
							)
						),
						"payment_method" => "Prepaid",
						"shipping_charges" => 0,
						"giftwrap_charges" => 0,
						"transaction_charges" => 0,
						"total_discount" => 0,
						"sub_total" => $getOrder->order_total_value,
						"length" => $getOrder->length,
						"breadth" => $getOrder->breadth,
						"height" => $getOrder->height,
						"weight" => $getOrder->weight,
					);

					//$data_string = json_encode($postData);

					$response = $this->shiprocket->generateOrder($postData);

					// print_obj($response);die;

					//shiprocket ends
					$order_status = 2;
					$payment_status = 'Ship In Progress';
					$neworder_update = array(
						'order_status' 	=> $order_status,
						'payment_status' 	=> $payment_status,
						'shiprocket_order_id' 	=> $response['order_id'],
						'shiprocket_shipment_id' 	=> $response['shipment_id'],
						'shiprocket_status_code' 	=> $response['status_code'],
					);
				} else if ($nowstatus == '3') {
					$order_status = 3;
					$payment_status = 'Paid';
					$neworder_update = array(
						'order_status' 	=> $order_status,
						'payment_status' 	=> $payment_status
					);
				} else {
					$order_status = $nowstatus;
					$neworder_update = array(
						'order_status' 	=> $order_status
					);
				}



				$this->billing_model->update_order($order_id, $neworder_update);
			}
		}



		redirect('controll_admin/order/view_details/' . $this->input->post('order_unique_id'));
	}

	public function delete($id)
	{
		//echo $this->product_model->delete_product($id);
		if ($this->product_model->delete_product($id)) {
			$this->session->set_flashdata('succ_msg', 'Product deleted successfully !!!!');
			redirect('controll_admin/order');
			exit();
		}
	}

	public function fileupload_check()
	{


		$number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);

		$files = $_FILES['uploadedimages'];


		for ($i = 0; $i < $number_of_files; $i++) {
			if ($_FILES['uploadedimages']['error'][$i] != 0) {
				// save the error message and return false, the validation of uploaded files failed
				$this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');
				return FALSE;
			}
		}

		// we first load the upload library
		$this->load->library('upload');
		// next we pass the upload path for the images
		$config['upload_path'] = 'uploads/';

		// also, we make sure we allow only certain type of images
		$config['allowed_types'] = 'gif|jpg|png';

		// now, taking into account that there can be more than one file, for each file we will have to do the upload
		for ($i = 0; $i < $number_of_files; $i++) {
			$_FILES['uploadedimage']['name'] = time() . rand(1000, 9999999999) . $files['name'][$i];
			$_FILES['uploadedimage']['type'] = $files['type'][$i];
			$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['uploadedimage']['error'] = $files['error'][$i];
			$_FILES['uploadedimage']['size'] = $files['size'][$i];

			//now we initialize the upload library
			$this->upload->initialize($config);
			if ($this->upload->do_upload('uploadedimage')) {
				$this->_uploaded[$i] = $this->upload->data();
			} else {
				$this->form_validation->set_message('fileupload_check', $this->upload->display_errors());
				return FALSE;
			}
		}
		return TRUE;
	}

	public function product_section_image_upload($value, $field)
	{

		if ($_FILES[$field]['size'] != 0) {

			$upload_dir = 'uploads/content/';
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir);
			}
			$config['upload_path']   = $upload_dir;
			$config['max_size'] = 1024 * 5;
			$config['allowed_types'] = 'gif|png|jpg|jpeg';
			$config['overwrite']     = false;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);
			if ($this->upload->do_upload($field)) {
				$upload_data = $this->upload->data();
				$_POST[$field] = $upload_data['file_name'];
				return TRUE;
			} else {
				$this->form_validation->set_message('image_upload', $this->upload->display_errors());
				return FALSE;
			}
		} else {


			$this->form_validation->set_message('image_upload', 'No file selected');
			return false;
		}
	}


	public function delete_image($image_id, $id)
	{

		if ($this->product_model->delete_image_only($image_id)) {
			$this->session->set_flashdata('succ_msg', 'Image deleted successfully !!!!');
			redirect('admin/product/add_edit/' . $id);
			exit();
		}
	}


	function download_order_pdf()
	{
		//echo "ok";
		$order_unique_id = $this->uri->segment(4);

		$order_list = $this->common_my_model->common($table_name = 'orders_management', $field = array(), $where = array('order_unique_id' => $order_unique_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$order_details = $this->common_my_model->common($table_name = 'order_detail', $field = array(), $where = array('order_id' => @$order_list[0]->order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// echo $order_unique_id;exit;

		$shipping_address_details = $this->common_my_model->common($table_name = 'user_shipping_address', $field = array(), $where = array('id' => @$order_list[0]->shipping_address_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$invoice_no = 'Burnett payment detailsadmin-' . rand(000, 999) . '' . $order_list[0]->order_id;

		$mail_data = array(
			'order_list' => $order_list,
			'order_details' => $order_details,
			'shipping_address_details' => $shipping_address_details
		);


		$this->load->view('order_details_invoice', $mail_data);
		//print_r($mail); exit;
		//$this->load->view('mail_template/client_booking_invoice',$mail_data);
		/* $html = $this->output->get_output();
      $dompdf = new DOMPDF();
      $dompdf->load_html($html);
      $dompdf->set_paper('A4', 'portrait');
      $dompdf->render();
      $output = $dompdf->output();
              
      $i = $invoice_no;
      $file_to_save = './upload/invoice/'.$i.'.pdf';
      file_put_contents($file_to_save,$output);

      $data_file = file_get_contents($file_to_save);
          
      $name = $i.'.pdf';
      force_download($name,$data_file);*/
	}
}
