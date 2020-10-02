<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller {


    function __construct(){
        parent::__construct();
        $this->load->model('model_app');

        if(!$this->session->userdata('id_user'))
    {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
    </div>");
        redirect('login');
        }


        
        
    }

	// public function index() 
	// {
    //     $data['header'] = "header";
    //     $data['footer'] = "footer/footer";
    //     $data['body'] = "body/calender";
	// 	$data_calendar = $this->model_app->get_list_printing();
	// 	$calendar = array();
	// 	foreach ($data_calendar as $key => $val) 
	// 	{
	// 		$calendar[] = array(
	// 			'title' => $val->total_pages,
	// 			'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i:s"),
	// 			'end' 	=> date_format( date_create($val->end_date) ,"Y-m-d H:i:s"),
	// 			'color' => '#0071c5',
	// 		);
	// 	}
	// 	$data = array();
	// 	$data['get_data']=json_encode($calendar);
	// 	$this->load->view('template',$data);
    // }
    // function index()
    // {
	// 	$data = array();
	// 	$data['header'] = "header/header";
    //     $data['footer'] = "footer/footer";
    //     $data['body'] = "body/view_calender";

	// 	$data_calendar = $this->model_app->get_list_printing();
	// 	$calendar = array();
	// 	foreach ($data_calendar as $key => $val) 
	// 	{
	// 		$calendar[] = array(
	// 			'title' => 'Total Pages :'.$val->total_pages,
	// 			'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i:s"),
	// 			'end' 	=> date_format( date_create($val->end_date) ,"Y-m-d H:i:s"),
	// 			'color' => '#0071c5',
	// 		);
	// 	}

	// 	$data['get_data']=json_encode($calendar);
    //     $this->load->view('template',$data);
	// }
	function index(){
        $data=$this->m_barang->barang_list();
        echo json_encode($data);
	}
}