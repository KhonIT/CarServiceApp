<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  MY_Controller extends CI_Controller {

	public $user_profile;
	public $className = '';
	public $methodName = '';
	public $restrict_area = array();

	public function __construct()
	{
		parent::__construct();


			$this->load->model('Employee_Model');
			$this->className = $this->router->fetch_class(); // Get Class Name
			$this->methodName = $this->router->fetch_method(); // Get Method Name
				// Restrict Access

			$className = $this->className . '/' . $this->methodName;

			$this->session->set_userdata('className',  $className );


			if(strlen($this->session->userdata('emp_id'))> 0   )# If Logged in
			{
				 $this->user_profile = $this->Employee_Model->Get_By_ID($this->session->userdata('emp_id'));
				 
			} else{
				redirect('/backend/Login');
			}
	}

}

/* End of file  MY_Controller  */
