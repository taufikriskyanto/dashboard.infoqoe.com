<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {


                function __construct(){
                    parent::__construct();
                    $this->load->model('model_app');
                    // $this->load->library('count_hours');
                    
                    if(!$this->session->userdata('id_user'))
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
                </div>");
                    redirect('login');
                    }


                    
                    
                }
                

                function list_customer()
                {
                    $data['header'] = "header/header";
                    $data['footer'] = "footer/footer";
                    $data['body'] = "body/customer";



                    $id_dept = trim($this->session->userdata('id_group'));
                    $id_user = trim($this->session->userdata('id_user'));

                    $get_customer = $this->model_app->get_customer();
                    $data['view_get_customer'] = $get_customer;
                    
                    $data['link'] = "customer/delete_customer";


                    $this->load->view('template',$data);
                }

                function list_type_customer()
                {
                    $data['header'] = "header/header";
                    $data['footer'] = "footer/footer";
                    $data['body'] = "body/type_customer";



                    $id_dept = trim($this->session->userdata('id_group'));
                    $id_user = trim($this->session->userdata('id_user'));

                    $get_type_customer = $this->model_app->get_type_customer();
                    $data['get_type_customer'] = $get_type_customer;
                    
                    $data['link'] = "customer/delete_customer_type";

                    $this->load->view('template',$data);
                }

                function AddCustomer(){

                    $data['header'] = "header/header";
                    $data['footer'] = "footer/footer";
                    $data['body'] = "body/Form_Customer";

                    $id_dept = trim($this->session->userdata('id_dept'));
                    $id_user = trim($this->session->userdata('id_user'));

                    //end notification

                    $data['customer_id'] = "";		
                    $data['customer_name'] = "";
                    $data['customer_code'] = "";
                    $data['customer_type_id'] = "";
                    

                    $data['customer_type'] = $this->model_app->dropdown_customer_type();
                    // $data['customer_type'] = $this->product_model->dropdown_customer_type()->result();
                    // $data['customertype'] = "";
                    
                    // $data['dd_status'] = $this->model_app->dropdown_status();
                    // $data['status'] = "";

                    $data['url'] = "customer/save_customer";

                    $data['flag'] = "add";
                
                    $this->load->view('template', $data);


                }

                function add_type_customer(){

                    $data['header'] = "header/header";
                    $data['footer'] = "footer/footer";
                    $data['body'] = "body/form_type_customer";

                    $id_dept = trim($this->session->userdata('id_dept'));
                    $id_user = trim($this->session->userdata('id_user'));

                    //end notification

                    $data['customer_type_id'] = "";		
                    $data['customer_type_name'] = "";
                    // $data['customer_code'] = "";
                    

                    // $data['dd_status'] = $this->model_app->dropdown_status();
                    // $data['status'] = "";

                    $data['url'] = "customer/save_type_customer";

                    $data['flag'] = "add";
                
                    $this->load->view('template', $data);


                }

                function save_customer(){
                    $customer_name = strtoupper(trim($this->input->post('customer_name')));
                    $customer_type_id = strtoupper(trim($this->input->post('customer_type_id')));
                    $customer_code = strtoupper(trim($this->input->post('customer_code')));
                    $user_id = $this->session->userdata('user_id');

                    $currentDateTime = date('Y-m-d H:i:s');

                    $this->db->set('customer_name', $customer_name);
                    $this->db->set('customer_type_id', $customer_type_id);
                    $this->db->set('customer_code', $customer_code);
                    $this->db->set('user_id_creation', $user_id);
                    $this->db->set('date_creation', $currentDateTime);
                    // $this->db->set('stats', $status);
                    $get_type_customer =  $this->db->insert('xpr_customer');
                    
                    if ($get_type_customer === FALSE)
                    {
                        $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='material-icons'>close</i>
                        </button>
                        <span>
                        <b>Data gagal disimpan</b> !!</span>
                        </div>");
                        redirect('customer/list_customer');	
                    } else 
                    {
                        $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='material-icons'>close</i>
                        </button>
                        <span>
                        <b>Data berhasil disimpan</b> !!</span>
                        </div>");
                        redirect('customer/list_customer');	
                    }
                }

                function save_type_customer()
                {
                
                $customer_type_name = strtoupper(trim($this->input->post('customer_type_name')));
                // $status = strtoupper(trim($this->input->post('status')));
                $user_id = $this->session->userdata('user_id');
                // $dt = new DateTime();
                $currentDateTime = date('Y-m-d H:i:s');


                $this->db->set('customer_type_name', $customer_type_name);
                $this->db->set('user_id_creation', $user_id);
                $this->db->set('date_creation', $currentDateTime);
                // $this->db->set('stats', $status);
                $get_type_customer =  $this->db->insert('xpr_customer_type');
                
                if ($get_type_customer === FALSE)
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b>Data gagal disimpan</b> !!</span>
                    </div>");
                    redirect('customer/list_type_customer');	
                } else 
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b>Data berhasil disimpan</b> !!</span>
                    </div>");
                    redirect('customer/list_type_customer');	
                }               
            }

            function report($flag){
                $data['header'] = "header/header";
                $data['footer'] = "footer/footer";
                $data['body'] = "body/report_customer";
                $data['flag'] = "customer/report/search";
                $datefrom="";$dateTo="";$customer_code=""; $type = "";
                if($flag == 'view'){
                    $data['customer'] = $this->model_app->dropdown_customer();
                    $report_customer = $this->model_app->report_customer();
                    $data['report_customer'] = $report_customer;
                    $data['to'] = $dateTo;
                    $data['from'] = $datefrom;
                    $data['customer_code'] = $customer_code;
                    $data['type'] = $type;
                    $data['export'] = "customer/export";
                    // $data['report_customer'] = $report_customer;
                    $this->load->view('template', $data);
                }else{
                    $type = trim($this->input->post('type'));
                    $from = trim($this->input->post('from'));
                    $to = trim($this->input->post('to'));
                    $customer_code = trim($this->input->post('customer_code'));
                    $dateTo ="";$datefrom="";
                    $formSubmit = $this->input->post('submitform');
                    if($formSubmit == 'download'){
                    
                    }else{
                        if(!empty($from)){
                            $datefrom = explode("/",$from);
                            $MMFrom = $datefrom[0];
                            $ddFrom = $datefrom[1];
                            $YYYYFrom = $datefrom[2];
                            $datefrom = $YYYYFrom.''.$MMFrom.''.$ddFrom;
                        }
                        if(!empty($to)){
                            $dateTo = explode("/",$to);
                            $MMTo = $dateTo[0];
                            $ddTo = $dateTo[1];
                            $YYYYTo = $dateTo[2];
                            $dateTo = $YYYYTo.''.$MMTo.''.$ddTo;
                            
                        }
                        if($type =="non"){
                            //Untuk Yang Non Polis
                            $report_customer = $this->model_app->report_customers_non($datefrom,$dateTo,$customer_code);
                            $data['report_customer'] = $report_customer;
                        }else{
                            //Untuk yang Polis
                            $report_customer = $this->model_app->report_customers_polis($datefrom,$dateTo,$customer_code);
                            $data['report_customer'] = $report_customer;
                        }
                        
                        $data['customer'] = $this->model_app->dropdown_customer();
                        $data['to'] = $to;
                        $data['from'] = $from;
                        $data['customer_code'] = $customer_code;
                        $data['type'] = $type;
                        $this->load->view('template', $data);
                    }

                }


                
            }

            
            function export(){
            // Load plugin PHPExcel nya
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            $type = trim($this->input->post('type'));
            $from = trim($this->input->post('from'));
            $to = trim($this->input->post('to')); 
            $datefrom = explode("/",$from);
            $MMFrom = $datefrom[0];
            $ddFrom = $datefrom[1];
            $YYYYFrom = $datefrom[2];
            $datefrom = $YYYYFrom.''.$MMFrom.''.$ddFrom;
            $customer_code = trim($this->input->post('customer_code'));
            $csv = new PHPExcel();
               
            $dateTo = explode("/",$to);
            $MMTo = $dateTo[0];
            $ddTo = $dateTo[1];
            $YYYYTo = $dateTo[2];

            $dateTo = $YYYYTo.''.$MMTo.''.$ddTo;
            // Settingan awal fil excel
            $csv->getProperties()->setCreator('Taufik Riskyanto')
                                ->setLastModifiedBy('PLT 2019')
                                ->setTitle("REPORT CUSTOMER")
                                ->setSubject("PROJECT MANAGER")
                                ->setDescription("Laporan Semua Data Cetak Customer")
                                ->setKeywords("REPORT CUSTOMER - PM");
            if($type==='non'){


                // Panggil class PHPExcel nya

    
                // Buat header tabel nya pada baris ke 1
                $csv->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
                $csv->setActiveSheetIndex(0)->setCellValue('B1', "CUSTOMER"); // Set kolom B1 dengan tulisan "CUSTOMER"
                $csv->setActiveSheetIndex(0)->setCellValue('C1', "PROJECT"); // Set kolom C1 dengan tulisan "PROJECT"
                $csv->setActiveSheetIndex(0)->setCellValue('D1', "PRODUK"); // Set kolom D1 dengan tulisan "PRODUK"
                $csv->setActiveSheetIndex(0)->setCellValue('E1', "CYCLE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('F1', "TOTAL PAGES"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('G1', "TOTAL ENVELOP"); // Set kolom G1 dengan tulisan "TOTAL ENVELOP"
                $csv->setActiveSheetIndex(0)->setCellValue('H1', "SLA (JAM)"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('I1', "DATE APPROVAL SPLOD"); // Set kolom I1 dengan tulisan "DATE APPROVAL SPLOD"
                $csv->setActiveSheetIndex(0)->setCellValue('J1', "DATE PRINTING"); // Set kolom J1 dengan tulisan "DATE PRINTING"
                $csv->setActiveSheetIndex(0)->setCellValue('K1', "DATE INSERTING"); // Set kolom K1 dengan tulisan "DATE INSERTING"
                $csv->setActiveSheetIndex(0)->setCellValue('L1', "DATE BALANCING"); // Set kolom L1 dengan tulisan "DATE BALANCING"
                $csv->setActiveSheetIndex(0)->setCellValue('M1', "DATE READY TO PICKUP"); // Set kolom M1 dengan tulisan "READY TO PICKUP"
    
                $report_pm = $this->model_app->export($datefrom,$dateTo,$customer_code);
    
                $no = 1; // Untuk penomoran tabel, di awal set dengan 1
                $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 2
                foreach($report_pm as $data){ // Lakukan looping pada variabel REPORT
                    $csv->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
                    $csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->customer_name);
                    $csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->project);
                    $csv->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->produk);
                    $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->cycle);
                    $csv->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->total_pages);
                    $csv->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->total_envelop);
                    $csv->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->sla);
                    $csv->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->date_approval_splod);
                    $csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->finish_printing);
                    $csv->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->finish_inserting);
                    $csv->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->finish_balancing);
                    $csv->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->finish_rtp);
    
                    $no++; // Tambah 1 setiap kali looping
                    $numrow++; // Tambah 1 setiap kali looping
                }
        
                // Set orientasi kertas jadi LANDSCAPE
                $csv->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        
                // Set judul file excel nya
                $csv->getActiveSheet(0)->setTitle("Laporan Data Project Manager");
                $csv->setActiveSheetIndex(0);
        
                // Proses file excel
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="REPORT CUSTOMER '.$customer_code.'-'. $datefrom.'-'.$dateTo.'.csv"'); // Set nama file excel nya
                header('Cache-Control: max-age=0');
        
                $write = new PHPExcel_Writer_CSV($csv);
                $write->save('php://output');
            }else{
                // Panggil class PHPExcel nya
                $report_pm = $this->model_app->export_polis($datefrom,$dateTo,$customer_code);

    
                // Buat header tabel nya pada baris ke 1
                $csv->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
                //$csv->setActiveSheetIndex(0)->setCellValue('B1', "CUSTOMER"); // Set kolom B1 dengan tulisan "CUSTOMER"
                $csv->setActiveSheetIndex(0)->setCellValue('B1', "NO POLIS"); // Set kolom B1 dengan tulisan "NO POLIS"
                $csv->setActiveSheetIndex(0)->setCellValue('C1', "SPAJ"); // Set kolom C1 dengan tulisan "PROJECT"
                $csv->setActiveSheetIndex(0)->setCellValue('D1', "NAMA PRODUK"); // Set kolom D1 dengan tulisan "PRODUK"
                $csv->setActiveSheetIndex(0)->setCellValue('E1', "ISSUED DATE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('F1', "CYCLE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('G1', "AGENCY"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('H1', "FLAG MEDAN"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('I1', "REMARKS"); // Set kolom G1 dengan tulisan "TOTAL ENVELOP"
                $csv->setActiveSheetIndex(0)->setCellValue('J1', "TANGGAL PROSES"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('K1', "TAT"); // Set kolom I1 dengan tulisan "DATE APPROVAL SPLOD"
                $csv->setActiveSheetIndex(0)->setCellValue('L1', "MANIFEST"); // Set kolom J1 dengan tulisan "DATE PRINTING"
                $csv->setActiveSheetIndex(0)->setCellValue('M1', "STATUS"); // Set kolom K1 dengan tulisan "DATE INSERTING"
                $csv->setActiveSheetIndex(0)->setCellValue('N1', "PROSES DATE"); // Set kolom L1 dengan tulisan "DATE BALANCING"XF
    
                
    
                $no = 1; // Untuk penomoran tabel, di awal set dengan 1
                $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 2
                $dateCycle = '';
                foreach($report_pm as $data){ // Lakukan looping pada variabel REPORT
                    $dateCycle = $data->cycle;
                    if($dateCycle != "0" && $dateCycle != "") {
                        $dd   = substr($dateCycle,6,2); 
                        $MM   = substr($dateCycle,4,2);
                        $YYYY = substr($dateCycle,0,4);
                        $dateCycle = $dd ."/".$MM."/".$YYYY;
                    }
                    $tgl_proses =   $data->tgl_proses;
                    $tgl_proses =  str_ireplace("/","-",$tgl_proses);
                    $proses_date =  $data->proses_date;
                    $proses_date = str_ireplace("/","-",$proses_date);
                    $selisih = $this->getWorkingDays($proses_date,$tgl_proses);
                    // $selisih = strtotime($tgl_proses) -  strtotime($proses_date);
                    // $hari = $selisih/(60*60*24);
                    $date = $selisih * 24;
                    $csv->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->no_urut);
                    // $csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->customer);
                    $csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_polis);
                    $csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->spaj);
                    $csv->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->produk);
                    $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->issued);
                    $csv->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $dateCycle);
                    $csv->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->agency);
                    $csv->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->flagmedan);
                    $csv->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->remarks);
                    $csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, substr($data->tgl_proses,0,10));
                    $csv->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $date);
                    $csv->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->manifest);
                    $csv->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->status);
                    $csv->setActiveSheetIndex(0)->setCellValue('N'.$numrow, substr($data->proses_date,0,10));
                    $no++; // Tambah 1 setiap kali looping
                    $numrow++; // Tambah 1 setiap kali looping
                }
        
                // Set orientasi kertas jadi LANDSCAPE
                $csv->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        
                // Set judul file excel nya
                $csv->getActiveSheet(0)->setTitle("Laporan Data Project Manager");
                $csv->setActiveSheetIndex(0);
        
                // Proses file excel
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="REPORT CUSTOMER POLIS '.$customer_code.'- Cycle '. $datefrom.' - '.$dateTo.'.xlsx"'); // Set nama file excel nya
                header('Cache-Control: max-age=0');
        
                $write = PHPExcel_IOFactory::createWriter($csv, 'Excel2007');
                $write->save('php://output');
            }
        }

            function edit_type_customer($id)
            {

            $data['header'] = "header/header";
            $data['footer'] = "footer/footer";
            $data['body'] = "body/form_type_customer";

            $id_dept = trim($this->session->userdata('id_dept'));
            $id_user = trim($this->session->userdata('id_user'));

            //notification 
            $sql_customer_type_name = "SELECT customer_type_name, stats FROM xpr_customer_type 
                                        WHERE customer_type_id ='$id'";
            $row_type_customer = $this->db->query($sql_customer_type_name)->row();

           //end notification
            $data['url'] = "customer/update_type_customer";
            $data['customer_type_id'] = $id;		
            $data['customer_type_name'] = $row_type_customer->customer_type_name;

            $data['flag'] = "edit";

            $this->load->view('template', $data);

            }

            function edit_customer($id)
            {
                $data['header'] = "header/header";
                $data['footer'] = "footer/footer";
                $data['body'] = "body/Form_Customer";

                $id_dept = trim($this->session->userdata('id_dept'));
                $id_user = trim($this->session->userdata('id_user'));

                $sql_customer = "SELECT customer_type_id, customer_name, customer_code FROM xpr_customer
                                            WHERE customer_id ='$id'";
                $row_customer = $this->db->query($sql_customer)->row();
                

                $data['url'] = "customer/update_customer";
                $customer_type_id = '';
                $data['customer_id'] = $id;		
                $data['customer_name'] = $row_customer->customer_name;
                $data['customer_code'] = $row_customer->customer_code;
                $customer_type_id = $row_customer->customer_type_id;

                $sql_customer_type = "SELECT customer_type_id FROM xpr_customer_type
                WHERE customer_type_id ='$customer_type_id'";
                $row_customer_type = $this->db->query($sql_customer_type)->row();
                $data['customer_type_id'] = $row_customer_type->customer_type_id;

                $data['customer_type'] = $this->model_app->dropdown_customer_type();
                
                $data['flag'] = "edit";

                $this->load->view('template', $data);
                
            }

            function update_type_customer(){

                $customer_type_id = strtoupper(trim($this->input->post('customer_type_id')));
                $customer_type_name = strtoupper(trim($this->input->post('customer_type_name')));
                $user_id = $this->session->userdata('user_id');
                $currentDateTime = date('Y-m-d H:i:s');
                $this->db->set('customer_type_name', $customer_type_name);
                $this->db->set('user_id_modification', $user_id);
                $this->db->set('date_modification', $currentDateTime);
                $this->db->where('customer_type_id', $customer_type_id);
                $this->db->update('xpr_customer_type');
                
                if ($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span><b> Success - </b> Update Customer Type</span>
                    </div>");
                    redirect('customer/list_type_customer');	
	
                } else 
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span><b> Failed - </b> Update Customer Type</span>
                    </div>");
                    redirect('customer/list_type_customer');
                }
                    
            }

            function update_customer(){
                $customer_id = strtoupper(trim($this->input->post('customer_id')));
                $customer_name = strtoupper(trim($this->input->post('customer_name')));
                $customer_type_id = strtoupper(trim($this->input->post('customer_type_id')));
                $customer_code = strtoupper(trim($this->input->post('customer_code')));
                $user_id = $this->session->userdata('user_id');
                $currentDateTime = date('Y-m-d H:i:s');
            
                $this->db->set('customer_name', $customer_name);
                $this->db->set('customer_type_id', $customer_type_id);
                $this->db->set('customer_code', $customer_code);
                $this->db->set('user_id_modification', $user_id);
                $this->db->set('date_modification', $currentDateTime);
                $this->db->where('customer_id', $customer_id);
                $this->db->update('xpr_customer');
                if ($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span><b> Success - </b> Update Customer Type</span>
                    </div>");
                    redirect('customer/list_customer');	
	
                } else 
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span><b> Failed - </b> Update Customer Type</span>
                    </div>");
                    redirect('customer/list_customer');
                }
            }

            function delete_customer_type($id)
            {
                
                $this->db->where('customer_type_id', $id);
                $this->db->delete('xpr_customer_type');
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b> Success - </b> Delete Customer</span>
                    </div>");
                    redirect('customer/list_type_customer');
                } else 
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b> Failed - </b> Delete Customer </span>
                    </div>");
                    redirect('customer/list_type_customer');
                } 
                

            }

            function delete_customer($id)
            {
                $this->db->where('customer_id', $id);
                $this->db->delete('xpr_customer');
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b> Success - </b> Delete Customer</span>
                    </div>");
                    redirect('customer/list_customer');	
                } else 
                {
                    $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span>
                    <b> Failed - </b> Delete Customer </span>
                    </div>");
                    redirect('customer/list_customer');	
                } 
            }


            function IntervalDays($CheckIn,$CheckOut){
                $CheckInX = explode("/", $CheckIn);
                $CheckOutX =  explode("/", $CheckOut);
                $date1 =  mktime(0, 0, 0, $CheckInX[0],$CheckInX[1],$CheckInX[2]);
                $date2 =  mktime(0, 0, 0, $CheckOutX[0],$CheckOutX[1],$CheckOutX[2]);
                $interval =($date2 - $date1)/(3600*24);
                return  $interval ;
            }

            function getWorkingDays($startDate,$endDate){
                // do strtotime calculations just once
                $holidays =  array("2020-03-25","2020-04-10","2020-05-01","2020-05-07",
                    "2020-05-21","2020-06-01","2020-07-31","2020-08-17","2020-08-20","2020-10-29","2020-12-25");
                $endDate = strtotime($endDate);
                $startDate = strtotime($startDate);
            
            
                //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
                //We add one to inlude both dates in the interval.
                // $days = ($endDate - $startDate) / 86400 + 1;
                $days = ($endDate - $startDate) / 86400;

                $no_full_weeks = floor($days / 7);
                $no_remaining_days = fmod($days, 7);
            
                //It will return 1 if it's Monday,.. ,7 for Sunday
                $the_first_day_of_week = date("N", $startDate);
                $the_last_day_of_week = date("N", $endDate);
            
                //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
                //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
                if ($the_first_day_of_week <= $the_last_day_of_week) {
                    if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
                    if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
                }
                else {
                    // (edit by Tokes to fix an edge case where the start day was a Sunday
                    // and the end day was NOT a Saturday)
            
                    // the day of the week for start is later than the day of the week for end
                    if ($the_first_day_of_week == 7) {
                        // if the start date is a Sunday, then we definitely subtract 1 day
                        $no_remaining_days--;
            
                        if ($the_last_day_of_week == 6) {
                            // if the end date is a Saturday, then we subtract another day
                            $no_remaining_days--;
                        }
                    }
                    else {
                        // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
                        // so we skip an entire weekend and subtract 2 days
                        $no_remaining_days -= 2;
                    }
                }
            
                //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
            //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
               $workingDays = $no_full_weeks * 5;
                if ($no_remaining_days > 0 )
                {
                  $workingDays += $no_remaining_days;
                }
            
                //We subtract the holidays
                foreach($holidays as $holiday){
                    $time_stamp=strtotime($holiday);
                    //If the holiday doesn't fall in weekend
                    if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
                        $workingDays--;
                }
            
                return $workingDays;
            }


    
}
