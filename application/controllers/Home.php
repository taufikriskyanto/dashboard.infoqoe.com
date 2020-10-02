<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


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
        }else if (!$this->session->userdata('authenticated')){
        redirect('home');
        }


        
        
    }

    
function index()
    {
        
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/dashboard";

//         $id_dept = trim($this->session->userdata('id_group'));
//         $id_user = trim($this->session->userdata('id_user'));

//         //notification
//         //Untuk mendapatkan tanggal yang dari tanggal 01 sampai tanggal terakhir berjalan.
//         $firstdate = date('Y-m-01');
//         $lastdate = date('Y-m-d');
        
//         $customer_code = trim($this->session->userdata('customer_code'));
//         $qcustomer_code = '';
//         if (empty($customer_code)){
// 			$qcustomer_code = "customer <> ''";
// 		}else{
// 			$qcustomer_code = "customer like '%$customer_code%'";
// 		}

//         //Menampilkan data dengan jumlah pages dari tanggal 01 sampai tanggal berjalan dan status sudah selesai proses.
//         $total_pages_compelete = "SELECT  SUM(total_pages) AS tpc FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and status = 6 and $qcustomer_code";
//         $row_total_pages_compelete = $this->db->query($total_pages_compelete)->row();
//         $data['total_pages_compelete'] = $this->format_angka($row_total_pages_compelete->tpc,0);
        
//         $total_pages = "SELECT  SUM(total_pages) AS total_pages FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and $qcustomer_code";
//         $row_total_pages = $this->db->query($total_pages)->row();
//         $data['total_pages'] = $this->format_angka($row_total_pages->total_pages,0);
        
//         $data['percent_pages'] = ($row_total_pages_compelete->tpc / $row_total_pages->total_pages) *100 ;

//         $total_envelops_compelete = "SELECT  SUM(total_envelop) AS tec FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and status = 6 and $qcustomer_code";
//         $row_total_envelops_compelete = $this->db->query($total_envelops_compelete)->row();
//         $data['total_envelops_compelete'] = $this->format_angka($row_total_envelops_compelete->tec,0);
        
//         $total_envelops = "SELECT  SUM(total_envelop) AS total_envelops FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and $qcustomer_code";
//         $row_total_envelops = $this->db->query($total_envelops)->row();
//         $data['total_envelops'] = $this->format_angka($row_total_envelops->total_envelops,0);
        
//         $data['percent_evenlops'] = ($row_total_envelops_compelete->tec / $row_total_envelops->total_envelops) *100 ;
        
//         $total_product_compelete = "SELECT  * FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and status = 6 and $qcustomer_code GROUP BY produk , cycle";
//         $row_total_product_compelete = $this->db->query($total_product_compelete)->num_rows();
//         $data['total_produk_compelete'] = $this->format_angka($row_total_product_compelete,0);
        
//         $total_product = "SELECT  * FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and $qcustomer_code GROUP BY produk , cycle ";
//         $row_total_product = $this->db->query($total_product)->num_rows();
//         $data['total_produk'] = $this->format_angka($row_total_product,0);
        
//         $data['percent_produk'] = ($row_total_product_compelete / $row_total_product) *100 ;
        
        // $submitted_printed = "SELECT  SUM(total_impressions_printed) AS submitted_printed FROM log_printing_detail";
        // $row_submitted_printed = $this->db->query($submitted_printed)->row();

        // $ttlsubmitted = $row_submitted_printed->submitted_printed;

        // $totalcancel = "SELECT  SUM(total_impressions_printed) AS totalcancel FROM xpr_log_printing_detail lpd  JOIN xpr_log_printing_summary lps 
        // ON lpd.log_printing_summary_id = lps.log_printing_summary_id  JOIN xpr_m_machine ON xpr_m_machine.m_machine_id = lps.m_machine_id
        // where job_status = 'Cancelled by operator'";
        // $row_totalcancel = $this->db->query($totalcancel)->row();

        // $data['totalcancel'] = $row_totalcancel->totalcancel;

        // $totalinvalid = "SELECT  SUM(total_impressions_printed) AS totalinvalid FROM xpr_log_printing_detail lpd  JOIN xpr_log_printing_summary lps 
        // ON lpd.log_printing_summary_id = lps.log_printing_summary_id  JOIN xpr_m_machine ON xpr_m_machine.m_machine_id = lps.m_machine_id
        // where job_status = '<invalid data>'";
        // $row_totalinvalid = $this->db->query($totalinvalid)->row();

        // $data['totalinvalid'] = $row_totalinvalid->totalinvalid;

        // $data['grafik'] = ($data['totalprinted']/$data['total_submitted']) * 100;

        $this->load->view('template',$data);
       
        
    }
    
    function format_angka($angka,$decimal){
	
	$generate_number = number_format($angka,$decimal,',','.');
	return $generate_number;
 
    }

    function edit_profile(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/edit_profile"; 
        $data['save_profile']="home/save_profile";
        
        $this->load->view('template',$data);
    }


    function save_profile(){
        $this->form_validation->set_rules('old_password','Old Password','trim|required|min_length[8]');
        $this->form_validation->set_rules('new_password','New Password','trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if($this->form_validation->run() === FALSE){
            $error = validation_errors();
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Please Check Again !!! </b> $error </span>
            </div>");
            redirect('home/edit_profile');
        }else{
            $username = $this->session->userdata('id_user');
            $old_password = md5(trim($this->input->post('old_password')));
  	        $new_password = md5(trim($this->input->post('new_password')));
            $check_account = $this->db->query("SELECT * FROM xpr_user WHERE user_name = '$username' and password = '$old_password'");
            if($check_account->num_rows() == 1)
            {
                $this->db->set('password', $new_password);
                $array = array('user_name' => $username);
                $this->db->where($array);
                $this->db->update('xpr_user');
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b>Success Update Password</b></span>
                    </div>");
                    redirect('home/edit_profile');		
                }
            }else{
                $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b>Failed Update Password</b> Wrong Old Password $check_account !!</span>
                <span>Please Check Again </span>
                </div>");
                redirect('home/edit_profile');

        }

    }


    
}
}