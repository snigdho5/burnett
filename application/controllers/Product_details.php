<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Product_details extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('common_my_model');
    $this->load->library('email');
  }

  public function index()
  {
    $product_id = $this->uri->segment(2);
    $product_uid = $product_id;
    //echo $product_id;exit();

    if ($product_id != '') {
      $toGetProduct_ID = $this->db->where('unique_key', $product_id)->get('product')->result();
      $product_id = $toGetProduct_ID[0]->product_id;

      //$data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'9'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $data['product_details'] = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $product_id, 'status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $data['product_details_image'] = $this->common_my_model->common($table_name = 'product_gallery_image', $field = array(), $where = array('product_id' => $product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $data['control_product_variable_attribute'] = $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => $product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $data['brand_details'] = $this->common_my_model->common($table_name = 'brand', $field = array(), $where = array('brand_id' => $data['product_details'][0]->brand_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $data['product_review_count'] = $this->common_my_model->common($table_name = 'product_review', $field = array(), $where = array('product_id' => $product_uid), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
      $data['related_product_list'] = $this->common_my_model->related_product($product_id);

      $this->load->view('common/header', $data);
      $this->load->view('product_details_view', $data);
      $this->load->view('common/footer');
    } else {
      redirect(base_url());
    }
  }

  public function product_review_submit()
  {



    $product_id = $this->input->post('product_hidden_id');

    $user_id = $this->session->userdata('user_session_id');

    $name = $this->input->post('name');
    $email_id = $this->input->post('email_id');
    $message = $this->input->post('message');
    $date = date('Y-m-d H:i:s');

    $product_details = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $product_id, 'status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


    //  echo $product_id; exit;

    if ($user_id) {





      $data = array(
        'name' => $name,
        'email_id' => $email_id,
        'message' => $message,
        'user_id' => $user_id,
        'date_added' => $date,
        'product_id' => $product_id,

      );



      $blog_comment = $this->common_my_model->common($table_name = 'product_review', $field = array(), $where = array('user_id' => $user_id, 'product_id' => $product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      if (count($blog_comment) == 0) {

        //echo '<pre>';print_r($data);exit;
        $this->db->insert('product_review', $data);
        $this->session->set_flashdata('succ', 'Message has been insert successfully...');
        redirect(base_url() . 'product-details/' . $product_id, 'refresh');
      } else {
        $this->db->where('product_id', $product_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('product_review', $data);
        $this->session->set_flashdata('succ', 'Message has been updated successfully...');
        redirect(base_url() . 'product-details/' . $product_id, 'refresh');
      }
    } else {


      $this->session->set_flashdata('exist', 'Check Log in...');
      redirect(base_url() . 'product-details/' . $product_id, 'refresh');
    }
  }

  public function change_size()
  {
    $variable_attribute_id = $this->input->post('variable_attribute_id');

    $product_variable_attribute_details = $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('variable_attribute_id' => $variable_attribute_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    echo json_encode(array('price' => $product_variable_attribute_details[0]->product_price));
  }

  public function product_enquiry_submit()
  {



    $product_id = $this->input->post('product_enquery_hidden_id');

    $user_id = $this->session->userdata('user_session_id');

    $name = $this->input->post('enquery_name');
    $phone = $this->input->post('enquery_phone');
    $email = $this->input->post('enquery_mail');
    $message = $this->input->post('enquery_message');
    $date = date('Y-m-d H:i:s');

    $product_details = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $product_id, 'status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


    /* $data=array(
                'name'=>$name,
                'email_id'=>$email_id,
                'message'=>$message,
                'user_id'=>$user_id,
                'date_added'=>$date,
                'product_id'=>$product_id,

                );

   $this->db->insert('product_enquiry',$data);*/

    if ($email != '') {

      // Send an email with password reset link
      $message = 'Dear Admin' . "\n\n";
      $message .=  ' Contact Form' . "\n\n";
      $message .= 'Product Name' . ' ' . $product_details[0]->product_title . "\n";
      $message .= 'Name' . ' ' . $name . "\n";
      $message .= 'Email' . ' ' . $email . "\n";
      $message .= 'Phone No' . ' ' . $phone . "\n";
      $message .= 'Message' . ' ' . $message . "\n\n";
      $message .= 'Best Regards,' . "\n";
      $message .= 'Burnett';
      @$this->email->from($email, 'Burnett Support Product enquiry mail');
      @$this->email->to('support@solutionsfinder.com');
      @$this->email->reply_to($email, 'Burnett');
      @$this->email->subject('Product enquiry mail');
      @$this->email->message($message);
      if (@$this->email->send()) {
        $this->session->set_flashdata('succ', 'Mail successfully Submit');
        redirect(base_url() . 'product-details' . '/' . $product_id . '/' . $product_details[0]->unique_key, 'refresh');
      } else {
        $this->session->set_flashdata('succ', "Mail successfully Submit.");
        redirect(base_url() . 'product-details' . '/' . $product_id . '/' . $product_details[0]->unique_key, 'refresh');
      }
    } else {

      $this->session->set_flashdata('succ', "Please enter email id.");
      redirect(base_url() . 'product-details' . '/' . $product_id . '/' . $product_details[0]->unique_key, 'refresh');
    }









    $this->session->set_flashdata('succ', 'Message has been submited successfully...');
    redirect(base_url() . 'product-details' . '/' . $product_id . '/' . $product_details[0]->unique_key, 'refresh');
  }
}
