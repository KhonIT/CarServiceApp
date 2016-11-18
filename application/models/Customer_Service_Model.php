<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Service_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }

	 public function Insert($data = null){
	 		if ($data == null){
		   log_message('error', 'Insert => customer service Data is null.');
		   throw new Exception('customer service Data is null.');
		  }
		  try {
		   $this->db->insert('orders', $data);
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }

	 public function Update($data = null, $id){
		  if ($data == null){
		   	log_message('error', 'Update => customer service Data is null.');
		   	throw new Exception('customer service Data is null.');
		  }
		  if ($data == null || $id == 0) {
		   	log_message('error', 'Required ID for update customer service Data.');
		   	throw new Exception('Required ID for update customer service Data.');
		  }
		  try {

		   	return $this->db->update('orders', $data, array('order_id' => $id));

		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }



	 public function Insert_Order_Detail($data = null){
			if ($data == null){
			 log_message('error', 'Insert => customer service Data is null.');
			 throw new Exception('customer service Data is null.');
			}
			try {
			 $this->db->insert('order_details', $data);
				return $this->db->insert_id();
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
	 }

	 public function Update_Order_Detail($data = null, $id){
			if ($data == null){
				log_message('error', 'Update => customer service Data is null.');
				throw new Exception('customer service Data is null.');
			}
			if ($data == null || $id == 0) {
				log_message('error', 'Required ID for update customer service Data.');
				throw new Exception('Required ID for update customer service Data.');
			}
			try {

				return $this->db->update('order_details', $data, array('order_detail_id' => $id));

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
	 }


	 public function Get_OrdersDetails_By_ID($id){
		  $sql = ' select   '.$id.'  as order_id,s.service_id,s.service_name,s.price as service_price , ifnull((select o.order_detail_id FROM order_details o where s.service_id = o.service_id and o.is_show ="1" and order_id = '.$id.'  ), 0 ) order_detail_id, ifnull((select o.price FROM order_details o where s.service_id = o.service_id and o.is_show ="1" and order_id = '.$id.'  ), 0 ) price from  service s  where s.is_show = 1';

			$query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->result();
	 }



	 public function Get_By_ID($id){
		  $sql = 'select  o.order_id as id,o.book_no,o.number,c.cus_tel,c.cus_name,c.cus_car_regis_number,c.cus_car_brand,c.cus_car_model,c.cus_car_color,c.cus_id,comment,total,pay_status,emp_id,created_date from orders o left join customers c on c.cus_id = o.cus_id where o.is_show = 1 and order_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 }

	 public function Get_All($pay_status){
		  $sql = 'select  o.order_id as id,o.book_no,o.number,c.cus_tel,c.cus_name,c.cus_car_regis_number,c.cus_car_brand,c.cus_car_model,c.cus_car_color,c.cus_id,comment,total,pay_status,emp_id,created_date from orders o left join customers c on c.cus_id = o.cus_id where o.is_show = 1 and o.pay_status = '.$pay_status.' order by created_date desc  limit 1000 offset 0 ';
		  $query = $this->db->query($sql);
		  return $query->result();
	 }

	 public function Get_Report_Daily(){
			$sql = 'select DATE(o.created_date)as name,sum(total) as total from orders o group by DATE(o.created_date) order by  DATE(o.created_date) asc ';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	 public function Get_Report_Monthly(){
			$sql = 'select MONTH(o.created_date)as month,YEAR(o.created_date) as year ,sum(total) as total from orders o group by MONTH(o.created_date) ,YEAR(o.created_date) order by YEAR(o.created_date) asc,MONTH(o.created_date) asc';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	 public function Get_Report_Annualy(){
			$sql = 'select  YEAR(o.created_date) as name,sum(total) as total from orders o group by YEAR(o.created_date)  order by YEAR(o.created_date) asc ';
			$query = $this->db->query($sql);
			return $query->result();
	 }
}
