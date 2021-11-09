<?php
class
Orders_model extends CI_Model
{

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function fetch_orders()
	{
		$this->db->order_by('order_id', 'desc');
		$gal_query = $this->db->get('orders_management');
		if ($gal_query->num_rows() > 0) {
			$result = $gal_query->result();
			return $result;
		} else {
			return false;
		}
	}

	public function get_order_modules_by_unique($order_unique_id)
	{
		$this->db->where('order_unique_id', $order_unique_id);
		$gal_query = $this->db->get('orders_management');
		if ($gal_query->num_rows() > 0) {
			$result = $gal_query->result();
			return $result;
		} else {
			return false;
		}
	}
	public function get_order_modules_item($order_id)
	{

		$this->db->select('*');
		$this->db->from('order_detail');
		$this->db->where('order_id', $order_id);
		$this->db->join('product_management', 'order_detail.product_id = product_management.product_id', 'left');
		$gal_query = $this->db->get();
		// $gal_query = $this->db->get_where('order_detail',array('order_id'=>$order_id));
		if ($gal_query->num_rows() > 0) {
			$result = $gal_query->result();
			return $result;
		} else {
			return false;
		}
	}
	public function get_order_modules_item_by_unique($order_unique_id)
	{
		$unique_query = $this->db->get_where('orders_management', array('order_unique_id' => $order_unique_id));
		$result = $unique_query->result();
		if (!empty($result)) {
			$order_id = $result[0]->order_id;
			$this->db->select('*');
			$this->db->from('order_detail');
			$this->db->where('order_id', $order_id);
			$this->db->join('product_management', 'order_detail.product_id = product_management.product_id', 'left');
			$gal_query = $this->db->get();
			// $gal_query = $this->db->get_where('order_detail',array('order_id'=>$order_id));
			if ($gal_query->num_rows() > 0) {
				$result = $gal_query->result();
				return $result;
			} else {
				return false;
			}
		}else {
			return false;
		}
	}


	public function get_order_bycustomer($member_id)
	{
		$gal_query = $this->db->get_where('orders_management', array('member_id' => $member_id));
		//echo $this->db->last_query();
		if ($gal_query->num_rows() > 0) {
			$result = $gal_query->result();
			return $result;
		} else {
			return false;
		}
	}



	public function delete_member_item($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_members');
	}

	public function update_mobile_otp($data = array())
	{
		if ($data['action'] == 'add') {
			unset($data['action']);
			$this->db->insert('mobile_otp', $data);
		} elseif ($data['action'] == 'edit') {
			unset($data['action']);
			$mobile_number = $data['mobile_number'];
			unset($data['mobile_number']);
			$this->db->where('mobile_number', $mobile_number);
			$this->db->update('mobile_otp', $data);
		}
	}
}
