<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Employee_Model');
    }

     public function index()
    {
		$this->output->set_template('Backend');
		$this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
        $this->load->js('Assets/Backend/js/Employee.js');
        $this->load->view('Content/Employee_View');
    }

    public function Get_All()
    {
        $this->output->unset_template();

        $result =  $this->Employee_Model->Get_All();

        if($result)
        {
        	echo json_encode ($result) ;
        }
    }
    public function Get_By_ID()
    {
        $this->output->unset_template();

        $result =  $this->Employee_Model->Get_By_ID($this->input->post('e_id'));

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
        $arr = array(
					'name'=>$this->input->post('name'),
					'nickname'=>$this->input->post('e_nickname'),
					'e_username'=>$this->input->post('e_username'),
					'e_password'=>$this->input->post('e_password'),
					'l_id'=>$this->input->post('l_id'),
					/*
					'name'=>$this->input->post('name'),
					'nickname'=>$this->input->post('nickname'),
					'tel'=>$this->input->post('tel'),
					'date_start_work'=>$this->input->post('date_start_work'),
					'picture'=>$this->input->post('picture'),
					'old_work'=>$this->input->post('old_work'),
					'degree'=>$this->input->post('degree'),
					'nationality'=>$this->input->post('nationality'),
					'status'=>$this->input->post('status'),
					'contact'=>$this->input->post('contact'),
					'current_salary'=>$this->input->post('current_salary'),
					*/
					'update_by' => $this->user_profile['name'],
					'modified_date' => date('Y-m-d H:i:s')
        );
        if($this->input->post('e_id')=='0'){
        	//$arr['e_password'] = random_string('alnum', 8);
        	$result =  $this->Employee_Model->Insert($arr);
        }else{
        	$result =  $this->Employee_Model->Update($arr,$this->input->post('e_id'));
        }
		if($result){
			echo "true";
		}else{
			echo "false";
		}
    }

    public function Delete()
    {
        $this->output->unset_template();

        $data_arr = array(
            'is_show'=>0,
            'update_by' => $this->user_profile['name'],
            'modified_date' => date('Y-m-d H:i:s')
        );
        $result =  $this->Employee_Model->Update($data_arr,$this->input->post('e_id'));

        if($result)
        {
           echo "true";
        }
    }

	public function logout()
	{
		$this->output->unset_template();
		$this->session->sess_destroy();
		echo "true";
	}
}
