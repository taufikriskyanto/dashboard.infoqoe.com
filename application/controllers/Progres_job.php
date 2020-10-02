<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progres_job extends CI_Controller {


	function __construct(){
        parent::__construct();
        

        if(!$this->session->userdata('id_user'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
       </div>");
        redirect('login');
        }


        
        
    }

    
function progres()
    {
        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/progres";



        $id_dept = trim($this->session->userdata('id_group'));
        $id_user = trim($this->session->userdata('id_user'));

        $this->load->view('template',$data);
    }

    
}
