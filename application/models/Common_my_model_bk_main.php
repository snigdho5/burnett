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
      //  $category_id=@$data['category_id'];
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
        $this->db->group_by('pc.product_id');
        $this->db->where('p.status','1');


               
       
        if($parent_category_id!="" && $sub_category_id=="")
        {
            $this->db->where('c.parent_id',$parent_category_id);
            $this->db->or_where('c.cat_id',$parent_category_id);
        }
         if($sub_category_id!="")
        {
           // $this->db->where('c.sub_category',$sub_category_id);
            $this->db->or_where('c.cat_id',$sub_category_id);
        }
       
        
        $this->db->where('p.status','1');
        $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();


        return $query->result();

        // print_r($query->result());exit;
    }












function product_list_page($data,$limit,$start)
    {
        $parent_category_id=@$data['parent_category_id'];
        $sub_category_id=@$data['sub_category_id'];
      //  $category_id=@$data['category_id'];
      //  echo $parent_category_id ;exit;

        

        /*$this->db->limit($limit,$start);   
        $this->db->select('p.*');
        $this->db->from('product p');
        $this->db->join('category c','c.cat_id=p.category_id','left');
        $this->db->where('p.status','1');*/


        $this->db->limit($limit,$start);   
        $this->db->select('p.*,c.*');
        $this->db->from('product_category pc');
        $this->db->join('category c','c.cat_id=pc.category_id','left');
        $this->db->join('product p','p.product_id=pc.product_id');
        $this->db->group_by('pc.product_id');  
        $this->db->where('p.status','1');


               
       
        if($parent_category_id!="" && $sub_category_id=="")
        {
            $this->db->where('c.parent_id',$parent_category_id);
            $this->db->or_where('c.cat_id',$parent_category_id);
        }
         if($sub_category_id!="")
        {
           // $this->db->where('c.sub_category',$sub_category_id);
            $this->db->or_where('c.cat_id',$sub_category_id);
        }
       
        
        $this->db->where('p.status','1');
        $this->db->order_by('p.product_id','desc');
       
        $query=$this->db->get();


        return $query->result();

        // print_r($query->result());exit;
    }


 



    

}
?>