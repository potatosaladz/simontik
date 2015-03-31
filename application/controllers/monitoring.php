<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Monitoring extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		$this->load->model('unit_model');
		$this->load->model('server_model');
		$this->load->model('jaringan_model');
		$this->load->model('berita_model');
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

		if($admin==1){
			$array=array(
				'hapus' => 0,
			);
		}else{
			$array=array(
				'hapus' => 0,
				'unit' => $ses['unit'],
			);
		}
		
		$res2=$this->unit_model->getUnit3($ses['unit']);
		$server=$this->server_model->getServerAll($array);
		$jaringan=$this->jaringan_model->getJaringanAll($array);
		$berita=$this->berita_model->getBeritaUtama();

		$result=array(
			'server' => $server,
			'jaringan' => $jaringan, 
			'bio' => $res2,
			'berita' => $berita,
			);

		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('monitoring',$result);
      	$this->load->view('footer');
	}

}