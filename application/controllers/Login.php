<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('model_app');
        
    }

    
function index()
    {
        $data = "";

        $this->load->view('login', $data);
    }


  function login_akses()
  {

  	$username = trim($this->input->post('username'));
  	$password = md5(trim($this->input->post('password')));
	  
			if (!$this->session->userdata('authenticated')){
			$akses = $this->db->query("select A.user_name, A.name, A.user_group_id, B.user_group_name, A.user_id, D.customer_code FROM xpr_user A 
			LEFT JOIN xpr_user_group B ON B.user_group_id = A.user_group_id LEFT JOIN xpr_user_customer C ON C.user_id = A.user_id 
			LEFT JOIN xpr_customer D ON D.customer_id = C.customer_id 
			WHERE A.user_name = '$username' AND A.password = '$password'");
		
			if($akses->num_rows() == 1)
			{
			
			foreach($akses->result_array() as $data)
			{
			// $this->session->sess_start();
			$session = array(
				'authenticated'=>true, // Buat session authenticated dengan value true
				'id_user'=>$data['user_name'],  // Buat session username
				'nama'=>$data['name'], // Buat session nama
				'user_id'=>$data['user_id'], // Buat session role
				'level' =>$data['user_group_name'],
				'id_group' =>$data['user_group_id'],
				'customer_code' =>  $data['customer_code']
			  );
			// $session['id_user'] = $data['user_name'];
			// $session['nama'] =	$data['name'];
			// $session['user_id'] = $data['user_id'];
			// $session['level'] = $data['user_group_name'];
			// $session['id_group'] = $data['user_group_id'];
			// $session['customer_code'] = $data['customer_code'];
			
			$this->session->set_userdata($session);
			
			}
			// $checkingLogin = $this->checkingLogin();
			// if ($checkingLogin == false){
				$insert_log = $this->user_post();
				if ($insert_log == 'Data is inserted successfully'){
					redirect('home');
				}else{
					$this->session->set_flashdata("msg", "<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<i class='material-icons'>close</i>
					</button>
					<span>
					Please check again. !</br>
					</div>");
					redirect('login');
				}
			// }else{
			// 	$this->session->set_flashdata("msg", "<div class='alert alert-danger'>
			// 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			// 	<i class='material-icons'>close</i>
			// 	</button>
			// 	<span>
			// 	Please use another user !</br>
			// 	</div>");
			// 	redirect('login');
			// }

			
			}
			else
			{
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<i class='material-icons'>close</i>
						</button>
						<span>
						  Username / Password Wrong !</br>
						  Please check Username & Password </br>
						</div>");
			redirect('login');
			}

		}else{
				$this->session->set_flashdata("msg", "<div class='alert alert-danger'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<i class='material-icons'>close</i>
				</button>
				<span>
				Please use another user !</br>
				</div>");
				redirect('login');
		}
  }


  public function logout() {
	$this->session->sess_destroy();
	redirect('login');
  }

  public function checkingLogin(){
	$currentDateTime = date('Y-m-d H:i:s');
	$dataSession = array('username' => $this->session->userdata('id_user'), 'dateCheckIn' => $currentDateTime);
	$check_login = $this->model_app->check_login_session($dataSession);
	return $check_login;
  }
  public function user_post(){
	$currentDateTime = date('Y-m-d H:i:s');
	$expiredlogin = date("Y-m-d H:i:s", strtotime("+15 minutes"));
	$data = array('username' => $this->session->userdata('id_user'),
	'user_group' => $this->session->userdata('id_group'),
	'lastlogin' => $currentDateTime,
	'expiredlogin' => $expiredlogin
	);

	$r = $this->model_app->insert_datalog($data);
	return $r; 
	}


    
}
