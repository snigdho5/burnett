<?php
class common_my_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	public function common($table_name='',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array())
	{
		if(trim($table_name))
		{
			if(count($field)>0)
			{
				 $field=implode(',',$field);
			}
			else
			{
				$field='*';
			}
			
			$this->db->select($field);  
			$this->db->from($table_name); 
			
			if(count($where)>0)
			{
			
				foreach($where as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->where($key,$val);
					} 
				}
			
			}
			
			
			if(count($where_or)>0)
			{
				foreach($where_or as $key=>$val)
				{
					
				
					if(trim($val))
					{
							
						$this->db->or_where($key,$val);
					} 
				}
			}
			
			if(count($order)>0)
			{
			
				foreach($order as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->order_by($key,$val);
					} 
				}
			
			}
			
			if(count($like)>0)
			{
			
				foreach($like as $key=>$val)
				{
					if(trim($val))
					{
					   $this->db->like($key,$val);
					 
					} 
				}
			
			}
			
			
			if($end)
			{

				$this->db->limit($end,$start);
			}
			
			if(count($where_in_array)>0)
			{
				
				$this->db->where_in('user_id', $where_in_array);
			}
			 
			$query = $this->db->get();
			$resultResponse=$query->result();
			return $resultResponse;
					
			}
			else
			{
					 echo 'Table name should not be empty';exit;
			}
	
	   }

	public function email_id_check($email_id)
	{
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('email', $email_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$result = $query->row();
			if($result->activate == 1) {
				return $result;
			} else {
				return 'user_inactive';
			}
		} else {
			return 'doesnt_exists';
		}
	}


	public function validate_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)){
			if($result->activate == 1){
				return 'ok';
			}
			else{
				return 'user_inactive';
			}
		}
		else{
			return 'user_not_found';
		}
	}


	 function selectOne($table_name, $column_name, $column_value)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($column_name, $column_value);
        $query = $this->db->get();
        return $query->result();
    }

    function product_list($data)
    {
         $parent_category_id=@$data['parent_category_id'];
        $sub_category_id=@$data['sub_category_id'];
        $keyword=@$data['key'];
      //  echo $parent_category_id ;exit;

        

        /*$this->db->limit($limit,$start);   
        $this->db->select('p.*');
        $this->db->from('product p');
        $this->db->join('category c','c.cat_id=p.category_id','left');
        $this->db->where('p.status','1');*/


       // $this->db->limit($limit,$start);   
        $this->db->select('p.*');
        $this->db->from('product_category pc');
        $this->db->join('category c','c.cat_id=pc.category_id','left');
        $this->db->join('product p','p.product_id=pc.product_id');
        //$this->db->where('p.status','1');
		if($keyword!=''){
			//$this->db->like('p.product_title', '$keyword%');
			//$this->db->like('p.product_title', '$keyword', 'before');
			$whr_cls = "p.product_title LIKE '$keyword%'"; 
			$this->db->where($whr_cls);
		}


               
       
        if($parent_category_id!="" && $sub_category_id=="")
        {
            //snigdho
            $st="(c.parent_id = ".$parent_category_id." OR c.cat_id =".$parent_category_id.")";
			$this->db->where($st, NULL, FALSE);

        }
         if($sub_category_id!="")
        {
           // $this->db->where('c.sub_category',$sub_category_id);
            $this->db->where('c.cat_id',$sub_category_id);
        }
       
        
        $this->db->where('p.status','1');

        $this->db->group_by('pc.product_id');
        $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();
        // echo $this->db->last_query();die;

        return $query->result();

        // print_r($query->result());exit;
    }












function product_list_page($data,$limit,$start)
    {
        $parent_category_id=@$data['parent_category_id'];
        $sub_category_id=@$data['sub_category_id'];
      $keyword=@$data['key'];
      //  echo $parent_category_id ;exit;

        

        /*$this->db->limit($limit,$start);   
        $this->db->select('p.*');
        $this->db->from('product p');
        $this->db->join('category c','c.cat_id=p.category_id','left');
        $this->db->where('p.status','1');*/


        //$this->db->limit($limit,$start);   
        $this->db->select('p.*,c.*');
        $this->db->from('product_category pc');
        $this->db->join('category c','c.cat_id=pc.category_id','left');
        $this->db->join('product p','p.product_id=pc.product_id');
		if($keyword!=''){
			//$this->db->like('p.product_title', '$keyword%');
			//$this->db->like('p.product_title', '$keyword', 'before');
			$whr_cls = "p.product_title LIKE '$keyword%'"; 
			$this->db->where($whr_cls);
		}


               
     
        if($parent_category_id!="" && $sub_category_id=="")
        {
            //snigdho
            $st="(c.parent_id = ".$parent_category_id." OR c.cat_id =".$parent_category_id.")";
			$this->db->where($st, NULL, FALSE);

        }
         if($sub_category_id!="")
        {
           // $this->db->where('c.sub_category',$sub_category_id);
            $this->db->where('c.cat_id',$sub_category_id);
        }
       
        
        $this->db->where('p.status','1');
        $this->db->group_by('pc.product_id');
        $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();

		// echo $this->db->last_query(); die;
        return $query->result();

        // print_r($query->result());exit;
    }

    function product_list_by_searching($product_name,$category)
    {
       // $parent_category_id=@$data['parent_category_id'];
       // $sub_category_id=@$data['sub_category_id'];
      //  $category_id=@$data['category_id'];
      //  echo $parent_category_id ;exit;

        
  
        $this->db->select('p.*,c.*');
        $this->db->from('product_category pc');
        $this->db->join('category c','c.cat_id=pc.category_id','left');
        $this->db->join('product p','p.product_id=pc.product_id');
        $this->db->group_by('pc.product_id');  
        $this->db->where('p.status','1');
        
        

        if($category =="")
        {
          $this->db->like('p.product_title',$product_name);

        }
        else{

        $this->db->like('p.product_title',$product_name);
        
        $this->db->where('c.cat_id',$category);
        $this->db->or_where('c.parent_id',$category);
        }

               
       
       /* if($parent_category_id!="" && $sub_category_id=="")
        {
            $this->db->where('c.parent_id',$parent_category_id);
            $this->db->or_where('c.cat_id',$parent_category_id);
        }
         if($sub_category_id!="")
        {
           // $this->db->where('c.sub_category',$sub_category_id);
            $this->db->where('c.cat_id',$sub_category_id);
        }*/
       
        
        $this->db->where('p.status','1');
        $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();


        return $query->result();

      //  echo '<pre>';

       //  print_r($query->result());exit;
    }

     function product_filter_list($data,$brand_ids,$max,$min,$orderbyprice)
    {

    	// print_r($brand_ids);
    	// echo $brand_ids;
        $parent_category_id=@$data['parent_category_id'];
        $sub_category_id=@$data['sub_category_id'];
     


       // $this->db->limit($limit,$start);   
        $this->db->select('p.*,c.*,pva.product_price,pva.product_regular_price');
        $this->db->from('product_category pc');
        $this->db->join('category c','c.cat_id=pc.category_id','left');
        $this->db->join('product p','p.product_id=pc.product_id');
        $this->db->join('product_variable_attribute pva','pc.product_id=pva.product_id');
       // $this->db->join('product_variable_attribute pva','pva.product_id=pc.product_id','right');
      // $this->db->join('product_variable_attribute pva','p.product_id=pva.product_id','left');
        $this->db->group_by('pc.product_id');  


        if($max != "" && $min != "")
                      {

                          $this->db->where("pva.product_price >=",$min);
                          $this->db->where("pva.product_price <=",$max);
                      }


        if($brand_ids!='')
    {
        $this->db->where_in('p.brand_id',$brand_ids);
    }


      //  $this->db->order_by('p.product_id','desc');


         /*-----sort price-----*/
        // echo $sort_by_price_header;
         if(@$orderbyprice !=''){

        if(@$orderbyprice =='asc'){
        $this->db->order_by('pva.product_price','asc');
        }

        if(@$orderbyprice =='desc'){
        $this->db->order_by('pva.product_price','desc');
        }

         }



        if($parent_category_id!="" && $sub_category_id=="")
        {
            //snigdho
            $st="(c.parent_id = ".$parent_category_id." OR c.cat_id =".$parent_category_id.")";
			$this->db->where($st, NULL, FALSE);

        }

         if($sub_category_id!="")
        {
           // $this->db->where('c.sub_category',$sub_category_id);
            $this->db->where('c.cat_id',$sub_category_id);
        }
       
        
        $this->db->where('p.status','1');

        if($max != "" && $min != "")
                      {

                          $this->db->where("pva.product_price >=",$min);
                          $this->db->where("pva.product_price <=",$max);
                      }


        if($brand_ids!='')
    {
        $this->db->where_in('p.brand_id',$brand_ids);
    }


      //  $this->db->order_by('p.product_id','desc');


         /*-----sort price-----*/
        // echo $sort_by_price_header;
         if(@$orderbyprice !=''){

        if(@$orderbyprice =='asc'){
        $this->db->order_by('pva.product_price','asc');
        }

        if(@$orderbyprice =='desc'){
        $this->db->order_by('pva.product_price','desc');
        }

         }




      //  $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();


        return $query->result();
        //  echo '<pre>';
       //  print_r($query->result());exit;
    }


    function related_product($product_id)
    {

    $category_list = $this->common($table_name = 'product_category', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


         $sq_arr2=array();
         for($i=0;$i<count($category_list);$i++)
             {
                $sq_arr2[$i]=$category_list[$i]->category_id;
             }



             if(count(@$sq_arr2)>0){
     


       // $this->db->limit($limit,$start);   
        $this->db->select('p.*,c.*');
        $this->db->from('product_category pc');
        $this->db->join('category c','c.cat_id=pc.category_id','left');
        $this->db->join('product p','p.product_id=pc.product_id');
        $this->db->group_by('pc.product_id'); 
        $this->db->where('p.product_id !=',$product_id); 
        $this->db->where('p.status','1');


        $this->db->where_in('c.cat_id',$sq_arr2);
                   
        $this->db->where('p.status','1');
        $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();


        return $query->result();

      }

      else{
        $this->db->select('p.*,c.*');
        $this->db->from('product_category pc');
        $this->db->join('category c','c.cat_id=pc.category_id','left');
        $this->db->join('product p','p.product_id=pc.product_id');
        $this->db->group_by('pc.product_id');  
        $this->db->where('p.product_id','3655hffr451');

        $this->db->where_in('c.cat_id',$sq_arr2);
                   
        $this->db->where('p.status','1');
        $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();


        return $query->result();
      }




        // print_r($query->result());exit;
    }


 



    

}
