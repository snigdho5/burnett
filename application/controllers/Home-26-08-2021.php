<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
{
	public function __construct()
    {
		parent::__construct();
		$this->load->database();
		$this->load->model('common_my_model');
	}
	
	public function index()
	{
		$data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['product_list']=  $this->common_my_model->common($table_name ='product', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$data['category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1','parent_id'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['message'] 		= $this->db->where('status', 1)->get('message')->result();
		$data['youtube'] 		= $this->db->where('id', 1)->where('status', 1)->get('youtube')->result();
		$data['content'] 		= $this->db->where('id', 1)->get('static_content')->result();
		$data['banner']  		= $this->db->where('status', 'Y')->get('banner')->result();
		$data['yourChoice'] 	= $this->db->where('status', 1)->get('get_your_choice')->result();
		$data['featureProduct'] = $this->db->where('status', 1)->get('featured_product')->result();
		
		$this->load->view('common/header',$data);
		$this->load->view('home_view',$data);
		$this->load->view('common/footer');
	}
}
?>