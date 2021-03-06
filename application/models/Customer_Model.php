<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 } 

	 public function Customer_Insert($data = null){
		if ($data == null){
			log_message('error', 'Insert => customer service Data is null.');
			throw new Exception('customer service Data is null.');
		}
		try {
			$this->db->insert('customer', $data);
			return $this->db->insert_id();
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	 }

	 public function Customer_Update($data = null, $id){
		  if ($data == null){
		   	log_message('error', 'Update => customer data is null.');
		   	throw new Exception('customer data is null.');
		  }
		  if ($data == null || $id == 0) {
		   	log_message('error', 'Required ID for update customer data.');
		   	throw new Exception('Required ID for update customer data.');
		  }
		  try {

		   	return $this->db->update('customer', $data, array('cus_id' => $id));

		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }
	 public function Car_Insert($data = null){
			if ($data == null){
			 log_message('error', 'Insert => customer service Data is null.');
			 throw new Exception('customer service Data is null.');
			}
			try {
			 $this->db->insert('car', $data);
				return $this->db->insert_id();
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
	 }
	  public function Car_Update($data = null, $id){
		  if ($data == null){
		   	log_message('error', 'Update => Car Data is null.');
		   	throw new Exception('Car Data is null.');
		  }
		  if ($data == null || $id == 0) {
		   	log_message('error', 'Required ID for update Car Data.');
		   	throw new Exception('Required ID for update Car Data.');
		  }
		  try { 
		   	return $this->db->update('car', $data, array('car_id' => $id));

		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }
	 public function Get_By_ID($id){
		$sql = 'SELECT c.car_id ,car_regis_number, car_regis_province, car_brand,car_model,car_color,car_size,cu.cus_id,cu.cus_name,cu.cus_tel FROM car c ';
		$sql .= 'left join customer cu on cu.cus_id = c.cus_id where c.is_deleted = 0   and c.cus_id = ?';

		$query = $this->db->query($sql, array($id));
		log_message('debug', sprintf('Found %b row with cus ID %s', $query->num_rows(), $id));
		return $query->row_array();// return one row
	 }

	 public function Get_Province(){
		$sql = 'SELECT  car_regis_province as province FROM car c group by car_regis_province order by car_regis_province';
 		$query = $this->db->query($sql); 
		return $query->result();
	 }

	 public function Car_Search($car_regis_number){
		$sql = 'SELECT c.car_id ,car_regis_number, car_regis_province, car_brand,car_model,car_color,car_size,cu.cus_id,cu.cus_name,cu.cus_tel FROM car c ';
		$sql .= 'left join customer cu on cu.cus_id = c.cus_id where c.is_deleted = 0 ';
		$sql .= 'and c.car_regis_number like "%'.$car_regis_number.'%"';
 		$query = $this->db->query($sql);
		log_message('debug', sprintf('Found %b row with car_regis_number: %s', $query->num_rows(), $car_regis_number));
		return $query->result();
	 }

	 public function Get_All(){
		$sql = 'SELECT c.car_id ,car_regis_number, car_regis_province, car_brand,car_model,car_color,car_size,cu.cus_id,cu.cus_name,cu.cus_tel FROM car c ';
		$sql .= 'left join customer cu on cu.cus_id = c.cus_id where c.is_deleted = 0 ';
		$query = $this->db->query($sql);
		return $query->result();
	 }


}
