<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Salary extends MY_Controller {
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
      $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
      $this->output->set_template('Backend');
      $this->load->js('Assets/js/Report_Salary.js');
      $this->load->js('https://www.gstatic.com/charts/loader.js');
      $this->load->view('Content/Report_Salary_View');
    }

    public function PrintSalary()
    {
      $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
      $this->output->set_template('Blank');
      $this->load->js('Assets/js/cont/PrintSalary.js');
      $this->load->view('Content/Print_Slip_View');
    }

    public function Get_Month_Salary()
   {
     $this->output->unset_template();
     $result =  $this->Employee_Model->Get_Month_Salary();
     if($result)
     {
       echo json_encode ($result) ;
     }
   }
   public function Get_Salary_Month()
   {
       $this->output->unset_template();
       $result =  $this->Employee_Model->Get_Salary_Month($this->input->post('month'));
       if($result)
       {
         echo json_encode ($result) ;
       }
   }
}
