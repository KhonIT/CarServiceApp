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
        $Permission =  $this->Permission_Model->Get_All();

        if($Permission)
        {
        	echo json_encode ($Permission) ;	
        } 
    }
    
    public function Get_By_ID()
    {  
        $Permission =  $this->Permission_Model->Get_By_ID($this->input->POST('l_id'));
 
        if($Permission)
        {
        	  echo json_encode ($Permission) ;	
        } 
    }
    public function Get_Menu()
    {  
        $result =  $this->Permission_Model->Get_Menu($this->session->userdata('e_id'));
 

        if($result)
        {
        	  echo json_encode ($result) ;	
        } 
    }
 

    public function Edit()
    {   
    	$json_array = json_decode($this->input->post('jsonObj'), true);
       
        
    	 foreach($json_array  as $key=>$val){ 
    		

    	 	$Permission_arr = array( 
    	 			'l_id'=>$val['l_id'],
    	 			'menu_id'=>$val['menu_id'],
    	 			'is_edit'=>($val['is_edit']  == 'true' ? 1 : 0),
    	 			'update_by' => $this->user_profile['name'],
    	 			'update_date' => date('Y-m-d H:i:s')
    	 	);
    	 	
    		 if( $val['permission_id']=='0'){ 
    		 	$Permission =  $this->Permission_Model->Insert($Permission_arr);
    		 }else{
    		 	$Permission =  $this->Permission_Model->Update($Permission_arr,$val['permission_id']);
    		 }
    		 
    	} 
            echo "true";	
     
    }
 
    
}

