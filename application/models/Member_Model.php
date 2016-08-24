<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }
 
  
	 public function Insert($member_data = null){ 
	 		if ($member_data == null){
		   log_message('error', 'Insert => member Data is null.');
		   throw new Exception('member Data is null.');
		  }
		  try {
		   $this->db->insert('member', $member_data); 
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
 
	 public function Update($member_data = null, $m_id){
	 
		  if ($member_data == null){
		   	log_message('error', 'Update => member Data is null.');
		   	throw new Exception('member Data is null.');
		  }

		  
		  if ($member_data == null || $m_id == 0) {
		   	log_message('error', 'Required ID for update member Data.');
		   	throw new Exception('Required ID for update member Data.');
		  } 
		 
		  try {
		    
		   	return $this->db->update('member', $member_data, array('m_id' => $m_id));
		    
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
	 
	 public function Get_By_ID($m_id){
		  $sql = 'select m.m_id,m.m_name,m.l_id,l.l_name from member m left join level l on l.l_id = m.l_id  where m.is_show = 1 and m_id = ?';
		  $query = $this->db->query($sql, array($m_id));
		  log_message('debug', sprintf('Found %b row with member ID %s', $query->num_rows(), $m_id));
		  return $query->row_array();// return one row
	 }
 
	 public function Get_All(){
		  $sql = 'select m.m_id,m.m_name,m.l_id,l.l_name from member m left join level l on l.l_id = m.l_id  where m.is_show = 1';
		  $query = $this->db->query($sql);
		  return $query->result();
	 } 
	 
	 
  
	 
	 public function Check_Login($m_username, $m_password)
	{  

		  $sql = 'select m.m_id,m.m_name,m.l_id,l.l_name from member m left join level l on l.l_id = m.l_id  where m.is_show = 1 and m_username = ? and m_password = ?';
 
		$query = $this->db->query($sql, array($m_username,$m_password));
 
	 	if($query->num_rows() > 0)  
	 	{
			 foreach ($query->result() as $row)
		   {
		  
				$this->session->set_userdata('m_id', $row->m_id);   
				$this->session->set_userdata('l_id', $row->l_id);     
				$this->session->set_userdata('m_name', $row->m_name);    
				$this->session->set_userdata('l_name', $row->l_name);    
		 
		   }
	 			return TRUE;
	 	}
	 	else
	 	{
	 		return FALSE;
	 	}
	 }
	 
	 
	 
 
}