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
        $result =  $this->Service_Model->Get_All();
        if($result)
        {
           echo json_encode ($result) ;
        }
    }
    public function Get_By_Car_Size()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));
        $result =  $this->Service_Model->Get_By_Car_Size($data->car_size);
        if($result)
        {
           echo json_encode ($result) ;
        }
    }

    public function Edit()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));
        $data_arr = array(
          'service_name'=>$data->service_name,
          'car_size'=>$data->car_size,
          'price'=>$data->price
        );
        if($data->id=="0"){
      		$result =  $this->Service_Model->Insert($data_arr);
      	}else{
      		$result =  $this->Service_Model->Update($data_arr,$data->id);
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

        $data_arr = array(
            'is_deleted'=>1
        );
        $result =  $this->Service_Model->Update($data_arr,$data->id);

        if($result)
        {
               echo "true";
        }
    }

}
