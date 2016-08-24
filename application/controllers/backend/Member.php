<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Member_Model');

    }

     public function index()
    {
		 $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
		$this->output->set_template('Backend');
        $this->load->js('Assets/js/Member.js');
        $this->load->view('Content/Member_View');
    }

    public function Get_All()
    {
        $this->output->unset_template();

        $result =  $this->Member_Model->Get_All();

        if($result)
        {
        	echo json_encode ($result) ;
        }
    }
    public function Get_By_ID()
    {
        $this->output->unset_template();

        $result =  $this->Member_Model->Get_By_ID($this->input->post('m_id'));

        if($result)
        {
        	echo json_encode ($result) ;
        }
    }

    public function Get_Profile()
    {
    	$this->output->unset_template();
    	if($this->user_profile)
    	{
    		echo json_encode ($this->user_profile) ;
    	}
    }


    public function Edit()
    {
        $this->output->unset_template();
        $Member_arr = array(
        		'm_name'=>$this->input->post('m_name'),
        		'm_email'=>$this->input->post('m_email'),
        		'l_id'=>$this->input->post('l_id'),
        		'update_by' => $this->user_profile['name'],
        		'update_date' => date('Y-m-d H:i:s')
        );
        if($this->input->post('m_id')=='0'){
        	$Member_arr['m_password'] = random_string('alnum', 8);
        	$Member =  $this->Member_Model->Insert($Member_arr);
        }else{
        	$Member =  $this->Member_Model->Update($Member_arr,$this->input->post('m_id'));
        }

    }


    public function Delete()
    {
        $this->output->unset_template();

        $Member_arr = array(
            'is_show'=>0,
            'update_by' => $this->user_profile['name'],
            'update_date' => date('Y-m-d H:i:s')
        );
        $Member =  $this->Member_Model->Update($Member_arr,$this->input->post('m_id'));

        if($Member)
        {
           echo "true";
        }
    }
}
