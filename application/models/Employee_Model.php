<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }
 
  
	 public function Insert($data = null){ 
	 		if ($data == null){
		   log_message('error', 'Insert => employee Data is null.');
		   throw new Exception('employee Data is null.');
		  }
		  try {
		   $this->db->insert('employees', $data); 
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
 
	 public function Update($data = null, $id){
	 
		  if ($data == null){
		   	log_message('error', 'Update => employees Data is null.');
		   	throw new Exception('employees Data is null.');
		  }

		  
		  if ($data == null || $id == 0) {
		   	log_message('error', 'Required ID for update employee Data.');
		   	throw new Exception('Required ID for update employee Data.');
		  } 
		 
		  try {
		    
		   	return $this->db->update('employees', $data, array('e_id' => $id));
		    
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
	 
	 public function Get_By_ID($id){
		  $sql = 'select e.e_id,e.st_name,e.name,e.nickname,e.tel,e.passport,e.address,e.date_start_work,e.picture,e.old_work,e.degree,e.nationality,e.status,e.contact,e.e_username,e.e_password,e.l_id,e.current_salary,e.l_id,l.l_name from employees e left join level l on l.l_id = e.l_id  where e.is_show = 1 and e.e_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with employee ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 }
 
	 public function Get_All(){
		  $sql = 'select e.e_id,CONCAT(e.st_name, e.name) As  name,e.nickname,e.l_id,l.l_name from employees e left join level l on l.l_id = e.l_id  where e.is_show = 1 and e_id not in (1,2,3)';
		  $query = $this->db->query($sql);
		  return $query->result();
	 } 
	 
	 
  
	 
	 public function Check_Login($e_username, $e_password)
	{  

		  $sql = 'select  e_id from employees e   where e.is_show = 1 and e.e_username = ? and e.e_password = ?';
 
		$query = $this->db->query($sql, array($e_username,$e_password));
 
	 	if($query->num_rows() > 0)  
	 	{
			 foreach ($query->result() as $row)
		   { 
				$this->session->set_userdata('e_id', $row->e_id);     
		   }
	 			return TRUE;
	 	}
	 	else
	 	{
	 		return FALSE;
	 	}
	 }
	 
	 
	 
 
}