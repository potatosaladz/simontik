<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Pengaturan extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		$this->load->model('unit_model');
		$this->load->model('user_model');
		$this->load->model('ttd_model');
	}

	public function index(){
		
		if($this->isLogged()){
			$this->tampil(5);
		}else{
			$this->load->view('utama');
		}
	}

	public function show(){
		
		if($this->isLogged()){
			$param=$this->uri->segment(3);
			$this->tampil(5,$param);
		}else{
			$this->load->view('utama');
		}
		
	}

	public function isLogged(){
		$log=$this->session->userdata("logged_in");
		if($log==false){
			return false;
		}else{
			return true;
		}
	}

	public function tampil($limit,$param=null){

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);

		$admin=$ses['admin'];
		
		$res2=$this->unit_model->getUnitAll();


		$result=array(
			'unitAll' => $res2,
			'rekam' => true,
			'update' => false,
			'admin' =>$ses['admin'],
			);


		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	if($this->isLogged() && $admin==1){
      		$this->load->view('rekam3',$result);
      	}else{
      		redirect('monitoring');
      	}
      	$this->load->view('footer');
	}

	public function ubahPass(){
		$this->ubah(null,false);
	}

	public function ubah($message=null,$error=false){
		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);

		$admin=$ses['admin'];

		$arr=array(
			'unit' => $ses['unit'],
			'username' => $ses['username'],
			);

		if($admin==1){
			$res2=$this->unit_model->getUnitAll();
		}else{
			$res2=$this->unit_model->getUnit2($unit_array);
		}
		
		
		$user=$this->user_model->getUser($arr);
		if($error){
			$msg='error_message';
		}else{
			$msg='message_display';
		}

		$result=array(
			'unitAll' => $res2,
			'rekam' => false,
			'update' => true,
			'user' => $user,
			'admin' =>$ses['admin'],
			$msg => $message,
			'error' => $error,
			);


		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	if($this->isLogged()){
      		$this->load->view('rekam3',$result);
      	}else{
      		redirect('monitoring');
      	}
      	$this->load->view('footer');
	}


	public function simpan(){

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean');

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);
		$res2=$this->unit_model->getUnitAll();


		$result=array(
			'unitAll' => $res2,
			'rekam' => true,
			'update' => false,
			'admin' =>$ses['admin'],
			);
		$date_created=date('Y-m-d H:i:s');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header',$unit);
			$this->load->view('rekam3',$result);
			$this->load->view('footer');
		} else {
			$data = array(
				'username' => strtolower($this->input->post('username')),
				'password' => md5($this->input->post('password')),
				'nip' => $this->input->post('nip'),
				'unit' => $this->input->post('unit'),
				'fl_admin' => (int) $this->input->post('admin'),
				'date_created' => $date_created,
			);

			$arr=array(
				'lower(username)' => strtolower($this->input->post('username')),
				);
			$dobel=$this->user_model->cekUser($arr);

			if($dobel){
				$result=array(
					'unitAll' => $res2,
					'rekam' => true,
					'update' => false,
					'message_display' => 'Username already exist!',
					'admin' =>$ses['admin'],
				);
				$this->load->view('header',$unit);
				$this->load->view('rekam3',$result);
				$this->load->view('footer');
			}else{
				$result = $this->user_model->User_insert($data);
				if ($result == TRUE) {
					$result=array(
						'unitAll' => $res2,
						'rekam' => true,
						'update' => false,
						'message_display' => 'Registration Successfully !',
						'admin' =>$ses['admin'],
					);
					$this->load->view('header',$unit);
					$this->load->view('rekam3',$result);
					$this->load->view('footer');
				} else {
					$result=array(
						'unitAll' => $res2,
						'rekam' => true,
						'update' => false,
						'message_display' => 'Failed to save!',
						'admin' =>$ses['admin'],
					);
					$this->load->view('header',$unit);
					$this->load->view('rekam3',$result);
					$this->load->view('footer');
				}
			}
			
		}
	}


	public function update(){

		//$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean');

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);
		$admin=$ses['admin'];
		if($admin==1){
			$res2=$this->unit_model->getUnitAll();
		}else{
			$res2=$this->unit_model->getUnit2($unit_array);
		}
		$result=array(
			'unitAll' => $res2,
			'rekam' => false,
			'update' => true,
			'admin' =>$ses['admin'],
			);
		$date_created=date('Y-m-d H:i:s');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header',$unit);
			$this->load->view('rekam3',$result);
			$this->load->view('footer');
		} else {
			if($ses['admin']==1){
				$data = array(
					//'username' => strtolower($this->input->post('username')),
					'password' => md5($this->input->post('password')),
					'nip' => $this->input->post('nip'),
					'fl_admin' => (int) $this->input->post('admin'),
				);
			}else{
				$data = array(
					//'username' => strtolower($this->input->post('username')),
					'password' => md5($this->input->post('password')),
					'nip' => $this->input->post('nip'),
				);
			}

			$id=$this->input->post('id');
			if(strtolower($this->input->post('username'))==strtolower($this->input->post('password'))){
				$result=array(
					'unitAll' => $res2,
					'rekam' => true,
					'update' => false,
					'error_message' => 'Failed to save!',
					'admin' =>$ses['admin'],
				);
				$this->ubah('Username dan Password tidak boleh sama!',true);
			}else{
				$result = $this->user_model->User_update($data,$id);
				if ($result == TRUE) {
					$result=array(
						'unitAll' => $res2,
						'rekam' => true,
						'update' => false,
						'message_display' => 'Update Successfully !',
						'admin' =>$ses['admin'],
					);
					// $this->load->view('header',$unit);
					// $this->load->view('rekam3',$result);
					// $this->load->view('footer');
					$this->ubah('Update Successfully !',false);
				} else {
					$result=array(
						'unitAll' => $res2,
						'rekam' => true,
						'update' => false,
						'error_message' => 'Failed to save!',
						'admin' =>$ses['admin'],
					);
					$this->ubah('Failed to save!',true);
					// $this->load->view('header',$unit);
					// $this->load->view('rekam3',$result);
					// $this->load->view('footer');
				}
			}
						
			
		}
	}


	public function ttd(){
		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);

		$admin=$ses['admin'];

		$result=array(
			'rekam' => true,
			'update' => false,
			);


		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	if($this->isLogged()){
      		$this->load->view('rekam4',$result);
      	}else{
      		redirect('monitoring');
      	}
      	$this->load->view('footer');
	}


	public function ttdsimpan(){

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean');

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);

		/* $result=array(
			'rekam' => true,
			'update' => false,
			); */

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header',$unit);
			$this->load->view('rekam4',$result);
			$this->load->view('footer');
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'nip' => $this->input->post('nip'),
				'unit' => $ses['unit'],
			);

			$arr=array(
				'unit' =>  $ses['unit'],
				);
			$dobel=$this->ttd_model->cekTtd($arr);

			if($dobel){
				$result=array(
					'rekam' => true,
					'update' => false,
					'message_display' => 'Pejabat Penandatangan sudah ada!',
				);
				$this->load->view('header',$unit);
				$this->load->view('rekam4',$result);
				$this->load->view('footer');
			}else{
			//print_r($data);
				$result2 = $this->ttd_model->Ttd_insert($data);
				if ($result2) {
					$result=array(
						'rekam' => true,
						'update' => false,
						'message_display' => 'Input Penandatangan Successfully !',
					);
					$this->load->view('header',$unit);
					$this->load->view('rekam4',$result);
					$this->load->view('footer');
				} else {
					$result=array(
						'rekam' => true,
						'update' => false,
						'error_message' => 'Failed to save!',
					);
					$this->load->view('header',$unit);
					$this->load->view('rekam4',$result);
					$this->load->view('footer');
				}
			}
			
		}

	}

	public function ubahttd(){
		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);


		$arr=array(
			'unit' => $ses['unit'],
			);

		$ttd=$this->ttd_model->getTtd($arr);

		$result=array(
			'rekam' => false,
			'update' => true,
			'ttd' => $ttd,
			);


		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	if($this->isLogged()){
      		$this->load->view('rekam6',$result);
      	}else{
      		redirect('monitoring');
      	}
      	$this->load->view('footer');
	}

	public function ttdupdate(){

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|xss_clean');

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);

		$arr=array(
			'unit' => $ses['unit'],
			);

		$ttd=$this->ttd_model->getTtd($arr);

		$result=array(
			'rekam' => false,
			'update' => true,
			'ttd' => $ttd,
			);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header',$unit);
			$this->load->view('rekam4',$result);
			$this->load->view('footer');
		} else {
			$data = array(
				'nama' =>$this->input->post('nama'),
				'jabatan' =>$this->input->post('jabatan'),
				'nip' => $this->input->post('nip'),
			);

			$id=$this->input->post('id');
			
			$result = $this->ttd_model->Ttd_update($data,$id);
			if ($result == TRUE) {
				$ttd=$this->ttd_model->getTtd($arr);
				$result=array(
					'rekam' => false,
					'update' => true,
					'ttd' => $ttd,
					'message_display' => 'Update Successfully !',
				);
				$this->load->view('header',$unit);
				$this->load->view('rekam6',$result);
				$this->load->view('footer');
			} else {
				$result=array(
					'rekam' => false,
					'update' => true,
					'message_display' => 'Failed to update!',
					'ttd' => $ttd,
				);
				$this->load->view('header',$unit);
				$this->load->view('rekam4',$result);
				$this->load->view('footer');
			}
			
			
		}
	}

}