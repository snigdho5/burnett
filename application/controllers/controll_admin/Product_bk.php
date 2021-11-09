<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Product extends CI_Controller
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
		
		$this->load->model('gst_model');

  }
 
  public function index() {    
		
		$data = array();
		$data['products'] = $this->product_model->product_list();	
  /*
[product_id] => 4
            [product_code] => 10063000
            [unique_key] => sarnamasuryrice-2
            [product_title_eng] => Sarna Masury Rice 2 kg Packet
            [product_title_hin] => 
            [product_title_ben] => 
            [product_des_eng] => Organic Non Aromatic Rice
            [product_des_hin] => 
            [product_des_ben] => 
            [category_id] => 11
            [gst_id] => 1
            [product_price_inr] => 190.467
            [product_price_usd] => 2.857
            [product_unit] => Piece
            [product_batch_no] => GROSMR2KG
            [product_quantity_info] => 2000 gm
            [product_image] => 15331163707723886158sona.png
            [stock_count] => 10
            [status] => 1

  */
/*
$data['mainCat'] = $this->category_model->category_details_by_id($id);	

echo "<pre>";
print_r($data['mainCat']);
exit;
*/
		$this->load->view('controll_admin/product/product_list', $data);
	}

	
	 public function product_bulk_mng() {    
		
		$data = array();
		$data['what_to_edit'] = $this->input->post('what_to_edit');
		
		
		if($this->input->post()){
		
		foreach($this->input->post('product_GUID') as $PGUID)

			{
				if($this->input->post('what_to_edit')=='product_price')
				{
					$data_bulk_edit[$this->input->post('what_to_edit').'_inr'] = $this->input->post($this->input->post('what_to_edit').'_inr_'.$PGUID);
					$data_bulk_edit[$this->input->post('what_to_edit').'_usd'] = $this->input->post($this->input->post('what_to_edit').'_usd_'.$PGUID);
			
				}
				else
				{
			$data_bulk_edit[$this->input->post('what_to_edit')] = $this->input->post($this->input->post('what_to_edit').'_'.$PGUID);
				}
				
				if($last_id = $this->product_model->edit_product($PGUID, $data_bulk_edit)){
							$this->session->set_flashdata('succ_msg', 'Product updated successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
	

			}
			
		//	redirect('controll_admin/product/product_bulk_mng');
		}

		$data['products'] = $this->product_model->product_list();			
		$this->load->view('controll_admin/product_bulk_mng', $data);
		
		
		
		
	}
	
	public function product_excel_up() {


if(!empty($_FILES) && is_uploaded_file($_FILES['uploaded_csv']['tmp_name']))
		{
			
				
							$uploaded_csv=time().$_FILES['uploaded_csv']['name'];
$ext=substr($uploaded_csv,strrpos($uploaded_csv,"."),(strlen($uploaded_csv)-strrpos($uploaded_csv,".")));
if($ext=='.xlsx' || $ext=='.xls' || $ext=='.csv')
{
							move_uploaded_file($_FILES['uploaded_csv']['tmp_name'],'uploads/bulk/'.$uploaded_csv);
							
						require('uploads/php-excel-reader/excel_reader2.php');

	require('uploads/SpreadsheetReader.php');

	date_default_timezone_set('UTC');

  $Filepath = 'uploads/bulk/'.$uploaded_csv;
	//$Filepath = 'uploads/bulk/1532495986output.xlsx';
	$StartMem = memory_get_usage();
	try

	{

		$Spreadsheet = new SpreadsheetReader($Filepath);

		$BaseMem = memory_get_usage();



		$Sheets = $Spreadsheet->Sheets();



	//echo '---------------------------------'.PHP_EOL;

	//echo 'Spreadsheets:'.PHP_EOL;

		//print_r($Sheets);

		//echo '---------------------------------'.PHP_EOL;

		//echo '---------------------------------'.PHP_EOL;



		foreach ($Sheets as $Index => $Name)

		{

		//echo '---------------------------------'.PHP_EOL;

		//echo '*** Sheet '.$Name.' ***'.PHP_EOL;

			//echo '---------------------------------'.PHP_EOL;



			$Time = microtime(true);



			$Spreadsheet->ChangeSheet($Index);

$new_arr  =array();
$get_title = '';	
$msg='<table class="table table-condensed table-hover table-striped">';

			foreach ($Spreadsheet as $Key => $Row)

			{
			
			//echo $Key;

				if ($Row)

				{

					//print_r($Row);

				}

				else

				{

					//var_dump($Row);

				}
				
				//exit;
				$count = 0;
				
if($Row[0]=='')
{
}
elseif($Row[0]=='product_id')
{
foreach ($Row as $k => $v)
{
	//echo $k;
$mainhead[$k]=$v;
}	
}
else
{
$inserarray =array();
foreach ($Row as $k => $v)
{
	//echo $k;
$inserarray[$mainhead[$k]]=$v;
}
//echo "select * from product_management where `unique_key`='".$inserarray['unique_key']."'";
//var_dump($inserarray);
unset($inserarray['product_id']);
 $query = $this->db->query("select * from product_management where `unique_key`='".$inserarray['unique_key']."'");
$user_exist_check = $query->num_rows();
        if($user_exist_check>0){
			
			$val = $query->result();
			$msg.= '<br>Product id '.$val[0]->product_id.' - edited ';
			$val = $query->result();
			//echo ;
			
          $this->product_model->edit_product($val[0]->product_id, $inserarray) ;
        }else{
			//echo 'add';
			$msg.= '<br>New Product - added ';
			$this->product_model->add_product($inserarray);


		}
		//echo '<br>';
//var_dump($inserarray);	
}
	
			}

	

			//echo PHP_EOL.'---------------------------------'.PHP_EOL;

			//echo 'Time: '.(microtime(true) - $Time);

			//echo PHP_EOL;



			//echo '---------------------------------'.PHP_EOL;

			//echo '*** End of sheet '.$Name.' ***'.PHP_EOL;

			//echo '---------------------------------'.PHP_EOL;

		}

		

	}

	catch (Exception $E)

	{

		$msg = $E -> getMessage();

	}
}
else
{
	$msg = 'Please choose correct format of excel';
}
	
	$data['msg'] = $msg;
		}
		
	
		
$query = $this->db->query('SELECT * FROM product_management'); 
$cur_date = date("d-m-Y");
$main_data_val = array();
$headers = $query->list_fields();
//var_dump($headers);
foreach($headers as $header) {
    $head[] = $header;
}
$fp = fopen('php://output', 'w');

if ($fp) {
   // header('Content-Type:text/html;charset=UCS-2LE');
  //  header('Content-Disposition: attachment; filename="product-cakes-'.$cur_date.'.csv"');
   // header('Pragma: no-cache');
   // header('Expires: 0');
	
    array_push($main_data_val, array_values($head)); 
   foreach ($query->result_array() as $row)
	{
		//var_dump($row);
		 array_push($main_data_val, array_values($row)); 
       
    }
	

$writer = new XLSXWriter();
$writer->writeSheet($main_data_val);
$writer->writeToFile('output.xlsx');	

    //die;
	$data['downloaded_file_name'] = 'output.xlsx';
	
}	
							
$this->load->view('controll_admin/product_excel_up', $data);

}
	public function add_edit() {
		
	 $id = $this->uri->segment(4);
	 $data = array();
		if($this->input->post()){
			

			$this->form_validation->set_rules('product_title_eng', 'Product Title', 'required|min_length[2]');
			
			$this->form_validation->set_rules('category_id', 'Product category', 'required');
			
			
			if($_FILES['main_image']['name'][0] =='' && $id > 0){
						
			}else{
				
				$this->form_validation->set_rules('main_image[]','Upload images','callback_filemain_image_check');	
			}	
			
					
			
			if($this->form_validation->run() == TRUE){
				
				$data['product_title_eng'] = $this->input->post('product_title_eng');
				$data['product_des_eng'] = $this->input->post('product_des_eng');
				$data['product_title_hin'] = $this->input->post('product_title_hin');		
				$data['product_des_hin'] = $this->input->post('product_des_hin');		
				$data['product_title_ben'] = $this->input->post('product_title_ben');					
				$data['product_des_ben'] = $this->input->post('product_des_ben');			
				$data['category_id'] = $this->input->post('category_id');	
				$data['gst_id'] = $this->input->post('gst_id');
				$data['product_price_inr'] = $this->input->post('product_price_inr');
				$data['product_price_usd'] = $this->input->post('product_price_usd');	
				$data['product_unit'] = $this->input->post('product_unit');
				$data['product_batch_no'] = $this->input->post('product_batch_no');
				$data['product_quantity_info'] = $this->input->post('product_quantity_info');
				$data['stock_count'] = $this->input->post('stock_count');
				
				$data['unique_key'] = $this->input->post('unique_key');
				
				if($data['unique_key'] == ''){
					$data['unique_key'] = strtolower(str_replace(' ','-',$data['product_title_eng']));
				}
			
				
				
				/*if($id == ''){			
					$data['date_added'] = date('Y-m-d H:i:s');
					$data['uploadedimages'] = $this->_uploaded;
					
				}*/
				$mainimages = $this->_uploaded_main_image;
				$image = $mainimages[0]['file_name'];	
				
				if($image != ''){
					$data['product_image'] = $image;
				}		

				if($id > 0){
						if($last_id = $this->product_model->edit_product($id, $data)){
							$this->session->set_flashdata('succ_msg', 'Product updated successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}else{
					/*echo 'here';
					var_dump($data);exit;*/
						if($last_id = $this->product_model->add_product($data)){
							$this->session->set_flashdata('succ_msg', 'Product added successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}
				
				
				
		$link_count = $this->input->post('link_count');
		$section  =array();
		for($S=1;$S<=$link_count;$S++)
		{
			$section[$S]['link_title']=$this->input->post('link_title_'.$S);
			$section[$S]['link_subtitle']=$this->input->post('link_subtitle_'.$S);
			$section[$S]['link_link']=$this->input->post('link_link_'.$S);
			
		}
		
		
			$this->product_model->update_product_link($last_id,$section);
			redirect('controll_admin/product');
				//exit;	
			}
		
		}
		
		if($id > 0){
			$data['product_details'] = $this->product_model->product_details_by_id($id);
			$product_section = $this->product_model->get_product_section($id);	
			$data['product_section'] = $product_section;
		}
		
		
//chk_sub_categories($subcategory_id)

    //$data['chk'] = $this->product_model->chk_sub_categories($subcategory_id);



		$data['results'] = $this->product_model->active_category_list();



/*echo "<pre>";
print_r($data['results']);
exit;
*/

		$data['results_gst'] = $this->gst_model->active_gst_list();
	
		$this->load->view('controll_admin/product/product_add_edit',$data);
		
	}




	
	public function view_details($id){
		
		$user = $this->user_model->user_details_by_id($id);
		$data['user'] = $user[0];
		//var_dump($data);
		$this->load->view('controll_admin/user_details',$data);
	}
	
	public function change_status($id, $status){
		
		if($this->product_model->change_status($id, $status)){
			$this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
			redirect(base_url().'controll_admin/product');
			exit();
		}
		
	}
	
	public function ajax_change() {
	$data['action'] = $this->input->post('action');
	 if($data['action']=='delete_link')
			{
			
			$this->product_model->delete_link($this->input->post('id'));
			
			}
	elseif($data['action']=='modify_link')	
			{
		
			 $section_details['product_link_id']=$this->input->post('id');
			 $section_details['product_link_title']=$this->input->post('already_link_title');
			 $section_details['product_link_subtitle']=$this->input->post('already_link_subtitle');
			 $section_details['product_link_href']=$this->input->post('already_link_href');
			
			//var_dump($section_details); 
			$this->product_model->modify_product_link($section_details);
			
			
			}
	elseif($data['action']=='cancel_booking')	
			{
		
			$order_id=$this->input->post('order_id');
			
			 
			$this->orders_model->cancel_order($order_id);
			
			$order_details = $this->orders_model->get_order_by_id($order_id);

$order_details_full = $this->orders_model->get_order_modules_item_by_unique($order_details[0]->order_unique_id,'room_booking_archive');	

$msg='<div style="margin:0 auto; width:700px;">
        <table cellpadding="0" cellspacing="0" width="700" style="margin:0 auto;">
            <tr>
            	<td colspan="3"><h2 style="text-align: center; text-transform:uppercase; color:#0066b4; font-size:25px; text-decoration:underline; margin-bottom:40px;font-family:Open Sans, sans-serif;">Booking Cancellation Report</h2></td>
				</tr>
				<tr>
                
                <td colspan="2"><img src="'.base_url().'images/logo.png" style="width:250px;"></td>
                          
                <td style="text-align:right; width:300px; font-family:Open Sans, sans-serif;">
                    Booking Id: '.$order_details[0]->order_unique_id.'<br>
                    Booking Date & time: '.date('M d,Y',$order_details[0]->date).'<br>
                    <strong>Cancelled By Admin</strong>
                </td>
            </tr>
            
            <tr>
            	<td style="width:300px; padding-top:10px;"><p style="font-family:Open Sans, sans-serif;">Dear '.$order_details[0]->billing_member_name.'</p>
				<p style="font-family:Open Sans, sans-serif;">Thank you for choosing Enjoy Holidayinn .</p></td>
            	
            </tr>';
			 foreach($order_details_full as $order_dt){ 
               // var_dump($order);  
			   $hotel_details = $this->hotel_model->category_details_by_id($order_dt->product_id);
			   
            $hotel_policy = $hotel_details->tnc;
			    $cancellation_policy = $hotel_details->cancellation_policy;
            $msg.='<tr>
            	<td colspan="2" style="padding-bottom:50px;"><img src="'.base_url().'uploads/'.$order_dt->product_section_image.'" width="200" height="100" alt=""></td>
            	
                <td style="text-align:right; font-family:Open Sans, sans-serif;">
                    <strong>Hotel Name:</strong> '.$hotel_details->name.'<br>
                    <strong>Hotel addres:</strong> '.$hotel_details->parent_name.'<br>
                    <strong>contract no:</strong> '.$hotel_details->hotel_contact.'
                </td>
            </tr>
            
            <tr style="background: #0066b4;color: #fff;font-size: 12px;line-height: 40px; text-align:center; padding:0 5px;font-family:Open Sans, sans-serif;">
                <th style="text-align:left;padding: 0 13px; font-family:Open Sans, sans-serif;">
                    Room Type 
                </th>
                
                <th style="text-align:left;padding: 0 13px; font-family:Open Sans, sans-serif;">
                    No of Room 
                </th>
                
                <th style="text-align:right;padding: 0 13px; font-family:Open Sans, sans-serif;">
                    Name of Guest  
                </th>
                
                
            </tr>
            
            
            <tr>
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:left;">
                    '.$order_dt->product_section_title.'
                </td>
                
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:left;">
                    '.$order_dt->room_quantity.'
                </td>
                
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:right;">'.$order_details[0]->billing_member_name.'</td>
            </tr>
            
            <tr style="background: #0066b4;color: #fff;font-size: 12px;line-height: 40px; text-align:center; padding:0 5px;font-family:Open Sans, sans-serif;">
                <td style="text-align:left;padding: 0 13px;">
                    Check in 
                </td >
                
                <td style="text-align:left;padding: 0 13px; font-family:Open Sans, sans-serif; ">Check out </td>
                
                <td style="text-align:right;padding: 0 13px; font-family:Open Sans, sans-serif; ">
                    Price';
				   $diff = date_diff(date_create($order_dt->checkin_date), date_create($order_dt->checkout_date));
	 $interval = $diff->format("%a");
	$total_booking_amount =  $order_dt->room_price*$order_dt->room_quantity*$interval;
	$total_gst =  $total_booking_amount * $order_dt->room_gst/100;
	$total_booking_amount_final =  $total_booking_amount + $total_gst;
	 $msg.=number_format($order_dt->room_price,2).' X '.$interval.' Days
                </td>
            </tr>
            
            <tr>
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:left;">
                    '.$order_dt->checkin_date.'
                </td>
                
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:left;">
                    '.$order_dt->checkout_date.'
                </td>
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:right;">
                   Booking amount:'.number_format($total_booking_amount,2).'
                </td>
                
            </tr>
            
                       
            <tr>
                <td></td>
                
                <td></td>
                
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:right;">
                   Gst Amount ('.$order_dt->room_gst.'%):'.number_format($total_gst,2).'
                </td>
            </tr>
                        
            <tr>
                <td></td>
                <td></td>
                <td style="padding:13px; color: #333;font-size: 13px;font-family:Open Sans, sans-serif; text-align:right;">
                  Total Amount paid:'.number_format($total_booking_amount_final,2).'
                </td>
            </tr>';
			 }
            
       $msg.=' </table>
        
        <table>
        	<tr>  <td>           

			<p style="font-family:Open Sans, sans-serif; font-size:14px; ">Booked by - ';
			
			if($order_details[0]->member_type=='agent')
			{
				$agentdetails = $this->agent_model->user_details_by_id($order_details[0]->member_id);
				$msg.=$agentdetails[0]->member_name.' ('.$agentdetails[0]->agent_code.')';
			}
			else
			{
				$userdetails = $this->user_model->user_details_by_id($order_details[0]->member_id);
				$msg.=$userdetails[0]->member_name;
			
			}
			$msg.='</p>         
              
			<p><strong>Hotel policy </strong> <br>'.$hotel_policy.'</p>      
			<p><strong>Cancellation policy </strong> <br>'.$cancellation_policy.'</p>       
            </td>
            </tr>
        
        </table>
    </div>';
               //echo "You got it!";
				$this->email->from('no-reply@njoyholidayinn.com', 'Holidayinn');
				if($order_details[0]->member_type=='agent')
			{
				$this->email->to(array('enjoyholidayinn@gmail.com',$order_details[0]->billing_email_id,$agentdetails[0]->email_address));
			
			}
			else
			{
				$this->email->to(array('enjoyholidayinn@gmail.com',$order_details[0]->billing_email_id));
			}




$this->email->subject('Booking Cancelled - '.$order_details[0]->order_unique_id);
$this->email->set_mailtype('html');
$this->email->message($msg);
//echo $this->email->print_debugger();
if($this->email->send())
{

//echo $this->email->print_debugger();
//$this->session->set_flashdata('success_msg', 'Message Send Successfully');
//$this->session->set_flashdata('err_msg', '');

}
else
{
	//$this->session->set_flashdata('err_msg', 'Something wrong. Please try again');
	//$this->session->set_flashdata('success_msg', '');

}
			}
	}
	
	public function delete($id){
		
		if($this->user_model->delete_user($id)){
			$this->session->set_flashdata('succ_msg', 'User deleted successfully !!!!');
			redirect(base_url().'controll_admin/user');
			exit();
		}
		
	}
	



	public function fileupload_check() {
    
    
    $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
    
    $files = $_FILES['uploadedimages'];

   
    for($i=0;$i<$number_of_files;$i++)
    {
      if($_FILES['uploadedimages']['error'][$i] != 0)
      {
        // save the error message and return false, the validation of uploaded files failed
        $this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');
        return FALSE;
      }
    }
    
    // we first load the upload library
    $this->load->library('upload');
    // next we pass the upload path for the images
    $config['upload_path'] = 'uploads/';
		
    // also, we make sure we allow only certain type of images
    $config['allowed_types'] = 'gif|jpg|png';

    // now, taking into account that there can be more than one file, for each file we will have to do the upload
    for ($i = 0; $i < $number_of_files; $i++)
    {
      $_FILES['uploadedimage']['name'] = time().rand(1000,9999999999).$files['name'][$i];
      $_FILES['uploadedimage']['type'] = $files['type'][$i];
      $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['uploadedimage']['error'] = $files['error'][$i];
      $_FILES['uploadedimage']['size'] = $files['size'][$i];
      
      //now we initialize the upload library
      $this->upload->initialize($config);
      if ($this->upload->do_upload('uploadedimage'))
      {
        $this->_uploaded[$i] = $this->upload->data();
      }
      else
      {
        $this->form_validation->set_message('fileupload_check', $this->upload->display_errors());
        return FALSE;
      }
    }
    return TRUE;
  }



	
	public function filemain_image_check() {
    
    
    $number_of_files = sizeof($_FILES['main_image']['tmp_name']);
    
    $files = $_FILES['main_image'];

   
    for($i=0;$i<$number_of_files;$i++)
    {
      if($_FILES['main_image']['error'][$i] != 0)
      {
        // save the error message and return false, the validation of uploaded files failed
        $this->form_validation->set_message('filemain_image_check', 'Couldn\'t upload the file(s)');
        return FALSE;
      }
    }
    
    // we first load the upload library
    $this->load->library('upload');
    // next we pass the upload path for the images
    $config['upload_path'] = 'uploads/';
		
    // also, we make sure we allow only certain type of images
    $config['allowed_types'] = 'gif|jpg|png';

    // now, taking into account that there can be more than one file, for each file we will have to do the upload
    for ($i = 0; $i < $number_of_files; $i++)
    {
      $_FILES['main_image']['name'] = time().rand(1000,9999999999).$files['name'][$i];
      $_FILES['main_image']['type'] = $files['type'][$i];
      $_FILES['main_image']['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['main_image']['error'] = $files['error'][$i];
      $_FILES['main_image']['size'] = $files['size'][$i];
      
      //now we initialize the upload library
      $this->upload->initialize($config);
      if ($this->upload->do_upload('main_image'))
      {
        $this->_uploaded_main_image[$i] = $this->upload->data();
      }
      else
      {
        $this->form_validation->set_message('filemain_image_check', $this->upload->display_errors());
        return FALSE;
      }
    }
    return TRUE;
  }




  
public function uploadcsv() {
    
    
    $number_of_files = sizeof($_FILES['uploaded_csv']['tmp_name']);
    
    $files = $_FILES['uploaded_csv'];

   
    for($i=0;$i<$number_of_files;$i++)
    {
      if($_FILES['uploaded_csv']['error'][$i] != 0)
      {
        // save the error message and return false, the validation of uploaded files failed
        $this->form_validation->set_message('filemain_image_check', 'Couldn\'t upload the file(s)');
        return FALSE;
      }
    }
    
    // we first load the upload library
    $this->load->library('upload');
    // next we pass the upload path for the images
    $config['upload_path'] = 'uploads/';
		
    // also, we make sure we allow only certain type of images
    $config['allowed_types'] = 'csv';

    // now, taking into account that there can be more than one file, for each file we will have to do the upload
    for ($i = 0; $i < $number_of_files; $i++)
    {
      $_FILES['uploaded_csv']['name'] = time().rand(1000,9999999999).$files['name'][$i];
      $_FILES['uploaded_csv']['type'] = $files['type'][$i];
      $_FILES['uploaded_csv']['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['uploaded_csv']['error'] = $files['error'][$i];
      $_FILES['uploaded_csv']['size'] = $files['size'][$i];
      
      //now we initialize the upload library
      $this->upload->initialize($config);
      if ($this->upload->do_upload('uploaded_csv'))
      {
        $this->_uploaded_uploaded_csv[$i] = $this->upload->data();
      }
      else
      {
        $this->form_validation->set_message('filemain_image_check', $this->upload->display_errors());
        return FALSE;
      }
    }
    return TRUE;
  }
	public function delete_image($image_id, $id){
		
		if($this->product_model->delete_image_only($image_id)){
			$this->session->set_flashdata('succ_msg', 'Image deleted successfully !!!!');
			redirect('admin/product/add_edit/'.$id);
			exit();
		}
		
	}
	
	
	public function add_money() {
	 $id = $this->uri->segment(4);
	 $data = array();
		if($this->input->post()){
		
			  $amount = $this->input->post('recharge_amount');
			  $pres_user_user_details =  $this->user_model->user_details_by_id($id);
			  $final_wallet_balance['wallet_balance'] = $pres_user_user_details[0]->wallet_balance + $amount;
			  $this->user_model->edit_user($id,$final_wallet_balance);
			  
			  $wallet_data['transaction_ID']= time().rand();
			  $wallet_data['user_GUID']= $id;
			  $wallet_data['payment_method']= 'Recharged by Admin';
			  $wallet_data['recharge_time']= time();
			  $wallet_data['recharge_amount']= $amount;
			  
			  if($last_id = $this->user_model->add_wallet($wallet_data)){
				$this->session->set_flashdata('succ_msg', 'Money added successfully ! Please Login');
			  }else{
				$this->session->set_flashdata('error_msg', $this->db->_error_message());
			  }
		
		}
		
		
		$this->load->view('controll_admin/add_wallet');
		
	}
	
	
}