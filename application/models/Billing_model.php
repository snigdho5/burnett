<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Billing_model extends CI_Model
{

	// Get all details ehich store in "products" table in database.
	public function get_all()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}

	// Insert customer details in "customer" table in database.
	public function insert_customer($data)
	{
		$this->db->insert('customers', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	// Insert order date with customer id in "orders" table in database.
	public function insert_order($data)
	{
		$this->db->insert('orders_management', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function update_order($order_id, $data)
	{


		if (!isset($data['order_unique_id'])) {
			$this->db->where(array('order_id' => $order_id));
		} else {
			$order_unique_id  =  $data['order_unique_id'];
			unset($data['order_unique_id']);
			$this->db->where(array('order_id' => $order_id, 'order_unique_id' => $order_unique_id));
		}
		if ($this->db->update('orders_management', $data)) {
			return $order_id;
		} else {
			return false;
		}
	}

	public function get_order($order_id)
	{
		$this->db->select('*');
		$this->db->from('orders_management');
		$this->db->where('order_id', $order_id);

		$gal_query = $this->db->get();
		// $gal_query = $this->db->get_where('order_detail',array('order_id'=>$order_id));
		if ($gal_query->num_rows() > 0) {
			$result = $gal_query->result();
			return $result;
		} else {
			return false;
		}
	}

	public function get_orderN($param=null, $many = FALSE)
	{
		$this->db->select('*');
		$this->db->from('orders_management');

		if($param != null){
			$this->db->where($param);
		}
		

		$gal_query = $this->db->get();
		// $gal_query = $this->db->get_where('order_detail',array('order_id'=>$order_id));
		if ($gal_query->num_rows() > 0) {
			if($many == FALSE){
				$result = $gal_query->row();
			}else{
				$result = $gal_query->result();
			}
			
			return $result;
		} else {
			return false;
		}
	}

	public function update_order_by_unique($uniqueorder_id, $data)
	{
		$this->db->where(array('order_unique_id' => $uniqueorder_id));
		$this->db->update('orders_management', $data);
	}
	// Insert ordered product detail in "order_detail" table in database.
	public function insert_order_detail($data)
	{
		$this->db->insert('order_detail', $data);
	}

	public function edit_order_detail($id, $data)
	{
		$this->db->where(array('order_detail_id' => $id));
		$this->db->update('order_detail', $data);
	}

	public function get_shipping_cost($country, $subtotal, $currency)
	{
		$shipping_cost = 0;
		// echo $country.','.$subtotal.','.$currency;

		/*  $query = $this->db->query("SELECT * FROM shipping_logic as SL INNER JOIN shipping_logic_attr as SLA  where FIND_IN_SET ('".$country."',SL.`country_id`) and SL.`shipping_logic_id` = SLA.`shipping_logic_id` and type='".$currency."' and 
	 (case when (SLA.max_value = 0) 
 THEN
      '".$subtotal."' >= SLA.min_value 
 ELSE
     '".$subtotal."' >= SLA.min_value and '".$subtotal."' < SLA.max_value 
 END)");*/
		//echo "SELECT * FROM shipping_logic as SL INNER JOIN shipping_logic_attr as SLA  where FIND_IN_SET ('".$country."',SL.`country_id`) and SL.`shipping_logic_id` = SLA.`shipping_logic_id` and type='".$currency."' and 
		//	 (case when (SLA.max_value = 0) 
		// THEN
		//      '".$subtotal."' >= SLA.min_value 
		// ELSE
		//     '".$subtotal."' >= SLA.min_value and '".$subtotal."' < SLA.max_value 
		// END)";
		//	 

		/*	
foreach ($query->result() as $row) {
	//var_dump($row);
	$shipping_cost =   $row->shipping_cost;
	}  */
		$shipping_cost = $subtotal * 15 / 100;
		return $shipping_cost;
	}
}
