<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Service extends MY_Controller {
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
        $this->load->js('Assets/Backend/js/Report_Service.js');
          $this->load->js('https://www.gstatic.com/charts/loader.js');
        $this->load->view('Content/Report_Service_View');
    }


    public function daily()
   {
     $this->output->unset_template();
     $result =  $this->Customer_Service_Model->Get_Report_Daily();
     if($result)
     {
        echo json_encode ($result) ;
     }
   }
   public function monthly()
  {
        $this->output->unset_template();
       $result =  $this->Customer_Service_Model->Get_Report_Monthly();
       if($result)
       {
          echo json_encode ($result) ;
       }
  }
  public function annualy()
 {
   $this->output->unset_template();
  $result =  $this->Customer_Service_Model->Get_Report_Annualy();
  if($result)
  {
     echo json_encode ($result) ;
  }
 }

}
