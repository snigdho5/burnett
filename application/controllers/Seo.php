<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seo extends CI_Controller {	
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_my_model');
	}
	
	public function index()
	{
		//$data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		//$data['category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1','parent_id'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		$data['product_list'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
        $this->load->view("sitemap",$data);
	}
}
?>