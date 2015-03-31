<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI

Class Laporan extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		$this->load->model('unit_model');
		$this->load->model('jenis_model');
		$this->load->model('server_model');
		$this->load->model('jaringan_model');
		$this->load->model('kondisi_model');
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

		$result=$this->getShow($param);

		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('laporan',$result);
      	$this->load->view('footer');
	}


	public function getShow($param){
		$ses=$this->session->userdata('logged_in');
		$admin=$ses['admin'];

		if($param==1){
			$ref_jenis=$this->jenis_model->getAllJenis();
			$result=array(
				'param_jenis' => $param,
				'all' => false,
				'ref_jenis' => $ref_jenis
			);

		}else if($param==2){
			$result=array(
				'param_jenis' => $param,
				'all' => false,
				'ref_tahun' => date("Y") - 11,
			);
		}
		else if($param==3){
			//kppn 15
			//es 2 13
			//admin 13 + 1
			$unit=$ses['unit'];
			$panjang=strlen($unit);
			if($panjang==13 && $admin==1){
				$kppn=$this->unit_model->getAllKPPN();
			}else if($panjang==13 && $admin==0){
				$kppn=$this->unit_model->getKppnByKanwil($unit);
			}else{
				$kppn=$this->unit_model->getKppnByKanwil($unit);
			}
			$result=array(
				'param_jenis' => $param,
				'all' => false,
				'ref_kppn' => $kppn,
			);
			
		}else if($param==4){
			$unit=$ses['unit'];
			if(strlen($unit)>13){
				redirect('monitoring');
			}
			$panjang=strlen($unit);
			if($panjang==13 && $admin==1){
				$kanwil=$this->unit_model->getEs2();
			}
			$result=array(
				'param_jenis' => $param,
				'all' => false,
				'ref_kanwil' => $kanwil
			);
		}else if($param==5){
			$ref_kondisi=$this->kondisi_model->getAllKondisi();
			$result=array(
				'param_jenis' => $param,
				'all' => false,
				'ref_kondisi' => $ref_kondisi
			);
		}else{
			$ref_jenis=$this->jenis_model->getAllJenis();
			$kppn=$this->unit_model->getUnitAll();
			$unit=$ses['unit'];
			$panjang=strlen($unit);
			if($panjang==13 && $admin==1){
				$kanwil=$this->unit_model->getEs2();
			}
			$ref_kondisi=$this->kondisi_model->getAllKondisi();
			$result=array(
				'param_jenis' => $param,
				'ref_jenis' => $ref_jenis,
				'ref_tahun' => date("Y") - 11,
				'ref_kppn' => $kppn,
				'ref_kondisi' => $ref_kondisi,
				'all' => true
			);
		}

		return $result;
	}


	public function perjenis(){
		$jenis=$this->input->post('jenis');
		$param=$this->input->post('param_jenis');

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
			$arr=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hardware.jenis' => $jenis,
				'hapus' => 0,
			);
		}else{
			$arr=array(
				't_hardware.unit' => $ses['unit'],
				't_hardware.jenis' => $jenis,
				'hapus' => 0,
			);
		}

		

		//$server=$this->server_model->getServer($arr,0);

		if($jenis==1 or $jenis==2 or $jenis==3){
			$server=$this->server_model->getServer($arr,0);
			$jaringan=false;
		}else if($jenis==6){
			$server=$this->server_model->getServer3($arr,0);
			$jaringan=false;
		}else if($jenis==4 or $jenis==5 or $jenis==9){
			if($admin==1){
				$arr=array(
					//'t_hardware.unit' => $ses['unit'],
					't_hajar.jenis' => $jenis,
					'hapus' => 0,
				);
			}else{
				$arr=array(
					't_hajar.unit' => $ses['unit'],
					't_hajar.jenis' => $jenis,
					'hapus' => 0,
				);
			}
			$server=$this->jaringan_model->getJaringan($arr,0);
			$jaringan=true;
		}else{
			$server=$this->server_model->getServer2($arr,0);
			$jaringan=false;
		}

		$data=array(
			//'result' => $this->getShow($param),
			'hasil' => $server,
			'param_jenis' => $param,
			'jenisnya' => $jenis,
			'filter' => 'jenis',
			'jaringan' => $jaringan,
			);

		//$this->load->helper(array('dompdf', 'file'));
		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('cetak',$data);
      	$this->load->view('footer');


	}


	public function pertahun(){
		$tahun=$this->input->post('tahun');
		//$param=$this->input->post('param_jenis');

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
			$arr=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hardware.tahun' => $tahun,
				'hapus' => 0,
			);
			$arr2=array(
					//'t_hardware.unit' => $ses['unit'],
					't_hajar.tahun' => $tahun,
					'hapus' => 0,
				);
		}else{
			$arr=array(
				't_hardware.unit' => $ses['unit'],
				't_hardware.tahun' => $tahun,
				'hapus' => 0,
			);
			$arr2=array(
					't_hajar.unit' => $ses['unit'],
					't_hajar.tahun' => $tahun,
					'hapus' => 0,
				);
		}

		

		//$server=$this->server_model->getServer($arr,0);

		$server=$this->server_model->getServer($arr,0);
		$jar=$this->jaringan_model->getJaringan($arr2,0);
		$jaringan=true;
		

		$data=array(
			//'result' => $this->getShow($param),
			'hasil' => $server,
			'jar' => $jar,
			'filter' => 'tahun',
			'filter_isi' => $tahun,
			//'param_jenis' => $param,
			'jaringan' => $jaringan,
			);

		//$this->load->helper(array('dompdf', 'file'));
		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('cetak2',$data);
      	$this->load->view('footer');


	}


	public function perkppn(){
		$kppn=$this->input->post('kppn');
		//$param=$this->input->post('param_jenis');

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

		// if($admin==1){
		// 	$arr=array(
		// 		//'t_hardware.unit' => $ses['unit'],
		// 		't_hardware.tahun' => $tahun,
		// 		'hapus' => 0,
		// 	);
		// 	$arr2=array(
		// 			//'t_hardware.unit' => $ses['unit'],
		// 			't_hajar.tahun' => $tahun,
		// 			'hapus' => 0,
		// 		);
		// }else{
		$arr=array(
			't_hardware.unit' => $kppn,
			//'t_hardware.tahun' => $tahun,
			'hapus' => 0,
		);
		$arr2=array(
				't_hajar.unit' => $kppn,
				//'t_hajar.tahun' => $tahun,
				'hapus' => 0,
			);
		// }

		

		//$server=$this->server_model->getServer($arr,0);

		$server=$this->server_model->getServer($arr,0);
		$jar=$this->jaringan_model->getJaringan($arr2,0);
		$jaringan=true;
		

		$data=array(
			//'result' => $this->getShow($param),
			'hasil' => $server,
			'jar' => $jar,
			'filter' => 'unit',
			'filter_isi' => $kppn,
			//'param_jenis' => $param,
			'jaringan' => $jaringan,
			);

		//$this->load->helper(array('dompdf', 'file'));
		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('cetak2',$data);
      	$this->load->view('footer');


	}

	public function perkanwil(){
	
		
		//$param=$this->input->post('param_jenis');

		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$admin=$ses['admin'];
		if($admin!=1 || strlen($ses['unit'])>13){
			redirect('monitoring');
		}
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);
		$kppn=$this->input->post('kanwil');
		
		

		// if($admin==1){
		// 	$arr=array(
		// 		//'t_hardware.unit' => $ses['unit'],
		// 		't_hardware.tahun' => $tahun,
		// 		'hapus' => 0,
		// 	);
		// 	$arr2=array(
		// 			//'t_hardware.unit' => $ses['unit'],
		// 			't_hajar.tahun' => $tahun,
		// 			'hapus' => 0,
		// 		);
		// }else{
		$arr=array(
			't_hardware.unit' => $kppn,
			//'t_hardware.tahun' => $tahun,
			'hapus' => 0,
		);
		$arr2=array(
				't_hajar.unit' => $kppn,
				//'t_hajar.tahun' => $tahun,
				'hapus' => 0,
			);
		// }

		

		//$server=$this->server_model->getServer($arr,0);

		$server=$this->server_model->getServer($arr,0);
		$jar=$this->jaringan_model->getJaringan($arr2,0);
		$jaringan=true;
		

		$data=array(
			//'result' => $this->getShow($param),
			'hasil' => $server,
			'jar' => $jar,
			'filter' => 'unit',
			'filter_isi' => $kppn,
			//'param_jenis' => $param,
			'jaringan' => $jaringan,
			);

		//$this->load->helper(array('dompdf', 'file'));
		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('cetak2',$data);
      	$this->load->view('footer');


	}

	


	public function perkondisi(){
		$kondisi=$this->input->post('kondisi');
		//$param=$this->input->post('param_jenis');

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
			$arr=array(
				't_hardware.kondisi' => $kondisi,
				//'t_hardware.tahun' => $tahun,
				'hapus' => 0,
			);
			$arr2=array(
					't_hajar.kondisi' => $kondisi,
					//'t_hajar.tahun' => $tahun,
					'hapus' => 0,
			);
		}else{
			$arr=array(
				't_hardware.kondisi' => $kondisi,
				//'t_hardware.tahun' => $tahun,
				't_hardware.unit' => $ses['unit'],
				'hapus' => 0,
			);
			$arr2=array(
					't_hajar.kondisi' => $kondisi,
					//'t_hajar.tahun' => $tahun,
					't_hajar.unit' => $ses['unit'],
					'hapus' => 0,
			);
		}

		
		// }

		

		//$server=$this->server_model->getServer($arr,0);

		$server=$this->server_model->getServer($arr,0);
		$jar=$this->jaringan_model->getJaringan($arr2,0);
		$jaringan=true;
		

		$data=array(
			//'result' => $this->getShow($param),
			'hasil' => $server,
			'jar' => $jar,
			'filter' => 'kondisi',
			'filter_isi' => $kondisi,
			//'param_jenis' => $param,
			'jaringan' => $jaringan,
			);

		//$this->load->helper(array('dompdf', 'file'));
		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('cetak2',$data);
      	$this->load->view('footer');


	}


	public function summary(){
		$kondisi=$this->input->post('kondisi');
		$tahun=$this->input->post('tahun');
		$jenis=$this->input->post('jenis');
		$kppn=$this->input->post('kppn');

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
			'hapus' => 0,
			);
		if($kondisi!=null){
			$arr['t_hardware.kondisi']=$kondisi;
		}
		if($tahun!=null){
			$arr['t_hardware.tahun']=$tahun;
		}
		if($jenis!=null){
			$arr['t_hardware.jenis']=$jenis;
		}
		if($kppn!=null){
			$arr['t_hardware.unit']=$kppn;
		}

		$arr2=array(
			'hapus' => 0,
			);
		if($kondisi!=null){
			$arr2['t_hajar.kondisi']=$kondisi;
		}
		if($tahun!=null){
			$arr2['t_hajar.tahun']=$tahun;
		}
		if($jenis!=null){
			$arr2['t_hajar.jenis']=$jenis;
		}
		if($kppn!=null){
			$arr2['t_hajar.unit']=$kppn;
		}


		$server=$this->server_model->getServer($arr,0);
		$jar=$this->jaringan_model->getJaringan($arr2,0);
		$jaringan=true;


		$data=array(
			//'result' => $this->getShow($param),
			'hasil' => $server,
			'jar' => $jar,
			'filter_hardware' => $arr,
			'filter_jaringan' => $arr2,
			//'param_jenis' => $param,
			'jaringan' => $jaringan,
			'filter' => '',
			);

		//$this->load->helper(array('dompdf', 'file'));
		// print_r($result);
		$this->load->view('header',$unit);
      	// $this->load->view('menu');
      	$this->load->view('cetak2',$data);
      	$this->load->view('footer');


	}

	public function cetakLaporan(){
		$parameter=$this->input->post('parameter');
		$parameter_id=$this->input->post('parameter_id');
		$opsi=$this->input->post('opsi');

		if($opsi==1){
			$this->cetak($parameter,$parameter_id);
		}else if($opsi==3){
			$this->barcode($parameter,$parameter_id);
		}else{
			$this->excel($parameter,$parameter_id);
		}
	}

	public function barcode(){

			$ses=$this->session->userdata('logged_in');

			$unit_array=array(
				'unit2' => $ses['unit'],
			);
			$res=$this->unit_model->getUnit($unit_array);
			$unit=array(
				'unit2' => $res[0]->unit2,
				'kantor' => $res[0]->kantor
				);

			$par_id=$this->uri->segment(3);

			$param_jenis=$this->uri->segment(4);


			$parJenis=array(
				'id' => $param_jenis
				);

			$id=array(
				't_hardware.id' => $par_id,
				);

			$id2=array(
				't_hajar.id' => $par_id,
				);

			if($param_jenis==1 or $param_jenis==2 or $param_jenis==3){
				$res=$this->server_model->getServerById($id);
			}else if($param_jenis==4 or $param_jenis==5 or $param_jenis==9){
				$res=$this->jaringan_model->getJaringanById($id2);
			}else{
				$res=$this->server_model->getServerById2($id);
			}

			
			foreach ($res as $row) {
				$data['data'] = $row['id_hardware']." | ".$row['sn'].' | '.$row['kantor'].' | '.$row['nmmerk'].' | '.$row['tipe'];
				$sn=$row['sn'];
			}			
           	$data['savename'] = FCPATH."/public/".$row['unit'].$row['id'].".jpg";

           	$this->load->library('ciqrcode');

			$data['level'] = 'H';
			$data['size'] = 2;
			$this->ciqrcode->generate($data);

			$html="| SIMONTIK-DSP |";
			$html.="<br />";
			$html.='<img src="'.base_url()."/public/".$row['unit'].$row['id'].'.jpg" />';
			$html.="<br />";
			$html.="| ".$sn." |";

			$this->pdf($html);
			//return $html;

	}

	public function cetakBarcode($parameter,$parameter_id){

		$this->load->library('ciqrcode');
		
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
			$arr=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}else{
			$arr=array(
				't_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				't_hajar.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}


		if($parameter_id==4 || $parameter_id==5 || $parameter_id==9){
			$hasil=$this->jaringan_model->getJaringan($arr2,0);
		}else{
			$hasil=$this->server_model->getServer($arr,0);
		}

		$html="<html><head><style type=\"text/css\">
				table.grid {
					border-width: 1px;
					border-spacing: 2px;
					border-style: solid;
					border-color: gray;
					border-collapse: collapse;
					background-color: white;
				}
				table.grid th {
					border-width: 1px;
					padding: 1px;
					border-style: solid;
					border-color: black;
					background-color: white;
					-moz-border-radius: ;
				}
				table.grid td {
					border-width: 1px;
					padding: 1px;
					border-style: solid;
					border-color: black;
					background-color: white;
					-moz-border-radius: ;
				}
				</style></head><body>";
		$html.=" <h1>Laporan Inventarisasi TIK</h1><table id=\"grid\" \">
        <thead>";
        		if($parameter_id==4 || $parameter_id==5 || $parameter_id==9){

        			$html.="<tr>
			                <th>UNIT</th>
			                <th>ID</th>
			                <th>MERK</th>
			                <th>TIPE</th>
			                <th>IP</th>
			                <th>SERIAL NUMBER</th>
			                <th>TAHUN</th>
			                
			            </tr>
			        </thead>
			        <tbody>";
			                    if(isset($hasil) && $hasil!=null){
			                        if(sizeof($hasil)>0){
			                            foreach ($hasil as $row)
			                            {

			                                $id=$row['id'];
			                                $html.= "<tr>";
			                                $html.= "<td>".$row['kantor']."</td>";
			                                $html.= "<td>".$row['id_hardware']."</td>";
			                                $html.= "<td>".$row['nmmerk']."</td>";
			                                $html.= "<td>".$row['tipe']."</td>";
			                                $html.= "<td>".$row['ip']."</td>";
			                                $html.= "<td>".$row['sn']."</td>";
			                                $html.= "<td>".$row['tahun']."</td>";
			                                //$html.= "<td><img src=\"".base_url()."/public/tes.png \"/></td>";
			                                $html.= "</tr>";
			                        }
			                        }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                           }
			                    }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                    }

                }else{
			            	$html.="<tr>
				                <th> ID</th>
				                <th>UNIT</th>
				                <th>MERK</th>";
			                $html.="<th>TIPE</th>";
			                $html.="<th>SERIAL NUMBER</th>";
			                $html.="<th >TAHUN</th><th>BARCODE</th>";
			            $html.="</tr>
						        </thead>
						        <tbody>";

			                    if(isset($hasil) && $hasil!=null){
			                        if(sizeof($hasil)>0){
			                            foreach ($hasil as $row)
			                            {
			                                $id=$row['id'];
			                                $html.="<tr>";
			                                $html.="<td>".$row['id_hardware']."</td>";
			                                $html.="<td>".$row['kantor']."</td>";
			                                $html.="<td>".$row['nmmerk']."</td>";
			                                $html.="<td>".$row['tipe']."</td>";
			                                $html.="<td>".$row['sn']."</td>";
			                                $html.="<td>".$row['tahun']."</td>";
			                                $html.= "</tr>";
			                            }
			                        }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                           }
			                    }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                    }
        		}
    
			$html.="</tbody>
		    </table>";

		   	$html.="</div></body></html>";

		    $this->pdf($html);

		
	}

	public function cetakLaporan2(){
		$parameter=$this->input->post('parameter');
		$parameter_id=$this->input->post('parameter_id');
		$opsi=$this->input->post('opsi');

		if($opsi==1){
			$this->cetak2($parameter,$parameter_id);
		}else{
			$this->excel2($parameter,$parameter_id);
		}
	}


	public function cetak($parameter,$parameter_id){

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
			$arr=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}else{
			$arr=array(
				't_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				't_hajar.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}


		if($parameter_id==4 || $parameter_id==5 || $parameter_id==9){
			$hasil=$this->jaringan_model->getJaringan($arr2,0);
		}else{
			$hasil=$this->server_model->getServer($arr,0);
		}


		$html="<html><head><style type=\"text/css\">
				table.grid {
					border-width: 1px;
					border-spacing: 2px;
					border-style: solid;
					border-color: gray;
					border-collapse: collapse;
					background-color: white;
				}
				table.grid th {
					border-width: 1px;
					padding: 1px;
					border-style: solid;
					border-color: black;
					background-color: white;
					-moz-border-radius: ;
				}
				table.grid td {
					border-width: 1px;
					padding: 1px;
					border-style: solid;
					border-color: black;
					background-color: white;
					-moz-border-radius: ;
				}
				</style></head><body>";
		$html.=" <h1>Laporan Inventarisasi TIK</h1><table id=\"grid\" \">
        <thead>";
        		if($parameter_id==4 || $parameter_id==5 || $parameter_id==9){

        			$html.="<tr>
			                <th>UNIT</th>
			                <th>MERK</th>
			                <th>TIPE</th>
			                <th>PORT</th>
			                <th>IP</th>
			                <th>SERIAL NUMBER</th>
			                <th>TAHUN</th>
			                <th>KONDISI</th>
			                <th>KETERANGAN</th>
			            </tr>
			        </thead>
			        <tbody>";
			                    if(isset($hasil) && $hasil!=null){
			                        if(sizeof($hasil)>0){
			                            foreach ($hasil as $row)
			                            {
			                                $id=$row['id'];
			                                $html.= "<tr>";
			                                $html.= "<td>".$row['kantor']."</td>";
			                                $html.= "<td>".$row['nmmerk']."</td>";
			                                $html.= "<td>".$row['tipe']."</td>";
			                                $html.= "<td>".$row['port']."</td>";
			                                $html.= "<td>".$row['ip']."</td>";
			                                $html.= "<td>".$row['sn']."</td>";
			                                $html.= "<td>".$row['tahun']."</td>";
			                                $html.= "<td>".$row['nmkondisi']."</td>";
			                                $html.= "<td>".$row['keterangan']."</td>";
			                                $html.= "</tr>";
			                        }
			                        }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                           }
			                    }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                    }

                }else{
			            	$html.="<tr>
				                <th> ID</th>
				                <th>UNIT</th>
				                <th>MERK</th>";

                
			                if($parameter_id==6)  $html.="<th>JENIS PRINTER</th>"; 
			                $html.="<th>TIPE</th>";
			                $html.="<th>SERIAL NUMBER</th>";
			                if($parameter_id==1 or $parameter_id==2 or $parameter_id==3)  $html.="<th >SISTEM OPERASI</th>"; 
			                $html.="<th >TAHUN</th>";
			                if($parameter_id==1 or $parameter_id==2 or $parameter_id==3)  $html.="<th>IP</th>"; 
			                if($parameter_id==1 or $parameter_id==2 or $parameter_id==3)  $html.="<th>PROSESOR</th>"; 
			                if($parameter_id==1 or $parameter_id==2 or $parameter_id==3)  $html.="<th>RAM</th>"; 
			                if($parameter_id==1 or $parameter_id==2 or $parameter_id==3)  $html.="<th>HDD</th>"; 
			                $html.="<th>KONDISI</th>";
							if($parameter_id==1 or $parameter_id==2 or $parameter_id==3)  $html.="<th>ANTIVIRUS</th>"; 
			                $html.="<th>KETERANGAN</th>";
			            $html.="</tr>
						        </thead>
						        <tbody>";

			                    if(isset($hasil) && $hasil!=null){
			                        if(sizeof($hasil)>0){
			                            foreach ($hasil as $row)
			                            {
			                                $id=$row['id'];
			                                $html.="<tr>";
			                                $html.="<td>".$row['id_hardware']."</td>";
			                                $html.="<td>".$row['kantor']."</td>";
			                                $html.="<td>".$row['nmmerk']."</td>";
			                                if($row['jenis']==6 ) $html.= "<td>".$row['nmprinter']."</td>";
			                                $html.="<td>".$row['tipe']."</td>";
			                                $html.="<td>".$row['sn']."</td>";
			                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) $html.= "<td>".$row['nmos']."</td>";
			                                $html.="<td>".$row['tahun']."</td>";
			                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) $html.= "<td>".$row['ip']."</td>";
			                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) $html.= "<td>".$row['prosesor']."</td>";
			                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) $html.= "<td>".$row['memori']."</td>";
			                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) $html.= "<td>".$row['hdd'];
			                                $html.= "<td>".$row['nmkondisi']."</td>";
			                                if($row['jenis']==1 or $row['jenis']==2 or $row['jenis']==3) $html.= "<td>".$row['nmstatus']."</td>";
			                                $html.= "<td>".$row['keterangan']."</td>";
			                                $html.= "</tr>";
			                            }
			                        }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                           }
			                    }else{
			                        $html.="<tr>
			                            <td >Data Kosong</td>
			                        </tr>";
			                    }
        		}
    
	$html.="</tbody>
    </table>";

    $ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit' => $ses['unit'],
		);

	$ttd=$this->ttd_model->getTtd($unit_array);
	foreach ($ttd as $rowttd) {
		$nama=$rowttd['nama'];
		$nip=$rowttd['nip'];
		$jabatan=$rowttd['jabatan'];
	}

	$html.="<div style:\" float: right;\"><table>";
	$html.="<tbody>";
    $html.="<tr>";
    $html.="<td colspan=\"8\">&nbsp;</td><td>'$jabatan'</td>";
    $html.="</tr>";
    $html.="<tr>";
    $html.="<td colspan=\"8\">&nbsp;</td>";
    $html.="</tr>";
    $html.="<tr>";
    $html.="<td colspan=\"8\">&nbsp;</td>";
    $html.="</tr>";
    $html.="<tr>";
    $html.="<td colspan=\"8\">&nbsp;</td>";
    $html.="</tr>";
    $html.="<tr>";
    $html.="<td colspan=\"8\">&nbsp;</td><td>'$nama'</td>";
    $html.="</tr>";
    $html.="<tr>";
    $html.="<td colspan=\"8\">&nbsp;</td><td>NIP. '$nip'</td>";;
    $html.="</tr>";
	$html.="</tbody>
    </table></div></body></html>";

    $this->pdf($html);


	}


	function pdf($html)
	{
		$ses=$this->session->userdata('logged_in');
		$unit_array=array(
			'unit2' => $ses['unit'],
		);
		$res=$this->unit_model->getUnit($unit_array);
		$unit=array(
			'unit2' => $res[0]->unit2,
			'kantor' => $res[0]->kantor
			);


	     $this->load->helper(array('dompdf', 'file'));

	     //pdf_create($html, 'filename',TRUE,'a4','landscape');
	     pdf_create_params($html, date('Y-m-d')."_".$res[0]->kantor);

	}


	public function excel($parameter,$parameter_id){

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
			$arr=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}else{
			$arr=array(
				't_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				't_hajar.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}

		$unit_array=array(
			'unit' => $ses['unit'],
		);

		$ttd=$this->ttd_model->getTtd($unit_array);
		foreach ($ttd as $rowttd) {
			$nama=$rowttd['nama'];
			$nip=$rowttd['nip'];
			$jabatan=$rowttd['jabatan'];
		}


		if($parameter_id==4 || $parameter_id==5 || $parameter_id==9){
			$hasil=$this->jaringan_model->getJaringan($arr2,0);
			$heading=array('ID','UNIT','MERK','TIPE','SN','OS','TAHUN','IP','PROSESOR','RAM','HDD','KONDISI','ANTIVIRUS','KETERANGAN');
		}else{
			$hasil=$this->server_model->getServer($arr,0);
			$heading=array('ID','UNIT','MERK','TIPE','PORT','IP','TAHUN','SN','KONDISI','KETERANGAN');
		}

	    
	    $this->load->library('excel');
	    //Create a new Object
	    $objPHPExcel = new Excel();
	    $objPHPExcel->getActiveSheet()->setTitle('Laporan Inventarisasi TIK');
	    //Loop Heading
	    $rowNumberH = 1;
	    $colH = 'A';
	    foreach($heading as $h){
	        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
	        $colH++;    
	    }
	    $totn=sizeof($hasil);
	    $maxrow=$totn+1;
        $row = 2;
        $no = 1;
        if($hasil!=null){
        	if($parameter_id==4 || $parameter_id==5 || $parameter_id==9){
        		foreach($hasil as $n){
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n['id_hardware']);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n['kantor']);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n['nmmerk']);
		            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n['tipe']);
		            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n['port']);
		            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n['ip']);
		            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n['tahun']);
		            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n['sn']);
		            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$n['nmkondisi']);
		            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$n['keterangan']);
		            $row++;
		            $no++;
		        }
        	}else{
		        foreach($hasil as $n){
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n['id_hardware']);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n['kantor']);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n['nmmerk']);
		            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n['tipe']);
		            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n['sn']);
		            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n['nmos']);
		            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n['tahun']);
		            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n['ip']);
		            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$n['prosesor']);
		            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$n['memori']);
		            $objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$n['hdd']);
		            $objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$n['nmkondisi']);
		            $objPHPExcel->getActiveSheet()->setCellValue('M'.$row,$n['nmstatus']);
		            $objPHPExcel->getActiveSheet()->setCellValue('N'.$row,$n['keterangan']);
		            // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		            // $objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$row,$n->nilai,PHPExcel_Cell_DataType::TYPE_NUMERIC);
		            $row++;
		            $no++;
		        }
		    }
	    }else{
	    	$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,'Kosong');
	    }

	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+2),$jabatan);
	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+5),$nama);
	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+6),'NIP. '.$nip);
	    //Freeze pane
	    $objPHPExcel->getActiveSheet()->freezePane('A2');
	    //Cell Style
	    $styleArray = array(
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN
	            )
	        )
	    );
	    $objPHPExcel->getActiveSheet()->getStyle('A1:N'.$maxrow)->applyFromArray($styleArray);
	    //Save as an Excel BIFF (xls) file
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="Laporan-'.$res[0]->kantor.'.xls"');
	    header('Cache-Control: max-age=0');

	    $objWriter->save('php://output');
	    exit();
	}

	public function excel2($parameter,$parameter_id){

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
			$arr=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				//'t_hardware.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}else{
			$arr=array(
				't_hardware.unit' => $ses['unit'],
				't_hardware.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
			$arr2=array(
				't_hajar.unit' => $ses['unit'],
				't_hajar.'.$parameter => $parameter_id,
				'hapus' => 0,
			);
		}

		$unit_array=array(
			'unit' => $ses['unit'],
		);

		$ttd=$this->ttd_model->getTtd($unit_array);
		foreach ($ttd as $rowttd) {
			$nama=$rowttd['nama'];
			$nip=$rowttd['nip'];
			$jabatan=$rowttd['jabatan'];
		}


		$hasil2=$this->jaringan_model->getJaringan($arr2,0);
		$heading2=array('ID','UNIT','MERK','TIPE','SN','OS','TAHUN','IP','PROSESOR','RAM','HDD','KONDISI','ANTIVIRUS','KETERANGAN');
		$hasil=$this->server_model->getServer($arr,0);
		$heading=array('ID','UNIT','MERK','TIPE','PORT','IP','TAHUN','SN','KONDISI','KETERANGAN');

	    
	    $this->load->library('excel');
	    //Create a new Object
	    $objPHPExcel = new Excel();
	    $objPHPExcel->setActiveSheetIndex(0);
	    $objPHPExcel->getActiveSheet()->setTitle('Laporan Hardware');
	    //Loop Heading
	    $rowNumberH = 1;
	    $colH = 'A';
	    foreach($heading as $h){
	        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
	        $colH++;    
	    }
	    $totn=sizeof($hasil);
	    $maxrow=$totn+1;
        $row = 2;
        $no = 1;
        if($hasil!=null){
		        foreach($hasil as $n){
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n['id_hardware']);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n['kantor']);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n['nmmerk']);
		            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n['tipe']);
		            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n['sn']);
		            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n['nmos']);
		            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n['tahun']);
		            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n['ip']);
		            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$n['prosesor']);
		            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$n['memori']);
		            $objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$n['hdd']);
		            $objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$n['nmkondisi']);
		            $objPHPExcel->getActiveSheet()->setCellValue('M'.$row,$n['nmstatus']);
		            $objPHPExcel->getActiveSheet()->setCellValue('N'.$row,$n['keterangan']);
		            // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		            // $objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$row,$n->nilai,PHPExcel_Cell_DataType::TYPE_NUMERIC);
		            $row++;
		            $no++;
		        }
	    }else{
	    	$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,'Kosong');
	    }

	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+2),$jabatan);
	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+5),$nama);
	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+6),'NIP. '.$nip);
	    //Freeze pane
	    $objPHPExcel->getActiveSheet()->freezePane('A2');
	    //Cell Style
	    $styleArray = array(
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN
	            )
	        )
	    );
	    $objPHPExcel->getActiveSheet()->getStyle('A1:N'.$maxrow)->applyFromArray($styleArray);

		//$objPHPExcel->addSheet();
		$objPHPExcel->createSheet(1);
		$objPHPExcel->setActiveSheetIndex(1); 
	    $objPHPExcel->getActiveSheet()->setTitle('Laporan Jaringan');
	    //Loop Heading
	    $rowNumberH = 1;
	    $colH = 'A';
	    foreach($heading2 as $h){
	        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
	        $colH++;    
	    }
	    $totn=sizeof($hasil2);
	    $maxrow=$totn+1;
        $row = 2;
        $no = 1;
	    if($hasil2!=null){
        		foreach($hasil2 as $n){
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n['id_hardware']);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n['kantor']);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n['nmmerk']);
		            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n['tipe']);
		            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n['port']);
		            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n['ip']);
		            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n['tahun']);
		            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n['sn']);
		            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$n['nmkondisi']);
		            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$n['keterangan']);
		            $row++;
		            $no++;
		         }
	    }else{
	    	$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,'Kosong');
	    }

	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+2),$jabatan);
	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+5),$nama);
	    $objPHPExcel->getActiveSheet()->setCellValue('L'.($maxrow+6),'NIP. '.$nip);
	    //Freeze pane
	    $objPHPExcel->getActiveSheet()->freezePane('A2');
	    //Cell Style
	    $styleArray = array(
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN
	            )
	        )
	    );
	    $objPHPExcel->getActiveSheet()->getStyle('A1:N'.$maxrow)->applyFromArray($styleArray);


	    //Save as an Excel BIFF (xls) file
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="Laporan-'.$res[0]->kantor.'.xls"');
	    header('Cache-Control: max-age=0');

	    $objWriter->save('php://output');
	    exit();
	}



}