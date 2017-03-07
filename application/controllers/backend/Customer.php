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
      $this->load->js('Assets/Backend/js/cont/Customer.js');
      $this->load->view('Content/Customer_View');
    }

    public function Get_Logo()
    {
        $this->output->unset_template();

        $this->load->helper('directory'); //load directory helper
        $dir = APPPATH. "Assets\Images\iconlogo";
        $dir = str_replace('\application','',$dir);

        $map = directory_map($dir);
        $data= array();
        foreach ($map as $key => $value) {

          $name = explode('.', $value);
           $data_arr = array(
               'name'=>$name[1],
               'img'=>$value
           );
               $data[] = $data_arr;
        }

        if($map)
        {
          echo json_encode ($data) ;
        }
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
      $data=json_decode(file_get_contents("php://input"));
    	$result =  $this->Customer_Model->Get_By_ID($data->id);
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
          'cus_name'=>$data->cus_name,
          'cus_tel'=>$data->cus_tel,
          'cus_car_regis_number'=>$data->cus_car_regis_number,
          'cus_car_brand'=>$data->cus_car_brand,
          'cus_car_model'=>$data->cus_car_model,
          'cus_car_color'=>$data->cus_car_color,
          'modify_by' =>$this->user_profile['emp_id'],
          'modify_date' => date('Y-m-d H:i:s')
        );
        if($data->id=="0"){
            $result =  $this->Customer_Model->Insert($data_arr);
        }else{
            $result =  $this->Customer_Model->Update($data_arr,$data->id);
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
        $id=$data->id;
        $data_arr = array(
            'is_deleted'=>1
        );
        $result =  $this->Customer_Model->Update($data_arr,$id);

        if($result)
        {
           echo json_encode (true) ;
        }else{
           echo json_encode (false) ;
        }
    }
}
