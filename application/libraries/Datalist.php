<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class datalist {
	
	
	function productlist()
	{
		$CI =& get_instance();
		$CI->load->model('admin_model');
		$data['productlist']=$CI->admin_model->selectAll('tblproduct');
		
		foreach($data['productlist'] as $rowproduct)
		{
			$whereclause='brand_id = '.$rowproduct->brand_id;				
			$rowproduct->brandname=$CI->admin_model->single_value('tblbrand','brand_name',$whereclause);
			
			$whereclause='userb_id = '.$rowproduct->supplier_id;				
			$rowproduct->companyid=$CI->admin_model->single_value('tbluser_business','userb_company',$whereclause);
			
			$whereclause='company_id = '.$rowproduct->companyid;
			$rowproduct->companyname=$CI->admin_model->single_value('tblcompany','company_name',$whereclause);
			
			$whereclause='category_id = '.$rowproduct->category_id;				
			$rowproduct->categoryname=$CI->admin_model->single_value('tblcategory','category_name',$whereclause);				
		}
		
		return $data['productlist'];
	}
	
	function edit_productlist($id)
	{
		$CI =& get_instance();
		$CI->load->model('admin_model');
		$data['productlist']=$CI->admin_model->selectOne('tblproduct','prod_id',$id);		
		foreach($data['productlist'] as $rowproduct)
		{
			$whereclause='brand_id = '.$rowproduct->brand_id;				
			$rowproduct->brandname=$CI->admin_model->single_value('tblbrand','brand_name',$whereclause);
											
			$whereclause='userb_id = '.$rowproduct->supplier_id;				
			$rowproduct->companyname=$CI->admin_model->single_value('tbluser_business','userb_company',$whereclause);
			
			$whereclause='category_id = '.$rowproduct->category_id;				
			$rowproduct->categoryname=$CI->admin_model->single_value('tblcategory','category_name',$whereclause);				
		}		
		return $data['productlist'];
	}
	
	
	function product_equvalentlist($prod_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin_model');
		$data['productlist']=$CI->admin_model->selectOne('tblprod_equvalent','prod_id',$prod_id);
		
		foreach($data['productlist'] as $rowproduct)
		{
			$whereclause='brand_id = '.$rowproduct->equ_brand;				
			$rowproduct->brandname=$CI->admin_model->single_value('tblbrand','brand_name',$whereclause);
											
			$whereclause='company_id = '.$rowproduct->equ_company;				
			$rowproduct->companyname=$CI->admin_model->single_value('tblcompany','company_name',$whereclause);
			
			$whereclause='state_id = '.$rowproduct->equ_state;				
			$rowproduct->statename=$CI->admin_model->single_value('tblstate','state_name',$whereclause);
			
			$whereclause='id = '.$rowproduct->equ_country;				
			$rowproduct->countryname=$CI->admin_model->single_value('tblcountry','country_name',$whereclause);			
							
		}
		
		return $data['productlist'];
	}
	
	
	function brandlist()
	{
		$CI =& get_instance();
		$CI->load->model('admin_model');
		$data['brandlist']=$CI->admin_model->selectAll('tblbrand');
		$data['brand']='';
		foreach($data['brandlist'] as $rowbrand)
		{
			$data['brand'].='<option value="'.$rowbrand->brand_id.'">'.$rowbrand->brand_name.'</option>';			
		}
		
		return $data['brand'];
	}
	
	function categorylist($id){
		$CI =& get_instance();
		$CI->load->model('admin_model');
		$data['categorylist']=$CI->admin_model->selectAll('tblcategory');
		$data['category']='';
		foreach($data['categorylist'] as $row_category)
		{
			$data['category'].='<option value="'.$row_category->category_id.'"';
			if($row_category->category_id==$id)
			{
				$data['category'].='selected="selected"';		
			}	
			
			$data['category'].='>'.$row_category->category_name.'</option>';
		}
		return $data['category'];
	}
	
	function supplierlist($id){
		$CI =& get_instance();
		$CI->load->model('admin_model');
		$data['supplierlist']=$CI->admin_model->selectOne('tbluser_business','user_role',2);
		$data['supplier']='';
		foreach($data['supplierlist'] as $row_supplier)
		{
			$whereclause='company_id = '.$row_supplier->userb_company;				
			 $companyname=$CI->admin_model->single_value('tblcompany','company_name',$whereclause);
			 if($companyname!='')
			 {
				 $data['supplier'].='<option value="'.$row_supplier->userb_id.'"';
				 if($id!='')
				 {
					if($row_supplier->userb_id == $id)
					{ 
						$data['supplier'].='selected="selected"';
					}
				 }
				$data['supplier'].='>'.$companyname.'</option>';	 
			 }
		}
		//echo "<pre>"; print_r($data['supplier']);exit;
		return $data['supplier'];
	}

	function countrylist($id){
		$CI =& get_instance();
		$CI->load->model('admin_model');
		$data['countrylist']=$CI->admin_model->selectAll('tblcountry');
		$data['country']='';
		foreach($data['countrylist'] as $row_country)
		{
			$data['country'].='<option value="'.$row_country->id.'"';			
			if($row_country->id==$id)
			{
				$data['country'].='selected="selected"';		
			}
			$data['country'].='>'.$row_country->country_name.'</option>';
		}
		return $data['country'];
	}
	
	 function checkexist($tbl,$col_id,$colname,$colvalu)
	 {
	 	$CI =& get_instance();
		$result=$CI->admin_model->selectOne($tbl,$colname,strtolower(trim($colvalu)) );
		if(count($result)>0)
		{
			$wherecls= $colname. ' = "'.strtolower(trim($colvalu)).'"' ;
			$_id=$CI->admin_model->single_value($tbl,$col_id,$wherecls );	
			return $_id;
		}
		else{			
			$data=array(	
					$colname=>strtolower(trim($colvalu)),
					'created_date'=>date("Y-m-d H:i:s")
				);
				$_id=$CI->admin_model->insert_data($data,$tbl);
			return $_id;
		}
	}

	function edit_product_equivalent($id)
	{
		$CI =& get_instance();
		$countrylist=$CI->admin_model->selectAll('tblcountry');
		$equvalentlist=$this->product_equvalentlist($id);
		//echo "<pre>"; print_r($equvalentlist);
		$str='';
		foreach($equvalentlist as $row)
		{
			$str.=' <div id="edit_tr_addanother_brand">';                    
	         $str.='    <div class="control-group" id="" style="float:left"> ';
	         $str.='          <label class="control-label" for="inputSuccess">Equivalent Brand</label>';
	         $str.='           <section class="controls">  ';                                  
	         $str.='         <input type="text" id="edit_equ_brand" class="list_equ_brand"  name="equ_brand" value=" ';
			  $str.= $row->brandname;                            
	         $str.='       "  />       <span class="help-inline" id="edit_equ_brand_message" style="display:none;"></span> ';
	         $str.='            </section>';
	         $str.='         </div> '; 	                          
	        $str.='     	<div class="control-group" id="" style="float:left">';
	        $str.='              <label class="control-label" for="inputSuccess">Company</label>';
	        $str.='              <div class="controls">';
	        $str.='             		<input type="text" id="edit_equ_company" class="list_equ_company" name="equ_company[]" value=" ';
			$str.= $row->companyname;
	       $str.='                "  />   <span class="help-inline" id="edit_equ_comp_message" style="display:none;"></span>';
	       $str.='                </div>';
	       $str.='        </div>';
	        $str.='        	<div class="control-group" id="" style="float:left" >';
	        $str.='             <label class="control-label" for="inputSuccess">State</label>';
	       $str.='              <div class="controls">';
	        $str.='           		<input type="text" id="edit_equ_state" name="equ_state[]" value=" ';
			$str.= $row->statename;
	        $str.='             "   />  <span class="help-inline" id="edit_equ_state_message" style="display:none;"></span>';
	        $str.='                </div>';
	        $str.='       </div>';
	        $str.='        <div class="control-group" id="">';
	        $str.='            <label class="control-label" for="inputSuccess">Country</label>';
	        $str.='            <div class="controls">';
	        $str.='           		<select id="edit_equ_country"  name="equ_country[]"  >';
	        $str.='                 	 <option value="">Select Country</option>';
		   $country='';		   
		foreach($countrylist as $row_country)
		{
			$country.='<option value="'.$row_country->id.'" ';
			if($row_country->id==$row->equ_country)
			{
				$country.='selected="selected"';		
			}				
			
			 $country.=' >'.$row_country->country_name.'</option>';
		} 
		   
		    $str.=   $country;
	        $str.='                   		</select>  ';                                  
	        $str.='                      <span class="help-inline" id="edit_equ_country_message" style="display:none;"></span> '; 
	        $str.='                  </div>';
	        $str.='           </div>';
	        $str.='         <section class="control-group" id="">';
	        $str.='                <section class="controls">   ';                             		                                     
	        $str.='                       <a href="javascript:void(0);" class="edit_remove_size_brand"> Remove Brand </a> ';
	        $str.='                  </section>';
	        $str.='           </section>';
	
	        $str.='            <br /><br />  ';               
	        $str.='    </div>  '; 
		} 
		
		
		if($str=='')
		{
			 $str.=' <div id="edit_tr_addanother_brand">';                    
	         $str.='    <div class="control-group" id="" style="float:left"> ';
	         $str.='          <label class="control-label" for="inputSuccess">Equivalent Brand</label>';
	         $str.='           <section class="controls">  ';                                  
	         $str.='              <input type="text" id="equbrand" class="list_equ_brand" name="equ_brand[]" value=" ';			                            
	         $str.='       "  />       <span class="help-inline" id="edit_equ_brand_message" style="display:none;"></span> ';
	         $str.='            </section>';
	         $str.='         </div> ';
	        $str.='     	<div class="control-group" id="" style="float:left">';
	        $str.='              <label class="control-label" for="inputSuccess">Company</label>';
	        $str.='              <div class="controls">';
	        $str.='             		<input type="text" id="edit_equcompany" name="equ_company[]" value=" ';
	        $str.='                "  />   <span class="help-inline" id="edit_equ_comp_message" style="display:none;"></span>';
	        $str.='                </div>';
	        $str.='        </div>';	                          
	        $str.='        	<div class="control-group" id="" style="float:left" >';
	        $str.='             <label class="control-label" for="inputSuccess">State</label>';
	        $str.='              <div class="controls">';
	        $str.='           		<input type="text" id="edit_equ_state" name="equ_state[]" value=" ';
	        $str.='             "   />  <span class="help-inline" id="edit_equ_state_message" style="display:none;"></span>';
	        $str.='                </div>';
	        $str.='       </div>';
	        $str.='        <div class="control-group" id="">';
	        $str.='            <label class="control-label" for="inputSuccess">Country</label>';
	        $str.='            <div class="controls">';
	        $str.='           		<select id="edit_equ_country"  name="equ_country[]"  >';
	        $str.='                 	 <option value="">Select Country</option>';
			
			$country='';		   
			foreach($countrylist as $row_country)
			{
				$country.='<option value="'.$row_country->id.'" ';
				 $country.=' >'.$row_country->country_name.'</option>';
			}
		    $str.=   $country;
			$str.='                   		</select>  ';                                  
	        $str.='                      <span class="help-inline" id="edit_equ_country_message" style="display:none;"></span> '; 
	        $str.='                  </div>';
	        $str.='           </div>';
	                         
	        $str.='         <section class="control-group" id="">';
	        $str.='                <section class="controls">   ';                             		                                     
	        $str.='                       <a href="javascript:void(0);" class="edit_remove_size_brand"> Remove Brand </a> ';
	        $str.='                  </section>';
	        $str.='           </section>';	
	        $str.='            <br /><br />  ';               
	        $str.='    </div>  '; 
			
		}
		
		
		return $str;	  
	}
	
	function autocomplete_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin_model');
		
		//---------------autocomplete brand-------------
		$brand_list = $CI->admin_model->selectAll('tblbrand');		
		$js_brand_list ='[';
			$tag_count=0;			
			foreach($brand_list as $tag)
			{				
				if($tag_count<(count($brand_list)-1)){
					$js_brand_list .= '"'.$tag->brand_name.'",';	
				}else{
					$js_brand_list .= '"'.$tag->brand_name.'"';
				}
				$tag_count=$tag_count+1	;				
			}
		$js_brand_list .= ']';
		$data['js_brand_list']= $js_brand_list;
		
	//--------------------autocomplete Company----------------
		
		$company_list = $CI->admin_model->selectAll('tblcompany');		
		$js_company_list ='[';
			$tag_count=0;			
			foreach($company_list as $tag)
			{				
				if($tag_count<(count($company_list)-1)){
					$js_company_list .= '"'.$tag->company_name.'",';	
				}else{
					$js_company_list .= '"'.$tag->company_name.'"';
				}
				$tag_count=$tag_count+1	;				
			}
		$js_company_list .= ']';
		$data['js_company_list']= $js_company_list;
		
		//======================State======================
		$state_list = $CI->admin_model->selectAll('tblstate');		
		$js_state_list ='[';
			$tag_count=0;			
			foreach($state_list as $tag)
			{				
				if($tag_count<(count($state_list)-1)){
					$js_state_list .= '"'.$tag->state_name.'",';	
				}else{
					$js_state_list .= '"'.$tag->state_name.'"';
				}
				$tag_count=$tag_count+1	;				
			}
		$js_state_list .= ']';
		$data['js_state_list']= $js_state_list;
		
		return $data;
	}
	
	function statelist($id,$where)
	{
		$CI=& get_instance();
		$str='';
		$statelist=$CI->users->selectWhere('tbl_state',$where);
		foreach($statelist as $row)
		{
			$str.='<option value="'.$row->state_id.'"';
			if($id == $row->state_id)
			{
				$str.=' selected="selected" ';
			}
			$str.='>'.$row->state_name.'</option>';
		}
		
		return $str;
	}
	
	function citylist($id,$where)
	{
		$CI=& get_instance();
		$str='';
		$citylist=$CI->users->selectWhere('tbl_city',$where);
		foreach($citylist as $row)
		{
			$str.='<option value="'.$row->city_id.'"';
			if($id == $row->city_id)
			{
				$str.=' selected="selected" ';
			}
			$str.='>'.$row->city_name.'</option>';
		}
		return $str;
	}
	
	function arealist($id,$where)
	{
		$CI=& get_instance();
		$str='';
		$arealist=$CI->users->selectWhere('tbl_area',$where);
		foreach($arealist as $row)
		{
			$str.='<option value="'.$row->area_id.'"';
			if($id == $row->area_id)
			{
				$str.=' selected="selected" ';
			}
			$str.='>'.$row->area_name.'</option>';
		}
		return $str;
	}
	
	
	
}
 ?>