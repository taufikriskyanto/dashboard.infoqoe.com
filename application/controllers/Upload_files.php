<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_files extends CI_Controller {


  function __construct(){
    parent::__construct();
    $this->load->model('model_app');
    if(!$this->session->userdata('id_user')){
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
        $data['body'] = "body/upload_files";
        $data['save_data'] = "upload_files/save_file";

        $customer_code = trim($this->session->userdata('customer_code'));
        $get_file = $this->model_app->get_file($customer_code);
        $data['get_file'] = $get_file;


        $this->load->view('template',$data);
    }
    
    public function file_pd($flag){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/PRU/prufile_pd";
        $data['search'] = "upload_files/file_pd/search";
        // $data['download'] = "upload_files/download_file_pd/";
        $vendor = "";
        $cycle  = "";
        $data['flag'] = $flag;
        if ($flag=='view'){
            // $data['customer_id'] = $customer_id;
            // $data['cyle_from'] =  $cyle_from;
            $data['cycle'] =  $cycle;
            $data['vendor'] = $vendor;
            $get_file = $this->model_app->search_file_pd($data);
            $data['get_file'] = $get_file;
            
        }else {
            $data['cycle'] = $this->input->post('cycle');
            $data['vendor'] = $this->input->post('vendor');
            $get_file = $this->model_app->search_file_pd($data);
            $data['get_file'] = $get_file;
        }

        $this->load->view('template',$data);
    }

    public function data_hold_customer($flag){
        $data['header'] = "header/header";
        $data['footer'] = "footer/footer";
        $data['body'] = "body/data_hold_customer";
        $data['search'] = "upload_files/data_hold_customer/search";
        $data['customer'] = $this->model_app->dropdown_customer();
        $customer_id = "";
        $cyle = "";
        $data['flag'] = $flag;
        if ($flag=='view'){
            $data['customer_id'] = $customer_id;
            $data['cycle'] =  $cyle;
            $get_file = $this->model_app->search_data_hold($data);
            $data['get_file'] = $get_file;
            
        }else {
            $data['customer_id'] = $this->input->post('customer_id');
			$data['cycle'] = $this->input->post('cycle');
            
            $get_file = $this->model_app->search_data_hold($data);
            $data['get_file'] = $get_file;
        }

        $this->load->view('template',$data);
    }
    
    
    public function download_file_pd($id)
    {
    $this->load->helper('download');
    $fileinfo = $this->model_app->download_pd($id);
    $file =  'log/PD/done/'.$fileinfo['nama_file'];
    force_download($file, NULL);
    
    }


    public function delete_file($id_file){
        $this->db->where('id_file', $id_file);
        $success = $this->db->delete('xpr_customer_file');
        if ($success === FALSE){
          $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <i class='material-icons'>close</i>
          </button>
          <span>
          <b> Failed - </b> Deleted File Fail </span>
          </div>");
              redirect('upload_files');
        }else{
          $this->session->set_flashdata("msg", "<div class='alert alert-success'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <i class='material-icons'>close</i>
          </button>
          <span>
          <b> Success - </b> Delete File Successfully </span>
          </div>");
              redirect('upload_files');
        }
    }
    
	public function save_file(){
		//validate the form data 

		$this->form_validation->set_rules('info_file', 'cycle_file', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='material-icons'>close</i>
            </button>
            <span><b> Failed - </b> Please, field do not empty</span>
            </div>");
            redirect('upload_files');	
		}else{
			
			//get the form values
			$data['info_file'] = $this->input->post('info_file', TRUE);
			$data['cycle_file'] = $this->input->post('cycle_file', TRUE);
			$type_data = $this->input->post('type_data', TRUE);

			//file upload code 
            //set file upload settings 
            $customer_code = trim($this->session->userdata('customer_code'));
            $cycle_path = str_replace('/','',$data['cycle_file']); 
            // $config['upload_path']          = APPPATH. '../uploads/'.$customer_code.'/';
            $config['upload_path']          = 'uploads/'.$type_data.'/'.$customer_code.'/'.$cycle_path.'/';
            if (!is_dir('uploads/'.$type_data.'/'.$customer_code.'/'.$cycle_path.'/')) {
                mkdir('./uploads/'.$type_data.'/'.$customer_code.'/'.$cycle_path.'/', 0777, TRUE);
            
            }
            $config['allowed_types'] = 'xls|doc|docx|xlsx|rar|zip';
            $config['max_size']      = '8192'; 
            $config['remove_spaces']=TRUE;  //it will remove all spaces
            // $config['encrypt_name']=TRUE; 

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('myfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata("msg", "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='material-icons'>close</i>
                </button>
                <span><b> ".$error." </span>
                </div>");
                redirect('upload_files');	
			}else{

				//file is uploaded successfully
				//now get the file uploaded data 
				$upload_data = $this->upload->data();

				//get the uploaded file name
				$data['myfile'] = $upload_data['file_name'];
                $data['path_file'] = $config['upload_path'] ;
                $data['customer_code'] = $customer_code;
                $data['type_data'] = $type_data;
				//store pic data to the db
                // $this->model_app->store_pic_data($data);
                
                if ($this->model_app->save_files($data)){
                    
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span><b> Success - </b> Upload File Successfully</span>
                    </div>");
                    redirect('upload_files');
                
                    
                }else{
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='material-icons'>close</i>
                    </button>
                    <span><b> Fail - </b> Upload File Failed</span>
                    </div>");
                    redirect('upload_files');
                }
                
		
			}
			// $this->load->view('footer');
		}
	}
}
?>