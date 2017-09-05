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
        $this->output->set_template('Backend');
        $this->load->js('Assets/js/cont/Menu.js'); 
        $this->load->view('Content/Menu_View');
    }

    public function Get_By_ID()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));
        $result =  $this->Menu_Model->Get_By_ID($data->id);
        if($result){
            echo json_encode($result);
        }
    }

    public function Get_All()
    {
        $this->output->unset_template();
        $result =  $this->Menu_Model->Get_All();
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
            'menu_name'=>$data->menu_name,
            'parent_menu_id'=>$data->parent_menu_id,
            'menu_link_url'=>$data->menu_link_url
        ); 
        if($data->menu_id=="0"){
            $result =  $this->Menu_Model->Insert($data_arr);
        }else{
            $result =  $this->Menu_Model->Update($data_arr,$data->menu_id);
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
        $data=json_decode(file_get_contents("php://input"));
        $data_arr = array(
            'is_deleted'=>1
        );
        $result =  $this->Menu_Model->Update($data_arr,$data->id);

        if($result)
        {
            echo "true";
        }
    }

}
