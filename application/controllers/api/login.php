<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class validate extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php 
        $this->methods['login_post']['limit'] = 500;  
    }
    
    
    function login_post()
    {
		$this->load->model('Member_model'); 
		
		$userData = array(
		  'user_name' =>$this->input->post('user_name'), 
		  'password'=>$this->input->post('password') 
		);  
		
		 $users  = $this->Member_model->validate_login($userData);
 	     if(count ($users)>0)
		 {
			 $status = true;
		 }
		 else
		 {
	 		 $status = false;
		 }
 
		 
		 $result  = array('user_id' => $user_id , 'status' =>  $status );
		 
		 $this->response($result, 200); // 200 being the HTTP response code
    }
     
     
}