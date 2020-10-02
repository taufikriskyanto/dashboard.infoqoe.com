<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materai extends CI_Controller {


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
    public function info_materai($flag){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/mesin_materai";
        $data['search'] = "materai/info_materai/search";
        $data['add_mesin'] = "materai/add_mesin";
        $data['add_materai'] = "materai/add_materai";
        $data['mesin'] = $this->model_app->dropdown_mesin();

       
        if ($flag=='view'){
            $vendor = "";
            $cycle  = "";
            $data['vendor'] = $vendor;
            $data['cycle'] =  $cycle;
            $get_data_materai = $this->model_app->data_materai($data);
            $data['get_data_materai'] = $get_data_materai;
            
        }else {
            $data['vendor'] = $this->input->post('vendor');
			$data['cycle'] = $this->input->post('cycle');
            $get_data_materai = $this->model_app->data_materai($data);
            $data['get_data_materai'] = $get_data_materai;
        }

        $this->load->view('template',$data);
    }
    
    
    function add_materai(){
    
    $mesin = strtoupper(trim($this->input->post('mesin')));
    $cycle_materai = strtoupper(trim($this->input->post('cycle_materai')));
    $cycle = strtoupper(trim($this->input->post('cycle')));
    $no_akhir = strtoupper(trim($this->input->post('no_akhir')));
    $top_up = strtoupper(trim($this->input->post('top_up')));
    $keterangan = strtoupper(trim($this->input->post('keterangan')));    
    
    
    $currentDateTime = date('Y-m-d H:i:s');

    $top_up = $this->textToInteger($top_up);    
    // $result_top_up = preg_replace("/[^0-9]/", "", $top_up);
    // $top_up = (int)$result_top_up;
    //echo($top_up);
    $last_index_mesin = "SELECT no_akhir, saldo_top_up FROM xpr_materai WHERE id_mesin_materai = '$mesin' and id_materai = (SELECT MAX(id_materai) FROM xpr_materai)";
    $row_index_mesin = $this->db->query($last_index_mesin)->row();
    $no_awal = $row_index_mesin->no_akhir;
    $saldo_sebelumnya = $row_index_mesin->saldo_top_up;
    
    $jumlah_terpakai = ($no_akhir - $no_awal) * 6000;    
    
    $check  = $this->check_kondisi_materai($no_awal, $no_akhir, $saldo_sebelumnya, $jumlah_terpakai);
    if($check==false){
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b>Data gagal disimpan</b> !!</span>
                 </div>");
            redirect('materai/info_materai/view');	
    }else{
            $saldo = $saldo_sebelumnya - $jumlah_terpakai; 
            $saldo_top_up =  $saldo + $top_up;
            $this->db->set('id_mesin_materai', $mesin);
            $this->db->set('tanggal_materai', $cycle_materai);
            $this->db->set('cycle', $cycle);
            $this->db->set('no_akhir', $no_akhir);
            $this->db->set('no_awal', $no_awal);
            $this->db->set('saldo', $saldo);
            $this->db->set('jumlah_terpakai', $jumlah_terpakai);
            $this->db->set('top_up', $top_up);
            $this->db->set('saldo_top_up', $saldo_top_up);
            $this->db->set('keterangan', $keterangan);
            $this->db->set('date_creation', $currentDateTime);
             $get_type_customer =  $this->db->insert('xpr_materai');
             
             console.log($get_type_customer);
                            
                if ($get_type_customer === FALSE)
                 {
                    $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='material-icons'>close</i>
                        </button>
                        <span>
                        <b>Data gagal disimpan</b> !!</span>
                         </div>");
                    redirect('materai/info_materai/view');	
                } else 
                    {
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b>Data berhasil disimpan</b> !!</span>
                    </div>");
                    redirect('materai/info_materai/view');	
                }        
        }   
    }
    
    function add_mesin(){

    $name_mesin = strtoupper(trim($this->input->post('name_mesin')));
    $vendor = strtoupper(trim($this->input->post('vendor')));
    
    $cycle_materai = strtoupper(trim($this->input->post('cycle_materai')));
    $cycle = strtoupper(trim($this->input->post('cycle')));
    // $jumlah_terpakai = strtoupper(trim($this->input->post('jumlah_terpakai')));
    $no_akhir = strtoupper(trim($this->input->post('no_akhir')));
    $no_awal = strtoupper(trim($this->input->post('no_awal')));
    $saldo = strtoupper(trim($this->input->post('saldo')));
    $top_up = strtoupper(trim($this->input->post('topup')));
    
    
    //Mengubah dari text ke integer
    
    $top_up = $this->textToInteger($top_up);
    $saldo  = $this->textToInteger($saldo);
    
    
    $jumlah_terpakai =  ($no_akhir - $no_awal) * 6000;
    
    $currentDateTime = date('Y-m-d H:i:s');
    
    $saldo_top_up = ($saldo + $top_up) - $jumlah_terpakai;
    
    $this->db->set('nama_mesin', $name_mesin);
    $this->db->set('vendor', $vendor);
    $this->db->set('date_creation', $currentDateTime);
     $get_type_customer =  $this->db->insert('xpr_mesin_materai');
     
                    
        if ($get_type_customer === FALSE)
         {
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b>Failed - </b> Data cannot uploaded !!</span>
                 </div>");
            redirect('materai/info_materai/view');	
        } else {
            
            $max_id_mesin = "SELECT MAX(`id_mesin`) as id_mesin FROM `xpr_mesin_materai`";
            $row_id_mesin = $this->db->query($max_id_mesin)->row();
            $data['id_mesin'] = $row_id_mesin->id_mesin;
            $convert_id_mesin  =  (int) $data['id_mesin'];
            // var_dump($convert_id_mesin);
            $data['id_mesin'] = $convert_id_mesin;
            $data['cycle_materai'] = $cycle_materai;
            $data['cycle'] = $cycle;
            $data['jumlah_terpakai'] = $jumlah_terpakai;
            $data['no_akhir'] = $no_akhir;
            $data['no_awal'] = $no_awal;
            $data['saldo'] = $saldo;
            $data['top_up'] = $top_up;
            $data['saldo_top_up'] = $saldo_top_up;
            
            if ($this->model_app->save_first_record_mesin($data)){
                    
                $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span>
                <b>Failed - </b> Data cannot uploaded !!</span>
                 </div>");
                redirect('materai/info_materai/view');
                }else{
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span><b> Success - </b> Data has been uploaded </span>
                    </div>");
                    redirect('materai/info_materai/view');
                }
        
                
        }


    }
    

    public function delete_materai($id_materai){
        $this->db->where('id_materai', $id_materai);
        $success = $this->db->delete('xpr_materai');
        if ($success === FALSE){
          $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <i class='material-icons'>close</i>
          </button>
          <span>
          <b> Failed - </b> Deleted File Fail </span>
          </div>");
              redirect('materai/info_materai/view');
        }else{
          $this->session->set_flashdata("msg", "<div class='alert alert-success'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <i class='material-icons'>close</i>
          </button>
          <span>
          <b> Success - </b> Delete File Successfully </span>
          </div>");
              redirect('materai/info_materai/view');
        }
    }
    
    function check_kondisi_materai($no_awal, $no_akhir, $saldo_sebelumnya, $jumlah_terpakai){
        $condition = true;
        
        if($no_akhir < $no_awal){
         $condition =  false;
        }
        // if($jumlah_terpakai > $saldo_sebelumnya){
        //  $condition = false;
        // }
    
    return $condition;    
    }
    
    function textToInteger($param){
        $replace = preg_replace("/[^0-9]/", "", $param);
        $result = (int)$replace;
    
    return $result;    
    }
}
    
?>
