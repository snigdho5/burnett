<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Contact_us extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('common_my_model');
		$this->load->library('pagination');
		$this->load->library('email');
	}

	public function index()
	{


		$data['seo_content_details'] =  $this->common_my_model->common($table_name = 'seo_module', $field = array(), $where = array('seo_module_id' => '3'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$this->load->view('common/header', $data);
		$this->load->view('contact_us_view', $data);
		$this->load->view('common/footer');
	}

	public function mail_submit()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$mymessage = $this->input->post('message');
		$out_message = '';


		if ($email != '' && $phone != '' && $name != '' && $mymessage != '') {

			//email
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// $out_message = $email . " is a valid email address" ;
				$if_email = 1; //email valid
			} else {
				$if_email = 0;
				$out_message .= $email . " is not a valid email address! ";
			}

			//phone with 10 digit
			if (preg_match('/^[0-9]{10}+$/', $phone)) {
				//$out_message = $phone . " is a valid phone" ;
				$if_phone = 1; //phone valid
			} else {
				$if_phone = 0;
				$out_message .= $phone . " is not a valid phone!";
			}

			if ($if_phone == 1 && $if_email == 1) {
				// Send an email with password reset link
				$message = 'Dear Admin' . "\n\n";
				$message .=  ' Contact Form' . "\n\n";
				$message .= 'Name' . ' ' . $name . "\n";
				$message .= 'Email' . ' ' . $email . "\n";
				$message .= 'Phone No' . ' ' . $phone . "\n";
				$message .= 'Message' . ' ' . $mymessage . "\n\n";
				$message .= 'Best Regards,' . "\n";
				$message .= 'Burnett';
				@$this->email->from($email, 'Burnett Support');
				@$this->email->to('support@solutionsfinder.com');
				@$this->email->reply_to($email, 'Burnett');
				@$this->email->subject('Contact Form');
				@$this->email->message($message);
				if (@$this->email->send()) {
					$this->session->set_flashdata('succ', 'Mail successfully sent!');
					redirect(base_url() . 'contact_us', 'refresh');
				} else {
					$this->session->set_flashdata('succ', "Mail successfully Submit.");
					redirect(base_url() . 'contact_us', 'refresh');
				}
			} else {
				$this->session->set_flashdata('exist', $out_message);
				redirect(base_url() . 'contact_us', 'refresh');
			}
		} else {

			$this->session->set_flashdata('exist', "Missing required fields!");
			redirect(base_url() . 'contact_us', 'refresh');
		}
	}
}
