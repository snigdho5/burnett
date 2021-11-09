<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_list extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');
           $this->load->library('pagination');

	}
	
	public function index()
	{

	//	$user_id=$this->session->userdata('user_session_id');

		 //$category_id=$this->uri->segment(2);
        $parent_category = $this->uri->segment(2);
        $sub_category = $this->uri->segment(3);
      //  $category = $this->uri->segment(4);

  

            $data['category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1','parent_id'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');	


           


        if($parent_category!=''){

       
          $parent_category_data=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('unique_name'=>$parent_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



        

          $data['category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('parent_id'=>$parent_category_data['0']->cat_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


        }

         

        // echo "<pre>"; print_r($parent_category_data); 

 // secho $parent_category_data[0]->category_id;exit;

         if($sub_category!=''){


          $sub_category_data=$this->common_my_model->common($table_name = 'category', $field = array(), $where = array('unique_name'=>$sub_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        }

     
      


        $data_model=array(

                      'parent_category_id'=>@$parent_category_data['0']->cat_id,
                      'sub_category_id'=>@$sub_category_data['0']->cat_id,
                      
                     
                      
                    );





            $url=$this->uri->segment(2);
          
            $data['url']=$this->common_my_model->selectOne('category','unique_name',@$url);

            if($this->uri->segment(2))
            {
                
                    $url=$this->uri->segment(2);
        $data['url']=$this->common_my_model->selectOne('category','unique_name',$url);
                   $url_id= $data['url'][0]->cat_id;
                   

                $total_row=$this->common_my_model->product_list($data_model);
             

         //  echo count($total_row);exit; 
  
                
            }
            else
            {
              

                 $total_row=$this->common_my_model->product_list($data_model);
                //  echo count($total_row);exit;
            }

            
         if($this->uri->segment(2))
            {
                if(count($data['url']))
                {
                    $url=$this->uri->segment(2);
                    $config['base_url'] = base_url()."product-list"."/".$url."?";
                }
                else
                {
                    redirect(base_url()."product-list");
                }
            }
            else
            {
                 $config['base_url'] = base_url()."product-list"."?";
            }






            $config['total_rows'] = count($total_row); 
            $config['per_page'] = 10;
            $config['first_link'] = 'FIRST';
            $config['last_link'] = 'LAST';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'NEXT<i class="fa fa-angle-double-right"></i>';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '<i class="fa fa-angle-double-left"></i>PREV';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['full_tag_open'] = '<ul class="pagination pagination-center">';
            $config['full_tag_close'] = '</ul>';
            $config['cur_tag_open'] = '<li class="page-item active">';
            $config['cur_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            $config["num_links"] =8;
            $config['page_query_string'] = TRUE;

            $this->pagination->initialize($config);
            if(isset($_GET['per_page'])){
                $page = $_GET['per_page'] ;


            }
            else{
                $page = 0;
            }
           $str_links = $this->pagination->create_links();

           $data['links'] = $str_links;

         //  $data['blog_list']=$this->common_model->fetch_all_blog('tbl_blog',$config['per_page'],$page);




  if($this->uri->segment(2))
            {
                 if(count($data['url']))
                {
                    $url=$this->uri->segment(2);
                    $url_id= $data['url'][0]->cat_id;
                  

                    $data['product_list']=$this->common_my_model->product_list_page($data_model,$config['per_page'],$page);
                }
                else
                {
                    redirect(base_url()."product-list");
                }
            }
            else
            {
               

                $data['product_list']=$this->common_my_model->product_list_page($data_model,$config['per_page'],$page);
            }


     // echo '<pre>'; 
     // print_r($data['product_list']);exit;
		

		
				
		$this->load->view('common/header');
		$this->load->view('product_list_view',$data);
		$this->load->view('common/footer');
	}



	



	
}
?>