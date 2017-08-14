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
        $this->load->js('Assets/js/cont/CustomerServices.js');
        $this->load->view('Content/Customer_Service_Unpay_View');
    }

    public function Payed()
   {
       $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
       $this->output->set_template('Backend');
       $this->load->js('Assets/js/Customer_Service_Payed.js');
       $this->load->view('Content/Customer_Service_View');
   }

   public function Add()
  {
      $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
      $this->output->set_template('Backend');
      $this->load->js('Assets/js/cont/CustomerService.js');
      $this->load->view('Content/Customer_Service_Add');
  }


  public function PrintReceived()
  {
    $this->output->set_common_meta('VTCar Service' ,'www.VTCarService.net','www.VTCarService.net');
    $this->output->set_template('Blank');
    $this->load->js('Assets/js/cont/PrintService.js');
    $this->load->view('Content/Print_Service_View');
  }


   public function Get_All_Payed()
   {
       $this->output->unset_template();

       $result =  $this->Customer_Service_Model->Get_All('payed');

       if($result)
       {
          echo json_encode ($result) ;
       }
   }

    public function Get_All_Unpay()
    {
        $this->output->unset_template();

        $result =  $this->Customer_Service_Model->Get_All('pending');

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
              'emp_id'=>$this->user_profile['emp_id']
          );
    			$result =  $this->Customer_Service_Model->Insert($data_arr);
    		}else{
          $data_arr = array(
              'book_no'=>$this->input->post('book_no'),
              'number'=>$this->input->post('number'),
              'comment'=>$this->input->post('comment'),
              'total'=>$this->input->post('total'),
              'pay_status'=>$this->input->post('pay_status')
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
    public function AddService()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));

          $data_arr = array(
            'car_id'=>$data->car_id,
            'total'=>$data->total_price,
            'comment'=>$data->comment
          );
          $receipt_id =  $this->Customer_Service_Model->Insert($data_arr);

        if($receipt_id)
        {
          $json_array = json_decode($data->services, true);
           foreach($json_array  as $key=>$val){
            $is_show =$val['is_show']  == 'true' ? 1 : 0;
             $Data_arr = array(
                 'receipt_id'=>$receipt_id,
                 'service_id'=>$val['service_id'],
                 'price'=>$val['price'],
                 'is_deleted'=>'0'
             );
              $result =  $this->Customer_Service_Model->Insert_Receipt_Detail($Data_arr);
              if($result)
              {
                 echo json_encode (true) ;
              }else{
                 echo json_encode (false) ;
              }
            }
        }

    }

    public function Delete()
    {
        $this->output->unset_template();
        $data=json_decode(file_get_contents("php://input"));

        $data_arr = array(
            'is_deleted'=>1
        );
        $result =  $this->Customer_Service_Model->Delete_Order($data_arr,$data->id);  
        if($result)
        {
             echo "true";
        }
    }

    public function OrderDetailEdit()
    {
      $this->output->unset_template();
      $json_array = json_decode($this->input->post('jsonObj'), true);

       foreach($json_array  as $key=>$val){
          $isshow = 0;
        if ($val['is_show'] == "true" ){$isshow =1;}
         $Data_arr = array(
             'receipt_detail_id'=>$val['order_id'],
             'service_id'=>$val['service_id'],
             'price'=>$val['price'],
             'is_deleted'=>$isshow
         );

         if( $val['receipt_detail_id']=='0' && $val['is_show'] == "true"  ){
            $this->Customer_Service_Model->Insert_Order_Detail($Data_arr);
          }else    if( $val['receipt_detail_id']!='0'  ){
            $this->Customer_Service_Model->Update_Order_Detail($Data_arr,$val['order_detail_id']);
        }
      }
          echo "true";
    }
}
