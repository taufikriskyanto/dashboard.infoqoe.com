<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facillity extends CI_Controller {


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
        // $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/commercial_package";

        $get_sales_order_demo = $this->model_app->get_sales_order_demo();
        $data['get_sales_order_demo'] = $get_sales_order_demo;
        $data['flag']="index";
        $data['link'] = "facillity/deleted_SOD";
        $this->load->view('template',$data);

    }

    function failed_so(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        // $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/commercial_package";

        $get_failed_printing_facillity = $this->model_app->get_failed_printing_facillity();
        $data['get_sales_order_demo'] = $get_failed_printing_facillity;
        
        $data['flag']="failed";
        $this->load->view('template',$data);

    }

    function add_sales_order_demo(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        // $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_add_sod";
        
        $data['url']="facillity/save_sales_order_demo";
        $data['id_surat_order']="";
        $data['number_so']="";
        $data['type_so'] = "";
        $data['job_type']="";
        $data['job_dept'] = "";
        $data['page'] = "";
        $data['set'] = "";
        $data['cost_center'] = "";
        $data['paper_size'] = "";
        $data['job_name'] = "";
        $data['sla'] = "";
        $data['customer'] = $this->model_app->dropdown_customer();
        $data['customer_id'] = "";
        $data['flag'] = "add";
        $this->load->view('template',$data);
    }

    function save_sales_order_demo(){
        $customer_id = 0;
        //SURAT ORDER SO
        $type_so = trim($this->input->post('type_so'));
        if ($type_so==='Customer') {
            $customer_id = trim($this->input->post('customer_id'));
        }

        //DATA PEMBERI ORDER
        $job_dept = trim($this->input->post('job_dept'));
        $number_so = trim($this->input->post('number_so'));
        
        $cost_center = trim($this->input->post('cost_center'));
        $name_pic = trim($this->input->post('name_pic'));
        $job_name = trim($this->input->post('job_name'));
        $size = trim($this->input->post('size'));
        if($size === 'Custom'){
         $size = trim($this->input->post('other_size'));   
        }
        $page = trim($this->input->post('page'));
        $set = trim($this->input->post('set'));
        $sla = trim($this->input->post('sla'));
        $currentDateTime = date('Y-m-d H:i:s');
        $job_type = trim($this->input->post('job_type'));
        $this->db->set('status',$job_type);
        $this->db->set('type_surat_order', $type_so);
        $this->db->set('number_so', $number_so);
        $this->db->set('sla', $sla);
        $this->db->set('job_dept', $job_dept);
        $this->db->set('cost_center', $cost_center);
        $this->db->set('paper_size',$size);
        $this->db->set('page',$page);
        $this->db->set('set_order',$set);
        
        $this->db->set('incoming_date',$currentDateTime);
        $this->db->set('customer',$customer_id);
        $this->db->set('pic_order', $this->session->userdata('user_id'));
        $this->db->set('at_last',$currentDateTime);
        $this->db->set('job_name', $job_name);
        $xpr_surat_order =  $this->db->insert('xpr_surat_order');
        if ($xpr_surat_order === FALSE)
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('facillity/add_sales_order_demo');	
        }  else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('facillity');	
        }
        $this->load->view('template',$data);
    }

    function edit_surat_order($id_surat_order){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/form_add_sod";

        $sql_surat_order = "SELECT * FROM xpr_surat_order where id_surat_order ='$id_surat_order'";
        $row_sql_surat_order = $this->db->query($sql_surat_order)->row();

        $data['url'] = "facillity/update_surat_order";
        $customer_type_id = '';
        $data['id_surat_order'] = $id_surat_order;
        $data['job_type'] = $row_sql_surat_order->status;
        $data['customer_id'] = $row_sql_surat_order->customer;
        $data['customer'] = $this->model_app->dropdown_customer();
        $data['number_so'] = $row_sql_surat_order->number_so;	
        $data['type_so'] = $row_sql_surat_order->type_surat_order;
        $data['job_dept'] = $row_sql_surat_order->job_dept;
        $data['cost_center'] = $row_sql_surat_order->cost_center;
        $data['name_pic'] = $row_sql_surat_order->pic_order;
        $data['job_name'] = $row_sql_surat_order->job_name;
        $data['paper_size'] = $row_sql_surat_order->paper_size;
        $data['page'] = $row_sql_surat_order->page;
        $data['set'] = $row_sql_surat_order->set_order;
        $data['sla'] = $row_sql_surat_order->sla;
        $data['incoming_date'] = $row_sql_surat_order->incoming_date;


        $data['flag'] = "edit";
        $this->load->view('template',$data);
    }

    function update_surat_order(){
        //SURAT ORDER SO
        $customer_id = 0;
        $id_surat_order = trim($this->input->post('id_surat_order'));
        $type_so = trim($this->input->post('type_so'));
        if ($type_so==='Customer') {
            $customer_id = trim($this->input->post('customer_id'));
        }
        //DATA PEMBERI ORDER
        $job_dept = trim($this->input->post('job_dept'));
        $number_so = trim($this->input->post('number_so'));
        $cost_center = trim($this->input->post('cost_center'));
        $name_pic = trim($this->input->post('name_pic'));
        $job_type = trim($this->input->post('job_type'));
        $job_name = trim($this->input->post('job_name'));
        $size = trim($this->input->post('size'));
        if($size === 'Custom'){
        $size = trim($this->input->post('other_size'));   
        }
        $page = trim($this->input->post('page'));
        $set = trim($this->input->post('set'));
        $sla = trim($this->input->post('sla'));
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->set('type_surat_order', $type_so);
        $this->db->set('number_so', $number_so);
        $this->db->set('customer',$customer_id);
        $this->db->set('sla', $sla);
        $this->db->set('job_dept', $job_dept);
        $this->db->set('status', $job_type);
        $this->db->set('cost_center', $cost_center);
        $this->db->set('paper_size',$size);
        $this->db->set('page',$page);
        $this->db->set('set_order',$set);
        $this->db->set('incoming_date',$currentDateTime);
        $this->db->set('pic_order', $this->session->userdata('user_id'));
        $this->db->set('at_last',$currentDateTime);
        $this->db->set('job_name', $job_name);

        // $this->db->set('stats', $status);
        $this->db->where('id_surat_order', $id_surat_order);
        $xpr_surat_order =  $this->db->update('xpr_surat_order');
        if ($xpr_surat_order === FALSE)
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('facillity/edit_surat_order');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-success' role='alert'> Data Berhasil ditambahkan <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>'");
            redirect('facillity');	
        }
        $this->load->view('template',$data);
    }

    function delete_surat_order($id_surat_order){
    
        $this->db->where('id_surat_order', $id_surat_order);
        $xpr_so_routine = $this->db->delete('xpr_surat_order');
        if($xpr_so_routine === FALSE){
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal dihapus</b> !!</span>
            </div>");
            redirect('facillity');	
        }else{
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil dihapus</b> !!</span>
            </div>");
            redirect('facillity');	
            }
    }

    function printing_facillity(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/printing_facillity";

        $get_printing_facillity = $this->model_app->get_printing_facillity();
        $data['get_printing_facillity'] = $get_printing_facillity;

        $data['link'] = "facillity/cancel_printing";

        $this->load->view('template',$data);

    }

    function edit_printing($id_surat_order){
        $status = 'done';
        $currentDateTime = date('Y-m-d H:i:s');
        
        $this->db->set('status_printing', $status);
        $this->db->set('printing_date', $currentDateTime);
        $this->db->set('status', 2);
        $this->db->set('at_last',$currentDateTime);
        $this->db->where('id_surat_order', $id_surat_order);
        $xpr_so_routine =  $this->db->update('xpr_surat_order');
        if ($xpr_so_routine === FALSE)
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('facillity/printing_facillity');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('facillity/printing_facillity');	
        }
    }

    function printing_reject($id_surat_order){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body']   = "body/form_reject_printing";

        $sql_surat_order = "SELECT * FROM xpr_surat_order so JOIN xpr_user us ON us.user_id = so.pic_order 
        WHERE so.id_surat_order ='$id_surat_order'";
        $row_sql_surat_order = $this->db->query($sql_surat_order)->row();


        //end notification

        $data['url'] = "facillity/update_reject_printing";

        $data['id_surat_order'] = $id_surat_order;		
        $data['number_so'] = $row_sql_surat_order->number_so;
        $data['sla'] = $row_sql_surat_order->sla;
        $data['job_dept'] = $row_sql_surat_order->job_dept;
        $data['cost_center'] = $row_sql_surat_order->cost_center;
        $data['incoming_date'] = $row_sql_surat_order->incoming_date;
        $data['name_pic'] = $row_sql_surat_order->name;
        $data['job_name'] = $row_sql_surat_order->job_name;

        $this->load->view('template',$data);

    }

    function confirm_reject($id_surat_order){
        $status = '';
        $currentDateTime = date('Y-m-d H:i:s');
        
        $this->db->set('printing_date', '');
        $this->db->set('status_finishing', $status);
        $this->db->set('status',1); 
        $this->db->set('at_last',$currentDateTime);
        $this->db->set('incoming_date', $currentDateTime);
        $this->db->where('id_surat_order', $id_surat_order);
        $xpr_so_routine =  $this->db->update('xpr_surat_order');
        if ($xpr_so_routine === FALSE)
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('facillity/failed_so');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('facillity/failed_so');	
        }    
    }

    function update_reject_printing(){
        $status = "waiting";
        $id_surat_order = strtoupper(trim($this->input->post('id_surat_order')));
        $alasan = strtoupper(trim($this->input->post('alasan')));
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->set('status_printing',$status);
        // $this->db->set('printing_date',$currentDateTime);
        $this->db->set('status',10);
        $this->db->set('reason_reject', $alasan);
        $this->db->set('at_last',$currentDateTime);
        $this->db->where('id_surat_order', $id_surat_order);
        $xpr_so_routine =  $this->db->update('xpr_surat_order');
        if ($xpr_so_routine === FALSE)
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('facillity/form_reject_printing');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('facillity/printing_facillity');	
        }
    }

    function finishing_facillity(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/finishing_facillity";

        $get_finishing_facillity = $this->model_app->get_finishing_facillity();
        $data['get_finishing_facillity'] = $get_finishing_facillity;

        $data['link'] = "facillity/cancel_printing";

        $this->load->view('template',$data);

    }

    function edit_finishing($id_surat_order){
        $status = 'done';
        $currentDateTime = date('Y-m-d H:i:s');
        
        $this->db->set('finishing_date', $currentDateTime);
        $this->db->set('status_finishing', $status);
        $this->db->set('status',3);
        $this->db->set('at_last',$currentDateTime);
        // $this->db->set('start_inserting', $currentDateTime);
        $this->db->where('id_surat_order', $id_surat_order);
        $xpr_so_routine =  $this->db->update('xpr_surat_order');
        if ($xpr_so_routine === FALSE)
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data gagal disimpan</b> !!</span>
            </div>");
            redirect('facillity/finishing_facillity');	
        } else 
        {
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span>
            <b>Data berhasil disimpan</b> !!</span>
            </div>");
            redirect('facillity/finishing_facillity');	
        }
    }

    
}
