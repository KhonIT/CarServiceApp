<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {
    function __construct()
    {
        parent::__construct();   
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Menu_Model');
    }

     public function index()
    { 
		$this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net'); 
		$this->output->set_template('Main');
        $this->load->js('Assets/js/Menu.js'); 
        $this->load->view('Content/Menu_View');
    }

    public function Get_All()
    {
        $this->output->unset_template(); 

        $Menu =  $this->Menu_Model->Get_All();

        if($Menu)
        {
           echo json_encode ($Menu) ;	
        } 
    } 
    public function Get_By_ID()
    {
    	$this->output->unset_template();
    
    	$Menu =  $this->Menu_Model->Get_By_ID($this->input->post('menu_id'));
    
    	if($Menu)
    	{
    		echo json_encode ($Menu) ;
    	}
    } 
    
    public function Edit()
    { 
        $this->output->unset_template();    
        $Menu_arr = array( 
        		'menu_name'=>$this->input->post('menu_name'),
				'parent_menu_id'=>$this->input->post('parent_menu_id'),
				'link_url'=>$this->input->post('link_url'),
            	'update_by' =>  $this->user_profile['name'],
            	'update_date' => date('Y-m-d H:i:s') 
        ); 
        if($this->input->post('menu_id') =="0"){
			$result =  $this->Menu_Model->Insert($Menu_arr);
		}else{
			$result =  $this->Menu_Model->Update($Menu_arr,$this->input->post('menu_id'));
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
        
        $Menu_arr = array( 
            'is_show'=>0,
            'update_by' => $this->user_profile['name'],
            'update_date' => date('Y-m-d H:i:s')
        );  
        $Menu =  $this->Menu_Model->Update($Menu_arr,$this->input->post('p_id'));

        if($Menu)
        {
               echo "true";	
        }  
    }  
    
}

