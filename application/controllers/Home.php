<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->_init();
	}

	private function _init()
	{

	}

	public function index()
	{
		$this->output->set_common_meta('VTCar Service' ,'ศูนย์เคลือบสี เคลือบแก้ว เชียงใหม่ ด้วยสุดยอดนวัตกรรมหนึ่งเดียวเพื่อการปกป้องสีรถอย่างสมบูรณ์แบบ','เคลือบแก้ว เชียงใหม่, Glass Coating เชียงใหม่, เคลือบสีรถยนต์เชียงใหม่, ขัดลบรอยขนแมว, ล้าง-ฟื้นฟูรถทุกรูปแบบในเชียงใหม่, ศูนย์ประดับยนต์ครบวงจร เชียงใหม่');
		$this->output->set_template('Frontend');
		$this->load->view('Content/Home_View');
	}
}