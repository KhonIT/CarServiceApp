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
		  $sql = 'select  cus_id as id ,cus_tel,cus_name,cus_car_regis_number,cus_car_brand,cus_car_model,cus_car_color  from customers where is_deleted = 0 and cus_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 }


	 public function Cus_Search($cus_tel,$cus_car_regis_number){

		  $sql = 'select  cus_id as id ,cus_tel,cus_name,cus_car_regis_number,cus_car_brand,cus_car_model,cus_car_color  from customers where is_deleted = 0 ' ;


if($cus_tel!= ""){
  $sql .=  'and  cus_tel like "%'.$cus_tel.'%"  ';

}if($cus_car_regis_number!= ""){
  $sql .=  'and cus_car_regis_number like "%'.$cus_car_regis_number.'%"';
}
  $sql .= 'order by cus_id desc limit 100 offset 0';
 
			$query = $this->db->query($sql);
		   return $query->result();
	 }

	 public function Get_All(){
		  $sql = 'select  cus_id as id ,cus_tel,cus_name,cus_car_regis_number,cus_car_brand,cus_car_model,cus_car_color  from customers where is_deleted = 0 order by cus_id desc limit 100 offset 0 ';
		  $query = $this->db->query($sql);
		  return $query->result();
	 }


}
