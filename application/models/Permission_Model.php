<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Permission_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }
 
  
	 public function Insert($permission_data = null){ 
	 		if ($permission_data == null){
		   log_message('error', 'Insert => permission Data is null.');
		   throw new Exception('permission Data is null.');
		  }
		  try {
		   $this->db->insert('permission', $permission_data); 
		   	return $this->db->insert_id();
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
 
	 public function Update($permission_data = null, $permission_id){
	 
		  if ($permission_data == null){
		   	log_message('error', 'Update => permission Data is null.');
		   	throw new Exception('permission Data is null.');
		  }

		  
		  if ($permission_data == null || $permission_id == 0) {
		   	log_message('error', 'Required ID for update permission Data.');
		   	throw new Exception('Required ID for update permission Data.');
		  } 
		 
		  try {
		    
		   	return $this->db->update('permission', $permission_data, array('permission_id' => $permission_id));
		    
		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 } 
	  
	 public function Get_Menu($e_id){
		  $sql = 'select m.menu_id
		  , m.menu_name  
, CASE ifnull((select is_edit FROM permission p where m.menu_id = p.menu_id and l.l_id = p.l_id ), 0 ) WHEN "0" THEN "#" WHEN "1" THEN m.link_url ELSE "#" END as link_url
		  ,m.parent_menu_id 
, ifnull((select menu_name from menu m1  where  m.parent_menu_id = m1.menu_id), 0 )as parent_menu


, ifnull((select is_edit FROM permission p where m.menu_id = p.menu_id and l.l_id = p.l_id  ),
        
         ifnull((select menu_name from menu m1  where  m.parent_menu_id = m1.menu_id),1 )
        ) is_show 
, ifnull((select is_edit FROM permission p where m.menu_id = p.menu_id and l.l_id = p.l_id  ), 0 ) is_edit
, ifnull((select permission_id FROM permission p where m.menu_id = p.menu_id and l.l_id = p.l_id   ), 0 ) permission_id 
from level l , menu m where m.is_show = 1    and l.l_id in( select l_id from employees where e_id = ?) ORDER by m.parent_menu_id,m.menu_id';
		  $query = $this->db->query($sql, array($e_id));
		  log_message('debug', sprintf('Found %b row with employee id %s', $query->num_rows(), $e_id));
		  return $query->result();
	 }

	 public function Get_By_ID($l_id){
		  $sql = 'select l.l_id,l.l_name,m.menu_id,(select menu_name from menu m1  where  m.parent_menu_id = m1.menu_id)as parent_menu, m.menu_name  , ifnull((select is_edit FROM permission p where m.menu_id = p.menu_id and l.l_id = p.l_id  ), 0 ) is_edit , ifnull((select permission_id FROM permission p where m.menu_id = p.menu_id and l.l_id = p.l_id   ), 0 ) permission_id from level l , menu m where m.is_show = 1 and m.parent_menu_id != 0 and l.l_id = ? ORDER by m.menu_id';
		  $query = $this->db->query($sql, array($l_id));
		  log_message('debug', sprintf('Found %b row with permission ID %s', $query->num_rows(), $l_id));
		  return $query->result();
	 }
 
	 public function Get_All(){
		  $sql = 'select p.permission_id,p.is_edit, l.l_id,l.l_name,m.menu_id,(select menu_name from menu m1  where  m.parent_menu_id = m1.menu_id)as parent_menu,m.menu_name from permission p  left join  level l  on p.l_id = l.l_id    left join menu m on m.menu_id = p.menu_id where m.is_show = 1 and m.parent_menu_id != 0    ';
		  $query = $this->db->query($sql);
		  return $query->result();
	 } 
	 
}