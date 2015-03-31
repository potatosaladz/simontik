<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Tiket extends CI_Controller {

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
		$this->load->model('tiket_model');
		$this->load->model('jenis_model');
		$this->load->model('sifat_model');
		$this->load->model('pic_model');
		$this->load->model('status_model');
		$this->load->model('petugas_model');
		$this->load->model('chat_model');
		$this->load->model('upload_model');
		$this->load->helper('download');

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

	public function tampil($limit){
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
				'hapus' => 0,
			);
			$all=true;
		}else{
			$data=array(
				't_tiket.unit' => $res[0]->unit2,
				'hapus' => 0,
			);
			$all=false;
		}
		// $limit=5;
		$tiket=$this->tiket_model->getTiket($data,$limit);

		$result=array(
			'tiket' => $tiket,
			'admin' => $all,
			);

		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('tiket',$result);
      	$this->load->view('footer');
	}

	public function rekam(){
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

			$jenis=$this->jenis_model->getAllJenis();
			$sifat=$this->sifat_model->getAllSifat();

			$data=array(
				'jenis' =>$jenis,
				'sifat' => $sifat,
				);
			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	$this->load->view('rekam_tiket',$data);
	      	$this->load->view('footer');
	      }else{
			$this->load->view('utama');
		}
	}

	public function simpan(){
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
		$this->form_validation->set_rules('detail', 'Detail', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tindakan', 'Tindakan', 'trim|required|xss_clean');

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

		$arr=array(
			'unit2'=>$ses['unit'],
			);

		$unit=$this->unit_model->getUnit2($arr);
		foreach ($unit as $row) {
			$kdkppn=(string) $row['kdkppn'];
			$kdkanwil=(string) $row['kdkanwil'];
			$kantor=(string) $row['kantor'];
		}

		$arr2=array(
			't_tiket.unit'=>$ses['unit'],
			't_tiket.hapus' => 0
			);

		$tiket=$this->tiket_model->getTiketCount($arr2,0);

		if($tiket==0){
			$urut=1;
		}else{
			$urut=$tiket+1;
		}

		if ($this->form_validation->run() == FALSE) {
			$this->rekam();
		} else {
			$data = array(
				'nomor' => "HD".date('y').$kdkanwil.$kdkppn.$urut,
				'unit' => $ses['unit'],
				'jenis' => $this->input->post('jenis'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'telp' => $this->input->post('telp'),
				'sifat' => $this->input->post('sifat'),
				'subject' => $this->input->post('subject'),
				'detail' => $this->input->post('detail'),
				'tindakan' => $this->input->post('tindakan'),
				'status' => 1,
				'date_created' => $date_created,
				'ip_rekam' => $ipaddress,
			);

			$result = $this->tiket_model->tiket_insert($data) ;
			if ($result == TRUE) {
				//$this->sendemail($kantor,$this->input->post('subject'),$this->input->post('detail'));
				$data['message_display'] = 'Insert Success !';
				$this->tampil(10);
			} else {
				$data['message_display'] = 'Insert Failed!';
				$this->rekam();
			}
		}
	}

	public function ubah($id_ubah){
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


			$jenis=$this->jenis_model->getAllJenis();
			$sifat=$this->sifat_model->getAllSifat();

			if(isset($id_ubah)){
				$param=$id_ubah;
			}else{
				$param=$this->uri->segment(3);
			}

			$id=array(
				't_tiket.id' => $param,
				);
			$res=$this->tiket_model->getTiketById($id);

			$data=array(
				'jenis' =>$jenis,
				'sifat' => $sifat,
				'tiket' => $res,
			);

			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	$this->load->view('rekam_tiket',$data);
	      	$this->load->view('footer');
		}else{
			$this->load->view('utama');
		}
		
	}

	public function update(){
		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
		$this->form_validation->set_rules('detail', 'Detail', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tindakan', 'Tindakan', 'trim|required|xss_clean');

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
				'jenis' => $this->input->post('jenis'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'telp' => $this->input->post('telp'),
				'sifat' => $this->input->post('sifat'),
				'subject' => $this->input->post('subject'),
				'detail' => $this->input->post('detail'),
				'tindakan' => $this->input->post('tindakan'),
				'date_updated' => $date_updated,
				'ip_rekam' => $ipaddress,
			);

			$result = $this->tiket_model->tiket_update($data,$this->input->post('id')) ;
			if ($result == TRUE) {
				$data['message_display'] = 'Update Success !';
				$this->tampil(10,$this->input->post('jenis'));
			} else {
				$data['message_display'] = 'Update Failed!';
				$this->ubah($this->input->post('id'));
			}
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

	public function detail($id_tiket=null,$message=null){
		if($this->isLogged()){
			if($id_tiket!=null){
				$param=$id_tiket;
			}else{
				$param=$this->uri->segment(3);
			}
			
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
				'tiket' => $param,
				'hapus' => 0,
				);
			$arrChat=array(
				'tiket' => $param,
				);

			$pic=$this->pic_model->getAllPic();
			$status=$this->status_model->getAllStatus();
			$petugas=$this->petugas_model->getPetugas($arr);
			$chat=$this->chat_model->getChat($arrChat);


			if($admin==1){
				$data=array(
					't_tiket.id' => $param,
					'hapus' => 0,
				);
				$all=true;
			}else{
				$data=array(
					'hapus' => 0,
					't_tiket.id' => $param,
				);
				$all=false;
			}
			// $limit=5;
			$tiket=$this->tiket_model->getTiket($data,1);
			$upload=$this->upload_model->getUpload($arr);

			$result=array(
				'tiket' => $tiket,
				'admin' => $all,
				'pic' => $pic,
				'status' => $status,
				'pic_tiket' =>$petugas,
				'message' => $message,
				'file_uploaded' => $upload,
				'chat' => $chat,
				);

			// print_r($result);
			$this->load->view('header',$unit);
	      	// $this->load->view('menu');
	      	$this->load->view('tiket_detail',$result);
	      	$this->load->view('footer');

		}else{
			$this->load->view('utama');
		}

	}

	public function setpic(){

		$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');

		$date_created=date('Y-m-d H:i:s');

		if ($this->form_validation->run() == FALSE) {
			$message = 'Update Failed!';
			$this->detail($this->input->post('id'),$message);
		} else {
			$data = array(
				'pic' => $this->input->post('pic'),
				'date_created' => $date_created,
				'tiket' => $this->input->post('id'),
			);

			$data2 = array(
				'pic' => $this->input->post('pic'),
				'tiket' => $this->input->post('id'),
			);

			$res=$this->petugas_model->getAllPetugasAssign($data2);

			if($res){
				$message = 'Already Assign!';
				$this->detail($this->input->post('id'),$message);
			}else{
				$result = $this->petugas_model->Petugas_insert($data) ;
				if ($result == TRUE) {
					$message = 'Update Success !';
					$this->detail($this->input->post('id'),$message);
				} else {
					$message = 'Update Failed!';
					$this->detail($this->input->post('id'),$message);
				}
			}

			
		}

	}

	public function removepic(){

		$id=$this->uri->segment(4);

		$id_tiket=$this->uri->segment(3);

		$data = array(
			'hapus' => 1,
		);

		$result = $this->petugas_model->Petugas_update($data,$id) ;
		if ($result == TRUE) {
			$message = 'Update Success !';
			$this->detail($id_tiket,$message);
		} else {
			$message = 'Update Failed!';
			$this->detail($id_tiket,$message);
		}

	}


	public function setstatus(){

		$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');

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
			$message = 'Update Failed!';
			$this->detail($this->input->post('id'),$message);
		} else {
			$data = array(
				'status' => $this->input->post('status'),
				'date_updated' => $date_updated,
				'ip_rekam' => $ipaddress,
			);

			$result = $this->tiket_model->tiket_update($data,$this->input->post('id')) ;
			if ($result == TRUE) {
				$message = 'Update Success !';
				$this->detail($this->input->post('id'),$message);
			} else {
				$message = 'Update Failed!';
				$this->detail($this->input->post('id'),$message);
			}
		}
	}


	public function upload(){

		$this->form_validation->set_rules('nama_file', 'Nama File', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$message = 'Upload Failed!';
			$this->detail($this->input->post('id'),$message);
		} else {

			$id=$this->input->post('id');
			$nama_file=$this->input->post('nama_file');


			$config['upload_path'] = 'public/uploads/';
			$config['allowed_types'] = 'pdf|jpg|jpeg';
			$config['max_size']	= '2048';

			$nmawal=$_FILES["userfile"]['name'];

			$new_name = $id.$_FILES["userfile"]['name'];
			$config['file_name'] = $new_name;
			// $config['max_width']  = '1024';
			// $config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$message = $this->upload->display_errors();
				$this->detail($this->input->post('id'),$message);
			}
			else
			{
				// $data = array('upload_data' => $this->upload->data());

				$ses=$this->session->userdata('logged_in');
				$admin=$ses['admin'];
				$date_created=date('Y-m-d H:i:s');

				$arr=array(
					'admin' => $admin,
					'tiket' => $id,
					'nmfile' => $nama_file,
					'lokasi' => $new_name,
					'nmawal' => $nmawal,
					'date_created' => $date_created,
					);

				$result=$this->upload_model->Upload_insert($arr);
				if ($result == TRUE) {
					$message = 'Upload Success !';
					$this->detail($this->input->post('id'),$message);
				} else {
					$message = 'Upload Failed!';
					$this->detail($this->input->post('id'),$message);
				}				
			}
		}
		
	}


	public function hapus(){

		$id=$this->uri->segment(4);

		$id_tiket=$this->uri->segment(3);

		$data = array(
			'hapus' => 1,
		);

		$result = $this->upload_model->Upload_update($data,$id) ;
		if ($result == TRUE) {
			$message = 'Update Success !';
			$this->detail($id_tiket,$message);
		} else {
			$message = 'Update Failed!';
			$this->detail($id_tiket,$message);
		}

	}

	public function download(){



		$id=$this->uri->segment(4);

		$id_tiket=$this->uri->segment(3);

		$arr=array(
			'id' => $id,
			'tiket' => $id_tiket,
			);

		$result=$this->upload_model->getUpload($arr);

		foreach ($result as $row) {
			$lokasi=$row['lokasi'];
			$nmawal=$row['nmawal'];
		}		

		$data = file_get_contents(base_url()."public/uploads/".$lokasi); // Read the file's contents
		$name = $nmawal;

		force_download($name, $data); 
	}

	public function sendemail($kantor,$subject,$detail){
		// Storing submitted values
		$sender_email = 'xxxxxxxx@gmail.com';//set email
		$user_password = 'xxxxxxxxxxxx';//set password
		$receiver_email = 'duktek.dsp@gmail.com';

		// Configure email library
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = $sender_email;
		$config['smtp_pass'] = $user_password;

		// Load email library and passing configured values to email library
		//$this->load->library('proxy'); 
		//$this->proxy->set_proxy('proxy02.depkeu.go.id',8080,'kaspersky.setpp1','djancuk123');
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		// Sender email address
		$this->email->from($sender_email, $kantor);
		// Receiver email address
		$this->email->to($receiver_email);
		// Subject of email
		$this->email->subject($subject);
		// Message in email
		$this->email->message($detail);

		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}

	public function chat(){
		$this->form_validation->set_rules('chat', 'Isi', 'trim|required|xss_clean');

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

		$arr=array(
			'unit2'=>$ses['unit'],
			);

		if ($this->form_validation->run() == FALSE) {
			$message = 'Insert Failed!';
			$this->detail($this->input->post('id_tiket'),$message);
		} else {

			$data = array(
				'unit' => $ses['unit'],
				'tiket' => $this->input->post('id_tiket'),
				'isi' => $this->input->post('chat'),
				'username' => $ses['username'],
				'date_created' => $date_created,
				'ip_rekam' => $ipaddress,
			);

			$result = $this->chat_model->Chat_insert($data) ;
			if ($result == TRUE) {
				$message = 'Insert Success !';
				$this->detail($this->input->post('id_tiket'),$message);
			} else {
				$message = 'Insert Failed!';
				$this->detail($this->input->post('id_tiket'),$message);
			}
		}
	}

}
