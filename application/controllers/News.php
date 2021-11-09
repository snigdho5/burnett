<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller 
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


            $data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'6'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        
              

            $total_row=  $this->common_my_model->common($table_name ='news', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
            // $total_row=count($total_blog_row);
            $config['base_url'] = base_url()."news-list"."?";
            

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





              //  $data['blog_list']=$this->common_my_model->product_list_page($data_model,$config['per_page'],$page);
            









		$data['blog_list']=  $this->common_my_model->common($table_name ='news', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = $page, $end = $config['per_page']);
			
		$this->load->view('common/header',$data);
		$this->load->view('news_list_view',$data);
		$this->load->view('common/footer');
	}

	public function news_details()
	{
		$news_id = $this->uri->segment(2);

    $data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'7'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['blog_details']=  $this->common_my_model->common($table_name ='news', $field = array(), $where = array('news_id'=>$news_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['blog_review_list']=  $this->common_my_model->common($table_name ='news_review', $field = array(), $where = array('news_id'=>$news_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			
		$this->load->view('common/header',$data);
		$this->load->view('news_details_view',$data);
		$this->load->view('common/footer');
	}

	public function news_review_submit()
  {



    $news_id=$this->input->post('blog_hidden_id');

    $user_id = $this->session->userdata('user_session_id');

    $name=$this->input->post('name');
    $email_id=$this->input->post('email_id');
    $message=$this->input->post('message');
    $date=date('Y-m-d H:i:s');

    $product_details=$this->common_my_model->common($table_name = 'news', $field = array(), $where = array('news_id'=>$news_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


   // echo $blog_id; exit;

if($user_id){

  



    $data=array(
               // 'name'=>$name,
               // 'email_id'=>$email_id,
                'message'=>$message,
                'user_id'=>$user_id,
                'date_added'=>$date,
                'news_id'=>$news_id,

                );



$blog_comment = $this->common_my_model->common($table_name = 'news_review', $field = array(), $where = array('user_id'=>$user_id,'news_id'=>$news_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

if(count($blog_comment)==0)
{

//echo '<pre>';print_r($data);exit;
	 $this->db->insert('news_review',$data);
   $this->session->set_flashdata('succ','Message has been insert successfully...');
   redirect(base_url().'news-details'.'/'.$news_id.'/'.$product_details[0]->news_slug,'refresh');

 }
 else{
$this->db->where('news_id',$news_id);
$this->db->where('user_id',$user_id);
 $this->db->update('news_review',$data);
   $this->session->set_flashdata('succ','Message has been updated successfully...');
   redirect(base_url().'news-details'.'/'.$news_id.'/'.$product_details[0]->news_slug,'refresh');

 }
}

else{


   $this->session->set_flashdata('exist','Check Log in...');
   redirect(base_url().'news-details'.'/'.$news_id.'/'.$product_details[0]->news_slug,'refresh');

}


  

	
}



	
}
?>