<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Policy extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');
           $this->load->library('pagination');

	}
	
	public function privacy_policy()
	{


      $data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'15'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
         
		$this->load->view('common/header',$data);
		$this->load->view('privacy_policy_view',$data);
		$this->load->view('common/footer');
	}

	public function terms_and_conditions()
	{
		$data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'16'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			
		$this->load->view('common/header',$data);
		$this->load->view('terms_and_conditions_view',$data);
		$this->load->view('common/footer');
	}

	



	
}
?>