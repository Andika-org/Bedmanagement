<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Controlbed extends MY_Controller {
	
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
		$this->load->model ( 'Model_bed' );
	}
	public function index() {
		$data["data"]="";
		$this->mouldthing('content',$data);
	}
	public function indexsalah() {
		
		$print ="";
		
		$data["ruangan"] = $this->Model_bed->listruangan();
		
		$i = 1;
		foreach($data["ruangan"] as $dtruang){
			
			$print = $print ."
					<tr>
					<td style='background:white;vertical-align:middle;'>".$dtruang->KODE_RUANG."</td>
					<td style='background:white;vertical-align:middle;'>".$dtruang->NAMA_RUANG.'</td>';
					
					$kdkelas = $dtruang->KodeKelas;
					$dtklas = $this->Model_bed->listkelas($kdkelas);
					
			$print = $print ."
					<td style='background:white;vertical-align:middle;'>".$dtklas['NamaKelas'].'</td>';		
					
					$kdruang = $dtruang->KODE_RUANG;
					
					$data["coba"] = $this->Model_bed->listkamar($kdruang);
					if(!empty($data['coba'])){
						
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:250px;' >";
						
						foreach($data['coba'] as $dd){
							//$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr><td style='border-top:none;vertical-align:middle;' >".$dd->NamaKamar.'</td>
								';
							/*
							$data["databed"] = $this->Model_bed->listbed($kdkamar);
							foreach($data['databed'] as $dtbed){
								$print = $print ."
								<td style='border-top:none;vertical-align:middle;' >".$dtbed->NamaBed.'</td>
								';
							}
							*/
							
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table>';
						
						//////////////////////
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:100%;'>";
						
						foreach($data['coba'] as $dd){
							$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr>".'
								';
							
							$data["databed"] = $this->Model_bed->listbed2($kdkamar);
							foreach($data['databed'] as $dtbed){
								$print = $print ."
								<td class='pull-leftt' style='border-top:none;border-right:1px solid black;vertical-align:middle;width:0px;' >".$dtbed->NamaBed.'</td>
								';
							}
							
							
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table>';
					
					}
					
					
					else{
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
					}		
						
					
		}
	
		//$kd = $this->Model_Stokopname->listdetailsogroup();
		$data["test"] = $print;
		//$data["idstok"] = $this->Model_Stokopname->idso();
		//$data["qty"] = $this->Model_Stokopname->listdetailsoqty();
		
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bed',$data);
}
	
public function indextester() {
		$print ="";
		$print2 ="";
		
		$data["ruangan"] = $this->Model_bed->listruangan();
		
		$i = 1;
		foreach($data["ruangan"] as $dtruang){
			
			$print = $print ."
					<tr>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->KODE_RUANG."</center></td>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->NAMA_RUANG.'</center></td>';
					
					$kdkelas = $dtruang->KodeKelas;
					$dtklas = $this->Model_bed->listkelas($kdkelas);
					
			$print = $print ."
					<td style='background:white;vertical-align:middle;'><center>".$dtklas['NamaKelas'].'</center></td>';		
					
					$kdruang = $dtruang->KODE_RUANG;
					
					$data["coba"] = $this->Model_bed->listkamar($kdruang);
					if(!empty($data['coba'])){
						
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:;' >";
						
						foreach($data['coba'] as $dd){
							$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr><td style='border:1px solid silver;vertical-align:middle;width:20%;' >".$dd->NamaKamar.'</td>
								';
							
							$print = $print."
							<td style='background:white;vertical-align:middle;padding-top:30px;border:1px solid silver;' ><table class='table table-striped table-bordered' style='width:100%;' >
							<tr>
								<th style='width:20%;' ><center><b>Nama Bed</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check In</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check Out</b></center></th>
								<th style='width:20%;' ><center><b>Estimasi Waktu Pulang</b></center></th>
							</tr>";
							
							//$databed = $this->Model_bed->listbed($kdkamar);
							//$print = $print ."
								//	<tr style='background:green;'>".$databed['datakamar'];
		
							
							$databed= $this->Model_bed->listbed($kdkamar);

								$databed = isset ( $databed ) ? $databed : [ ];
								foreach ( $databed as $attendance ) {
									
									$print = $print .$attendance;
								
								}
							
							$print = $print.'
							</table></td>';
						
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table></tr>';
						
						//////////////////////
						
					
					}
					
					
					else{
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
					}		
						
					
		}
	
		$data["test"] = $print;
		$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		$data["jumlahpasienpulangbesok"] = $this->Model_bed->jumlahpulangbesok();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bedtester',$data);
}
public function ajaxambilpasien($idnya,$kddokter,$kodebed){
	$datakamar = $this->Model_bed->ambil_data_mr($idnya,$kddokter,$kodebed);
	echo json_encode($datakamar);
}
public function ajaxambilpasienpulangsekarang($idnya,$kddokter,$kodebed){
	$datakamar = $this->Model_bed->ambil_data_mr_pulangsekarang($idnya,$kddokter,$kodebed);
	echo json_encode($datakamar);
}

public function bedpasienpulangsekarang() {
	$data["listbed"] = $this->Model_bed->databedpulanghariini();
		//$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bedpulangsekarang',$data);
}

public function bedpasienpulangbesok() {
	$data["listbed"] = $this->Model_bed->databedpulangbesok();
		//$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bedpulangbesok',$data);
}
public function pasien() {
	$print ="";
	$data["pasien"] = $this->Model_bed->listpasienperbed();
		
		$i = 1;
		foreach($data["pasien"] as $dtpasien){
			
			$datatglcekout = date("Y-m-d H:i:s",strtotime($dtpasien->TglKeluar." ".$dtpasien->JamKeluar));
			//////////// tgl cekin ////////////
			  $tglcekin = $dtpasien->TgLIsi;
			  if($tglcekin){
				$tglisi = date("d F Y",strtotime($dtpasien->TgLIsi))." ".$dtpasien->JamIsi;
			  }else{
				$tglisi = " "; 
			  }
			  //////////// tgl cekout ////////////
			  $tglcekout = $dtpasien->TglKeluar;
			  if($tglcekout){
				$tglkeluar = date("d F Y",strtotime($dtpasien->TglKeluar))." ".$dtpasien->JamKeluar;
			  }else{
				$tglkeluar = " "; 
			  }
			 //////////// estimasi pulang /////////////////
			  
				$awal  = date_create($datatglcekout);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				
				
				$tglsekarang = date("Y-m-d");
				if($tglcekout == $tglsekarang){
					$hasilkedipestimasi = "<p id='kedip'>".$hasilestimasi.'</p>';
				}else{
					$hasilkedipestimasi = '<b>'.$hasilestimasi.'</b>';
					}
			/////////////////////////////
			$kodedokter = $dtpasien->Dokter;
			$querydokter = $this->db->query("Select * from JDokter where Kode_Dokter = '$kodedokter' ")->row_array();
			
			$mr = $dtpasien->MR;
			$querypasien = $this->db->query("SELECT * from JPasien where Nomor_mr='$mr'")->row_array();
			
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$mr' ")->row_array();
			/////////////////////
			
			$print = $print .'<tr style="background:white;" ><td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;b:white;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$dtpasien->MR."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$dtpasien->KodeBed."'".','."'".$dtpasien->NamaBed."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
						
						
							<div class="info-box-content">
								<small>'.$dtpasien->NamaBed.'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
								
								
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
					</td>'.
					"<td style='vertical-align:middle;width:;'>
					<table class='table table-striped' style='vertical-align:middle;'>
						<tr>
							<td style='width:50px;'>MR</td>
							<td style='width:5px;'><center>:</td>
							<td>".$dtpasien->MR."</td>
						</tr>
						<tr>
							<td style='width:50px;'>Pasien</td>
							<td style='width:5px;'><center>:</td>
							<td>".strtoupper($querypasien['Nama'])."</td>
						</tr>
					</table>
					</td>".
					"<td style='vertical-align:middle;width:;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><center>".$hasilkedipestimasi."</td></tr>";
					
		}
		
		$data["test"] = $print;
		$this->mouldthing('Badmanagement/Pasien/View_pasien',$data);
}

////////////////////// bed sedang kosong ///////////////////////////////////////
public function bedkosong() {
		$print ="";
		$print2 ="";
		
		$data["ruangan"] = $this->Model_bed->listruangan();
		
		$i = 1;
		foreach($data["ruangan"] as $dtruang){
			
			$print = $print ."
					<tr>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->KODE_RUANG."</center></td>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->NAMA_RUANG.'</center></td>';
					
					$kdkelas = $dtruang->KodeKelas;
					$dtklas = $this->Model_bed->listkelas($kdkelas);
					
			$print = $print ."
					<td style='background:white;vertical-align:middle;'><center>".$dtklas['NamaKelas'].'</center></td>';		
					
					$kdruang = $dtruang->KODE_RUANG;
					
					$data["coba"] = $this->Model_bed->listkamar($kdruang);
					if(!empty($data['coba'])){
						
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:;' >";
						
						foreach($data['coba'] as $dd){
							$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr><td style='border:1px solid silver;vertical-align:middle;width:20%;' >".$dd->NamaKamar.'</td>
								';
							
							$print = $print."
							<td style='background:white;vertical-align:middle;padding-top:30px;border:1px solid silver;' ><table class='table table-striped table-bordered' style='width:100%;' >
							<tr>
								<th style='width:20%;' ><center><b>Nama Bed</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check In</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check Out</b></center></th>
								<th style='width:20%;' ><center><b>Estimasi Waktu Pulang</b></center></th>
							</tr>";
							
							$databed= $this->Model_bed->listbedkosong($kdkamar);

								$databed = isset ( $databed ) ? $databed : [ ];
								foreach ( $databed as $attendance ) {
									
									$print = $print .$attendance;
								
								}
							
							
							
							$print = $print.'
							</table></td>';
						
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table>';
						
						//////////////////////
						
					
					}
					
					
					else{
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
					}		
						
					
		}
	
		$data["test"] = $print;
		$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		$data["jumlahpasienpulangbesok"] = $this->Model_bed->jumlahpulangbesok();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bedkosong',$data);
}
////////////////////// bed sedang dibersihkan ///////////////////////////////////////
public function beddibersihkan() {
		$print ="";
		$print2 ="";
		
		$data["ruangan"] = $this->Model_bed->listruangan();
		
		$i = 1;
		foreach($data["ruangan"] as $dtruang){
			
			$print = $print ."
					<tr>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->KODE_RUANG."</center></td>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->NAMA_RUANG.'</center></td>';
					
					$kdkelas = $dtruang->KodeKelas;
					$dtklas = $this->Model_bed->listkelas($kdkelas);
					
			$print = $print ."
					<td style='background:white;vertical-align:middle;'><center>".$dtklas['NamaKelas'].'</center></td>';		
					
					$kdruang = $dtruang->KODE_RUANG;
					
					$data["coba"] = $this->Model_bed->listkamar($kdruang);
					if(!empty($data['coba'])){
						
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:;' >";
						
						foreach($data['coba'] as $dd){
							$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr><td style='border:1px solid silver;vertical-align:middle;width:20%;' >".$dd->NamaKamar.'</td>
								';
							
							$print = $print."
							<td style='background:white;vertical-align:middle;padding-top:30px;border:1px solid silver;' ><table class='table table-striped table-bordered' style='width:100%;' >
							<tr>
								<th style='width:20%;' ><center><b>Nama Bed</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Selesai Di Bersihkan</b></center></th>
								<th style='width:20%;' ><center><b>Waktu Bersih</b></center></th>
							</tr>";
							
							$databed= $this->Model_bed->listbeddibersihkan($kdkamar);

								$databed = isset ( $databed ) ? $databed : [ ];
								foreach ( $databed as $attendance ) {
									
									$print = $print .$attendance;
								
								}
							
							
							
							$print = $print.'
							</table></td>';
						
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table>';
						
						//////////////////////
						
					
					}
					
					
					else{
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
					}		
						
					
		}
	
		$data["test"] = $print;
		$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		$data["jumlahpasienpulangbesok"] = $this->Model_bed->jumlahpulangbesok();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_beddibersihkan',$data);
}	
////////////////////// bed sedang terisi ///////////////////////////////////////
public function bedterisi() {
		$print ="";
		$print2 ="";
		
		$data["ruangan"] = $this->Model_bed->listruangan();
		
		$i = 1;
		foreach($data["ruangan"] as $dtruang){
			
			$print = $print ."
					<tr>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->KODE_RUANG."</center></td>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->NAMA_RUANG.'</center></td>';
					
					$kdkelas = $dtruang->KodeKelas;
					$dtklas = $this->Model_bed->listkelas($kdkelas);
					
			$print = $print ."
					<td style='background:white;vertical-align:middle;'><center>".$dtklas['NamaKelas'].'</center></td>';		
					
					$kdruang = $dtruang->KODE_RUANG;
					
					$data["coba"] = $this->Model_bed->listkamar($kdruang);
					if(!empty($data['coba'])){
						
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:;' >";
						
						foreach($data['coba'] as $dd){
							$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr><td style='border:1px solid silver;vertical-align:middle;width:20%;' >".$dd->NamaKamar.'</td>
								';
							
							$print = $print."
							<td style='background:white;vertical-align:middle;padding-top:30px;border:1px solid silver;' ><table class='table table-striped table-bordered' style='width:100%;' >
							<tr>
								<th style='width:20%;' ><center><b>Nama Bed</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check In</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check Out</b></center></th>
								<th style='width:20%;' ><center><b>Estimasi Waktu Pulang</b></center></th>
							</tr>";
							
							$databed= $this->Model_bed->listbedterisi($kdkamar);

								$databed = isset ( $databed ) ? $databed : [ ];
								foreach ( $databed as $attendance ) {
									
									$print = $print .$attendance;
								
								}
							
							
							
							$print = $print.'
							</table></td>';
						
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table>';
						
						//////////////////////
						
					
					}
					
					
					else{
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
					}		
						
					
		}
	
		$data["test"] = $print;
		$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		$data["jumlahpasienpulangbesok"] = $this->Model_bed->jumlahpulangbesok();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bedterisi',$data);
}	
////////////////////// bed sedang tidakaktif ///////////////////////////////////////
public function bedtidakaktif() {
		$print ="";
		$print2 ="";
		
		$data["ruangan"] = $this->Model_bed->listruangan();
		
		$i = 1;
		foreach($data["ruangan"] as $dtruang){
			
			$print = $print ."
					<tr>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->KODE_RUANG."</center></td>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->NAMA_RUANG.'</center></td>';
					
					$kdkelas = $dtruang->KodeKelas;
					$dtklas = $this->Model_bed->listkelas($kdkelas);
					
			$print = $print ."
					<td style='background:white;vertical-align:middle;'><center>".$dtklas['NamaKelas'].'</center></td>';		
					
					$kdruang = $dtruang->KODE_RUANG;
					
					$data["coba"] = $this->Model_bed->listkamar($kdruang);
					if(!empty($data['coba'])){
						
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:;' >";
						
						foreach($data['coba'] as $dd){
							$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr><td style='border:1px solid silver;vertical-align:middle;width:20%;' >".$dd->NamaKamar.'</td>
								';
							
							$print = $print."
							<td style='background:white;vertical-align:middle;padding-top:30px;border:1px solid silver;' ><table class='table table-striped table-bordered' style='width:100%;' >
							<tr>
								<th style='width:20%;' ><center><b>Nama Bed</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check In</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check Out</b></center></th>
								<th style='width:20%;' ><center><b>Estimasi Waktu Pulang</b></center></th>
							</tr>";
							
							$databed= $this->Model_bed->listbedtidakaktif($kdkamar);

								$databed = isset ( $databed ) ? $databed : [ ];
								foreach ( $databed as $attendance ) {
									
									$print = $print .$attendance;
								
								}
							
							
							
							$print = $print.'
							</table></td>';
						
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table>';
						
						//////////////////////
						
					
					}
					
					
					else{
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
					}		
						
					
		}
	
		$data["test"] = $print;
		$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		$data["jumlahpasienpulangbesok"] = $this->Model_bed->jumlahpulangbesok();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bedtidakaktif',$data);
}

////////////////////// bed sedang dbooking ///////////////////////////////////////
public function bedboking() {
		$print ="";
		$print2 ="";
		
		$data["ruangan"] = $this->Model_bed->listruangan();
		
		$i = 1;
		foreach($data["ruangan"] as $dtruang){
			
			$print = $print ."
					<tr>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->KODE_RUANG."</center></td>
					<td style='background:white;vertical-align:middle;'><center>".$dtruang->NAMA_RUANG.'</center></td>';
					
					$kdkelas = $dtruang->KodeKelas;
					$dtklas = $this->Model_bed->listkelas($kdkelas);
					
			$print = $print ."
					<td style='background:white;vertical-align:middle;'><center>".$dtklas['NamaKelas'].'</center></td>';		
					
					$kdruang = $dtruang->KODE_RUANG;
					
					$data["coba"] = $this->Model_bed->listkamar($kdruang);
					if(!empty($data['coba'])){
						
						$print = $print."
						<td style='background:white;vertical-align:middle;padding-top:30px;' ><table class='table table-hover' style='width:;' >";
						
						foreach($data['coba'] as $dd){
							$kdkamar = $dd->KodeKamar;
							
							$print = $print ."
								<tr><td style='border:1px solid silver;vertical-align:middle;width:20%;' >".$dd->NamaKamar.'</td>
								';
							
							$print = $print."
							<td style='background:white;vertical-align:middle;padding-top:30px;border:1px solid silver;' ><table class='table table-striped table-bordered' style='width:100%;' >
							<tr>
								<th style='width:20%;' ><center><b>Nama Bed</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check In</b></center></th>
								<th style='width:20%;' ><center><b>Tanggal Check Out</b></center></th>
								<th style='width:20%;' ><center><b>Estimasi Waktu Pulang</b></center></th>
							</tr>";
							
							$databed= $this->Model_bed->listbedboking($kdkamar);

								$databed = isset ( $databed ) ? $databed : [ ];
								foreach ( $databed as $attendance ) {
									
									$print = $print .$attendance;
								
								}
							
							
							
							$print = $print.'
							</table></td>';
						
							$print = $print.'
							</tr>';
						}
						
						$print = $print.'
						</td></table>';
						
						//////////////////////
						
					
					}
					
					
					else{
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
						
						///////////////////////////
						$print = $print.'
						<td><table>';
						
						$print = $print .'
						<td></td>';
					
						$print = $print.'
						</td></table>';
					}		
						
					
		}
	
		$data["test"] = $print;
		$data["jumlahpasienpulang"] = $this->Model_bed->jumlahpulanghariini();
		$data["jumlahpasienpulangbesok"] = $this->Model_bed->jumlahpulangbesok();
		
		
		///////////////////////////////////////////////////////////////////////
		
		$this->mouldthing('Badmanagement/Bed/View_bedboking',$data);
}
public function jumlahpasienpertanggal() {
		
		if($this->input->post()){
		$tanggalawal = date("Y-m-d",strtotime($this->input->post("Tanggal_Awal")));
		$tanggalakhir = date("Y-m-d",strtotime($this->input->post("Tanggal_Akhir")));
		}else{
			$tanggalawal = date("Y-m-d");
			$tanggalakhir = date("Y-m-d");
		}
		
		$print ="";
		$data["jumlahpasien"] = $this->Model_bed->listpasienpulang($tanggalawal,$tanggalakhir);
		
		$i = 1;
		foreach($data["jumlahpasien"] as $dtjmlpasien){
			$mr = $dtjmlpasien->NOMOR_MR;
			$ruangan = $dtjmlpasien->LASTROOM;
			
			$tglmasuk = $dtjmlpasien->TANGGAL_MASUK.' '.$dtjmlpasien->JAM_MASUK;
			$tglkeluar = $dtjmlpasien->TANGGAL_KELUAR.' '.$dtjmlpasien->JAM_KELUAR;
			
			$awal  = date_create($tglmasuk);
			$akhir = date_create($tglkeluar); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilestimasi = $diff->d . ' hari ';
			
			$pasien = $this->db->query("select * from JPasien where Nomor_mr='$mr' ")->row_array();
			$ruangan = $this->db->query("select * from ITbrRwt where KODE_RUANG='$ruangan' ")->row_array();
			$kodekelas = $ruangan["KodeKelas"];
			$kelas = $this->db->query("select * from ITbKelas where KodeKelas='$kodekelas' ")->row_array();
			
			$print = $print."
			<tr>
			<td style='background:white;vertical-align:middle;'><center>".$dtjmlpasien->NOMOR_MR."</center></td>
			<td style='background:white;vertical-align:middle;'>".$pasien['Nama']."</td>
			
			<!-- tidak diaktifkan
			<td style='background:white;vertical-align:middle;'><center>".date("d F Y",strtotime($tglmasuk)).'<br>'.date("H:i:s",strtotime($tglmasuk))."</center></td>
			<td style='background:white;vertical-align:middle;'><center>".date("d F Y",strtotime($tglkeluar)).'<br>'.date("H:i:s",strtotime($tglmasuk))."</center></td>
			-->
			
			<td style='background:white;vertical-align:middle;'><center>".date("d F Y",strtotime($tglmasuk))."</center></td>
			<td style='background:white;vertical-align:middle;'><center>".date("d F Y",strtotime($tglkeluar))."</center></td>
			<td style='background:white;vertical-align:middle;'><center>".$hasilestimasi."</center></td>
			<td style='background:white;vertical-align:middle;'><center>".$kelas["NamaKelas"]."</center></td>";
			
			
			$print = $print.'
						</tr>';
						
		}
		
		$data["tglawal"]=$tanggalawal;
		$data["tglakhir"]=$tanggalakhir;
		
		$data["test"] = $print;
		$this->mouldthing('Badmanagement/Pasien/View_jumlahpasien',$data);
		
}
public function jumlahpasienpertanggalexcel() {
		
		$tanggalawal = $this->uri->segment(3);
		$tanggalakhir = $this->uri->segment(4);
		
		$print ="";
		$data["jumlahpasien"] = $this->Model_bed->listpasienpulang($tanggalawal,$tanggalakhir);
		
		$i = 1;
		foreach($data["jumlahpasien"] as $dtjmlpasien){
			$mr = $dtjmlpasien->NOMOR_MR;
			$ruangan = $dtjmlpasien->LASTROOM;
			
			$tglmasuk = $dtjmlpasien->TANGGAL_MASUK.' '.$dtjmlpasien->JAM_MASUK;
			$tglkeluar = $dtjmlpasien->TANGGAL_KELUAR.' '.$dtjmlpasien->JAM_KELUAR;
			
			$awal  = date_create($tglmasuk);
			$akhir = date_create($tglkeluar); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilestimasi = $diff->d . ' hari ';
			
			$pasien = $this->db->query("select * from JPasien where Nomor_mr='$mr' ")->row_array();
			$ruangan = $this->db->query("select * from ITbrRwt where KODE_RUANG='$ruangan' ")->row_array();
			$kodekelas = $ruangan["KodeKelas"];
			$kelas = $this->db->query("select * from ITbKelas where KodeKelas='$kodekelas' ")->row_array();
			
			$print = $print."
			<tr>
			<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$dtjmlpasien->NOMOR_MR."</center></td>
			<td style='background:white;vertical-align:middle;border:1px solid black;'>".$pasien['Nama']."</td>
			<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".date("d F Y",strtotime($tglmasuk))."</center></td>
			<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".date("d F Y",strtotime($tglkeluar))."</center></td>
			<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$hasilestimasi."</center></td>
			<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$kelas["NamaKelas"]."</center></td>";
			
			
			$print = $print.'
						</tr>';
						
		}
		
		$data["tglawal"]=$tanggalawal;
		$data["tglakhir"]=$tanggalakhir;
		
		$data["test"] = $print;
		$this->load->view('Badmanagement/Pasien/View_jumlahpasienexcel',$data);
		//$this->mouldthing('Badmanagement/Pasien/View_jumlahpasienexcel',$data);
		
}

////////////// proses status bed dibersihkan ////////////
public function prosesstatusdibersihkan(){
	$idbed = $this->uri->segment(3);
	
	$databed = $this->db->query("select * from ITbrRwtDD where KodeBed='$idbed' ")->row_array();
	$nmbed = $databed["NamaBed"];
	$kdkamar = $databed["KodeRuang"];
	$tglbersih = $databed["TanggalBersih"];
	$jambersih = $databed["JamBersih"];
	
	$datakamar = $this->db->query("select * from ITbrRwtD where KodeKamar='$kdkamar' ")->row_array();
	$nmkmar = $datakamar["NamaKamar"];
	$kdruang = $datakamar["KodeRuang"];
	
	$dataruang = $this->db->query("select * from ITbrRwt where KODE_RUANG='$kdruang' ")->row_array();
	$nmruang = $dataruang["NAMA_RUANG"];
	$kdkelas =  $dataruang["KodeKelas"];
	
	$datakelas = $this->db->query("select * from ITbKelas where KodeKelas='$kdkelas' ")->row_array();
	$nmkelas = $datakelas["NamaKelas"];
	$kodekelas =  $datakelas["KodeKelas"];
	
	$idhystori = $this->Model_bed->kodehystorybedbersih();
	
	$data["kodebed"]=$idbed;
	$data["namabed"]=$nmbed;
	$data["tanggalbersih"]=$tglbersih.' '.$jambersih;
	
	$data["kodekamar"]=$kdkamar;
	$data["namakamar"]=$nmkmar;
	
	$data["koderuang"]=$kdruang;
	$data["namaruang"]=$nmruang;
	
	$data["kodekelas"]=$kodekelas;
	$data["namakelas"]=$nmkelas;
	
	$data["idhistori"]=$idhystori;
	
	$data[""]="";
	$this->mouldthing('Badmanagement/Bed/View_Updateprosesstatusbed',$data);
	
}
public function simpanstatuspembersihanbed(){
	$idhystori = $this->Model_bed->kodehystorybedbersih();
	/*$dataupdate = array(
					"Id_Hystori"=>$idhystori,
					"User_Id"=>$this->input->post("User_Id"),
					"KodeBed"=>$this->input->post("KodeBed"),
					"KodeKamar"=>$this->input->post("KodeKamar"),
					"KodeRuang"=>$this->input->post("KodeRuang"),
					"KodeKelas"=>$this->input->post("KodeKelas"),
					"PetugasKebersihan"=>$this->input->post("PetugasKebersihan"),
					"TanggalBersih"=>date("Y-m-d",strtotime($this->input->post("tanggaldanjambersih"))),
					"JamBersih"=>date("H:i:s",strtotime($this->input->post("tanggaldanjambersih")))
					);
	*/	
					$a = $idhystori;
					$b = $this->input->post("User_Id");
					$c = $this->input->post("KodeBed");
					$d = $this->input->post("KodeKamar");
					$e = $this->input->post("KodeRuang");
					$f = $this->input->post("KodeKelas");
					$g = $this->input->post("PetugasKebersihan");
					$h = date("Y-m-d",strtotime($this->input->post("tanggaldanjambersih")));
					$i = date("H:i:s",strtotime($this->input->post("tanggaldanjambersih")));
		
	$this->db->query("insert into Tb_Hystori_Pembersihanbed (Id_Hystori,User_Id,KodeBed,KodeKamar,KodeRuang,KodeKelas,PetugasKebersihan,TanggalBersih,JamBersih)
					values('$a','$b','$c','$d','$e','$f','$g','$h','$i')",$dataupdate);
	// update table bed 
	/*
	$data = array(
				"StatusKamar"=>"0",
				"StatusBooking"=>"0",
				"MR"=>"0",
				"Dokter"=>"",
				"TanggalBersih"=>"",
				"JamBersih"=>"",
				"TgLIsi"=>"",
				"JamIsi"=>"",
				"TglKeluar"=>"",
				"JamKeluar"=>"",
				"statusdibersihkan"=>"",
				);
	*/			
				$aa = "0";
				$bb = "0";
				$cc = "0";
				$dd = "";
				$ee = "1999-01-01";
				$ff = "00:00:00.000";
				$gg = "1999-01-01";
				$hh = "00:00:00.000";
				$ii = "1999-01-01";
				$jj = "00:00:00.000";
				$kk = "";
	
	$this->db->query("update ITbrRwtDD set 
						StatusKamar='$aa',
						StatusBooking='$bb',
						MR='$cc',
						Dokter='$dd',
						TanggalBersih='$ee',
						JamBersih='$ff',
						TgLIsi='$gg',
						JamIsi='$hh',
						TglKeluar='$ii',
						JamKeluar='$jj',
						statusdibersihkan='$kk'
						
						where KodeBed='$c'");
	
	redirect(base_url("Controlbed/beddibersihkan")); 
}

public function laporanbed(){
	
	if($this->input->post()){
		$tglawal = date("Y-m-d",strtotime($this->input->post("Tanggal_Awal")));
		$tglakhir = date("Y-m-d",strtotime($this->input->post("Tanggal_Akhir")));
	}else{
		$tglawal = date("Y-m-d");
		$tglakhir = date("Y-m-d");;
	}
	
	$print ="";
	$datalist["datanya"] = $this->db->query("select * from Tb_Hystori_Pembersihanbed where TanggalBersih between '$tglawal' and '$tglakhir' order by TanggalBersih ASC  ")->result();
	
	foreach($datalist["datanya"] as $dt){
		$userid = $dt->User_Id;
		$kdbed = $dt->KodeBed;
		$kdkamar = $dt->KodeKamar;
		$kdruang = $dt->KodeRuang;
		$kdkelas = $dt->KodeKelas;
		
		$dtkelas = $this->db->query("select * from ITbKelas where KodeKelas='$kdkelas' ")->row_array();
		$dtruang = $this->db->query("select * from ITbrRwt where KODE_RUANG='$kdruang' ")->row_array();
		$dtkmar = $this->db->query("select * from ITbrRwtD where KodeKamar='$kdkamar' ")->row_array();
		$dtbed = $this->db->query("select * from ITbrRwtDD where KodeBed='$kdbed' ")->row_array();
		
		$print = $print."<tr>";
		
		$print = $print."
		<td style='background:white;vertical-align:middle;'><center>".$dtkelas["NamaKelas"]."</center></td>
		<td style='background:white;vertical-align:middle;'><center>".$dtruang["NAMA_RUANG"]."</center></td>
		<td style='background:white;vertical-align:middle;'><center>".$dtkmar["NamaKamar"]."</center></td>
		<td style='background:white;vertical-align:middle;'><center>".$dtbed["NamaBed"]."</center></td>
		<td style='background:white;vertical-align:middle;'><center>".$userid."</center></td>
		<td style='background:white;vertical-align:middle;'><center>".date("d F Y H:i:s",strtotime($dt->TanggalBersih.' '.$dt->JamBersih))."</center></td>
		<td style='background:white;vertical-align:middle;'><center>".$dt->PetugasKebersihan."</center></td>
		";
		
		$print = $print."</tr>";
	
	}
	
	$data["tglawal"]= $tglawal;
	$data["tglakhir"]= $tglakhir;
	 $data["test"]=$print;
	$this->mouldthing('Badmanagement/Bed/View_laporankebersihan',$data);
}

public function laporanbedcetakexcel(){
	
		$tglawal = date("Y-m-d",strtotime($this->uri->segment(3)));
		$tglakhir = date("Y-m-d",strtotime($this->uri->segment(4)));

	
	$print ="";
	$datalist["datanya"] = $this->db->query("select * from Tb_Hystori_Pembersihanbed where TanggalBersih between '$tglawal' and '$tglakhir' order by TanggalBersih ASC  ")->result();
	
	foreach($datalist["datanya"] as $dt){
		$userid = $dt->User_Id;
		$kdbed = $dt->KodeBed;
		$kdkamar = $dt->KodeKamar;
		$kdruang = $dt->KodeRuang;
		$kdkelas = $dt->KodeKelas;
		
		$dtkelas = $this->db->query("select * from ITbKelas where KodeKelas='$kdkelas' ")->row_array();
		$dtruang = $this->db->query("select * from ITbrRwt where KODE_RUANG='$kdruang' ")->row_array();
		$dtkmar = $this->db->query("select * from ITbrRwtD where KodeKamar='$kdkamar' ")->row_array();
		$dtbed = $this->db->query("select * from ITbrRwtDD where KodeBed='$kdbed' ")->row_array();
		
		$print = $print."<tr>";
		
		$print = $print."
		<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$dtkelas["NamaKelas"]."</center></td>
		<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$dtruang["NAMA_RUANG"]."</center></td>
		<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$dtkmar["NamaKamar"]."</center></td>
		<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$dtbed["NamaBed"]."</center></td>
		<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$userid."</center></td>
		<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".date("d F Y H:i:s",strtotime($dt->TanggalBersih.' '.$dt->JamBersih))."</center></td>
		<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$dt->PetugasKebersihan."</center></td>
		";
		
		$print = $print."</tr>";
	
	}
	
	$data["tglawal"]= $tglawal;
	$data["tglakhir"]= $tglakhir;
	 $data["test"]=$print;
	$this->load->view('Badmanagement/Bed/View_laporankebersihancetakexcel',$data);
}

}
