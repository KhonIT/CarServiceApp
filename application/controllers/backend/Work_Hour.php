<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Work_Hour extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Work_Hour_Model');
    }

     public function index()
    {
        $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
        $this->output->set_template('Backend');
        $this->load->js('Assets/Backend/js/Work_Hour.js');
        $this->load->view('Content/Work_Hour_View');
    }

    public function Get_All()
    {
        $this->output->unset_template();

        $result =  $this->Work_Hour_Model->Get_All();

        if($result)
        {
           echo json_encode ($result) ;
        }
    }
    public function Get_By_ID()
    {
    	$this->output->unset_template();

    	$result =  $this->Work_Hour_Model->Get_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }
	public function Get_OrdersDetails_By_ID()
    {
    	$this->output->unset_template();

    	$result =  $this->Work_Hour_Model->Get_OrdersDetails_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }


    public function Edit()
    {
        $this->output->unset_template();
        $data_arr = array(
        		'service_name'=>$this->input->post('name'),
				'price'=>$this->input->post('price'),
            	'modify_by' =>  $this->user_profile['emp_id'],
            	'modify_date' => date('Y-m-d H:i:s')
        );
        if($this->input->post('id') =="0"){
			$result =  $this->Work_Hour_Model->Insert($data_arr);
		}else{
			$result =  $this->Work_Hour_Model->Update($data_arr,$this->input->post('id'));
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

        $data_arr = array(
            'is_show'=>0,
            'modify_by' => $this->user_profile['emp_id'],
            'modify_date' => date('Y-m-d H:i:s')
        );
        $result =  $this->Work_Hour_Model->Update($data_arr,$this->input->post('id'));

        if($result)
        {
               echo "true";
        }
    }
 
}
