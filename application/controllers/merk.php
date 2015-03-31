<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Merk extends CI_Controller {

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
		$this->load->model('merk_model');
	}

	public function index(){
		
		if($this->isLogged() && $this->isAdmin()){
			$this->tampil(5);
		}else{
			redirect('monitoring');
		}
	}

	public function show(){
		
		if($this->isLogged() && $this->isAdmin()){
			$param=$this->uri->segment(3);
			$this->tampil(5,$param);
		}else{
			//$this->load->view('utama');
			redirect('monitoring');
		}
		
	}

	public function tampil($limit,$param){
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

		// $limit=5;
		$merk=$this->merk_model->getAllMerk();

		$result=array(
			'merk' => $merk,
			'admin' => $admin,
			);

		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('merk',$result);
      	$this->load->view('footer');
	}

	public function isLogged(){
		$log=$this->session->userdata("logged_in");
		if($log==false){
			return false;
		}else{
			return true;
		}
	}

	public function isAdmin(){
		$log=$this->session->userdata("logged_in");
		if($log['admin']==0){
			return false;
		}else{
			return true;
		}
	}


	public function rekam(){

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
		
		//$res2=$this->unit_model->getUnitAll();


		$result=array(
			//'unitAll' => $res2,
			'rekam' => true,
			'update' => false,
			'admin' =>$ses['admin'],
			);


		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	if($this->isLogged() && $admin==1){
      		$this->load->view('rekam8',$result);
      	}else{
      		redirect('monitoring');
      	}
      	$this->load->view('footer');
	}

	public function ubah(){
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
			'id' => $this->uri->segment(3),
			);

		$merk=$this->merk_model->getMerk($arr);

		$result=array(
			'rekam' => false,
			'update' => true,
			'merk' => $merk,
			//'admin' =>$ses['admin'],
			);


		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	if($this->isLogged() && $this->isAdmin()){
      		$this->load->view('rekam8',$result);
      	}else{
      		redirect('monitoring');
      	}
      	$this->load->view('footer');
	}


	public function simpan(){

		$this->form_validation->set_rules('merk', 'Merk', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('judul', 'Judul', 'trim|required|xss_clean');

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);
		//$res2=$this->unit_model->getUnitAll();


		$result=array(
			//'unitAll' => $res2,
			'rekam' => true,
			'update' => false,
			'admin' =>$ses['admin'],
			);
		$date_created=date('Y-m-d H:i:s');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header',$unit);
			$this->load->view('rekam8',$result);
			$this->load->view('footer');
		} else {
			$data = array(
				'nmmerk' => $this->input->post('merk'),
				//'judul' => $this->input->post('judul'),
				//'user' => $this->session->userdata('username'),
				//'date_created' => $date_created,
			);


			$result = $this->merk_model->Merk_insert($data);
			$merk=$this->merk_model->getAllMerk();
			if ($result == TRUE) {
				$result=array(
					'rekam' => true,
					'update' => false,
					'merk' => $merk,
					'message_display' => 'Insert Successfully !',
				);
				$this->load->view('header',$unit);
				$this->load->view('merk',$result);
				$this->load->view('footer');
			} else {
				$result=array(
					'rekam' => true,
					'update' => false,
					'message_display' => 'Failed to save!',
				);
				$this->load->view('header',$unit);
				$this->load->view('rekam8',$result);
				$this->load->view('footer');
			}

			
		}
	}


	public function update(){

		//$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('merk', 'Merk', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('judul', 'judul', 'trim|required|xss_clean');

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);

		$result=array(
			'rekam' => false,
			'update' => true,
			'admin' =>$ses['admin'],
			);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('header',$unit);
			$this->load->view('rekam8',$result);
			$this->load->view('footer');
		} else {
			$data = array(
				//'username' => strtolower($this->input->post('username')),
				'merk' => $this->input->post('merk'),
				//'judul' => $this->input->post('judul'),
			);

			$id=$this->input->post('id');
			
			$result = $this->merk_model->Merk_update($data,$id);
			$merk=$this->merk_model->getAllMerk();
			if ($result == TRUE) {
				$result=array(
					'rekam' => true,
					'update' => false,
					'merk' => $merk,
					'message_display' => 'Update Successfully !',
					'admin' =>$ses['admin'],
				);
				$this->load->view('header',$unit);
				$this->load->view('merk',$result);
				$this->load->view('footer');
			} else {
				$result=array(
					'rekam' => true,
					'update' => false,
					'message_display' => 'Failed to save!',
					'admin' =>$ses['admin'],
				);
				$this->load->view('header',$unit);
				$this->load->view('rekam8',$result);
				$this->load->view('footer');
			}
			
			
		}
	}


	public function hapus(){
		$id=$this->uri->segment(3);

		$date_updated=date('Y-m-d H:i:s');
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
		    $ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
		    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
		    $ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
		    $ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		    $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
		    $ipaddress = getenv('REMOTE_ADDR');
		else
		    $ipaddress = 'UNKNOWN';

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);



		$data = array(
			'hapus' => 1,
			//'ip_rekam' => $ipaddress
		);

		$result = $this->merk_model->merk_update($data,$id) ;
		$merk=$this->merk_model->getAllMerk();

		if($this->isLogged() && $this->isAdmin()){
			if ($result == TRUE) {
			
				$result=array(
						'rekam' => true,
						'update' => false,
						'merk' => $merk,
						'message_display' => 'Delete Success !',

					);
				
			} else {
				
				$result=array(
						'rekam' => true,
						'update' => false,
						'merk' => $merk,
						'message_display' => 'Delete Failed!',

					);
			}
		}else{
			redirect('monitoring');
		}		

		
		$this->load->view('header',$unit);
		$this->load->view('berita',$result);
		$this->load->view('footer');
		
	}


	
}