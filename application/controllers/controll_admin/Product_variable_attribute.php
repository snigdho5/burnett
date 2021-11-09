<?php defined('BASEPATH') or exit('No direct script access allowed');

class product_variable_attribute extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_admin_login')) {
      redirect('controll_admin');
      exit();
    }
    $this->load->library('form_validation');
    $this->load->library('XLSXWriter');
    $this->load->model('product_model');
    $this->load->model('category_model');

    $this->load->model('gst_model');

    $this->load->model('common_my_model');
  }

  public function list_view()
  {

    $product_id = $this->uri->segment(4);


    $data['data_list'] = $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => $product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    //	$data['category_list'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    // print_r($data['products']);exit;

    $this->load->view('controll_admin/product/product_variable_attribute/product_variable_attribute_list', $data);
  }

  public function add_view()
  {


    // $data['products'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['category_list'] = $this->common_my_model->common($table_name = 'category', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



    $data['brand_list'] = $this->common_my_model->common($table_name = 'brand', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $this->load->view('controll_admin/product/product_variable_attribute/product_variable_attribute_add_view', $data);
  }

  public function product_attribute_get()
  {

?>

    <div class="control-group"><label class="control-label" for="stonegroup_name">Attribute</label>
      <div class="controls"> <select class="form-control" onchange="select_attribute_option_fun();" name="attribute_id" id="attribute_id">
          <option value="">Select Attribute</option>


          <?php


          $products_attribute = $this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('status' => '1', 'variation' => 'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

          foreach ($products_attribute as $key => $value) {
          ?>

            <option value="<?php echo $value->product_attribute_id; ?>"><?php echo $value->name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

  <?php

  }

  public function product_variation_get()
  {

    $attribute_id = $this->input->post('attribute_id');


    $products_variation = $this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('status' => '1', 'variation' => $attribute_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



  ?>

    <div class="control-group"><label class="control-label" for="stonegroup_name">Variation</label>
      <div class="controls"> <select class="form-control" name="variation_id" id="variation_id">
          <option value="">Select Variation</option>


          <?php


          // $products_attribute = $this->common_my_model->common($table_name ='product_attribute', $field = array(), $where = array('status'=>'1','variation'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

          foreach ($products_variation as $key => $value) {
          ?>

            <option value="<?php echo $value->product_attribute_id; ?>"><?php echo $value->name; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

<?php



  }


  function create_slug($string)
  {
    $replace = '-';
    $string = strtolower($string);

    //replace / and . with white space     
    $string = preg_replace("/[\/\.]/", " ", $string);
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

    //remove multiple dashes or whitespaces     
    $string = preg_replace("/[\s-]+/", " ", $string);

    //convert whitespaces and underscore to $replace     
    $string = preg_replace("/[\s_]/", $replace, $string);

    //limit the slug size     
    $string = substr($string, 0, 100);

    //slug is generated     
    return $string;
  }



  function add_submit()
  {
    $product_id = $this->input->post('hidden_product_id');

    $attribute_id = $this->input->post('attribute_id');
    $variation_id = $this->input->post('variation_id');
    $product_price = $this->input->post('product_price');
    $product_regular_price = $this->input->post('product_regular_price');
    $product_weight = $this->input->post('product_weight');
    $product_length = $this->input->post('product_length');
    $product_breadth = $this->input->post('product_breadth');
    $product_height = $this->input->post('product_height');
    $added_date = date('Y-m-d H:i:s');

    $product_variable_attribute = array(

      'product_id' => $product_id,
      'attribute_id' => $attribute_id,
      'variation_id' => $variation_id,
      'product_price' => $product_price,
      'product_regular_price' => $product_regular_price,
      'weight' => $product_weight,
      'length' => $product_length,
      'breadth' => $product_breadth,
      'height' => $product_height,
    );

    // $this->db->where('blog_id',$edit_id);
    // $this->db->update('product_variable_attribute',$product_variable_attribute);
    $this->db->insert('product_variable_attribute', $product_variable_attribute);

    $this->session->set_flashdata('succ_add', 'Successfully added');
    redirect(base_url() . BaseAdminURl . '/product_variable_attribute/list_view/' . $product_id);
  }


  public function edit_view()
  {
    $variable_attribute_id = $this->uri->segment(4);

    $product_id = $this->uri->segment(5);


    // $data['products'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $data['category_list'] = $this->common_my_model->common($table_name = 'category', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['brand_list'] = $this->common_my_model->common($table_name = 'brand', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['edited_details'] = $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('variable_attribute_id' => $variable_attribute_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $this->load->view('controll_admin/product/product_variable_attribute/product_variable_attribute_edit_view', $data);
  }

  function edit_submit()
  {

    //  $product_id= $this->input->post('edited_product_id');

    //  echo $product_id;exit;

    $variable_attribute_id = $this->input->post('hidden_variable_attribute_id');

    $product_id = $this->input->post('hidden_product_id');

    $attribute_id = $this->input->post('attribute_id');
    $variation_id = $this->input->post('variation_id');
    $product_price = $this->input->post('product_price');
    $product_regular_price = $this->input->post('product_regular_price');
    $product_weight = $this->input->post('product_weight');
    $product_length = $this->input->post('product_length');
    $product_breadth = $this->input->post('product_breadth');
    $product_height = $this->input->post('product_height');

    $added_date = date('Y-m-d H:i:s');



    $product_variable_attribute = array(

      'product_id' => $product_id,
      'attribute_id' => $attribute_id,
      'variation_id' => $variation_id,
      'product_price' => $product_price,
      'product_regular_price' => $product_regular_price,
      'weight' => $product_weight,
      'length' => $product_length,
      'breadth' => $product_breadth,
      'height' => $product_height,
    );

    $this->db->where('variable_attribute_id', $variable_attribute_id);
    $this->db->update('product_variable_attribute', $product_variable_attribute);



    $this->session->set_flashdata('succ_add', 'Successfully Edited');
    redirect(base_url() . BaseAdminURl . '/product_variable_attribute/list_view/' . $product_id);
  }

  public function change_status($id, $status)
  {

    //  echo $id;exit;

    $data = array(
      'status' => $status
    );

    $this->db->where('product_id', $id);
    $query = $this->db->update('product', $data);
    if ($query) {
      $this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
      redirect(base_url() . 'controll_admin/product');
      exit();
    }
  }

  public function delete($variable_attribute_id, $product_id)
  {

    //  echo $id;exit;

    $this->db->where('variable_attribute_id', $variable_attribute_id);
    $this->db->delete('product_variable_attribute');
    $this->session->set_flashdata('succ_msg', 'Product Attribute deleted successfully !!!!');
    redirect(base_url() . BaseAdminURl . '/product_variable_attribute/list_view/' . $product_id);
    exit();
  }
}
