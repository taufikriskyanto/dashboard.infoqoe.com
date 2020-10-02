<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procces_balancing extends CI_Controller {


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

    function index(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/procces_balancing";

        $get_balancing = $this->model_app->get_balancing();
        $data['get_balancing'] = $get_balancing;

        $data['link'] = "procces_balancing/cancel_printing";
        $data['finish_jobs']="procces_balancing/finish_jobs";
        $data['finish_polis_jobs']="procces_balancing/finish_polis_jobs";
        $this->load->view('template',$data);

    }
    function finish_jobs(){
        $splod = strtoupper(trim($this->input->post('splod')));
        $status = 'done';
        $currentDateTime = date('Y-m-d H:i:s');
        
        $this->db->set('finish_balancing', $currentDateTime);
        $this->db->set('balancing_status', $status);
        $this->db->set('at_last',$currentDateTime);
        $this->db->set('status',5);
        $array = array('splod' => $splod, 'status' => 4);
        $this->db->where($array);
        $this->db->update('xpr_product_routine');
        if($this->db->affected_rows() > 0)
        {
            $cycle_customer = "SELECT  cycle , customer FROM xpr_product_routine where splod = '$splod'";
            $row_cycle_customer = $this->db->query($cycle_customer)->row();

            $cycle = $row_cycle_customer->cycle;
            $customer = $row_cycle_customer->customer;
            $currentDatePolis = date('d/m/Y H:i:s');
            $this->db->set('remarks', 'FINISHING');
            $this->db->set('tgl_proses', $currentDatePolis);
            $this->db->where('cycle', $cycle);
            $this->db->where('customer', $customer);
            $this->db->update('xpr_report_polis');

            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('procces_balancing');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('procces_balancing');	
        }
      }

      function finish_polis_jobs(){
        $splod = strtoupper(trim($this->input->post('polis')));
        $status = 'done';
        $currentDateTime = date('Y-m-d H:i:s');
        
        $this->db->set('finish_balancing', $currentDateTime);
        $this->db->set('balancing_status', $status);
        $this->db->set('at_last',$currentDateTime);
        $this->db->set('status',5);
        $array = array('project' => $splod, 'status' => 4);
        $this->db->where($array);
        $this->db->update('xpr_product_routine');
        if($this->db->affected_rows() > 0)
        {
            $cycle_customer = "SELECT  cycle , customer FROM xpr_product_routine where splod = '$splod'";
            $row_cycle_customer = $this->db->query($cycle_customer)->row();

            $cycle = $row_cycle_customer->cycle;
            $customer = $row_cycle_customer->customer;
            $currentDatePolis = date('d/m/Y H:i:s');
            $this->db->set('remarks', 'FINISHING');
            $this->db->set('tgl_proses', $currentDatePolis);
            $this->db->where('cycle', $cycle);
            $this->db->where('customer', $customer);
            $this->db->update('xpr_report_polis');
            
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('procces_balancing');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('procces_balancing');	
        }    
    }
    function edit_procces($id_log_summary_dnr_detail){
    // $splod = strtoupper(trim($this->input->post('splod')));
    $status = 'done';
    $currentDateTime = date('Y-m-d H:i:s');
    
    $this->db->set('finish_balancing', $currentDateTime);
    $this->db->set('balancing_status', $status);
    $this->db->set('at_last',$currentDateTime);
    $this->db->set('status',5);
    $this->db->where('id_log_summary_dnr_detail', $id_log_summary_dnr_detail);
    $procces_balancing =  $this->db->update('xpr_product_routine');

    if ($procces_balancing === FALSE)
    {
        $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <i class='material-icons'>close</i>
        </button>
        <span>
        <b>Data gagal disimpan</b> !!</span>
        </div>");
        redirect('procces_balancing');	
    } else 
    {
        $this->session->set_flashdata("msg", "<div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <i class='material-icons'>close</i>
        </button>
        <span>
        <b>Data berhasil disimpan</b> !!</span>
        </div>");
        redirect('procces_balancing');	
    }    

    // if ($procces_balancing === FALSE)
    // {
    //     $this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
    //     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    //     <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
    //     </div>");
    //     redirect('procces_inserting');	
    // } else 
    // {
    //     $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
    //     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    //     <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
    //     </div>");
    //     redirect('procces_inserting');	
    // }
    }

}
?>