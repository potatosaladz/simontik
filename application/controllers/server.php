<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Server extends CI_Controller {

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
		$this->load->model('server_model');
		$this->load->model('jenis_model');
		$this->load->model('merk_model');
		$this->load->model('os_model');
		$this->load->model('kondisi_model');
		$this->load->model('antivirus_model');
		$this->load->model('printer_model');

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


		$ref_jenis=$this->jenis_model->getAllJenis();



		foreach ($ref_jenis as $row) {
			$ref[$row['id']]=$row['nmjenis'];
		}
		if($admin==1){
			$data=array(
				'jenis' => $param,
				'hapus' => 0
			);
		}else{
			$data=array(
				't_hardware.unit' => $res[0]->unit2,
				'jenis' => $param,
				'hapus' => 0
			);
		}
		// $limit=5;
		if($param==1 or $param==2 or $param==3){
			$server=$this->server_model->getServer($data,$limit);
		}else if($param==6){
			$server=$this->server_model->getServer3($data,$limit);
		}else if($param==10){
			$server=$this->server_model->getServerLain($data,$limit);
		}else{
			$server=$this->server_model->getServer2($data,$limit);
		}
		$result=array(
			'server' => $server,
			'param_jenis' => $param,
			'ref_jenis' => $ref
			);

		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('server',$result);
      	$this->load->view('footer');
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
			if(isset($param) && $param!==null){
				$id_jenis=$param;
			}else{
				$id_jenis=$this->input->post('jenis');
			}
			$parJenis=array(
				'id' => $id_jenis
				);
			$jenis=$this->jenis_model->getJenis($parJenis);
			$merk=$this->merk_model->getAllMerk();
			$os=$this->os_model->getAllOs();
			$kondisi=$this->kondisi_model->getAllKondisi();
			$antivirus=$this->antivirus_model->getAllAntivirus();
			$printer=$this->printer_model->getAllPrinter();


			$data=array(
				'jenis' =>$jenis,
				'merk' => $merk,
				'os' => $os,
				'kondisi' => $kondisi,
				'antivirus' => $antivirus,
				'param_jenis' => $param,
				'printer' => $printer,
				);
			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	if($id_jenis==1 or $id_jenis==2 or $id_jenis==3){
	      		$this->load->view('rekam',$data);
	      	}else{
	      		$this->load->view('rekam2',$data);
	      	}
	      	$this->load->view('footer');
			
		}else{
			$this->load->view('utama');
		}
		
	}

	public function simpan(){
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sn', 'Serial Number', 'trim|required|xss_clean');
		if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){
			$this->form_validation->set_rules('ip', 'IP', 'trim|required|xss_clean');
			$this->form_validation->set_rules('prosesor', 'Prosesor', 'trim|required|xss_clean');
			$this->form_validation->set_rules('memori', 'Memory', 'trim|required|xss_clean');
			$this->form_validation->set_rules('hdd', 'HDD', 'trim|required|xss_clean');
		}

		
		
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
			't_hardware.unit'=>$ses['unit'],
			't_hardware.tahun' => $this->input->post('tahun'),
			't_hardware.jenis' => $this->input->post('jenis'),
			't_hardware.merk' => $this->input->post('merk'),
			't_hardware.hapus' => 0
			);
			
		$arrUnit=array(
			'unit2' => $ses['unit'],
		);
		
		$unitnya=$this->unit_model->getUnit2($arrUnit);
		
		foreach($unitnya as $row3){
			$kppn=(string) $row3['kdkppn'];
			$kdkanwil=(string) $row3['kdkanwil'];
		}

		$hardware=$this->server_model->getServerCount($arr2);

		if($hardware==0){
			$urut=1;
		}else{
			$urut=$hardware+1;
		}


		if ($this->form_validation->run() == FALSE) {
			$this->rekam();
		} else {
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $os=$this->input->post('os'); } else { $os=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $ip=$this->input->post('ip'); }else { $ip=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $prosesor=$this->input->post('prosesor'); }else { $prosesor=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $memori=$this->input->post('memori'); }else { $memori=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $hdd=$this->input->post('hdd'); }else { $hdd=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $antivirus=$this->input->post('antivirus'); }else { $antivirus=null;}
			if($this->input->post('jenis')==6 ){ $printer=$this->input->post('printer'); }else { $printer=null;}
			$data = array(
				'id_hardware' => "DUK".$this->input->post('jenis').$this->input->post('merk').$this->input->post('tahun').$this->input->post('os').$kppn.$kdkanwil.$urut,
				'unit' => $ses['unit'],
				'jenis' => $this->input->post('jenis'),
				'merk' => $this->input->post('merk'),
				'tipe' => $this->input->post('tipe'),
				'sn' => $this->input->post('sn'),
				'os' => $os,
				'ip' => $ip,
				'prosesor' => $prosesor,
				'memori' => $memori,
				'bmn' => $this->input->post('bmn'),
				'hdd' => $hdd,
				'kondisi' => $this->input->post('kondisi'),
				'tahun' => $this->input->post('tahun'),
				'antivirus' => $antivirus,
				'keterangan' => $this->input->post('ket'),
				'date_created' => $date_created,
				'ip_rekam' => $ipaddress,
				'printer' => $printer,
			);

			$result = $this->server_model->server_insert($data) ;
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
			$os=$this->os_model->getAllOs();
			$kondisi=$this->kondisi_model->getAllKondisi();
			$antivirus=$this->antivirus_model->getAllAntivirus();
			$printer=$this->printer_model->getAllPrinter();

			if(isset($id_ubah)){
				$param=$id_ubah;
			}else{
				$param=$this->uri->segment(3);
			}

			$id=array(
				't_hardware.id' => $param,
				);
			if($param_jenis==1 or $param_jenis==2 or $param_jenis==3){
				$res=$this->server_model->getServerById($id);
			}else{
				$res=$this->server_model->getServerById2($id);
			}

			$data=array(
				'jenis' =>$jenis,
				'merk' => $merk,
				'os' => $os,
				'kondisi' => $kondisi,
				'antivirus' => $antivirus,
				'hardware' => $res,
				'printer' => $printer,
				'param_jenis' => $param_jenis,
			);

			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	if($param_jenis==1 or $param_jenis==2 or $param_jenis==3){
	      		$this->load->view('rekam',$data);
	      	}else{
	      		$this->load->view('rekam2',$data);
	      	}
	      	$this->load->view('footer');
		}else{
			$this->load->view('utama');
		}
		
	}

	public function update(){
		
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sn', 'Serial Number', 'trim|required|xss_clean');
		if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){
			$this->form_validation->set_rules('ip', 'IP', 'trim|required|xss_clean');
			$this->form_validation->set_rules('prosesor', 'Prosesor', 'trim|required|xss_clean');
			$this->form_validation->set_rules('memori', 'Memory', 'trim|required|xss_clean');
			$this->form_validation->set_rules('hdd', 'HDD', 'trim|required|xss_clean');
		}

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
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $os=$this->input->post('os'); } else { $os=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $ip=$this->input->post('ip'); }else { $ip=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $prosesor=$this->input->post('prosesor'); }else { $prosesor=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $memori=$this->input->post('memori'); }else { $memori=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $hdd=$this->input->post('hdd'); }else { $hdd=null;}
			if($this->input->post('jenis')==1 or $this->input->post('jenis')==2 or $this->input->post('jenis')==3){ $antivirus=$this->input->post('antivirus'); }else { $antivirus=null;}
			if($this->input->post('jenis')==6 ){ $printer=$this->input->post('printer'); }else { $printer=null;}
			$data = array(
				'jenis' => $this->input->post('jenis'),
				'merk' => $this->input->post('merk'),
				'tipe' => $this->input->post('tipe'),
				'sn' => $this->input->post('sn'),
				'os' => $os,
				'ip' => $ip,
				'prosesor' => $prosesor,
				'memori' => $memori,
				'bmn' => $this->input->post('bmn'),
				'hdd' => $hdd,
				'kondisi' => $this->input->post('kondisi'),
				'tahun' => $this->input->post('tahun'),
				'antivirus' => $antivirus,
				'keterangan' => $this->input->post('ket'),
				'date_updated' => $date_updated,
				'ip_rekam' => $ipaddress,
				'printer' => $printer, 
			);

			$result = $this->server_model->server_update($data,$this->input->post('id')) ;
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

		$result = $this->server_model->server_update($data,$id) ;
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