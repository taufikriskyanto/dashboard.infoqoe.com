<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procces_rtp extends CI_Controller {


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
        $data['body'] = "body/procces_rtp";

        $get_rtp = $this->model_app->get_rtp();
        $data['get_rtp'] = $get_rtp;

        $data['link'] = "procces_printing/cancel_printing";
        $data['finish_jobs']="procces_rtp/finish_jobs";
        $data['finish_polis_jobs']="procces_rtp/finish_polis_jobs";
        $data['customer'] = $this->model_app->dropdown_customer();
        $this->load->view('template',$data);

    }
    function finish_jobs(){
        $splod = strtoupper(trim($this->input->post('splod')));
        $status = 'done';
        $currentDateTime = date('Y-m-d H:i:s');
        
        $this->db->set('finish_rtp', $currentDateTime);
        $this->db->set('rtp_status', $status);
        $this->db->set('status',6);
        $this->db->set('at_last',$currentDateTime);
        $array = array('splod' => $splod, 'status' => 5);
        $this->db->where($array);
        $this->db->update('xpr_product_routine');
        if($this->db->affected_rows() > 0)
        {
            $cycle_customer = $this->model_app->change_status_polis($splod);
            $remarks = '';
            $manifest = '';
            $produks   = '';
            $cycle    = '';
            $customer = '';
            $currentDatePolis = date('d/m/Y H:i:s');
            foreach($cycle_customer as $data){
            $manifest = $data->manifest;
            $produks = $data->produk;
            $customer = $data->customer;
            $cycle = $data->cycle;
            $polis  = $data->project;
            $manifest =  substr($manifest,0,1);
                // if($data->produk === 'BUKU POLIS'){
                   

                    if (substr($data->manifest,0,1) ==='R'){
                        $remarks = 'DELIVERY';
                        // $this->db->set('remarks', 'DELIVERY');
                    }elseif (substr($data->manifest,0,1) ==='C'){
                        $remarks = 'DELIVERY PRU';
                        // $this->db->set('remarks', 'DELIVERY PRU');
                    }
                    $this->db->set('remarks', $remarks);
                    $this->db->set('tgl_proses', $currentDatePolis);
                    $this->db->where('cycle', $cycle);
                    $this->db->where('customer', $customer);
                    $this->db->where('no_polis', $polis);
                    $this->db->update('xpr_report_polis');
                // }
            }


            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('procces_rtp');	
            	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('procces_rtp');	
        }
      }

      

      function finish_polis_jobs(){
        $hold = strtoupper(trim($this->input->post('hold')));
        $polis = strtoupper(trim($this->input->post('polis')));
        $cycle = '';
        if(strlen($polis)>8){
            $polis = substr($polis,-14);
            $cycle = substr($polis,0,6);
            $polis = substr($polis,6,8);
        }
        $cycle = '20'.$cycle;
        $status = 'done';
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->set('finish_rtp', $currentDateTime);
        $this->db->set('at_last',$currentDateTime);
        // $array = array('cycle' => $cycle, 'status' => 6, 'project' => $polis);
        $array = array('status' => 6, 'project' => $polis);
        $this->db->where($array);
        $this->db->update('xpr_product_routine');
        if($this->db->affected_rows() > 0)
        {
            $cycle_customer = "SELECT  cycle , customer FROM xpr_product_routine where cycle = '$cycle' and project = '$polis'";
            $row_cycle_customer = $this->db->query($cycle_customer)->row();

            $cycle = $row_cycle_customer->cycle;
            $customer = $row_cycle_customer->customer;
            $manifest = '';
            
            
            if($hold === 'REGULER'){
                $this->db->set('remarks', 'DELIVERY');
                $manifest = 'R'.$polis;
            }else {
                $this->db->set('remarks', 'DELIVERY PRU');
                $manifest = 'C'.$polis;
            }
            $currentDatePolis = date('d/m/Y H:i:s');
            $this->db->set('tgl_proses',$currentDatePolis);
            $this->db->set('status', $hold);
            $this->db->set('manifest',$manifest);
            $this->db->where('cycle', $cycle);
            $this->db->where('customer', $customer);
            $this->db->where('no_polis', $polis);
            $this->db->update('xpr_report_polis');
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' src='<?php echo base_url();?>assets/img/icons/baseline_close_black_18dp.png'>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('procces_rtp');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <img src='<?php echo base_url();?>assets/img/icons/baseline_close_black_18dp.png'>
            </button>
            <span>
            <b>Data gagal disimpan</b> $cycle $polis $hold !!</span>
            </div>");
            redirect('procces_rtp');	
        }    
    }

    function edit_procces($id_log_summary_dnr_detail){
    // $splod = strtoupper(trim($this->input->post('splod')));
    $status = 'done';
    $currentDateTime = date('Y-m-d H:i:s');
    
    $this->db->set('finish_rtp', $currentDateTime);
    $this->db->set('rtp_status', $status);
    $this->db->set('status',6);
    $this->db->set('at_last',$currentDateTime);
    $this->db->where('id_log_summary_dnr_detail', $id_log_summary_dnr_detail);
    $procces_rtp =  $this->db->update('xpr_product_routine');
    if ($procces_rtp === FALSE)
    {
        $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <img src='<?php echo base_url();?>assets/img/icons/baseline_close_black_18dp.png'>
        </button>
        <span>
        <b>Data gagal disimpan</b> !!</span>
        </div>");
        redirect('procces_rtp');	
    } else 
    {
        $this->session->set_flashdata("msg", "<div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <img src='<?php echo base_url();?>assets/img/icons/baseline_close_black_18dp.png'>
        </button>
        <span>
        <b>Data berhasil disimpan</b> !!</span>
        </div>");
        redirect('procces_rtp');	
    }
    }

}
?>