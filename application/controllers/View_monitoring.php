<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_monitoring extends CI_Controller {


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

    
    function index()
    {
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        // $data['body'] = "body/view_monitoring";
        $id_dept = trim($this->session->userdata('id_group'));
        $id_user = trim($this->session->userdata('id_user'));
        $level = trim($this->session->userdata('level'));
        if($level ==='Customers'){
        $data['export'] = "customer/export_report_polis";
        $data['customer'] = $this->model_app->dropdown_customer();    
        $data['body'] = "body/v_report_polis";
        $customer_code = trim($this->session->userdata('customer_code'));
        $data['level'] = trim($this->session->userdata('level')); 
        $view_monitoring = $this->model_app->view_monitoring_customer($customer_code);
        $data['view_monitoring'] = $view_monitoring;
        $this->load->view('template',$data);
        }else{
        $data['body'] = "body/view_monitoring";
        $data['level'] = $level; 
        $view_monitoring = $this->model_app->view_monitoring(); 
        $data['view_monitoring'] = $view_monitoring;  
        $this->load->view('dashboard_template',$data); 
        
        }

        
    }

    function report_polis($flag){
        
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/v_report_polis";
        $data['flag'] = "view_monitoring/report_polis/search";
        // $data['export'] = "view_monitoring/export_to_excel";
        $id_dept = trim($this->session->userdata('id_group'));
        $id_user = trim($this->session->userdata('id_user'));
        $level = trim($this->session->userdata('level'));
        $data['level'] = trim($this->session->userdata('level'));
        $customer_code = trim($this->session->userdata('customer_code'));
        $agency_code = "";
        $product = "";
        $delivery = "";
        $epolicy = "";
        $manifest = "";
        $cycle_from = "";
        $cycle_end = "";
        $channels = "";
        $parameters = '';
        // $issued_from = "";
        // $issued_end = "";
        $kartu_hs = "";
        $kartu_gah = "";
        $vendor = "";
        if($flag=='view'){
            $customer_code = '';
            $view_monitoring = $this->model_app->view_monitoring_customer($customer_code);
                $data['view_monitoring'] = $view_monitoring;
                $data['agency_code'] = $agency_code;
                $data['product'] = $product;
                $data['delivery_option'] = $delivery;
                $data['policy'] = $epolicy;
                $data['manifes'] = $manifest;
                $data['cycle_from'] = $cycle_from;
                $data['cycle_end'] = $cycle_end;
                $data['channels'] = $channels;
                // $data['issued_from'] = $issued_from;
                // $data['issued_end'] = $issued_end;
                $data['kartu_hs'] = $kartu_hs;
                $data['kartu_gah'] = $kartu_gah;
                $data['vendor'] = $vendor;
            $this->load->view('template',$data);
        }else{
        //METHOD POST
            
            $agency_code = trim($this->input->post('agency_code'));
            $product = trim($this->input->post('product'));
            $delivery = trim($this->input->post('delivery_option'));
            $epolicy = trim($this->input->post('policy'));
            $manifest = trim($this->input->post('manifes'));
            $kartu_hs = trim($this->input->post('kartu_hs'));
            $kartu_gah = trim($this->input->post('kartu_gah'));
            $vendor = trim($this->input->post('vendor'));
            $channels = trim($this->input->post('channels'));
            $cycle_from = trim($this->input->post('cycle_from'));
            $cycle_end = trim($this->input->post('cycle_end')); 
            // $issued_from = trim($this->input->post('issued_from'));
            // $issued_end = trim($this->input->post('issued_end'));
            $formSubmit = $this->input->post('submitform');
            $dateTo ="" ; $issued_fromdate =""; $issued_todate =""; $datefrom="";   
            // if(!empty($issued_from)){
            //     $issued_fdate = explode("/",$issued_from);
            //     $MMissued = $issued_fdate[0];
            //     $ddissued = $issued_fdate[1];
            //     $YYYYissued = $issued_fdate[2];
            //     $issued_fromdate = $YYYYissued.''.$MMissued.''.$ddissued;
            // }
            // if(!empty($issued_end)){
            //     $issued_edate = explode("/",$issued_end);
            //     $MMissued_end = $issued_edate[0];
            //     $ddissued_end = $issued_edate[1];
            //     $YYYYissued_end = $issued_edate[2];
            //     $issued_todate = $YYYYissued_end.''.$MMissued_end.''.$ddissued_end;
            // }
            if(!empty($cycle_from)){
                $datefrom = explode("/",$cycle_from);
                $MMFrom = $datefrom[0];
                $ddFrom = $datefrom[1];
                $YYYYFrom = $datefrom[2];
                $datefrom = $YYYYFrom.''.$MMFrom.''.$ddFrom;
            }
            if(!empty($cycle_end)){
                $dateTo = explode("/",$cycle_end);
                $MMTo = $dateTo[0];
                $ddTo = $dateTo[1];
                $YYYYTo = $dateTo[2];
                $dateTo = $YYYYTo.''.$MMTo.''.$ddTo;
            }

            // $data['view_monitoring'] = $view_monitoring;

            // $parameters = array('agency_code' =>$agency_code,
            //                     'product' =>$product,
            //                     'delivery_option' =>$delivery,
            //                     'policy' =>$epolicy,
            //                     'manifes' =>$manifest,
            //                     'cycle_from' =>$cycle_from,
            //                     'cycle_end' =>$cycle_end,
            //                     'kartu_hs' =>$kartu_hs,
            //                     'kartu_gah' =>$kartu_gah,
            //                     'kartu_gah' =>$kartu_gah,
            //                     'vendor' =>$vendor,
            //                     'customer_code' =>$customer_code) ;

            $data['agency_code'] = $agency_code;
            $data['product'] = $product;
            $data['delivery_option'] = $delivery;
            $data['policy'] = $epolicy;
            $data['manifes'] = $manifest;
            $data['cycle_from'] = $datefrom;
            $data['cycle_end'] = $dateTo;
            $data['kartu_hs'] = $kartu_hs;
            $data['kartu_gah'] = $kartu_gah;
            $data['vendor'] = $vendor;
            $data['customer_code'] =  $customer_code;
            $data['channels'] = $channels;
                

            //KONDISI UNTUK SEARCH DAN DOWNLOAD DATA DAILY REPORT PRUDENTIAL    

            if($formSubmit == 'formExcel'){
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                $csv = new PHPExcel();
                $csv->getProperties()->setCreator('Taufik Riskyanto')
                                ->setLastModifiedBy('PLT 2019')
                                ->setTitle("REPORT CUSTOMER")
                                ->setSubject("PROJECT MANAGER")
                                ->setDescription("Laporan Semua Data Cetak Customer")
                                ->setKeywords("REPORT CUSTOMER - PM"); 

                $report_pm = $this->model_app->view_polis($data);

                $csv->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
                //$csv->setActiveSheetIndex(0)->setCellValue('B1', "CUSTOMER"); // Set kolom B1 dengan tulisan "CUSTOMER"
                $csv->setActiveSheetIndex(0)->setCellValue('B1', "NO POLIS"); // Set kolom B1 dengan tulisan "NO POLIS"
                //$csv->setActiveSheetIndex(0)->setCellValue('C1', "SPAJ"); // Set kolom C1 dengan tulisan "PROJECT"
                $csv->setActiveSheetIndex(0)->setCellValue('C1', "NAMA PRODUK"); // Set kolom D1 dengan tulisan "PRODUK"
                // $csv->setActiveSheetIndex(0)->setCellValue('E1', "ISSUED DATE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('D1', "CYCLE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('E1', "AGENCY"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('F1', "FLAG MEDAN"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('G1', "REMARKS"); // Set kolom G1 dengan tulisan "TOTAL ENVELOP"
                $csv->setActiveSheetIndex(0)->setCellValue('H1', "TANGGAL PROSES"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
               // $csv->setActiveSheetIndex(0)->setCellValue('J1', "TIME");
                $csv->setActiveSheetIndex(0)->setCellValue('I1', "TAT"); // Set kolom I1 dengan tulisan "DATE APPROVAL SPLOD"
                $csv->setActiveSheetIndex(0)->setCellValue('J1', "MANIFEST"); // Set kolom J1 dengan tulisan "DATE PRINTING"
                $csv->setActiveSheetIndex(0)->setCellValue('K1', "STATUS"); // Set kolom K1 dengan tulisan "DATE INSERTING"
                $csv->setActiveSheetIndex(0)->setCellValue('L1', "PROSES DATE"); // Set kolom L1 dengan tulisan "DATE BALANCING"XF
                
                
    
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
                    //$csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->customer);
                    $csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_polis);
                    //$csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->spaj);
                    $csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->produk);
                    // $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->issued);
                    $csv->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $dateCycle);
                    $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->agency);
                    $csv->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->flagmedan);
                    $csv->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->remarks);
                    if($data->tgl_proses ==  FALSE){
                        $csv->setActiveSheetIndex(0)->setCellValue('H'.$numrow, 0);
                        //$csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, 0);
                    }else{
                        $csv->setActiveSheetIndex(0)->setCellValue('H'.$numrow, substr($data->tgl_proses,0,10));
                        //$csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, substr($data->tgl_proses,11,20));
                    }
                    if($date < 0){
                        $csv->setActiveSheetIndex(0)->setCellValue('I'.$numrow, 0);
                    }else{
                        $csv->setActiveSheetIndex(0)->setCellValue('I'.$numrow, floor($date));
                    }
                    $csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->manifest);
                    $csv->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->status);
                    $csv->setActiveSheetIndex(0)->setCellValue('L'.$numrow, substr($data->proses_date,0,10));
                    

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
                header('Content-Disposition: attachment; filename="REPORT CUSTOMER POLIS '.$customer_code.'_'.$cycle_from.'-'.$cycle_end.'.xlsx"'); // Set nama file excel nya
                header('Cache-Control: max-age=0');
        
                $write = PHPExcel_IOFactory::createWriter($csv, 'Excel2007');
                $write->save('php://output');
            }else{
                $view_polis = $this->model_app->view_polis($data);
                $data['view_monitoring'] = $view_polis;

                $data['agency_code'] = $agency_code;
                $data['product'] = $product;
                $data['delivery_option'] = $delivery;
                $data['policy'] = $epolicy;
                $data['manifes'] = $manifest;
                $data['cycle_from'] = $cycle_from;
                $data['cycle_end'] = $cycle_end;
                // $data['issued_from'] = $issued_from;
                // $data['issued_end'] = $issued_end;
                $data['kartu_hs'] = $kartu_hs;
                $data['kartu_gah'] = $kartu_gah;
                $data['vendor'] = $vendor;
                $data['channels'] = $channels;
                $this->load->view('template',$data);
                
            }
        }

    }
    
        function report_summary($flag){
        
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/v_report_summary";
        $data['flag'] = "view_monitoring/report_summary/search";
        // $data['export'] = "view_monitoring/export_to_excel";
        $id_dept = trim($this->session->userdata('id_group'));
        $id_user = trim($this->session->userdata('id_user'));
        $level = trim($this->session->userdata('level'));
        $data['level'] = trim($this->session->userdata('level'));
        $customer_code = trim($this->session->userdata('customer_code'));
        $agency_code = "";
        $product = "";
        $delivery = "";
        $epolicy = "";
        $manifest = "";
        $cycle_from = "";
        $cycle_end = "";
        $channels = "";
        $parameters = '';
        // $issued_from = "";
        // $issued_end = "";
        $kartu_hs = "";
        $kartu_gah = "";
        $vendor = "";
        if($flag=='view'){
            $customer_code = '';
                $view_monitoring = $this->model_app->view_monitoring_customer($customer_code);
                $data['view_monitoring'] = $view_monitoring;
                $data['agency_code'] = $agency_code;
                $data['product'] = $product;
                $data['delivery_option'] = $delivery;
                $data['policy'] = $epolicy;
                $data['manifes'] = $manifest;
                $data['cycle_from'] = $cycle_from;
                $data['cycle_end'] = $cycle_end;
                $data['channels'] = $channels;
                // $data['issued_from'] = $issued_from;
                // $data['issued_end'] = $issued_end;
                $data['kartu_hs'] = $kartu_hs;
                $data['kartu_gah'] = $kartu_gah;
                $data['vendor'] = $vendor;
            $this->load->view('template',$data);
        }else{
        //METHOD POST
            
            $agency_code = trim($this->input->post('agency_code'));
            //$product = trim($this->input->post('product'));
            $delivery = trim($this->input->post('delivery_option'));
            $epolicy = trim($this->input->post('policy'));
            $manifest = trim($this->input->post('manifes'));
            //$kartu_hs = trim($this->input->post('kartu_hs'));
            //$kartu_gah = trim($this->input->post('kartu_gah'));
            $vendor = trim($this->input->post('vendor'));
           // $channels = trim($this->input->post('channels'));
            $cycle_from = trim($this->input->post('cycle_from'));
            $cycle_end = trim($this->input->post('cycle_end')); 
            // $issued_from = trim($this->input->post('issued_from'));
            // $issued_end = trim($this->input->post('issued_end'));
            $formSubmit = $this->input->post('submitform');
            $dateTo ="" ; $issued_fromdate =""; $issued_todate =""; $datefrom="";   
            // if(!empty($issued_from)){
            //     $issued_fdate = explode("/",$issued_from);
            //     $MMissued = $issued_fdate[0];
            //     $ddissued = $issued_fdate[1];
            //     $YYYYissued = $issued_fdate[2];
            //     $issued_fromdate = $YYYYissued.''.$MMissued.''.$ddissued;
            // }
            // if(!empty($issued_end)){
            //     $issued_edate = explode("/",$issued_end);
            //     $MMissued_end = $issued_edate[0];
            //     $ddissued_end = $issued_edate[1];
            //     $YYYYissued_end = $issued_edate[2];
            //     $issued_todate = $YYYYissued_end.''.$MMissued_end.''.$ddissued_end;
            // }
            if(!empty($cycle_from)){
                $datefrom = explode("/",$cycle_from);
                $MMFrom = $datefrom[0];
                $ddFrom = $datefrom[1];
                $YYYYFrom = $datefrom[2];
                $datefrom = $YYYYFrom.''.$MMFrom.''.$ddFrom;
            }
            if(!empty($cycle_end)){
                $dateTo = explode("/",$cycle_end);
                $MMTo = $dateTo[0];
                $ddTo = $dateTo[1];
                $YYYYTo = $dateTo[2];
                $dateTo = $YYYYTo.''.$MMTo.''.$ddTo;
            }

            // $data['view_monitoring'] = $view_monitoring;

            // $parameters = array('agency_code' =>$agency_code,
            //                     'product' =>$product,
            //                     'delivery_option' =>$delivery,
            //                     'policy' =>$epolicy,
            //                     'manifes' =>$manifest,
            //                     'cycle_from' =>$cycle_from,
            //                     'cycle_end' =>$cycle_end,
            //                     'kartu_hs' =>$kartu_hs,
            //                     'kartu_gah' =>$kartu_gah,
            //                     'kartu_gah' =>$kartu_gah,
            //                     'vendor' =>$vendor,
            //                     'customer_code' =>$customer_code) ;

            //$data['agency_code'] = $agency_code;
            //$data['product'] = $product;
            $data['delivery_option'] = $delivery;
            $data['policy'] = $epolicy;
            $data['manifes'] = $manifest;
            $data['cycle_from'] = $datefrom;
            $data['cycle_end'] = $dateTo;
            //$data['kartu_hs'] = $kartu_hs;
            //$data['kartu_gah'] = $kartu_gah;
            $data['vendor'] = $vendor;
            $data['customer_code'] =  $customer_code;
            //$data['channels'] = $channels;
                

            //KONDISI UNTUK SEARCH DAN DOWNLOAD DATA DAILY REPORT PRUDENTIAL    

            if($formSubmit == 'formExcel'){
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                $csv = new PHPExcel();
                $csv->getProperties()->setCreator('Taufik Riskyanto')
                                ->setLastModifiedBy('PLT 2019')
                                ->setTitle("REPORT CUSTOMER")
                                ->setSubject("PROJECT MANAGER")
                                ->setDescription("Laporan Semua Data Cetak Customer")
                                ->setKeywords("REPORT CUSTOMER - PM"); 

                $report_pm = $this->model_app->view_policy_summary($data);

                $csv->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
                //$csv->setActiveSheetIndex(0)->setCellValue('B1', "CUSTOMER"); // Set kolom B1 dengan tulisan "CUSTOMER"
                $csv->setActiveSheetIndex(0)->setCellValue('B1', "CYCLE"); // Set kolom B1 dengan tulisan "NO POLIS"
                //$csv->setActiveSheetIndex(0)->setCellValue('C1', "SPAJ"); // Set kolom C1 dengan tulisan "PROJECT"
                $csv->setActiveSheetIndex(0)->setCellValue('C1', "VENDOR"); // Set kolom D1 dengan tulisan "PRODUK"
                // $csv->setActiveSheetIndex(0)->setCellValue('E1', "ISSUED DATE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('D1', "E-POLICY"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('E1', "MANIFEST TYPE"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('F1', "DELIVERY OPTIONS"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('G1', "TOTAL POLICY"); // Set kolom G1 dengan tulisan "TOTAL ENVELOP"
                // $csv->setActiveSheetIndex(0)->setCellValue('H1', "TANGGAL PROSES"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                // $csv->setActiveSheetIndex(0)->setCellValue('J1', "TIME");
                // $csv->setActiveSheetIndex(0)->setCellValue('I1', "TAT"); // Set kolom I1 dengan tulisan "DATE APPROVAL SPLOD"
                // $csv->setActiveSheetIndex(0)->setCellValue('J1', "MANIFEST"); // Set kolom J1 dengan tulisan "DATE PRINTING"
                // $csv->setActiveSheetIndex(0)->setCellValue('K1', "STATUS"); // Set kolom K1 dengan tulisan "DATE INSERTING"
                // $csv->setActiveSheetIndex(0)->setCellValue('L1', "PROSES DATE"); // Set kolom L1 dengan tulisan "DATE BALANCING"XF
                
                
    
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



                    $csv->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->no_urut);
                    //$csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->customer);
                    $csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $dateCycle);
                    //$csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->spaj);
                    $csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->vendor);
                    // $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->issued);
                    $csv->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->epolicy);
                    $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->manifest);
                    $csv->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->delivery_option);
                    $csv->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->total_policy);
                    // if($data->tgl_proses ==  FALSE){
                    //     $csv->setActiveSheetIndex(0)->setCellValue('H'.$numrow, 0);
                    //     //$csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, 0);
                    // }else{
                    //     $csv->setActiveSheetIndex(0)->setCellValue('H'.$numrow, substr($data->tgl_proses,0,10));
                    //     //$csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, substr($data->tgl_proses,11,20));
                    // }
                    // if($date < 0){
                    //     $csv->setActiveSheetIndex(0)->setCellValue('I'.$numrow, 0);
                    // }else{
                    //     $csv->setActiveSheetIndex(0)->setCellValue('I'.$numrow, floor($date));
                    // }
                    // $csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->manifest);
                    // $csv->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->status);
                    // $csv->setActiveSheetIndex(0)->setCellValue('L'.$numrow, substr($data->proses_date,0,10));
                    

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
                header('Content-Disposition: attachment; filename="REPORT CUSTOMER POLIS '.$customer_code.'_'.$cycle_from.'-'.$cycle_end.'.xlsx"'); // Set nama file excel nya
                header('Cache-Control: max-age=0');
        
                $write = PHPExcel_IOFactory::createWriter($csv, 'Excel2007');
                $write->save('php://output');
            }else{
                $view_polis = $this->model_app->view_policy_summary($data);
                $data['view_monitoring'] = $view_polis;

                //$data['agency_code'] = $agency_code;
               // $data['product'] = $product;
                $data['delivery_option'] = $delivery;
                $data['policy'] = $epolicy;
                $data['manifes'] = $manifest;
                $data['cycle_from'] = $cycle_from;
                $data['cycle_end'] = $cycle_end;
                // $data['issued_from'] = $issued_from;
                // $data['issued_end'] = $issued_end;
                //$data['kartu_hs'] = $kartu_hs;
                //$data['kartu_gah'] = $kartu_gah;
                $data['vendor'] = $vendor;
                $this->load->view('template',$data);
                
            }
        }

    }

    function report_jobdesk($flag){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/v_report_jobdesk";
        $data['flag'] = "view_monitoring/report_jobdesk/search";
        $id_dept = trim($this->session->userdata('id_group'));
        $id_user = trim($this->session->userdata('id_user'));
        $level = trim($this->session->userdata('level'));
        $data['level'] = trim($this->session->userdata('level'));
        $customer_code = trim($this->session->userdata('customer_code'));
        $data['produk'] = $this->model_app->dropdown_product($customer_code);
        $cycle_from = "";
        $cycle_end = "";
        $product = "";
        if($flag=='view'){
            $customer_code = '';
            $view_monitoring = $this->model_app->view_monitoring_nonpolis($customer_code);
            $data['view_monitoring'] = $view_monitoring;
         
                $data['product'] = $product;
                $data['cycle_from'] = $cycle_from;
                $data['cycle_end'] = $cycle_end;

            $this->load->view('template',$data);
        }else{
        //METHOD POST
            

            $product = trim($this->input->post('product'));
            $cycle_from = trim($this->input->post('cycle_from'));
            $cycle_end = trim($this->input->post('cycle_end')); 
            $formSubmit = $this->input->post('submitform');
            $dateTo ="" ; $datefrom="";   
            if(!empty($cycle_from)){
                $datefrom = explode("/",$cycle_from);
                $MMFrom = $datefrom[0];
                $ddFrom = $datefrom[1];
                $YYYYFrom = $datefrom[2];
                $datefrom = $YYYYFrom.''.$MMFrom.''.$ddFrom;
            }
            if(!empty($cycle_end)){
                $dateTo = explode("/",$cycle_end);
                $MMTo = $dateTo[0];
                $ddTo = $dateTo[1];
                $YYYYTo = $dateTo[2];
                $dateTo = $YYYYTo.''.$MMTo.''.$ddTo;
            }
            if($formSubmit == 'formExcel'){
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                $csv = new PHPExcel();
                $csv->getProperties()->setCreator('Taufik Riskyanto')
                                ->setLastModifiedBy('PLT 2019')
                                ->setTitle("REPORT CUSTOMER")
                                ->setSubject("PROJECT MANAGER")
                                ->setDescription("Laporan Semua Data Cetak Customer")
                                ->setKeywords("REPORT CUSTOMER - PM"); 

                $report_pm = $this->model_app->view_polis($customer_code,$datefrom,$dateTo,$issued_fromdate,$issued_todate,$product,$agency_code,$delivery,$epolicy,$manifest);

                $csv->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
                $csv->setActiveSheetIndex(0)->setCellValue('B1', "CUSTOMER"); // Set kolom B1 dengan tulisan "CUSTOMER"
                $csv->setActiveSheetIndex(0)->setCellValue('C1', "NO POLIS"); // Set kolom B1 dengan tulisan "NO POLIS"
                $csv->setActiveSheetIndex(0)->setCellValue('D1', "SPAJ"); // Set kolom C1 dengan tulisan "PROJECT"
                $csv->setActiveSheetIndex(0)->setCellValue('E1', "NAMA PRODUK"); // Set kolom D1 dengan tulisan "PRODUK"
                $csv->setActiveSheetIndex(0)->setCellValue('F1', "ISSUED DATE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('G1', "CYCLE"); // Set kolom E1 dengan tulisan "CYCLE"
                $csv->setActiveSheetIndex(0)->setCellValue('H1', "AGENCY"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('I1', "FLAG MEDAN"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('J1', "REMARKS"); // Set kolom G1 dengan tulisan "TOTAL ENVELOP"
                $csv->setActiveSheetIndex(0)->setCellValue('K1', "TANGGAL PROSES"); // Set kolom F1 dengan tulisan "TOTAL PAGES"
                $csv->setActiveSheetIndex(0)->setCellValue('L1', "TAT"); // Set kolom I1 dengan tulisan "DATE APPROVAL SPLOD"
                $csv->setActiveSheetIndex(0)->setCellValue('M1', "MANIFEST"); // Set kolom J1 dengan tulisan "DATE PRINTING"
                $csv->setActiveSheetIndex(0)->setCellValue('N1', "STATUS"); // Set kolom K1 dengan tulisan "DATE INSERTING"
                $csv->setActiveSheetIndex(0)->setCellValue('O1', "PROSES DATE"); // Set kolom L1 dengan tulisan "DATE BALANCING"XF
    
                
    
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

                    $selisih = strtotime($tgl_proses) -  strtotime($proses_date);
                    $hari = $selisih/(60*60*24);
                    $date = $hari * 24;
                    $csv->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->no_urut);
                    $csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->customer);
                    $csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->no_polis);
                    $csv->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->spaj);
                    $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->produk);
                    $csv->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->issued);
                    $csv->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $dateCycle);
                    $csv->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->agency);
                    $csv->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->flagmedan);
                    $csv->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->remarks);
                    $csv->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tgl_proses);
                    $csv->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $date);
                    $csv->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->manifest);
                    $csv->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->status);
                    $csv->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->proses_date);
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
                header('Content-Disposition: attachment; filename="REPORT CUSTOMER POLIS '.$customer_code.'.xlsx"'); // Set nama file excel nya
                header('Cache-Control: max-age=0');
        
                $write = PHPExcel_IOFactory::createWriter($csv, 'Excel2007');
                $write->save('php://output');
            }else{
                $view_polis = $this->model_app->view_non_polis($customer_code, $product, $datefrom, $dateTo);
                $data['view_monitoring'] = $view_polis;


                $data['product'] = $product;
                $data['cycle_from'] = $cycle_from;
                $data['cycle_end'] = $cycle_end;
                $this->load->view('template',$data);
                
            }
        }
    }

    function monitoring_facillity()
    {
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/view_monitoring_facillity";
        $id_dept = trim($this->session->userdata('id_group'));
        $id_user = trim($this->session->userdata('id_user'));

        $view_monitoring_facillity = $this->model_app->view_monitoring_facillity();
        $data['view_monitoring_facillity'] = $view_monitoring_facillity;

        $this->load->view('dashboard_template',$data);
    }

    function export_to_excel(){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/view_monitoring";

        $this->load->view('dashboard_template',$data);
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
        $days = ($endDate - $startDate) / 86400+1;

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
