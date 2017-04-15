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
      $this->load->js('Assets/js/cont/Customer.js');
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

   public function Get_By_CarRegisNumber()
    {
    	$this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
    	$result =  $this->Customer_Model->Car_Search($data->car_regis_number);
    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }

    public function Get_By_ID()
    {
    	$this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
    	$result =  $this->Customer_Model->Car_Search($data->id);
    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }

    public function Edit()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $cus_id="";
        if($data->cus_name !="" &&  $data->cus_tel !=""){

          $data_cus_arr = array(
            'cus_name'=>$data->cus_name,
            'cus_tel'=>$data->cus_tel,
          );
          if($data->cus_id=="0"){
              $cus_id =  $this->Customer_Model->Customer_Insert($data_cus_arr);
          }else{
              $result =  $this->Customer_Model->Update($data_cus_arr,$data->cus_id);
              $cus_id = $data->cus_id;
          }
        }

        $data_car_arr = array(
          'car_regis_number'=>$data->car_regis_number,
          'car_regis_province'=>$data->car_regis_province,
          'car_brand'=>$data->car_brand,
          'car_model'=>$data->car_model,
          'car_color'=>$data->car_color,
          'car_size'=>$data->car_size,
          'cus_id'=>$cus_id
        );

        if($data->car_id=="0"){
            $result =  $this->Customer_Model->Car_Insert($data_car_arr);
        }else{
            $result =  $this->Customer_Model->Update($data_car_arr,$data->car_id);
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
