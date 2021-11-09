<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class News extends CI_Controller
{
 function __construct() { 
    parent::__construct();
		if(!$this->session->userdata('is_admin_login')) {
    	redirect('controll_admin');
			exit();
    }
		$this->load->library('form_validation');
		$this->load->library('XLSXWriter');
		$this->load->model('product_model');
		$this->load->model('category_model');
    $this->load->library('image_lib');
		
		$this->load->model('gst_model');

		$this->load->model('common_my_model');

  }
 
  public function index() {    
		
	
		$data['news'] = $this->common_my_model->common($table_name ='news', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	//	$data['category_list'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// print_r($data['products']);exit;
 
		$this->load->view('controll_admin/news/news_list', $data);
	}

	 public function add_view() {    
		
	$data['category_list'] = $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1','parent_id'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
 
		$this->load->view('controll_admin/news/news_add_view',$data);
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



	function data_add_submit()
	{
		           
            $news_title = $this->input->post('news_title');
            $news_slug = $this->create_slug($news_title);
            $category_id = $this->input->post('category_id');
          //  $image = $this->input->post('image');
            $description = $this->input->post('description');
            $meta_title  = $this->input->post('meta_title');
            $meta_keyword = $this->input->post('meta_keyword');
            $meta_description = $this->input->post('meta_description');
            $status = $this->input->post('status');
            $date_added=date('Y-m-d H:i:s');

          //  echo $coupon_end;exit;

             $image=NULL;

         if(@$_FILES['news_image']['name']!="")
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['news_image']['tmp_name'];
            $file = $_FILES['news_image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg")
            {
                move_uploaded_file($file_tmp, "./uploads/news/" . $new_name . "." . $ext);
                
                $image = $new_name . "." . $ext;

                   $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/news/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 600;
                $img_config_4['height'] = 600;
                $img_config_4['new_image'] ='./uploads/news/large/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();

                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/news/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 300;
                $img_config_4['height'] = 300;
                $img_config_4['new_image'] ='./uploads/news/small/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();


             



            
            }
        }

            


            
		    $insert_data= array( 

		    					             'news_title'=>$news_title,
                                'news_slug' =>$news_slug,
                                'category_id'=>$category_id,
                                'image'=>$image,
                                'description'=>$description,
                                'meta_title '=>$meta_title,
                                'meta_keyword'=>$meta_keyword,
                                'meta_description'=>$meta_description,
                                'status'=>$status,
                                'added_by'=>$this->session->userdata('is_admin_login'),
                                
                                'added_date'=>$date_added
                                
                               
                               );

		  
		    $this->db->insert('news', $insert_data);


		    $this->session->set_flashdata('succ_add','Successfully added');
		    redirect(base_url().BaseAdminURl.'/news');
	}


   public function edit_view() {
   $news_id=$this->uri->segment(4);    
    
 

     $data['edited_details'] = $this->common_my_model->common($table_name ='news', $field = array(), $where = array('news_id'=>$news_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     $data['category_list'] = $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1','parent_id'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
 
    $this->load->view('controll_admin/news/news_edit_view',$data);
  }

  function data_edit_submit()
  {
            $news_id = $this->input->post('edited_news_id');
            $news_title = $this->input->post('news_title');
            $news_slug = $this->create_slug($news_title);
            $category_id = $this->input->post('category_id');
          //  $image = $this->input->post('image');
            $description = $this->input->post('description');
            $meta_title  = $this->input->post('meta_title');
            $meta_keyword = $this->input->post('meta_keyword');
            $meta_description = $this->input->post('meta_description');
            $status = $this->input->post('status');
            $date_added=date('Y-m-d H:i:s');

            $old_pic=$this->input->post('old_pic');

          //  echo $coupon_end;exit;

             $image=NULL;

         if(@$_FILES['news_image']['name']!="")
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['news_image']['tmp_name'];
            $file = $_FILES['news_image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg")
            {
                move_uploaded_file($file_tmp, "./uploads/news/" . $new_name . "." . $ext);
                
                $image = $new_name . "." . $ext;

                   $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/news/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 600;
                $img_config_4['height'] = 600;
                $img_config_4['new_image'] ='./uploads/news/large/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();

                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/news/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 300;
                $img_config_4['height'] = 300;
                $img_config_4['new_image'] ='./uploads/news/small/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();


             



            
            }

            @unlink('./uploads/news/'.@$old_pic);
            @unlink('./uploads/news/large/'.@$old_pic);
            @unlink('./uploads/news/small/'.@$old_pic);

        }
        else{
          $image=$old_pic;
        }

            


            
        $insert_data= array( 

                               'news_title'=>$news_title,
                                'news_slug' =>$news_slug,
                                'category_id'=>$category_id,
                                'image'=>$image,
                                'description'=>$description,
                                'meta_title '=>$meta_title,
                                'meta_keyword'=>$meta_keyword,
                                'meta_description'=>$meta_description,
                                'status'=>$status,
                                'added_by'=>$this->session->userdata('is_admin_login'),
                                
                                'added_date'=>$date_added
                                
                               
                               );

        $this->db->where('news_id',$news_id);
        $this->db->update('news',$insert_data);
     


        $this->session->set_flashdata('succ_add','Successfully edited');
        redirect(base_url().BaseAdminURl.'/news');
  }

  public function change_status($id, $status){

  //  echo $id;exit;

    $data = array(
               'status' => $status
            );
    
    $this->db->where('news_id', $id);
    $query = $this->db->update('news', $data); 
    if($query){
       $this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
      redirect(base_url().'controll_admin/news');
      exit();
    }
    
  }

  public function delete($id){



$product_image_details = $this->common_my_model->common($table_name ='news', $field = array(), $where = array('news_id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    @unlink('./uploads/news/'.@$product_image_details[0]->image);
    @unlink('./uploads/news/large/'.@$product_image_details[0]->image);
    @unlink('./uploads/news/small/'.@$product_image_details[0]->image);
 
       
        $this->db->where('news_id',$id);
        $this->db->delete('news');


      $this->session->set_flashdata('succ_msg', 'news deleted successfully !!!!');
      redirect(base_url().'controll_admin/news');
      exit();
    
    
  }



	
	
}