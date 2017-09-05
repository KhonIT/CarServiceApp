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
		   $this->db->insert('employee', $data);
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }

	 public function Update($data = null, $id){

		  if ($data == null){
		   	log_message('error', 'Update => employee Data is null.');
		   	throw new Exception('employee Data is null.');
		  }


		  if ($data == null || $id == 0) {
		   	log_message('error', 'Required ID for update employee Data.');
		   	throw new Exception('Required ID for update employee Data.');
		  }

		  try {

		   	return $this->db->update('employee', $data, array('emp_id' => $id));

		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }

	 public function Get_By_ID($id){
		  $sql = 'select
			e.emp_id 
			,e.emp_st_name 
			,e.emp_fname 
			,e.emp_lname 
			,e.emp_nickname 
			,e.emp_tel 
			,e.emp_ssn 
			,e.emp_address 
			,e.emp_date_start_work 
			,e.emp_picture 
			,e.emp_old_work 
			,e.emp_degree 
			,e.emp_nationality 
			,e.emp_status 
			,e.emp_contact 
			,e.emp_current_salary 
			,e.emp_username
			,l.l_id 
			,l.l_name from employee e left join level l on l.l_id = e.l_id  
			where e.is_deleted = 0 and e.emp_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with employee ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 }

	 public function Get_All(){
		  $sql = 'select e.emp_id as emp_id,CONCAT(e.emp_st_name,e.emp_fname,"  ",e.emp_lname) As  name,e.emp_nickname,l.l_name from employee e left join level l on l.l_id = e.l_id  where e.is_deleted = 0 and emp_id not in (1,2,3)';
		 $query = $this->db->query($sql);
		return $query->result();
	 }
	 public function Cal_Salary(){
		  $boolean = false;
		  $sql = 'INSERT INTO salary_slip (emp_id,salary,creadated_date) SELECT e.emp_id,e.current_salary,now() FROM employee e WHERE e.is_deleted = 0  and emp_id not in (1,2,3) and concat(month(now()),emp_id) not in (select  concat(month(creadated_date),emp_id) from  salary_slip  GROUP by  month(creadated_date) )';
			if($this->db->query($sql))	 {	 $boolean = true;}
		  return $boolean;
	 }

	 public function Del_Salary($slip_id){
		 try {

			 return   $this->db->delete('salary_slip', array('slip_id' => $slip_id));

		 } catch (Exception $e) {
			 throw new Exception($e->getMessage());
		 }
	 }

	 public function Get_Salary_Byid($slip_id){
		  $sql = 'select s.slip_id,CONCAT(e.emp_st_name,e.emp_fname,"  ",e.emp_lname) As  emp_name ,e.tel as tel,s.salary as salary,month(s.creadated_date) as salary_month,l.l_name from salary_slip s left join employee e  on e.emp_id = s.emp_id left join level l on l.l_id = e.l_id where s.slip_id =? ';
		  $query = $this->db->query($sql,array($slip_id));
		  return $query->row_array();
	 }

	 public function Get_Salary(){
			$sql = 'select s.slip_id,CONCAT(e.emp_st_name,e.emp_fname,"  ",e.emp_lname) As  emp_name ,e.tel ,s.salary,month(s.creadated_date) as salary_month,l.l_name from salary_slip s left join employee e  on e.emp_id = s.emp_id left join level l on l.l_id = e.l_id where month(s.creadated_date) = month(now()) ';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	 public function Get_Month_Salary(){
			$sql = 'select  MONTH(s.creadated_date)as month from salary_slip s   group by   MONTH(s.creadated_date)   order by MONTH(s.creadated_date) asc  ';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	public function Get_Salary_Month($month){
		$sql = 'select s.slip_id,CONCAT(e.emp_st_name,e.emp_fname,"  ",e.emp_lname) As  emp_name ,e.tel ,s.salary,month(s.creadated_date) as salary_month,l.l_name from salary_slip s left join employee e  on e.emp_id = s.emp_id left join level l on l.l_id = e.l_id where month(s.creadated_date) = ? ';
		$query = $this->db->query($sql,array($month));
		return $query->result();
	}

	 public function Check_Login($e_username, $e_password)
	{

		  $sql = 'select  emp_id  from employee e   where e.is_deleted = 0 and e.emp_username = ? and e.emp_password = ?';

		$query = $this->db->query($sql, array($e_username,$e_password));

	 	if($query->num_rows() > 0)
	 	{
			 foreach ($query->result() as $row)
		   {
				$this->session->set_userdata('emp_id', $row->emp_id);
		   }
	 			return TRUE;
	 	}
	 	else
	 	{
	 		return FALSE;
	 	}
	 }



}
