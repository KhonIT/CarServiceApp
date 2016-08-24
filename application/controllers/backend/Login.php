<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->_init();
	}

	private function _init()
	{
		$this->load->model('Employee_Model');
	}

	public function index()
	{
		if(strlen($this->session->userdata('e_id'))> 0)
		{
			redirect('backend/Home');
		}
		else # If not Log in
		{
			$this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
			$this->output->append_title('Login' );
			$this->output->set_template('Blank'); 
			$this->load->css('Assets/css/Login.css');
			$this->load->js('Assets/js/Login.js');
			$this->load->view('Content/Login_View');
		}

	}
      public function check_auth()
	{
		$this->output->unset_template();
		$result = $this->Employee_Model->Check_Login($this->input->post('inputUsername'),  $this->input->post('inputPassword'));

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
