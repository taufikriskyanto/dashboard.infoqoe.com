<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procces_printing extends CI_Controller {


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
        $data['body'] = "body/procces_printing";

        $get_printing = $this->model_app->get_printing();
        $data['get_printing'] = $get_printing;

        $data['link'] = "procces_printing/cancel_printing";

        $data['finish_jobs']="procces_printing/finish_jobs";
        $data['reject_job']="procces_printing/reject_job";
        $this->load->view('template',$data);

    }
        function finish_jobs(){
          $splod = strtoupper(trim($this->input->post('splod')));
          $this->db->select('*');
          $this->db->from('xpr_product_routine');
          $this->db->where('splod', $splod );
          $this->db->where('status', 2);
          $checking_splod = $this->db->get();
          if($checking_splod -> num_rows() > 0){
            $status = 'done';
            $currentDateTime = date('Y-m-d H:i:s');
            $this->db->set('finish_printing', $currentDateTime);
            $this->db->set('printing_status', $status);
            $this->db->set('at_last',$currentDateTime);
            $this->db->set('status',3);
            $array = array('splod' => $splod, 'status' => 2);
            $this->db->where($array);
            $this->db->update('xpr_product_routine');
            if($this->db->affected_rows() > 0)
            {
              $cycle_customer = "SELECT  cycle , customer FROM xpr_product_routine where splod = '$splod'";
              $row_cycle_customer = $this->db->query($cycle_customer)->row();

              $cycle = $row_cycle_customer->cycle;
              $customer = $row_cycle_customer->customer;
            
              $currentDatePolis = date('d/m/Y H:i:s');
              $this->db->set('remarks', 'PRINTING');
              $this->db->set('tgl_proses', $currentDatePolis);
              $this->db->where('cycle', $cycle);
              $this->db->where('customer', $customer);
              $this->db->update('xpr_report_polis');
              $this->session->set_flashdata("msg", "<div class='alert alert-success'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <i class='material-icons'>close</i>
              </button>
              <span>
              <span><b> Success - </b> Update Status Printing </span>
              </div>");
              redirect('procces_printing');	
  
            } else 
            {
              $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <i class='material-icons'>close</i>
              </button>
              <span>
              <span><b> Failed - </b> Update Status Printing</span>
              </div>");
              redirect('procces_printing');	
            }

          }else{
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span><b> Failed - </b> Update Status Printing</span>
            </div>");
            redirect('procces_printing');	
          }

        }

    function reject_job(){
          $splod = strtoupper(trim($this->input->post('splod')));
          $reject_printing = trim($this->input->post('reject_printing'));
          $this->db->select('*');
          $this->db->from('xpr_product_routine');
          $this->db->where('splod', $splod );
          $this->db->where('status', 2);
          $checking_splod = $this->db->get();
          if($checking_splod-> num_rows() > 0){
            $status = 'Pending';
            $currentDateTime = date('Y-m-d H:i:s');
            $this->db->set('printing_reject', $reject_printing);
            $this->db->set('printing_status', $status);
            $this->db->set('date_reject_printing',$currentDateTime);
            $array = array('splod' => $splod, 'status' => 2);
            $this->db->where($array);
            $this->db->update('xpr_product_routine');
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span><b> Success - </b> Update Status Printing</span>
                </div>");
                redirect('procces_printing');	
            } else 
            {
                $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span><b> Failed - </b> Update Status Printing</span>
                </div>");
                redirect('procces_printing');		
            }
          }else{
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span><b> Failed - </b> Update Status Printing</span>
            </div>");
            redirect('procces_printing');	
          }

    
      }
    function edit_procces($id_log_summary_dnr_detail){
    // $splod = strtoupper(trim($this->input->post('splod')));
    $status = 'done';
    $currentDateTime = date('Y-m-d H:i:s');
    $this->db->set('finish_printing', $currentDateTime);
    $this->db->set('printing_status', $status);
    $this->db->set('at_last',$currentDateTime);
    $this->db->set('status',3);
    $this->db->where('id_log_summary_dnr_detail', $id_log_summary_dnr_detail);
    $procces_printing =  $this->db->update('xpr_product_routine');
    if ($procces_printing === FALSE)
    {
      $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <i class='material-icons'>close</i>
      </button>
      <span>
      <b> Failed - </b> Update Status Printing </span>
      </div>");
        redirect('procces_printing');	
    } else 
    {
      $this->session->set_flashdata("msg", "<div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <i class='material-icons'>close</i>
      </button>
      <span>
      <b> Success - </b> Update Status Printing </span>
      </div>");
        redirect('procces_printing');	
    }
}

    function cancel_printing($id){
        $this->db->where('id_log_summary_dnr_detail', $id);
        $success = $this->db->delete('xpr_product_routine');
        if ($success === FALSE){
          $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <i class='material-icons'>close</i>
          </button>
          <span>
          <b> Failed - </b> Printing </span>
          </div>");
              redirect('procces_printing');
        }else{
          $this->session->set_flashdata("msg", "<div class='alert alert-success'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <i class='material-icons'>close</i>
          </button>
          <span>
          <b> Success - </b> Printing </span>
          </div>");
              redirect('procces_printing');
        }
    }

}
?>