<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_log_dnr extends CI_Controller {


    function __construct(){
        parent::__construct();
        $this->load->model('model_app');
        $this->load->helper(array('form', 'url'));

            if(!$this->session->userdata('id_user'))
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
                </div>");
                    redirect('login');
            }


                    
                    
    }

    function index(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/upload_file_dnr";

        $data['flag']="UPLOAD SPLOD";
        $get_log_dnr = $this->model_app->get_log_dnr();
        $data['view_get_dnr'] = $get_log_dnr;

        $data['url'] = "upload_log_dnr/upload_file";
        
        $id_log_summary_dnr_detail = '';
        $data['id_log_summary_dnr_detail'] = $id_log_summary_dnr_detail;
        
        $approval_jobs_many = $this->model_app->approval_jobs_many();
        $data['approval_jobs_many'] = $approval_jobs_many;

        $data['finish_jobs'] = "upload_log_dnr/finish_jobs";
        $data['send_splod_printing'] = "upload_log_dnr/send_splod_printing";
        $data['send_splod'] = "upload_log_dnr/send_splod";

        $this->load->view('template',$data);

    }

    function reupload_splod(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/upload_file_dnr";

        $data['flag']="REUPLOAD SPLOD";

        $data['update_splod'] = "upload_log_dnr/update_splod";

        $get_log_dnr = $this->model_app->reupload_splod();
        $data['view_get_dnr'] = $get_log_dnr;

        $this->load->view('template',$data);

    }

    function update_splod(){
    $oldsplod = trim($this->input->post('oldsplod'));
    $newsplod = trim($this->input->post('newsplod'));

    $checking_splod = $this->db->query("select * from xpr_product_routine WHERE splod = '$oldsplod'");
    if($checking_splod->num_rows() == 1)
	{
        $this->db->set('splod', $newsplod);
        $this->db->update('xpr_product_routine');

    }else{
        $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <i class='material-icons'>close</i>
        </button>
        <span>
        <b> Failed - </b> Entry Splod </span>
        </div>");
        redirect('upload_log_dnr/reupload_splod');	
    }
     

    }

    function finish_jobs(){
            $splod = strtoupper(trim($this->input->post('splod')));
            $id_log_summary_dnr_detail = strtoupper(trim($this->input->post('id_log_summary_dnr_detail')));
            $time = trim($this->input->post('time'));
            $split = explode("-",$id_log_summary_dnr_detail);
            $customer = $split[0];
            $produk = $split[1];
            $cycle = $split[2];
            $currentDateTime = date('Y-m-d H:i:s');
            $this->db->set('splod', $splod);
            $this->db->set('date_approval_splod', $currentDateTime);
             $this->db->set('sla',$time);
            $this->db->set('status',1);
            $this->db->set('at_last',$currentDateTime);
            $this->db->where('customer', $customer);
            $this->db->where('produk', $produk);
            $this->db->where('cycle', $cycle);
            $this->db->update('xpr_product_routine');
            if($this->db->affected_rows() > 0)
            {           
                $currentDatePolis = date('d/m/Y H:i:s');
               // $this->db->set('remarks', 'PROCESS');
                $this->db->set('tgl_proses', $currentDatePolis);
                $this->db->where('cycle', $cycle);
                $this->db->where('customer', $customer);
                $this->db->update('xpr_report_polis');

                $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b> Success - </b> Entry Splod </span>
                </div>");
                redirect('upload_log_dnr');	
            } else 
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b> Failed - </b> Entry Splod </span>
                </div>");
                redirect('upload_log_dnr');	
            }     
    }

    function form_tambah_splod($id_log_summary_dnr_detail){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/form_add_splod";

        $data['url'] = "upload_log_dnr/add_tambah_splod";

        $sql_dnr = "SELECT * FROM xpr_product_routine 
        WHERE id_log_summary_dnr_detail ='$id_log_summary_dnr_detail'";
        $row_dnr = $this->db->query($sql_dnr)->row();

        if(empty($row_dnr->splod)){
            $data['splod'] = "";
            $data['type'] = "NEW";
        }else {
            $data['splod'] = $row_dnr->splod;
            $data['type'] = "RENEW";
        }
        $data['id_log_summary_dnr_detail'] = $id_log_summary_dnr_detail;

        $data['produk'] = $row_dnr->produk;
        $data['customer'] = $row_dnr->customer;
        $data['cycle'] = $row_dnr->cycle;
        $data['total_pages'] = $row_dnr->total_pages;
        $data['total_envelop'] = $row_dnr->total_envelop;

        $this->load->view('template',$data);
    }

    function send_splod_printing(){
        $splod = strtoupper(trim($this->input->post('splod')));
        $this->db->select('*');
        $this->db->from('xpr_product_routine');
        $this->db->where('splod', $splod );
        $this->db->where('status', 1);
        $checking_splod = $this->db->get();
        if($checking_splod -> num_rows() > 0){
            $currentDateTime = date('Y-m-d H:i:s');
            $this->db->set('status',2);
            $this->db->set('date_come_printing',$currentDateTime);
            $this->db->where('splod', $splod);
            $this->db->update('xpr_product_routine');
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b> Success - </b> Entry Splod </span>
                </div>");
                redirect('upload_log_dnr');	
            } else 
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b> Failed - </b> Entry Splod </span>
                </div>");
                redirect('upload_log_dnr');	
            }
        }else{
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span><b> Failed - </b> Send Splod To Printing </span>
            </div>");
            redirect('upload_log_dnr');	   
        }   
    }

    function send_splod($id_log_summary_dnr_detail){
        $this->db->select('*');
        $this->db->from('xpr_product_routine');
        $this->db->where('id_log_summary_dnr_detail', $id_log_summary_dnr_detail );
        $this->db->where('splod <>', "");
        $checking_splod = $this->db->get(); 
        if ($checking_splod->num_rows() > 0)
        {
            $currentDateTime = date('Y-m-d H:i:s');
            $this->db->set('status',2);
            $this->db->set('date_come_printing',$currentDateTime);
            $this->db->where('id_log_summary_dnr_detail', $id_log_summary_dnr_detail);
            $this->db->update('xpr_product_routine');
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b> Success - </b> Send Splod To Printing</span>
                </div>");
                redirect('upload_log_dnr');	
            } else 
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b> Failed - </b> Entry Splod </span>
                </div>");
                redirect('upload_log_dnr');	
            }     
        }else{
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b> Failed - </b> Send Splod To Printing </span>
            </div>");
            redirect('upload_log_dnr');	 
        }

    }

    function add_tambah_splod(){
        $splod = strtoupper(trim($this->input->post('splod')));
        $id_log_summary_dnr_detail = strtoupper(trim($this->input->post('id_log_summary_dnr_detail')));
        $status = trim($this->input->post('status'));
        $time = trim($this->input->post('time'));
        $currentDateTime = date('Y-m-d H:i:s');

        if($status === 'NEW'){
            $this->db->set('splod', $splod);
            $this->db->set('date_approval_splod', $currentDateTime);
            $this->db->set('sla',$time);
            $this->db->set('status',1);
            $this->db->set('at_last',$currentDateTime);
        }else{
            $this->db->set('splod', $splod);
        }

        $this->db->where('id_log_summary_dnr_detail', $id_log_summary_dnr_detail);
        $get_type_customer =  $this->db->update('xpr_product_routine');
        if ($get_type_customer === FALSE)
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b> Failed - </b> Entry Splod </span>
            </div>");
            if($status === 'NEW'){
                redirect('upload_log_dnr');	
            }else{
                redirect('upload_log_dnr/reupload_splod');	
            }
            
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b> Success - </b> Entry Splod </span>
            </div>");
            if($status === 'NEW'){
                redirect('upload_log_dnr');	
            }else{
                redirect('upload_log_dnr/reupload_splod');	
            }	
        }

    }
    function delete_splod($id){
        $this->db->where('id_log_summary_dnr_detail', $id);
        $success = $this->db->delete('xpr_product_routine');
        if ($success === FALSE){
            $this->session->set_flashdata("msg","Swal.fire({
                title: '<i>Message</i>', 
                html: 'Success',  
                confirmButtonText: 'OK', 
              });");
              redirect('upload_log_dnr');
        }else{
            $this->session->set_flashdata("msg","Swal.fire({
                title: '<i>Message</i>', 
                html: 'Failed',  
                confirmButtonText: 'OK', 
              });");
              redirect('upload_log_dnr');
        }
        
    }
}//kurung untuk class

      
?>