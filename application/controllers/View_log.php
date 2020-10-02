<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_log extends CI_Controller {


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

    function list_log(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/vlog_nuvera";

        $id_dept = trim($this->session->userdata('id_group'));
        $id_user = trim($this->session->userdata('id_user'));

        $machines = $this->model_app->get_list_machine();

		$opt = array('' => 'All Machine');
		foreach ($machines as $country) {
			$opt[$country] = $country;
		}

		$data['machine_name'] = form_dropdown('',$opt,'','id="machine_name" class="form-control"');
        $view_log_nuvera = $this->model_app->view_log_nuvera();
	    $data['view_log_nuvera'] = $view_log_nuvera;

        $this->load->view('template',$data);
    }

}
    ?>