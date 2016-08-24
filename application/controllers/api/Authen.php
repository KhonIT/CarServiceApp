	<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Authen extends CI_Controller
{
	function __construct()
    { 
      	$this->_init();
	}

	private function _init()
	{
		$this->load->model('Employee_Model');
	}
	
    function index( )
    {  
		$this->output->unset_template();
		$result = $this->Employee_Model->Check_Login($this->input->post('username_txt'),  $this->input->post('password')); 
		if($result === TRUE)
		{  
			echo "true";
		}
		else
		{  
 			echo "false";
		} 
    }
    
   
}