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
        $this->load->js('Assets/Backend/js/cont/Employee.js');
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
        $data=json_decode(file_get_contents("php://input"));
        $result =  $this->Employee_Model->Get_By_ID($data->id);

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
        $data=json_decode(file_get_contents("php://input"));
        $arr = array(
					'name'=>$data->emp_name,
					'nickname'=>$data->emp_emp_nickname,
					'e_username'=>$data->emp_emp_username,
					'e_password'=>$data->emp_emp_password,
					'l_id'=>$data->emp_emp_l_id,

					'tel'=>$data->emp_emp_tel,
					'date_start_work'=>$data->emp_date_start_work,
					'picture'=>$data->emp_picture,
					'old_work'=>$data->emp_old_work,
					'degree'=>$data->emp_degree,
					'nationality'=>$data->emp_nationality,
					'status'=>$data->emp_status,
					'contact'=>$data->emp_contact,
					'current_salary'=>$data->emp_current_salary,

					'modify_by' => $this->user_profile['e_id'],
					'modify_date' => date('Y-m-d H:i:s')
        );
        if($data->id=='0'){
        	//$arr['e_password'] = random_string('alnum', 8);
        	$result =  $this->Employee_Model->Insert($arr);
        }else{
        	$result =  $this->Employee_Model->Update($arr,$data->e_id);
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
        $data=json_decode(file_get_contents("php://input"));
        $data_arr = array(
            'is_show'=>0,
            'modify_by' => $this->user_profile['e_id'],
            'modify_date' => date('Y-m-d H:i:s')
        );
        $result =  $this->Employee_Model->Update($data_arr,$data->e_id);

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
