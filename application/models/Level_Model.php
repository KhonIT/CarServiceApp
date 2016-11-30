<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Level_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }


	 public function Insert($level_data = null){
	 		if ($level_data == null){
		   log_message('error', 'Insert => level Data is null.');
		   throw new Exception('level Data is null.');
		  }
		  try {
		   $this->db->insert('level', $level_data);
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }

	 public function Update($level_data = null, $l_id){

		  if ($level_data == null){
		   	log_message('error', 'Update => level Data is null.');
		   	throw new Exception('level Data is null.');
		  }


		  if ($level_data == null || $l_id == 0) {
		   	log_message('error', 'Required ID for update level Data.');
		   	throw new Exception('Required ID for update level Data.');
		  }

		  try {

		   	return $this->db->update('level', $level_data, array('l_id' => $l_id));

		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }



	 public function Get_By_ID($l_id){
		  $sql = "select l.l_id,l.l_name,IFNULL(lp.l_id,'-')as l_parent_id,IFNULL(lp.l_name,'-')as l_parent_name from level l left join level lp on l.l_parent_id = lp.l_id where l.is_show = 1 and l.l_id = ?";
		  $query = $this->db->query($sql, array($l_id));
		  log_message('debug', sprintf('Found %b row with level ID %s', $query->num_rows(), $l_id));
		  return $query->row_array();// return one row
	 }

	 public function Get_All(){
		  $sql = "select l.l_id,l.l_name,IFNULL(lp.l_id,'-')as l_parent_id,IFNULL(lp.l_name,'-')as l_parent_name from level l left join level lp on l.l_parent_id = lp.l_id where l.is_show = 1";
		  $query = $this->db->query($sql);
		  return $query->result();
	 }


}
