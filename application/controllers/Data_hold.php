<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_hold extends CI_Controller {


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

    function index($flag){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/data_hold_customer";
        $data['search'] = "data_hold/search";

        // if()
        $this->load->view('template',$data);
    }

    function search (){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/data_hold_customer";
        $data['search'] = "data_hold_customer/search";
        
        $data['customer'] = $this->model_app->dropdown_customer();

        $data['customer_code'] = trim($this->session->userdata('customer_code'));
        $data['cycle'] = $this->input->post('info_file');
        
        $get_file = $this->model_app->search_data_hold($data);
        $data['get_file'] = $get_file;
        
        $this->load->view('template',$data);
    }

}
?>