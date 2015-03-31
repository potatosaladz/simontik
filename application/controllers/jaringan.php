<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Jaringan extends CI_Controller {

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
		$this->load->model('jaringan_model');
		$this->load->model('jenis_model');
		$this->load->model('kondisi_model');
		$this->load->model('merk_model');

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

		if($this->isLogged()){	
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
				$data=array(
					'jenis' => $param,
					'hapus' => 0
				);
			}else{
				$data=array(
					't_hajar.unit' => $res[0]->unit2,
					'jenis' => $param,
					'hapus' => 0
				);
			}
			// $limit=5;

			$ref_jenis=$this->jenis_model->getAllJenis();



			foreach ($ref_jenis as $row) {
				$ref[$row['id']]=$row['nmjenis'];
			}
			$jaringan=$this->jaringan_model->getJaringan($data,$limit);
			$result=array(
				'jaringan' => $jaringan,
				'param_jenis' => $param,
				'ref_jenis' => $ref
				);

			// print_r($result);
			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	$this->load->view('jaringan',$result);
	      	$this->load->view('footer');
	      }else{
			$this->load->view('utama');
		}
	}


	public function rekam($param=null){

		if($this->isLogged()){
			$ses=$this->session->userdata('logged_in');

			$unit_array=array(
				'unit2' => $ses['unit'],
			);
			$res=$this->unit_model->getUnit($unit_array);
			$unit=array(
				'unit2' => $res[0]->unit2,
				'kantor' => $res[0]->kantor
				);
			if(isset($param) && $param!=null){
				$id_jenis=$param;
			}else{
				$id_jenis=$this->input->post('jenis');
			}
			$parJenis=array(
				'id' => $id_jenis
				);
			$jenis=$this->jenis_model->getJenis($parJenis);
			$merk=$this->merk_model->getAllMerk();
			$kondisi=$this->kondisi_model->getAllKondisi();


			$data=array(
				'jenis' =>$jenis,
				'merk' => $merk,
				'kondisi' => $kondisi,
				'param_jenis' => $param,
				);
			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	$this->load->view('rekam_jaringan',$data);
	      	$this->load->view('footer');
	      }else{
			$this->load->view('utama');
		}
	}

	public function simpan(){
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sn', 'Serial Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ip', 'IP', 'trim|required|xss_clean');
		$this->form_validation->set_rules('port', 'Port', 'trim|required|xss_clean');

		$ses=$this->session->userdata('logged_in');
		$date_created=date('Y-m-d H:i:s');
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


		$arr2=array(
			't_hajar.unit'=>$ses['unit'],
			't_hajar.tahun' => $this->input->post('tahun'),
			't_hajar.jenis' => $this->input->post('jenis'),
			't_hajar.merk' => $this->input->post('merk'),
			't_hajar.hapus' => 0
			);

		$hardware=$this->jaringan_model->getJaringanCount($arr2,0);

		if($hardware==0){
			$urut=1;
		}else{
			$urut=$hardware+1;
		}
		
		$arrUnit=array(
			'unit2' => $ses['unit'],
		);
		
		$unitnya=$this->unit_model->getUnit2($arrUnit);
		
		foreach($unitnya as $row3){
			$kppn=(string) $row3['kdkppn'];
			$kdkanwil=(string) $row3['kdkanwil'];
		}

		if ($this->form_validation->run() == FALSE) {
			$this->rekam();
		} else {
			$data = array(
				'id_hardware' => "KOM".$this->input->post('jenis').$this->input->post('tahun').$this->input->post('merk').$kppn.$kdkanwil.$urut,
				'unit' => $ses['unit'],
				'jenis' => $this->input->post('jenis'),
				'merk' => $this->input->post('merk'),
				'tipe' => $this->input->post('tipe'),
				'sn' => $this->input->post('sn'),
				'ip' => $this->input->post('ip'),
				'kondisi' => $this->input->post('kondisi'),
				'tahun' => $this->input->post('tahun'),
				'bmn' => $this->input->post('bmn'),
				'keterangan' => $this->input->post('ket'),
				'date_created' => $date_created,
				'port' => $this->input->post('port'),
				'ip_rekam' => $ipaddress,
			);

			$result = $this->jaringan_model->jaringan_insert($data) ;
			if ($result == TRUE) {
				$data['message_display'] = 'Insert Success !';
				$this->tampil(10,$this->input->post('jenis'));
			} else {
				$data['message_display'] = 'Insert Failed!';
				$this->rekam($this->input->post('jenis'));
			}
		}
	}

	public function ubah($id_ubah,$jen){


		if($this->isLogged()){
			$ses=$this->session->userdata('logged_in');

			$unit_array=array(
				'unit2' => $ses['unit'],
			);
			$res=$this->unit_model->getUnit($unit_array);
			$unit=array(
				'unit2' => $res[0]->unit2,
				'kantor' => $res[0]->kantor
				);

			if(isset($jen)){
				$param_jenis=$jen;
			}else{
				$param_jenis=$this->uri->segment(4);
			}

			$parJenis=array(
				'id' => $param_jenis
				);
			$jenis=$this->jenis_model->getJenis($parJenis);
			$merk=$this->merk_model->getAllMerk();
			$kondisi=$this->kondisi_model->getAllKondisi();

			if(isset($id_ubah)){
				$param=$id_ubah;
			}else{
				$param=$this->uri->segment(3);
			}

			$id=array(
				't_hajar.id' => $param,
				);
			$res=$this->jaringan_model->getJaringanById($id);

			$data=array(
				'jenis' =>$jenis,
				'merk' => $merk,
				'kondisi' => $kondisi,
				'jaringan' => $res,
				'param_jenis' => $param_jenis,
			);

			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	$this->load->view('rekam_jaringan',$data);
	      	$this->load->view('footer');
		}else{
			$this->load->view('utama');
		}
		
	}

	public function update(){
		
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sn', 'Serial Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ip', 'IP', 'trim|required|xss_clean');
		$this->form_validation->set_rules('port', 'Port', 'trim|required|xss_clean');

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


		if ($this->form_validation->run() == FALSE) {
			$this->ubah($this->input->post('id'));
		} else {
			$data = array(
				'merk' => $this->input->post('merk'),
				'tipe' => $this->input->post('tipe'),
				'sn' => $this->input->post('sn'),
				'ip' => $this->input->post('ip'),
				'kondisi' => $this->input->post('kondisi'),
				'tahun' => $this->input->post('tahun'),
				'bmn' => $this->input->post('bmn'),
				'keterangan' => $this->input->post('ket'),
				'date_updated' => $date_updated,
				'port' => $this->input->post('port'),
				'ip_rekam' => $ipaddress,
			);

			$result = $this->jaringan_model->jaringan_update($data,$this->input->post('id')) ;
			if ($result == TRUE) {
				$data['message_display'] = 'Update Success !';
				$this->tampil(10,$this->input->post('jenis'));
			} else {
				$data['message_display'] = 'Update Failed!';
				$this->ubah($this->input->post('id'));
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



		$data = array(
			'hapus' => 1,
			'date_updated' => $date_updated,
			'ip_rekam' => $ipaddress
		);

		$jenis=$this->uri->segment(4);

		$result = $this->jaringan_model->jaringan_update($data,$id) ;
		if ($result == TRUE) {
			$data['message_display'] = 'Delete Success !';
			$this->tampil(10,$jenis);
		} else {
			$data['message_display'] = 'Delete Failed!';
			$this->tampil(10,$jenis);
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
}