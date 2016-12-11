<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Service_Model');
    }

     public function index()
    {
      $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
      $this->output->set_template('Backend');
      $this->load->js('Assets/Backend/js/cont/Service.js');
      $this->load->view('Content/Service_View');
    }

    public function Get_All()
    {
        $this->output->unset_template();

        $Menu =  $this->Service_Model->Get_All();

        if($Menu)
        {
           echo json_encode ($Menu) ;
        }
    }
    public function Get_By_ID()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));

    	$result =  $this->Service_Model->Get_By_ID($data->id);

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }

    public function Edit()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));
        $Menu_arr = array(
          'service_name'=>$data->service_name,
          'price'=>$data->price,
          'modify_by' =>  $this->user_profile['emp_id'],
          'modify_date' => date('Y-m-d H:i:s')
        );
        if($data->id=="0"){
      		$result =  $this->Service_Model->Insert($Menu_arr);
      	}else{
      		$result =  $this->Service_Model->Update($Menu_arr,$data->id);
      	}
        if($result)
        {
            echo "true";
        } else{
		 echo "false";
		}
    }


    public function Delete()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));

        $Menu_arr = array(
            'is_show'=>0,
            'modify_by' => $this->user_profile['emp_id'],
            'modify_date' => date('Y-m-d H:i:s')
        );
        $Menu =  $this->Service_Model->Update($Menu_arr,$data->id);

        if($Menu)
        {
               echo "true";
        }
    }

}
