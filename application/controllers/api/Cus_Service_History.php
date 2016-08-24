<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Cus_Service_History extends CI_Controller
{
	function __construct()
    { 
        parent::__construct();
        
    } 
    function Cus_Get($limit,$offset)
    { 
		if($limit == null || $limit ==''){
			$limit = 1;
		}
		if($offset == null || $offset ==''){
			$offset = 50;
		}
		$this->load->model('Customer_Service_Model'); 
		$result = 	$result =  $this->Customer_Service_Model->Get_Cus_History($limit,$offset);
        if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }
    
   
}