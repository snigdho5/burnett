<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('is_admin_login')) {
      redirect('controll_admin');
      exit();
    }
    $this->load->library('form_validation');
    //$this->load->library('XLSXWriter');
    $this->load->model('product_model');
    $this->load->model('category_model');
    $this->load->library('image_lib');
    $this->load->model('gst_model');
    $this->load->model('common_my_model');
  }

  public function index()
  {


    $data['products'] = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    //	$data['category_list'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    // print_r($data['products']);exit;

    $this->load->view('controll_admin/product/product_list', $data);
  }

  public function product_add()
  {


    // $data['products'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['category_list'] = $this->common_my_model->common($table_name = 'category', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



    $data['brand_list'] = $this->common_my_model->common($table_name = 'brand', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $this->load->view('controll_admin/product/product_add_view', $data);
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



  function product_add_submit()
  {



    $image = NULL;
    $english_image = NULL;
    $hindi_image = NULL;
    $bengali_image = NULL;

    if (@$_FILES['product_image']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['product_image']['tmp_name'];
      $file = $_FILES['product_image']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);

        $image = $new_name . "." . $ext;

        $img_config_4['image_library'] = 'gd2';
        $img_config_4['source_image'] = './uploads/product/' . $image;
        $img_config_4['create_thumb'] = FALSE;
        $img_config_4['maintain_ratio'] = FALSE;
        $img_config_4['width']  = 600;
        $img_config_4['height'] = 600;
        $img_config_4['new_image'] = './uploads/product/large/' . $image;
        $this->image_lib->initialize($img_config_4);
        $this->image_lib->resize();

        $this->image_lib->clear();

        $img_config_4['image_library'] = 'gd2';
        $img_config_4['source_image'] = './uploads/product/' . $image;
        $img_config_4['create_thumb'] = FALSE;
        $img_config_4['maintain_ratio'] = FALSE;
        $img_config_4['width']  = 300;
        $img_config_4['height'] = 300;
        $img_config_4['new_image'] = './uploads/product/small/' . $image;
        $this->image_lib->initialize($img_config_4);
        $this->image_lib->resize();

        $this->image_lib->clear();
      }
    }

    if (@$_FILES['indication_english_img']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['indication_english_img']['tmp_name'];
      $file = $_FILES['indication_english_img']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);

        $english_image = $new_name . "." . $ext;
      }
    }

    if (@$_FILES['indication_hindi_img']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['indication_hindi_img']['tmp_name'];
      $file = $_FILES['indication_hindi_img']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);

        $hindi_image = $new_name . "." . $ext;
      }
    }

    if (@$_FILES['indication_bengali_img']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['indication_bengali_img']['tmp_name'];
      $file = $_FILES['indication_bengali_img']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);

        $bengali_image = $new_name . "." . $ext;
      }
    }





    $product_type = $this->input->post('select_product_option');

    $attribute_id = $this->input->post('attribute_id');
    $variation_id = $this->input->post('variation_id');
    $brand_id = 1;
    //$brand_id = $this->input->post('brand_id');
    $category_id = $this->input->post('category_id');
    $product_title = $this->input->post('product_title');
    $unique_key = $this->create_slug($product_title);
    $product_code = 'CODPRO' . time() . rand(0000, 9999);



    $product_batch_no = $this->input->post('product_batch_no');
    $product_quantity_info = $this->input->post('product_quantity_info');
    $stock_count = $this->input->post('stock_count');
    $product_price = $this->input->post('product_price');
    $product_regular_price = $this->input->post('product_regular_price');
    $product_description = $this->input->post('product_description');
    $product_weight = $this->input->post('product_weight');

    $dose = $this->input->post('dose');
    $dose_hindi = $this->input->post('dose_hindi');
    $dose_bengali = $this->input->post('dose_bengali');

    $indication_english_text = $this->input->post('indication_english_text');
    $indication_hindi_text = $this->input->post('indication_hindi_text');
    $indication_bengali_text = $this->input->post('indication_bengali_text');

    $meta_title = $this->input->post('meta_title');
    $meta_keyword = $this->input->post('meta_keyword');
    $meta_description = $this->input->post('meta_description');
    $added_date = date('Y-m-d H:i:s');




    $insert_data = array(

      'product_type' => $product_type,
      // 'category_id'=>$category_id,
      'brand_id' => $brand_id,
      'product_title' => $product_title,
      'unique_key' => $unique_key,
      'product_code' => $product_code,
      'product_batch_no' => $product_batch_no,
      'product_quantity_info' => $product_quantity_info,
      'stock_count' => $stock_count,
      'product_price' => $product_price,
      'product_regular_price' => $product_regular_price,
      'weight' => $product_weight,
      'product_description' => $product_description,
      'product_image' => $image,

      'dose' => $dose,
      'dose_hindi' => $dose_hindi,
      'dose_bengali' => $dose_bengali,
      'indication_english_text' => $indication_english_text,
      'indication_hindi_text' => $indication_hindi_text,
      'indication_bengali_text' => $indication_bengali_text,
      'indication_english_img' => $english_image,
      'indication_hindi_img' => $hindi_image,
      'indication_bengali_img' => $bengali_image,

      'meta_title' => $meta_title,
      'meta_keyword' => $meta_keyword,
      'meta_description' => $meta_description,
      'added_date' => $added_date


    );


    $this->db->insert('product', $insert_data);
    $product_id = $this->db->insert_id();

    $product_image_array = array(

      'product_id' => $product_id,
      'product_image' => $image

    );


    $this->db->insert('product_gallery_image', $product_image_array);



    if (count(@$category_id) > 0) {
      for ($i = 0; $i < count(@$category_id); $i++) {

        $product_category = array(

          'product_id' => $product_id,
          'category_id' => $category_id[$i]


        );


        $this->db->insert('product_category', $product_category);
      }
    }


    // if($product_type=='variable'){

    // 	$product_variable_attribute = array(

    //                             'product_id'=>$product_id,
    //                             'attribute_id'=>$attribute_id,
    //                             'variation_id'=>$variation_id,

    //                             );


    // $this->db->insert('product_variable_attribute',$product_variable_attribute);


    // }
    if ($product_type == 'simple') {

      $product_variable_attribute = array(

        'product_id' => $product_id,
        'product_price' => $product_price,
        'product_regular_price' => $product_regular_price,
        'weight' => $product_weight,
      );


      $this->db->insert('product_variable_attribute', $product_variable_attribute);
    }









    $this->session->set_flashdata('succ_add', 'Successfully added');
    redirect(base_url() . BaseAdminURl . '/product');
  }


  public function product_edit()
  {
    $product_id = $this->uri->segment(4);


    // $data['products'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $data['category_list'] = $this->common_my_model->common($table_name = 'category', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['brand_list'] = $this->common_my_model->common($table_name = 'brand', $field = array(), $where = array('status' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['product_list'] = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('status' => '1', 'product_id' => $product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $this->load->view('controll_admin/product/product_edit_view', $data);
  }

  function product_edit_submit()
  {

    $product_id = $this->input->post('edited_product_id');

    //  echo $product_id;exit;

    $old_pic = $this->input->post('old_pic');
    $old_indication_english_img = $this->input->post('old_indication_english_img');
    $old_indication_hindi_img = $this->input->post('old_indication_hindi_img');
    $old_indication_bengali_img = $this->input->post('old_indication_bengali_img');

    $image = NULL;
    $english_image = NULL;
    $hindi_image = NULL;
    $bengali_image = NULL;

    if (@$_FILES['product_image']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['product_image']['tmp_name'];
      $file = $_FILES['product_image']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);

        $image = $new_name . "." . $ext;

        $img_config_4['image_library'] = 'gd2';
        $img_config_4['source_image'] = './uploads/product/' . $image;
        $img_config_4['create_thumb'] = FALSE;
        $img_config_4['maintain_ratio'] = FALSE;
        $img_config_4['width']  = 600;
        $img_config_4['height'] = 600;
        $img_config_4['new_image'] = './uploads/product/large/' . $image;
        $this->image_lib->initialize($img_config_4);
        $this->image_lib->resize();

        $this->image_lib->clear();

        $img_config_4['image_library'] = 'gd2';
        $img_config_4['source_image'] = './uploads/product/' . $image;
        $img_config_4['create_thumb'] = FALSE;
        $img_config_4['maintain_ratio'] = FALSE;
        $img_config_4['width']  = 300;
        $img_config_4['height'] = 300;
        $img_config_4['new_image'] = './uploads/product/small/' . $image;
        $this->image_lib->initialize($img_config_4);
        $this->image_lib->resize();

        $this->image_lib->clear();
      }
      @unlink('./uploads/product/' . @$old_pic);
      @unlink('./uploads/product/large/' . @$old_pic);
      @unlink('./uploads/product/small/' . @$old_pic);
    } else {
      $image = $old_pic;
    }

    if (@$_FILES['indication_english_img']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['indication_english_img']['tmp_name'];
      $file = $_FILES['indication_english_img']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);
        $english_image = $new_name . "." . $ext;
      }
      @unlink('./uploads/product/' . @$old_indication_english_img);
    } else {
      $english_image = $old_indication_english_img;
    }

    if (@$_FILES['indication_hindi_img']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['indication_hindi_img']['tmp_name'];
      $file = $_FILES['indication_hindi_img']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);

        $hindi_image = $new_name . "." . $ext;
      }
      @unlink('./uploads/product/' . @$old_indication_hindi_img);
    } else {
      $hindi_image = $old_indication_hindi_img;
    }

    if (@$_FILES['indication_bengali_img']['name'] != "") {
      $new_name1 = str_replace(".", "", microtime());
      $new_name = str_replace(" ", "_", $new_name1);
      $file_tmp = $_FILES['indication_bengali_img']['tmp_name'];
      $file = $_FILES['indication_bengali_img']['name'];
      $ext = substr(strrchr($file, '.'), 1);
      if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
        move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);

        $bengali_image = $new_name . "." . $ext;
      }
      @unlink('./uploads/product/' . @$old_indication_bengali_img);
    } else {
      $bengali_image = $old_indication_bengali_img;
    }





    $product_type = $this->input->post('select_product_option');

    $attribute_id = $this->input->post('attribute_id');
    $variation_id = $this->input->post('variation_id');
    $brand_id = 1;
    //$brand_id = $this->input->post('brand_id');
    $category_id = $this->input->post('category_id');
    $product_title = $this->input->post('product_title');
    $unique_key = $this->create_slug($product_title);
    $product_code = 'CODPRO' . time() . rand(0000, 9999);



    $product_batch_no = $this->input->post('product_batch_no');
    $product_quantity_info = $this->input->post('product_quantity_info');
    $stock_count = $this->input->post('stock_count');
    $product_price = $this->input->post('product_price');
    $product_regular_price = $this->input->post('product_regular_price');
    $product_description = $this->input->post('product_description');
    $product_weight = $this->input->post('product_weight');

    $dose = $this->input->post('dose');
    $dose_hindi = $this->input->post('dose_hindi');
    $dose_bengali = $this->input->post('dose_bengali');
    $indication_english_text = $this->input->post('indication_english_text');
    $indication_hindi_text = $this->input->post('indication_hindi_text');
    $indication_bengali_text = $this->input->post('indication_bengali_text');


    $meta_title = $this->input->post('meta_title');
    $meta_keyword = $this->input->post('meta_keyword');
    $meta_description = $this->input->post('meta_description');
    $added_date = date('Y-m-d H:i:s');




    $insert_data = array(

      'product_type' => $product_type,
      // 'category_id'=>$category_id,
      'brand_id' => $brand_id,
      'product_title' => $product_title,
      'unique_key' => $unique_key,
      'product_code' => $product_code,
      'product_batch_no' => $product_batch_no,
      'product_quantity_info' => $product_quantity_info,
      'stock_count' => $stock_count,
      'product_price' => $product_price,
      'product_regular_price' => $product_regular_price,
      'product_description' => $product_description,
      'weight' => $product_weight,
      'product_image' => $image,
      'dose' => $dose,
      'dose_hindi' => $dose_hindi,
      'dose_bengali' => $dose_bengali,
      'indication_english_text' => $indication_english_text,
      'indication_hindi_text' => $indication_hindi_text,
      'indication_bengali_text' => $indication_bengali_text,
      'indication_english_img' => $english_image,
      'indication_hindi_img' => $hindi_image,
      'indication_bengali_img' => $bengali_image,

      'meta_title' => $meta_title,
      'meta_keyword' => $meta_keyword,
      'meta_description' => $meta_description,
      'added_date' => $added_date


    );


    // $this->db->insert('product', $insert_data);

    $this->db->where('product_id', $product_id);
    $this->db->update('product', $insert_data);
    // $product_id=$this->db->insert_id();

    $gallery_image_details = $this->common_my_model->common($table_name = 'product_gallery_image', $field = array(), $where = array('product_id' => $product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $product_image_array = array(

      'product_id' => $product_id,
      'product_image' => $image

    );

    $this->db->where('product_image_id', $gallery_image_details[0]->product_image_id);
    $this->db->update('product_gallery_image', $product_image_array);


    //  $this->db->insert('product_gallery_image',$product_image_array);

    $this->db->where('product_id', $product_id);
    $this->db->delete('product_category');



    if (count(@$category_id) > 0) {
      for ($i = 0; $i < count(@$category_id); $i++) {

        $product_category = array(

          'product_id' => $product_id,
          'category_id' => $category_id[$i]


        );


        $this->db->insert('product_category', $product_category);
      }
    }


    // if($product_type=='variable'){

    //  $product_variable_attribute = array(

    //                             'product_id'=>$product_id,
    //                             'attribute_id'=>$attribute_id,
    //                             'variation_id'=>$variation_id,

    //                             );


    // $this->db->insert('product_variable_attribute',$product_variable_attribute);


    // }

    if ($product_type == 'simple') {
      $product_variable_attribute = array(

        // 'product_id'=>$product_id,
        'product_price' => $product_price,
        'product_regular_price' => $product_regular_price,
        'weight' => $product_weight,
      );


      // $this->db->insert('product_variable_attribute',$product_variable_attribute);

      $this->db->where('product_id', $product_id);
      $this->db->update('product_variable_attribute', $product_variable_attribute);
    }








    $this->session->set_flashdata('succ_add', 'Successfully added');
    redirect(base_url() . BaseAdminURl . '/product');
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

  public function delete($id)
  {

    //  echo $id;exit;

    $product_image_details = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    @unlink('./uploads/product/' . @$product_image_details[0]->product_image);
    @unlink('./uploads/product/large/' . @$product_image_details[0]->product_image);
    @unlink('./uploads/product/small/' . @$product_image_details[0]->product_image);


    $this->db->where('product_id', $id);
    $this->db->delete('product_variable_attribute');
    $this->db->where('product_id', $id);
    $this->db->delete('product_category');
    $this->db->where('product_id', $id);
    $this->db->delete('product_gallery_image');





    $this->db->where('product_id', $id);
    $this->db->delete('product');
    $this->session->set_flashdata('succ_msg', 'Product deleted successfully !!!!');
    redirect(base_url() . 'controll_admin/product');
    exit();
  }

  public function product_pickup()
  {
    $data['pickup_det'] = $this->product_model->pickup_details();
    // print_obj($data['pickup_det']);die;

    $this->load->view('controll_admin/product/product_pickup_edit', $data);
  }

  public function product_pickup_edit_submit()
  {
    $id = $this->input->post('pickupid');
    $pickup_pincode = $this->input->post('pickup_pincode');
    $pickup_address = $this->input->post('pickup_address');
    $landmark = $this->input->post('pickup_landmark');
    $contact_number = $this->input->post('contact_number');

    if($id != '' && $id >0 && $pickup_pincode != '' && $pickup_address != '' && $contact_number != ''){
      $data = array(
        'pickup_pincode' => $pickup_pincode,
        'address' => $pickup_address,
        'landmark' => $landmark,
        'phone' => $contact_number,
        'edited_dtime' => DTIME
      );
  
      $this->db->where('id', $id);
      $query = $this->db->update('pickup_details', $data);
      if ($query) {
        $this->session->set_flashdata('succ_msg', 'Pickup details changed successfully !!');
        redirect(base_url() . 'controll_admin/product/product_pickup');
        exit();
      }
    }else{
        $this->session->set_flashdata('succ_msg', 'All the fields are mandatory !!');
        redirect(base_url() . 'controll_admin/product/product_pickup');
        exit();
    }
    
  }
}
