<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Salary extends MY_Controller {
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
    }

    public function Calculate()
   {
       $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
       $this->output->set_template('Backend');
   }
 
}
