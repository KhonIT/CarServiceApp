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
		  $sql = 'select
			e.e_id as emp_id
			,e.st_name as emp_st_name
			,e.name as emp_name
			,e.nickname as emp_nickname
			,e.tel as emp_tel
			,e.passport as emp_passport
			,e.address as emp_address
			,e.date_start_work as emp_date_start_work
			,e.picture as emp_picture
			,e.old_work as emp_old_work
			,e.degree as emp_degree
			,e.nationality as emp_nationality
			,e.status as emp_status
			,e.contact as emp_contact
			,e.e_username as emp_username
			,e.current_salary as emp_current_salary
			,l.l_id as emp_l_id
			,l.l_name from employees e left join level l on l.l_id = e.l_id  where e.is_show = 1 and e.e_id = ?';

		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with employee ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 }

	 public function Get_All(){
		  $sql = 'select e.e_id as emp_id,CONCAT(e.st_name, e.name) As  name,e.nickname,l.l_name from employees e left join level l on l.l_id = e.l_id  where e.is_show = 1 and e_id not in (1,2,3)';
		 $query = $this->db->query($sql);
		return $query->result();
	 }
	 public function Cal_Salary(){
		  $boolean = false;
		  $sql = 'INSERT INTO salary_slip (e_id,salary,creadated_date) SELECT e.e_id,e.current_salary,now() FROM employees e WHERE e.is_show =1  and e_id not in (1,2,3) and concat(month(now()),e_id) not in (select  concat(month(creadated_date),e_id) from  salary_slip  GROUP by  month(creadated_date) )';
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
		  $sql = 'select s.slip_id,CONCAT(e.st_name, e.name) As  emp_name ,e.tel as tel,s.salary as salary,month(s.creadated_date) as salary_month,l.l_name from salary_slip s left join employees e  on e.e_id = s.e_id left join level l on l.l_id = e.l_id where s.slip_id =? ';
		  $query = $this->db->query($sql,array($slip_id));
		  return $query->row_array();
	 }

	 public function Get_Salary(){
			$sql = 'select s.slip_id,CONCAT(e.st_name, e.name) As  emp_name ,e.tel ,s.salary,month(s.creadated_date) as salary_month,l.l_name from salary_slip s left join employees e  on e.e_id = s.e_id left join level l on l.l_id = e.l_id where month(s.creadated_date) = month(now()) ';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	 public function Get_Month_Salary(){
			$sql = 'select  MONTH(s.creadated_date)as month from salary_slip s   group by   MONTH(s.creadated_date)   order by MONTH(s.creadated_date) asc  ';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	 	 public function Get_Salary_Month($month){
	 			$sql = 'select s.slip_id,CONCAT(e.st_name, e.name) As  emp_name ,e.tel ,s.salary,month(s.creadated_date) as salary_month,l.l_name from salary_slip s left join employees e  on e.e_id = s.e_id left join level l on l.l_id = e.l_id where month(s.creadated_date) = ? ';
	 			$query = $this->db->query($sql,array($month));
	 			return $query->result();
	 	 }

	 public function Check_Login($e_username, $e_password)
	{

		  $sql = 'select  e_id as emp_id from employees e   where e.is_show = 1 and e.e_username = ? and e.e_password = ?';

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
