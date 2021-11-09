<?php
class Myaccountmodel extends CI_Model
{
    public function save_user($user_data){
        $phone ="'".$user_data['phone']."'";
        $user_exists = $this->db->query("select * from register_users where phone=$phone");
        if($user_exists->num_rows() > 0){
         return $this->db->query("select * from register_users where phone=$phone")->row_array();
        }else{
        $this->db->insert('register_users',$user_data);
        if($this->db->affected_rows() > 0){
            $insert_id = $this->db->insert_id();
            return $this->db->query("select * from register_users where user_id=$insert_id")->row_array();
        }
        }
        return false;

    }

    public function isLogin($user_data){
        $phone="'".$user_data['phone']."'";
        $password="'".$user_data['password']."'";
       $login_check_query = $this->db->query("select * from register_users where phone=$phone and password=$password");
        if($login_check_query->num_rows() > 0){
            return $login_check_query->row_array();
        }
        return false;

    }
	
	public function get_order_bycustomer($member_id)
		{
			$gal_query = $this->db->get_where('orders_management',array('member_id'=>$member_id));
			//echo $this->db->last_query();
			if($gal_query->num_rows()>0)
			{
				$result = $gal_query->result();	
				return $result;
			}
			else
			{
				return false;	
			}	
		}

public function get_order_modules_item($order_id)
		{
			
			$this->db->select('*');
			$this->db->from('order_detail');
			$this->db->where('order_id',$order_id);
			$this->db->join('product_management', 'order_detail.product_id = product_management.product_id', 'left');
			$gal_query = $this->db->get();
			// $gal_query = $this->db->get_where('order_detail',array('order_id'=>$order_id));
			if($gal_query->num_rows()>0)
			{
				$result = $gal_query->result();	
				return $result;
			}
			else
			{
				return false;	
			}	
		}



}