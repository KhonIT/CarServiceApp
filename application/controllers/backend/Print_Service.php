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


    public function Get_By_ID()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));

    	$result =  $this->Customer_Service_Model->Get_By_ID($data->id);

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }

    public function Get_OrdersDetails_Print()
      {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $result =  $this->Customer_Service_Model->Get_OrdersDetails_Print($data->id);

        if($result)
        {
          echo json_encode ($result) ;
        }
      }
      
      public function ChangePay()
        {
          $this->output->unset_template();
          $data=json_decode(file_get_contents("php://input"));
          $data_arr = array(
              'pay_status'=>1,
              'modify_by' =>  $this->user_profile['emp_id'],
              'modify_date' => date('Y-m-d H:i:s')
          );
    			$result =  $this->Customer_Service_Model->Update($data_arr,$data->id);
          if($result)
              {
                 echo json_encode (true) ;
              }else{
                 echo json_encode (false) ;
              }
        }
}
