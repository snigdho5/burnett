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
		$key = '';
		if($this->input->get('key')!= '')
		{
			$product_key = $this->input->get('key');
			if($product_key == 'all'){
				$key = '';
			} else {
				$key = $product_key;
			}
		}
        // echo $sub_category;exit;

            $data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'8'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

            $data['category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1','parent_id'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');	
            $data['sub_category_list']=array();


           


        if($parent_category !='' && $sub_category == ''){

       
          @$parent_category_data=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('unique_name'=>$parent_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



        

          $data['sub_category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('parent_id'=>@$parent_category_data['0']->cat_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

         // echo "<pre>"; print_r($parent_category_data); 

      // echo $parent_category_data[0]->cat_id;exit;


        }

         

         

         if($parent_category !='' && $sub_category!=''){


          $sub_category_data=$this->common_my_model->common($table_name = 'category', $field = array(), $where = array('unique_name'=>$sub_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

         // echo $sub_category_data[0]->cat_id;exit;

        }



      //  echo "<pre>"; print_r($parent_category_data); 

      // echo $parent_category_data[0]->cat_id;

       // echo $sub_category_data[0]->cat_id;exit;
      


        $data_model=array(

                      'parent_category_id'=>@$parent_category_data['0']->cat_id,
                      'sub_category_id'=>@$sub_category_data['0']->cat_id,
					  'key'=>@$key,
                      
                     
                      
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

          //  $data['category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('parent_id'=>$parent_category_data['0']->cat_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


     // echo '<pre>'; 
     // print_r($data['product_list']);exit;

            $data['brand_list']=  $this->common_my_model->common($table_name ='brand', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 
		

		
				
		$this->load->view('common/header',$data);
		$this->load->view('product_list_view',$data);
		$this->load->view('common/footer');
	}




  public function srearch_product()
  {

    $product_name=$this->input->get('product_name');
    $category=$this->input->get('category_id');
    $data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'8'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $data['product_list']=  $this->common_my_model->product_list_by_searching($product_name,$category);

  
        
    $this->load->view('common/header',$data);
    $this->load->view('srearch_product_view',$data);
    $this->load->view('common/footer');
  }


    public function product_filter()
  {

  //  $user_id=$this->session->userdata('user_session_id');

     //$category_id=$this->uri->segment(2);
        $parent_category = $this->input->post('parent_category');
       
        $sub_category = $this->input->post('sub_category');
        $brand_ids = $this->input->post('brand_ids');
        $max = $this->input->post('max');
        $min = $this->input->post('min');
        $orderbyprice = $this->input->post('orderbyprice');
        $parent_category = $this->input->post('parent_category');
        $parent_category = $this->input->post('parent_category');
        $parent_category = $this->input->post('parent_category');
        $parent_category = $this->input->post('parent_category');
      //  $category = $this->uri->segment(4);

        // echo $sub_category;exit;

  


        if($parent_category !='' && $sub_category == ''){

       
          @$parent_category_data=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('unique_name'=>$parent_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



        

          $data['sub_category_list']=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('parent_id'=>@$parent_category_data['0']->cat_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

         // echo "<pre>"; print_r($parent_category_data); 

      // echo $parent_category_data[0]->cat_id;exit;


        }

         

         

         if($parent_category !='' && $sub_category!=''){


          $sub_category_data=$this->common_my_model->common($table_name = 'category', $field = array(), $where = array('unique_name'=>$sub_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

         // echo $sub_category_data[0]->cat_id;exit;

        }



      //  echo "<pre>"; print_r($parent_category_data); 

      // echo $parent_category_data[0]->cat_id;

       // echo $sub_category_data[0]->cat_id;exit;
      


        $data_model=array(

                      'parent_category_id'=>@$parent_category_data['0']->cat_id,
                      'sub_category_id'=>@$sub_category_data['0']->cat_id,
                      
                     
                      
                    );



              

                 $product_list=$this->common_my_model->product_filter_list($data_model,$brand_ids,$max,$min,$orderbyprice);
                //  echo count($total_row);exit;
            

            
       
         

     // echo '<pre>'; 
     // print_r($data['product_list']);exit;

?>
   
<li id="package_heading" class="li_heading" style="">
    <ul><li class="product-name">Product Name</li><li class="potency">Potency</li><li class="product-price">Price</li><li class="cart-button">Buy Now</li>			
    </ul>
</li>   
    
<?php if(count($product_list)>0){
	foreach($product_list as $row){ ?>       
 <li class="no-heading">
			<ul>
				<li class="product-name"><div class="screen-resize" style="display: none;">Product Name</div><a href="<?php echo base_url();?>product-details/<?php echo $row->product_id;?>/<?php echo $row->unique_key;?>" onclick="#"><?php echo $row->product_title;?></a></li>
				<li class="potency"><div class="screen-resize" style="display: none;">Potency</div><select name="" onchange="">                                 	
				<option value="">Q 10ml</option>
				<option value="">Q 20ml</option>
				<option value="">Q 30ml</option>
				 </select>
				</li>
				<li class="product-price"><div class="screen-resize" style="display: none;">Price</div>Rs. <span id="comb_price_3469">85.00</span></li>
				<li class="cart-button"><div class="screen-resize" style="display: none;"></div>
				<a class="new_list_btn" onclick="" rel="" href="#" title="Buy Now">Buy Now</a>
				 </li>
			</ul>
			<input type="hidden" name="hdncomb_3469" id="hdncomb_3469" value="">
		</li> 
 <?php } } else{ echo '<h1>No Products Found.</h1>'; } ?>
    
        
 <?php   
  }

	



	
}
?>