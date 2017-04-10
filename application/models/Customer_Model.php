<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }


	 public function Insert($data = null){
	 		if ($data == null){
		   log_message('error', 'Insert => customer service Data is null.');
		   throw new Exception('customer service Data is null.');
		  }
		  try {
		   $this->db->insert('customers', $data);
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

		   	return $this->db->update('customers', $data, array('cus_id' => $id));

		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }
	 public function Get_By_ID($id){ 
		$sql = 'SELECT c.car_id ,cus_name,cus_tel,car_regis_number, car_regis_province, car_brand,car_model,car_color,car_size FROM car c ';
		$sql .= 'left join customer cu on cu.cus_id = c.cus_id where c.is_deleted = 0   and c.cus_id = ?';

		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 } 
	 public function Cus_Search($car_regis_number){

		$sql = 'SELECT c.car_id ,cus_name,cus_tel,car_regis_number, car_regis_province, car_brand,car_model,car_color,car_size FROM car c ';
		$sql .= 'left join customer cu on cu.cus_id = c.cus_id where c.is_deleted = 0 ';
		$sql .= 'and c.car_regis_number like "%'.$car_regis_number.'%"'; $query = $this->db->query($sql);
		   return $query->result();
	 }

	 public function Get_All(){
		$sql = 'SELECT c.car_id ,cus_name,cus_tel,car_regis_number, car_regis_province, car_brand,car_model,car_color,car_size FROM car c ';
		$sql .= 'left join customer cu on cu.cus_id = c.cus_id where c.is_deleted = 0 ';
		 $query = $this->db->query($sql);
		  return $query->result();
	 }


}
