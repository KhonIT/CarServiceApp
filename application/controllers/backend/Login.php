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
		if(strlen($this->session->userdata('emp_id'))> 0)
		{
			redirect('/BackEnd/Home');
		}
		else # If not Log in
		{
			$this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
			$this->output->append_title('ระบบหลังร้าน' );
			$this->output->set_template('Blank');
			$this->load->css('Assets/css/Login.css');
			$this->load->js('Assets/js/cont/Login.js');
			$this->load->view('Content/Login_View');
		}

	}
      public function check_auth()
	{
		$this->output->unset_template();

		$data=json_decode(file_get_contents("php://input"));

		$result = $this->Employee_Model->Check_Login($data->username, $data->password);

		if($result)
		{
			 echo json_encode (true) ;
		}else{
			 echo json_encode (false) ;
		}
	}
}
