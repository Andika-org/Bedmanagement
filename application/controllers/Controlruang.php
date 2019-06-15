<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Controlruang extends MY_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
		parent::__construct ();
		$this->load->library ( array (
				'PHPExcel',
				'PHPExcel/IOFactory' 
		) );
		$this->load->model ( 'Model_ruang' );
	}
	
	public function index() {
		
		$attendance_datas = $this->Model_ruang->dataruang ();
		$data ['attendance_list'] = [ ];
		$no = 0;
		foreach ( $attendance_datas as $attendance_data ) {
			
			$koderuang = $attendance_data['KODE_RUANG'];
			$namaruang = $attendance_data['NAMA_RUANG'];
			$kodekelas = $attendance_data['KodeKelas'];
			$kapasitas = $attendance_data['KAPASITAS'];
			$rootkelas = $attendance_data['ROOT_KLS'];
			
			$nmkelas = $this->Model_ruang->kelas($kodekelas);
			$namakelas = $nmkelas["NamaKelas"];
			$biayarawat = $nmkelas["BiayaRawat"];
			
			$data ['attendance_list'] [] = array (
					'nomor' => ++ $no,
					'koderuang' => $koderuang,
					'namaruang' => $namaruang,
					'kodekelas' => $kodekelas,
					'namakelas' => $namakelas,
					'kapasitas' => $kapasitas,
					'rootkelas' => $rootkelas
					
			);
		}
	
		$this->mouldthing("Badmanagement/Ruang/View_Ruangan",$data );
	}
	
public function ajaxambilkamar($idnya){
	$datakamar = $this->Model_ruang->ambil_data_kamar($idnya);
	echo json_encode($datakamar);
}	

public function ajaxambilbed($idnya){
	$ambilbed = $this->Model_ruang->ambil_data_bad($idnya);
	echo json_encode($ambilbed);
}	

	
}
