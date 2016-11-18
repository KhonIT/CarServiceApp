<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_Service extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->load->model('Customer_Service_Model');
    }

     public function index()
    {
        $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
        $this->output->set_template('Backend');
        $this->load->js('Assets/Backend/js/Customer_Service.js');
        $this->load->view('Content/Customer_Service_View');
    }

    public function Payed()
   {
       $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
       $this->output->set_template('Backend');
       $this->load->js('Assets/Backend/js/Customer_Service_Payed.js');
       $this->load->view('Content/Customer_Service_View');
   }


   public function Get_All_Payed()
   {
       $this->output->unset_template();

       $result =  $this->Customer_Service_Model->Get_All('1');

       if($result)
       {
          echo json_encode ($result) ;
       }
   }

    public function Get_All_Unpay()
    {
        $this->output->unset_template();

        $result =  $this->Customer_Service_Model->Get_All('0');

        if($result)
        {
           echo json_encode ($result) ;
        }
    }



    public function Get_By_ID()
    {
    	$this->output->unset_template();

    	$result =  $this->Customer_Service_Model->Get_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }
	public function Get_OrdersDetails_By_ID()
    {
    	$this->output->unset_template();
    	$result =  $this->Customer_Service_Model->Get_OrdersDetails_By_ID($this->input->post('id'));

    	if($result)
    	{
    		echo json_encode ($result) ;
    	}
    }


    public function Edit()
    {
        $this->output->unset_template();
        if($this->input->post('id') =="0"){
          $data_arr = array(
              'book_no'=>$this->input->post('book_no'),
              'number'=>$this->input->post('number'),
              'comment'=>$this->input->post('comment'),
              'cus_id'=>$this->input->post('cus_id'),
              'pay_status'=>$this->input->post('pay_status'),
              'total'=>$this->input->post('total'),
              'emp_id'=>$this->user_profile['e_id'],
              'modify_by' =>  $this->user_profile['e_id'],
              'modify_date' => date('Y-m-d H:i:s')
          );
    			$result =  $this->Customer_Service_Model->Insert($data_arr);
    		}else{
          $data_arr = array(
              'book_no'=>$this->input->post('book_no'),
              'number'=>$this->input->post('number'),
              'comment'=>$this->input->post('comment'),
              'total'=>$this->input->post('total'),
              'pay_status'=>$this->input->post('pay_status'),
              'modify_by' =>  $this->user_profile['e_id'],
              'modify_date' => date('Y-m-d H:i:s')
          );
    			$result =  $this->Customer_Service_Model->Update($data_arr,$this->input->post('id'));
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

        $data_arr = array(
            'is_show'=>0,
            'modify_by' => $this->user_profile['e_id'],
            'modify_date' => date('Y-m-d H:i:s')
        );
        $result =  $this->Customer_Service_Model->Update($data_arr,$this->input->post('id'));

        if($result)
        {
               echo "true";
        }
    }


    public function OrderDetailEdit()
    {
      $json_array = json_decode($this->input->post('jsonObj'), true);


       foreach($json_array  as $key=>$val){
        $is_show =$val['is_show']  == 'true' ? 1 : 0;
         $Data_arr = array(
             'order_id'=>$val['order_id'],
             'service_id'=>$val['service_id'],
             'price'=>$val['price'],
             'is_show'=>$is_show,
             'modify_by' => $this->user_profile['e_id'],
             'modify_date' => date('Y-m-d H:i:s')
         );

         if( $val['order_detail_id']=='0' && $val['is_show']  == 'true'){
          $Permission =  $this->Customer_Service_Model->Insert_Order_Detail($Data_arr);
        }else    if( $val['order_detail_id']!='0'){ 
          $Permission =  $this->Customer_Service_Model->Update_Order_Detail($Data_arr,$val['order_detail_id']);
         }

      }
            echo "true";

    }

}
