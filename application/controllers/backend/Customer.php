<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Customer_Model');
    }

     public function index()
    {
        $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
        $this->output->set_template('Backend');
        $this->load->js('Assets/Backend/js/Customer.js');
        $this->load->view('Content/Customer_View');
    }

    public function Get_All()
    {
        $this->output->unset_template();

        $result =  $this->Customer_Model->Get_All();

        if($result)
        {
           echo json_encode ($result) ;
        }
    }
    public function Get_By_ID()
    {
    	$this->output->unset_template();

    	$result =  $this->Customer_Model->Get_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }
	public function Get_OrdersDetails_By_ID()
    {
    	$this->output->unset_template();

    	$result =  $this->Customer_Model->Get_OrdersDetails_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }


    public function Customer_Search()
      {
      	$this->output->unset_template();

      	$result =  $this->Customer_Model->Cus_Search($this->input->post('cus_tel'),$this->input->post('cus_car_regis_number'));

      	if($result)
      	{
      		echo json_encode ($result) ;
      	}
      }


    public function Edit()
    {
        $this->output->unset_template();
        $data_arr = array(
          'cus_name'=>$this->input->post('cus_name'),
          'cus_tel'=>$this->input->post('cus_tel'),
          'cus_car_regis_number'=>$this->input->post('cus_car_regis_number'),
          'cus_car_brand'=>$this->input->post('cus_car_brand'),
          'cus_car_model'=>$this->input->post('cus_car_model'),
          'cus_car_color'=>$this->input->post('cus_car_color'),
          'modify_by' =>  $this->user_profile['e_id'],
          'modify_date' => date('Y-m-d H:i:s')
        );
        if($this->input->post('id') =="0"){
  			  $result =  $this->Customer_Model->Insert($data_arr);
    		}else{
      	   $result =  $this->Customer_Model->Update($data_arr,$this->input->post('id'));
    		}
        if($result)
        {
            echo $result;
        } else
        {
		        echo "false";
        }
    }
    public function Delete()
    {

        $this->output->unset_template();

        $data_arr = array(
            'is_show'=>0,
            'modify_by' => $this->user_profile['e_id'],
            'modify_date' => date('Y-m-d H:i:s')
        );
        $result =  $this->Customer_Model->Update($data_arr,$this->input->post('id'));

        if($result)
        {
               echo "true";
        }
    }
}