<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Service_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }
 
  
	 public function Insert($data = null){ 
	 		if ($data == null){
		   log_message('error', 'Insert => service Data is null.');
		   throw new Exception('Service Data is null.');
		  }
		  try {
		   $this->db->insert('service', $data); 
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
 
	 public function Update($data = null, $id){ 
		  if ($data == null){
		   	log_message('error', 'Update => service Data is null.');
		   	throw new Exception('service Data is null.');
		  }

		  
		  if ($data == null || $id == 0) {
		   	log_message('error', 'Required ID for update service Data.');
		   	throw new Exception('Required ID for update service Data.');
		  } 
		 
		  try {
		    
		   	return $this->db->update('service', $data, array('service_id' => $id));
		    
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }

	 public function Get_By_ID($id){
		  $sql = 'select service_id,service_name,price  from service where is_deleted = 0 and service_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 } 
	 public function Get_All(){
		  $sql = 'select service_id,service_name,price  from service where is_deleted = 0';
		  $query = $this->db->query($sql);
		  return $query->result();
	 }  

}