<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('login_model');
		$this->load->model('unit_model');
		$this->load->model('user_model');

	}

	public function index()
	{
		$this->load->view('utama');
	}

	// Show login page
	public function user_login_show() {
		$this->load->view('utama');
	}

	// Show registration page
	public function user_registration_show() {
		$this->load->view('registration_form');
	}

	// Validate and store registration data in database
	public function new_user_registration() {

	// Check validation for user input in SignUp form
		$this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('registration_form');
		} else {
			$data = array(
				'user_name' => $this->input->post('username'),
				'user_password' => $this->input->post('password')
			);
			$result = $this->login_model->registration_insert($data) ;
			if ($result == TRUE) {
				$data['message_display'] = 'Registration Successfully !';
				$this->load->view('login_form', $data);
			} else {
				$data['message_display'] = 'Username already exist!';
				$this->load->view('registration_form', $data);
			}
		}
	}

	// Check for user login process
	public function process() {

		$this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('utama');
		} else {
			$data = array(
				'username' => strtolower($this->input->post('user')),
				'password' => md5($this->input->post('pass'))
			);

			$result = $this->login_model->login($data);
			if($result == TRUE){
				$sess_array = array(
					'username' => $this->input->post('user')
				);

				// Add user data in session
				// $this->session->set_userdata('logged_in', $sess_array);
				$result = $this->login_model->read_user_information($sess_array);

				if($result != false){
					$data = array(
						'unit' =>$result[0]->unit,
						'username' =>$result[0]->username,
						'nip' =>$result[0]->nip,
						'admin' =>$result[0]->fl_admin
					);
					// $this->load->view('main', $data);
					$this->session->set_userdata('logged_in', $data);
					$unit_array=array(
						'unit2' => $result[0]->unit,
					);
					$res=$this->unit_model->getUnit($unit_array);
					$unit=array(
						'unit2' => $res[0]->unit2,
						'kantor' => $res[0]->kantor
						);
					// $this->load->view('header',$unit);
			  //     	$this->load->view('menu');
			  //     	$this->load->view('monitoring', $data);
			  //     	$this->load->view('footer');
					$arraUser=array(
						'username' => $result[0]->username,
						'password' => md5($result[0]->username)
						);
					$userpass=$this->user_model->cekUserPass($arraUser);
					if($userpass){
						redirect('pengaturan/ubahPass');
					}else{
						redirect('monitoring');
					}
					
				} else {
					$data = array(
						'error_message' => 'Invalid Data'
					);
					$this->load->view('utama', $data);
				}
			}else{
				$data = array(
					'error_message' => 'Invalid Username or Password'
				);
				$this->load->view('utama', $data);
			}
		}
	}

	// Logout from admin page
	public function logout() {

		// Removing session data
		$sess_array = array(
			'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('utama', $data);
	}

	public function isLogged(){
		$log=$this->session->userdata("logged_in");
		if($log==false){
			return false;
		}else{
			return true;
		}
	}
}