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
        $this->load->js('Assets/js/Customer_Service.js');
        $this->load->view('Content/Customer_Service_View');
    }

    public function Get_All()
    {
        $this->output->unset_template();

        $result =  $this->Customer_Service_Model->Get_All();

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
        $data_arr = array(
        		'service_name'=>$this->input->post('name'),
				'price'=>$this->input->post('price'),
            	'modified_by' =>  $this->user_profile['name'],
            	'modified_date' => date('Y-m-d H:i:s')
        );
        if($this->input->post('id') =="0"){
			$result =  $this->Customer_Service_Model->Insert($data_arr);
		}else{
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
            'modified_by' => $this->user_profile['name'],
            'modified_date' => date('Y-m-d H:i:s')
        );
        $result =  $this->Customer_Service_Model->Update($data_arr,$this->input->post('id'));

        if($result)
        {
               echo "true";
        }
    }

	/*

    public function OrdersImportFromExcel($filename){
    	$this->output->unset_template();
    	$inputFileName =  FCPATH.'Assets/Upload/'.$filename.'.xlsx';
    	$this->excel = PHPExcel_IOFactory::load($inputFileName);

    	//activate worksheet number 1
    	$this->excel->setActiveSheetIndex(0);

    	$this->excel->getActiveSheet()->setShowGridlines(true);
    	$this->excel->getActiveSheet()->setPrintGridlines(true);


    	//  Read your Excel workbook
    	try {
    		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
    		$objPHPExcel = $objReader->load($inputFileName);
    	} catch(Exception $e) {
    		die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    	}
    	//  Get worksheet dimensions
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$data_arr = array();
    	for ($row = 1; $row <= $highestRow; $row++){
    		$arr = array(

					'id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
					'book_no'=> $this->excel->getActiveSheet()->getCell('B'.$row),
					'number'=> $this->excel->getActiveSheet()->getCell('C'.$row),
					'cus_tel'=>$this->excel->getActiveSheet()->getCell('D'.$row),
					'cus_type'=>$this->excel->getActiveSheet()->getCell('E'.$row),
					'cus_name'=>$this->excel->getActiveSheet()->getCell('F'.$row),
					'cus_car_regis_number'=>$this->excel->getActiveSheet()->getCell('G'.$row),
					'cus_car_brand'=>$this->excel->getActiveSheet()->getCell('H'.$row),
					'cus_car_model'=>$this->excel->getActiveSheet()->getCell('I'.$row),
					'cus_car_color'=>$this->excel->getActiveSheet()->getCell('J'.$row),
					'customers_id'=>$this->excel->getActiveSheet()->getCell('K'.$row),
					'emp_name'=>$this->excel->getActiveSheet()->getCell('L'.$row),
					'comment'=>$this->excel->getActiveSheet()->getCell('M'.$row),
					'total'=>$this->excel->getActiveSheet()->getCell('N'.$row),
					'created_date'=>$this->excel->getActiveSheet()->getCell('O'.$row),
					'modified_date'=>$this->excel->getActiveSheet()->getCell('P'.$row),
					'modified_by'=>$this->excel->getActiveSheet()->getCell('Q'.$row),
					'order_status'=>$this->excel->getActiveSheet()->getCell('R'.$row),
					'emp_id'=>$this->excel->getActiveSheet()->getCell('S'.$row),
					'promotion_id'=>$this->excel->getActiveSheet()->getCell('T'.$row)
    		);
    		array_push($data_arr, $arr);
    	}
    	$result =  $this->Customer_Service_Model->Insert_Batch($data_arr);
    	if($result)
    	{
    		echo  "Success<br>";
    	}
    }


    public function OrderDetailsImportFromExcel($filename){
    	$this->output->unset_template();
    	$inputFileName =  FCPATH.'Assets/Upload/'.$filename.'.xlsx';
    	$this->excel = PHPExcel_IOFactory::load($inputFileName);

    	//activate worksheet number 1
    	$this->excel->setActiveSheetIndex(0);

    	$this->excel->getActiveSheet()->setShowGridlines(true);
    	$this->excel->getActiveSheet()->setPrintGridlines(true);


    	//  Read your Excel workbook
    	try {
    		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
    		$objPHPExcel = $objReader->load($inputFileName);
    	} catch(Exception $e) {
    		die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    	}
    	//  Get worksheet dimensions
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$data_arr = array();
    	for ($row = 1; $row <= $highestRow; $row++){


		if($this->excel->getActiveSheet()->getCell('C'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('C'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('D'.$row)
			);
			array_push($data_arr, $arr);
		}
		if($this->excel->getActiveSheet()->getCell('E'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('E'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('F'.$row)
			);
			array_push($data_arr, $arr);
		}
		if($this->excel->getActiveSheet()->getCell('G'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('G'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('H'.$row)
			);
			array_push($data_arr, $arr);
		}
		if($this->excel->getActiveSheet()->getCell('I'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('I'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('J'.$row)
			);
			array_push($data_arr, $arr);
		}
		if($this->excel->getActiveSheet()->getCell('K'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('K'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('L'.$row)
			);
			array_push($data_arr, $arr);
		}
		if($this->excel->getActiveSheet()->getCell('M'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('M'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('N'.$row)
			);
			array_push($data_arr, $arr);
		}
 		if($this->excel->getActiveSheet()->getCell('O'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('O'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('P'.$row)
			);
			array_push($data_arr, $arr);
		}
		if($this->excel->getActiveSheet()->getCell('Q'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('Q'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('R'.$row)
			);
			array_push($data_arr, $arr);
		}
		if($this->excel->getActiveSheet()->getCell('S'.$row)!= ''	){
			$arr = array(
				'order_id'=>$this->excel->getActiveSheet()->getCell('A'.$row),
				'service_id'=> $this->excel->getActiveSheet()->getCell('S'.$row),
				'price'=>$this->excel->getActiveSheet()->getCell('T'.$row)
			);
			array_push($data_arr, $arr);
		}


    	}
    	$result =  $this->Customer_Service_Model->Insert_Details_Batch($data_arr);
    	if($result)
    	{
    		echo  "Success<br>";
    	}
    }

*/
}
