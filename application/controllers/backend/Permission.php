<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Permission_Model');

    }

    public function index()
    {
    	echo "Permission";
    }

    public function Get_All()
    {
        $this->output->unset_template();
        $result =  $this->Permission_Model->Get_All();
        if($result)
        {
        	echo json_encode ($result) ;
        }
    }

    public function Get_By_ID()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));
        $result =  $this->Permission_Model->Get_By_ID($data->id);

        if($result)
        {
        	  echo json_encode ($result) ;
        }
    }

    public function Get_Menu()
    {
      $this->output->unset_template();
      $result =  $this->Permission_Model->Get_Menu($this->session->userdata('emp_id'));
      if($result){echo json_encode ($result);}
    }

	public function Get_Menu_Home()
    {
      $this->output->unset_template();
      $result =  $this->Permission_Model->Get_Menu_Home($this->session->userdata('emp_id'));
      if($result){echo json_encode ($result);}
    }
	 
    public function Edit()
    {
      $this->output->unset_template();
      $data=json_decode(file_get_contents("php://input"));
    	$json_array = json_decode($data->jsonObj, true);
    	 foreach($json_array  as $key=>$val){
    	 	$Permission_arr = array(
    	 			'l_id'=>$val['l_id'],
    	 			'menu_id'=>$val['menu_id'],
    	 			'is_edit'=>($val['is_edit']  == 'true' ? 1 : 0), 
    	 	);
    		 if( $val['permission_id']=='0'){
    		 	$result =  $this->Permission_Model->Insert($Permission_arr);
    		 }else{
    		 	$result =  $this->Permission_Model->Update($Permission_arr,$val['permission_id']);
    		 }
    	}
      if($result)
      {
         echo json_encode (true) ;
      }else{
         echo json_encode (false) ;
      }

    }


}
