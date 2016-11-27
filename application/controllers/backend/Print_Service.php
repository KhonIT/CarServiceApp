<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_Service extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Customer_Service_Model');
    }

     public function index()
    {
        $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
        $this->output->set_template('Backend');
        $this->load->js('Assets/Backend/js/Print_Service.js');
        $this->load->view('Content/Print_Service_View');
    }

    public function Get_By_ID()
    {
    	$this->output->unset_template();

    	$result =  $this->Customer_Service_Model->Get_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    } 
	public function Get_OrdersDetails_By_ID()
    {
    	$this->output->unset_template();
    	$result =  $this->Customer_Service_Model->Get_OrdersDetails_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }
}
