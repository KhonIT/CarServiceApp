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
        $this->load->js('Assets/js/cont/Employee.js');
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
    
    public function Salary()
    {
        $this->output->set_template('Backend');
        $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
        $this->load->js('Assets/js/cont/Salary.js');
        $this->load->view('Content/Salary_View');
    }
    public function Cal_Salary()
    {
        $this->output->unset_template();
        $result =  $this->Employee_Model->Cal_Salary();
        if($result){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
    
    
    public function Get_Salary_Byid()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $result =  $this->Employee_Model->Get_Salary_Byid($data->id);
        if($result){
            echo json_encode($result);
        }
    }
    
    public function Del_Salary()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $result =  $this->Employee_Model->Del_Salary($data->id);
        if($result)
        {
            echo json_encode ($result) ;
        }
    }
    
    public function Get_Salary()
    {
        $this->output->unset_template();
        $result =  $this->Employee_Model->Get_Salary();
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
        $arr =array();
        if($data->emp_password !=""){
            $arr = array(
                'emp_st_name'=>$data->emp_st_name,
                'emp_fname'=>$data->emp_fname,
                'emp_lname'=>$data->emp_lname,
                'emp_nickname'=>$data->emp_nickname,
                'emp_tel'=>$data->emp_tel,
                'emp_current_salary'=>$data->emp_current_salary,
                'emp_username'=>$data->emp_username,
                'emp_password'=>$data->emp_password,
                'l_id'=>$data->l_id
            ); 
        }else{ 
            $arr = array(
                'emp_st_name'=>$data->emp_st_name,
                'emp_fname'=>$data->emp_fname,
                'emp_lname'=>$data->emp_lname,
                'emp_nickname'=>$data->emp_nickname,
                'emp_tel'=>$data->emp_tel,
                'emp_current_salary'=>$data->emp_current_salary,
                'emp_username'=>$data->emp_username, 
                'l_id'=>$data->l_id,
            ); 
        } 
        if($data->id=='0'){ 
            $result =  $this->Employee_Model->Insert($arr);
        }else{
            $result =  $this->Employee_Model->Update($arr,$data->id);
        }
        if($result){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
    
    public function Upload_Image()
    {
        $this->output->unset_template();
        
        $file_element_name = 'file_image';
        
        $config['upload_path'] =  FCPATH.'Assets/Upload/ImageEmp/';
        $config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG';
        $config['max_size'] = 1024 * 5;
        $config['encrypt_name'] = false;
        $config['overwrite'] = false;
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload($file_element_name))
        {
            //Image Resizing
            $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 200;
            $config['height'] = 200;
            
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
			$data = $this->upload->data();
            
			$status = $data['file_name'];
        }
        else
        {
            $status =  $this->upload->display_errors();
            //	$status = "error";
            
        }
        @unlink($_FILES[$file_element_name]);
        
        echo $status;
    }
    
    public function Delete()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $data_arr = array(
            'is_deleted'=>1
        );
        $result =  $this->Employee_Model->Update($data_arr,$data->id);
        
        if($result)
        {
            echo "true";
        }
    }
    
    
    public function Get_Emp()
    {
        $this->output->unset_template();
        $result =  $this->Employee_Model->Get_By_ID($this->user_profile['emp_id']);
        if($result)
        {
            echo json_encode ($result) ;
        }
    }
    public function Edit_Emp()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $arr = array(
            'e_password'=>$data->emp_password
        );
        $result =  $this->Employee_Model->Update($arr,$this->user_profile['emp_id']);
        if($result){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
    
    
    
	public function logout()
	{
		$this->output->unset_template();
		$this->session->sess_destroy();
		echo "true";
	}
}
