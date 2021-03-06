<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }
 
  
	 public function Insert($menu_data = null){ 
	 		if ($menu_data == null){
		   log_message('error', 'Insert => menu Data is null.');
		   throw new Exception('menu Data is null.');
		  }
		  try {
		   $this->db->insert('menu', $menu_data); 
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
 
	 public function Update($menu_data = null, $menu_id){ 
		  if ($menu_data == null){
		   	log_message('error', 'Update => menu Data is null.');
		   	throw new Exception('menu Data is null.');
		  }

		  
		  if ($menu_data == null || $menu_id == 0) {
		   	log_message('error', 'Required ID for update menu Data.');
		   	throw new Exception('Required ID for update menu Data.');
		  } 
		 
		  try {
		    
		   	return $this->db->update('menu', $menu_data, array('menu_id' => $menu_id));
		    
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }
	 public function Get_By_ID($menu_id){ 
		  $sql = 'SELECT menu_id, menu_name, menu_link_url, parent_menu_id, is_deleted, menu_css, is_shortcut FROM menu WHERE is_deleted = 0 AND menu_id = ?';
		  $query = $this->db->query($sql, array($menu_id));
		  log_message('debug', sprintf('Found %b row with menu ID %s', $query->num_rows(), $menu_id));
		  return $query->row_array();// return one row
	 } 
	 public function Get_All(){
		  $sql = 'SELECT menu_id, menu_name, menu_link_url, parent_menu_id, is_deleted, menu_css, is_shortcut FROM menu WHERE is_deleted = 0';
		  $query = $this->db->query($sql);
		  return $query->result();
	 }  
}