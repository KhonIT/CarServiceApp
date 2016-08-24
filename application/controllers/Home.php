<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->_init();
	}

	private function _init()
	{

	}

	public function index()
	{
		$this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
		$this->output->set_template('Main');
		$this->load->view('Content/Home_View');
	}

}
