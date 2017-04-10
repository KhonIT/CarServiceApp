<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Level extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Level_Model');

    }

     public function index()
     {
       $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
       $this->output->set_template('Backend');
       $this->load->js('Assets/Backend/js/cont/Level.js');
       $this->load->view('Content/Level_View');
     }

    public function Get_All()
    {
        $this->output->unset_template();

        $result =  $this->Level_Model->Get_All();

        if($result)
        {
           echo json_encode ($result) ;
        }
    }

    public function Get_By_ID()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));

    	$result =  $this->Level_Model->Get_By_ID($data->id);

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
          'l_name'=>$data->l_name,
          'l_parent_id'=>$data->l_parent_id
        );

        if($data->id=="0"){
          $result =  $this->Level_Model->Insert($Level_arr);
        }else{
          $result =  $this->Level_Model->Update($data_arr,$data->id);
        }

        if($result)
        {
           echo json_encode (true) ;
        }else{
           echo json_encode (false) ;
        }
    }

    public function Delete()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $data_arr = array(
            'is_deleted'=>1 
        );
        $result =  $this->Level_Model->Update($data_arr,$data->id);

        if($result)
        {
           echo json_encode (true) ;
        }else{
           echo json_encode (false) ;
        }
    }

}
