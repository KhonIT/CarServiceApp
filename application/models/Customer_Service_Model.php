<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Service_Model extends CI_Model{
	 public function __construct(){
	  	$this->load->database();
	 }

	 public function Insert($data = null){
	 		if ($data == null){
		   log_message('error', 'Insert => customer service Data is null.');
		   throw new Exception('customer service Data is null.');
		  }
		  try {
		   $this->db->insert('receipt', $data);
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

		   	return $this->db->update('receipt', $data, array('receipt_id' => $id));

		  } catch (Exception $e) {
		   	throw new Exception($e->getMessage());
		  }
	 }



	 public function Insert_Receipt_Detail($data = null){
			if ($data == null){
			 log_message('error', 'Insert => customer service Data is null.');
			 throw new Exception('customer service Data is null.');
			}
			try {
			 $this->db->insert('receipt_details', $data);
				return $this->db->insert_id();
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
	 }

	 public function Update_Order_Detail($data = null, $id){
			if ($data == null){
				log_message('error', 'Update => customer service Data is null.');
				throw new Exception('customer service Data is null.');
			}
			if ($data == null || $id == 0) {
				log_message('error', 'Required ID for update customer service Data.');
				throw new Exception('Required ID for update customer service Data.');
			}
			try {

				return $this->db->update('receipt_details', $data, array('receipt_detail_id' => $id));

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
	 }

	 public function Delete_Order($data = null, $id){
		if ($data == null){
			log_message('error', 'Update => customer service Data is null.');
			throw new Exception('customer service Data is null.');
		}
		if ($data == null || $id == 0) {
			log_message('error', 'Required ID for update customer service Data.');
			throw new Exception('Required ID for update customer service Data.');
		}
		try {

			$this->db->update('receipt_details', $data, array('receipt_id' => $id));
			return $this->db->update('receipt', $data, array('receipt_id' => $id));

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}	


	 public function Get_OrdersDetails_By_ID($id){
		  $sql = ' select   '.$id.'  as order_id,s.service_id,s.service_name,s.price as service_price , ifnull((select r.receipt_detail_id FROM receipt_details r where s.service_id = r.service_id and r.is_deleted = 0 and order_id = '.$id.'  ), 0 ) order_detail_id, ifnull((select r.price FROM receipt_details r where s.service_id = r.service_id and r.is_deleted = 0 and order_id = '.$id.'  ), 0 ) price from  service s  where s.is_deleted = 0';
			$query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->result();
	 }




	 public function Get_By_ID($id){
		  $sql = 'select  r.receipt_id as id,receipt_number as book_no,comment,total as total_price,payment_status from receipt r  where r.is_deleted = 0 and receipt_id = ?';
		  $query = $this->db->query($sql, array($id));
		  log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		  return $query->row_array();// return one row
	 }

	 public function Get_Recieve_By_ID($id){
		$sql = 'select  r.receipt_id as id,receipt_number as book_no,cu.cus_tel,cu.cus_name,c.car_regis_number as cus_car_regis_number,c.car_brand as cus_car_brand,c.car_model as cus_car_model,c.car_color as cus_car_color,comment,r.total as total_price,payment_status from receipt r left join car c on c.car_id = r.car_id left join customer cu on cu.cus_id = c.cus_id where r.is_deleted = 0 and receipt_id = ?';
		$query = $this->db->query($sql, array($id));
		log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		return $query->row_array();// return one row
   	}
	 
	   public function Get_receiptsDetails_Print($id){
		$sql = ' select   s.service_name,r.price as service_price   from  receipt_details r left join  service s  on  s.service_id = r.service_id where s.is_deleted = 0 and receipt_id = ?';
		  $query = $this->db->query($sql, array($id));
		log_message('debug', sprintf('Found %b row with service ID %s', $query->num_rows(), $id));
		return $query->result();
   }
   
	 public function Get_All($pay_status){
		  $sql = 'select  r.receipt_id as id,r.receipt_number,cu.cus_tel,cu.cus_name,c.car_regis_number,c.car_brand,c.car_model,c.car_color,c.cus_id,comment,total as total_price,payment_status,emp_id,receipt_date from receipt r left join car c on c.car_id = r.car_id left join customer cu on cu.cus_id = c.cus_id where r.is_deleted = 0 and r.receipt_status = "'.$pay_status.'" order by receipt_date desc  limit 100 offset 0 ';
		  $query = $this->db->query($sql);
		  return $query->result();
	 }

	 public function Get_Report_Daily($year,$mounth,$service_id){

			$sql = 'select left(TIME(r.receipt_date),2) as time_name,YEAR(r.receipt_date) as  year';
			$sql .= ' ,MONTH(r.receipt_date)as month ,left(DATE(r.receipt_date),2) as day_no,sum(total) as total ';
			$sql .= ' , CONCAT_WS(\'-\',  left(DATE(r.receipt_date),2),MONTH(r.receipt_date),YEAR(r.receipt_date),left(TIME(r.receipt_date),2) )  as name ';
			$sql .= ' from receipt r  where r.is_deleted = 0 ';
			if($year!= '0' ){
				$sql .= ' and YEAR(r.receipt_date) = \''.$year.'\'';
			}
			if($mounth!= '0' ){
				$sql .= ' and MONTH(r.receipt_date) =\''.$mounth.'\'';
			}
			if($service_id!= '0' ){
				$sql .= ' and r.receipt_id in (select receipt_id from receipt_details rd  where rd.service_id = \''.$service_id.'\')';
			}

			$sql .= ' group by DATE(r.receipt_date), left(TIME(r.receipt_date),2)  ';
			$sql .= ' order by left(TIME(r.receipt_date),2),  DATE(r.receipt_date) asc ';

			$query = $this->db->query($sql);
			return $query->result();
	 }
	 public function Get_Report_Monthly($service_id){
			$sql = 'select MONTH(r.receipt_date)as month,YEAR(r.receipt_date) as year ,sum(total) as total from receipt r where r.is_deleted = 0  ';

			if($service_id!= '0' ){
				$sql .= ' and r.receipt_id in (select receipt_id from receipt_details rd  where rd.service_id = \''.$service_id.'\')';
			}
			$sql .= ' group by MONTH(r.receipt_date) ,YEAR(r.receipt_date) order by YEAR(r.receipt_date) asc,MONTH(r.receipt_date) asc';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	 public function Get_Report_Annualy($service_id){
			$sql = 'select  YEAR(r.receipt_date) as name,sum(total) as total from receipt r where r.is_deleted = 0  ';


			if($service_id!= '0' ){
				$sql .= ' and r.receipt_id in (select receipt_id from receipt_details rd  where rd.service_id = \''.$service_id.'\')';
			}
				$sql .= ' group by YEAR(r.receipt_date)  order by YEAR(r.receipt_date) asc ';
			$query = $this->db->query($sql);
			return $query->result();
	 }

	 public function Get_Year(){
			$sql = 'select  YEAR(r.receipt_date) as year from receipt r where r.is_deleted = 0  group by YEAR(r.receipt_date)  order by YEAR(r.receipt_date) asc ';
			$query = $this->db->query($sql);
			return $query->result();
	 }
	 public function Get_Month($year){
			$sql = 'select  MONTH(r.receipt_date)as month from receipt r where r.is_deleted = 0 and YEAR(r.receipt_date) = ?  group by  YEAR(r.receipt_date),MONTH(r.receipt_date)   order by MONTH(r.receipt_date) asc ';
			$query = $this->db->query($sql, array($year));
			return $query->result();
	 }
}
