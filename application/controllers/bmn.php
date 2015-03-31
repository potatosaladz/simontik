<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Bmn extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('unit_model');
		$this->load->model('bmn_model');


		// $this->load->controller('login');


	}


	public function index(){
		
		if($this->isLogged()){
			$this->tampil(5);
		}else{
			$this->load->view('utama');
		}
	}

	public function show(){
		$param=$this->uri->segment(3);
		if($this->isLogged()){
			$this->tampil(5,$param);
		}else{
			$this->load->view('utama');
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

		$result=$this->bmn_model->getBmn();

		$bmn=array(
			'bmn' => $result,
			);
		
		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('bmn',$bmn);
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


}