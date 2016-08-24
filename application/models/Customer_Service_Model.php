<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Service_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }
 
  /*
   public function Insert_Batch($data = null){
	 	if ($data == null){
	 		log_message('error', 'Insert => customer service Data is null.');
	 		throw new Exception('customer service Data is null.');
	 	}
	 	try {
	 		$this->db->insert_batch('orders', $data);
	 		return $this->db->insert_id();
	 	} catch (Exception $e) {
	 		throw new Exception($e->getMessage());
	 	}
	 }
 
  public function Insert_Details_Batch($data = null){
	 	if ($data == null){
	 		log_message('error', 'Insert => customer service Data is null.');
	 		throw new Exception('customer service Data is null.');
	 	}
	 	try {
	 		$this->db->insert_batch('order_details', $data);
	 		return $this->db->insert_id();
	 	} catch (Exception $e) {
	 		throw new Exception($e->getMessage());
	 	}
	 }
 */

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
		    
		   	return $this->db->update('orders', $data, array('id' => $id));
		    
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
	 public function Get_OrdersDetails_By_ID($id){
		  $sql = 'select order_detail_id as id,order_id,o.service_id,s.service_name,o.price,promotion_id  from order_details o  left join service s on s.service_id = o.service_id where o.is_show = 1 and order_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->result(); 
	 } 
	 public function Get_By_ID($id){
		  $sql = 'select  order_id as id,book_no,number,cus_tel,cus_type,cus_name,cus_car_regis_number,cus_car_brand,cus_car_model,cus_car_color,customers_id,emp_name,comment,total,order_status,emp_id,promotion_id,created_date from orders where is_show = 1 and order_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 } 
	 public function Get_All(){
		  $sql = 'select  order_id as id,book_no,number,cus_tel,cus_type,cus_name,cus_car_regis_number,cus_car_brand,cus_car_model,cus_car_color,customers_id,emp_name,comment,total,order_status,emp_id,promotion_id,created_date from orders where is_show = 1';
		  $query = $this->db->query($sql);
		  return $query->result();
	 }  
	  public function Get_Cus_History($limit,$offset){
		  $query = $this->db->get('orders', $limit, $offset);
		  return $query->result(); 
	 }  

}