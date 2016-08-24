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
        $this->output->set_template('Backend');  

    }

     public function index()
    {
        $this->load->js('Assets/js/Level.js');
        $this->load->view('Content/Level_View');
    }

    public function Get_All()
    {
        $this->output->unset_template();

        $Level =  $this->Level_Model->Get_All();

        if($Level)
        {
           echo json_encode ($Level) ;
        }
    }

    public function Get_By_ID()
    {
    	$this->output->unset_template();

    	$Level =  $this->Level_Model->Get_By_ID($this->input->post('l_id'));

    	if($Level)
    	{
    		echo json_encode ($Level) ;
    	}
    }



    public function Add()
    {
        $this->output->unset_template();

        $Level_arr = array(
                'l_name'=>$this->input->post('l_name'),
        		'l_parent_id'=>$this->input->post('l_parent_id'),
        		'update_by' => $this->user_profile['name'],
        		'update_date' => date('Y-m-d H:i:s')
        );

        $Level =  $this->Level_Model->Insert($Level_arr);

        if($Level)
        {
                echo "true";
        }
    }


    public function Edit()
    {
        $this->output->unset_template();
        $Level_arr = array(
            'l_name'=>$this->input->post('l_name'),
        	'l_parent_id'=>$this->input->post('l_parent_id'),
            'update_by' => $this->user_profile['name'],
            'update_date' => date('Y-m-d H:i:s')
        );

        $Level =  $this->Level_Model->Update($Level_arr,$this->input->post('l_id'));

        if($Level)
        {
            echo "true";
        }
    }


    public function Delete()
    {
        $this->output->unset_template();

        $Level_arr = array(
            'is_show'=>0,
            'update_by' => $this->user_profile['name'],
            'update_date' => date('Y-m-d H:i:s')
        );
        $Level =  $this->Level_Model->Update($Level_arr,$this->input->post('l_id'));

        if($Level)
        {
               echo "true";
        }
    }

}
