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

class member extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key

    }
    
    function user_get()
    { 
	$this->load->model('Member_Model'); 
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }
 
    	$user = $this->Member_Model->get_user_by_id($this->get('id'));	 
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        } 
        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function user_post()
    {
		$this->load->model('Member_Model');
		$user_id = $this->get('id');
	if ($this->input->post('login')!= 'true'){
		$userData = array(
		  'user_name' =>$this->input->post('re_username'),
		  'email' => $this->input->post('re_email'),
		  'password'=>$this->input->post('re_password'),
		  'gender'=>$this->input->post('re_gender'),
		  'birthday'=>$this->input->post('re_birthday'),
		  'phone_tel'=>$this->input->post('re_phone'), 
		  'social'=> $this->input->post('social'),
		  'active' => 'Y'
		);  
		  
		 if ($user_id == null)
		 {
			 $user_id = $this->Member_Model->insert_user($userData);
		 }
		 else
		 {
			 $this->Member_Model->update_user($user_id, $userData);
		 }
 
		 
		 $result  = array('user_id' => $user_id , 'status' => 'บันทึกข้อมูล สำเร็จ');
		  
		}else{
			
			$userData = array(
		  'user_name' =>$this->input->post('user_name'), 
		  'password'=>$this->input->post('password') 
		);  
		
		 $users  = $this->Member_Model->validate_login($userData);
 	     if(count ($users)>0)
		 {
			 $status = true;
		 }
		 else
		 {
	 		 $status = false;
		 } 
		 		 $result  = array('user_id' => $users['user_id'] , 'status' =>  $status );

			}
				 $this->response($result, 200); // 200 being the HTTP response code
    }
    
    function user_delete()
    { 
		$this->load->model('Member_Model');
		$user_id = $this->get('id');
		$this->Member_Model->delete_user($user_id);
 
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
		$this->load->model('Member_Model'); 
        $users =  $this->Member_Model->Get_All();
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }


	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}