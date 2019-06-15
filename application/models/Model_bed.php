<?php
class Model_bed extends CI_Model {
	
	public function listruangan() {
		$query = $this->db->query ( "SELECT * from ITbrRwt where ROOT_KLS != 'Non Aktif' order by NAMA_RUANG ASC" );
		return $query->result();
	}
	public function listkelas($kdkelas) {
		$query = $this->db->query ( "SELECT * from ITbKelas where KodeKelas = '$kdkelas'" );
		return $query->row_array();
	}
	
	public function listkamar($kdruang) {
		$query = $this->db->query ( "SELECT * from ITbrRwtD where KodeRuang = '$kdruang' order by NamaKamar ASC" );
		return $query->result();
	}
	
	public function listbed($kdkamar){
		
		$queryString = $this->db->query( "SELECT * from ITbrRwtDD where KodeRuang = '$kdkamar' order by StatusKamar ASC");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$sts = $hasilkamar['StatusKamar'];
			$mr = $hasilkamar["MR"];
			
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$mr' ")->row_array();
			$querypasien = $this->db->query("SELECT * from JPasien where Nomor_mr='$mr'")->row_array();
			
			$datatglcekout = date("Y-m-d H:i:s",strtotime($hasilkamar['TglKeluar']." ".$hasilkamar['JamKeluar']));
			
			//$hasilestimasi = $tglkluar - $tglmasuk;
			 // $hasilestimasi = "tes";
			  
			  //////////// tgl cekin ////////////
			  $tglcekin = $hasilkamar['TgLIsi'];
			  if($tglcekin){
				$tglisi = date("d F Y",strtotime($hasilkamar['TgLIsi']))." ".$hasilkamar['JamIsi'];
			  }else{
				$tglisi = " "; 
			  }
			  //////////// tgl cekout ////////////
			  $tglcekout = $hasilkamar['TglKeluar'];
			  if($tglcekout){
				$tglkeluar = date("d F Y",strtotime($hasilkamar['TglKeluar']))." ".$hasilkamar['JamKeluar'];
			  }else{
				$tglkeluar = " "; 
			  }
			  //////////// estimasi pulang /////////////////
			  
				$awal  = date_create($datatglcekout);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				//$hasilestimasi = $diff->d . ' hari, '.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
			
			  /////////////// ambil dokter /////////////////
			  $kodedokter = $hasilkamar['Dokter'];
			  $statusboking = $hasilkamar['StatusBooking'];
			  
			  $querydokter = $this->db->query("Select * from JDokter where Kode_Dokter = '$kodedokter' ")->row_array();
			 
			 $tglsekarang = date("Y-m-d");
			 if($tglcekout == $tglsekarang){
					$hasilkedipestimasi = "<p id='kedip'>".$hasilestimasi.'</p>';
				}else{
					$hasilkedipestimasi = '<b>'.$hasilestimasi.'</b>';
					}
			  //////////////////////////////////////////////
			
			if($sts == '0'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-green">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-green'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>Sedang Kosong</span>
							<legend></legend>
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
				
			}
			
			else if($sts == '1'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-yellow">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-yellow'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
								<span class='info-box-text'>Sedang Dibersihkan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}else if($sts == '2'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;b:white;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
						
						
							<div class="info-box-content">
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
								
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				
			}else if($sts == '3'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-primary">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-primary'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>STidak Dapat Digunakan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}
			$datakamar [] = "<tr>".$status."</tr>";
		}
		return $datakamar;
		
	}
	
	public function ambil_data_kamar($idnya){
		
		$queryString = $this->db->query("SELECT * from ITbrRwtD where KodeRuang='$idnya' ");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$datakamar [] = '<table class="table table-bordered" ><tr><td style="width:50%;">'.$hasilkamar['NamaKamar'].'</td><td>'.'<a class="btn btn-sm btn-primary form form-control" href="javascript:void(0)" onclick="ambilbed('."'".$hasilkamar['KodeKamar']."'".','."'".$hasilkamar['NamaKamar']."'".')"><span class="glyphicon glyphicon-bed"></span>&nbsp; Lihat Bed</center></a></td></tr></table>';
		}
		return $datakamar;
		
	}
	
	public function ambil_data_mr($idnya,$kddokter,$kodebed){
		
		$queryString = $this->db->query("SELECT * from JPasien where Nomor_mr='$idnya'");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilpasien ) {
		
			$biday = new DateTime($hasilpasien['TanggalLahir']);
			$today = new DateTime();
	
			$diff = $today->diff($biday);
	
			//////////
			// kelamin //
			$kelamin = $hasilpasien['Jenis_kelamin'];
			if($kelamin == "L"){
				$jkl = "Laki-Laki";
			}else if($kelamin == "P"){
				$jkl = "Perempuan";
			}
			/////// cari diagnosa ///
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$idnya' ")->row_array();
			$querydokter = $this->db->query("select * from JDokter where Kode_Dokter='$kddokter' ")->row_array();
			$querybed = $this->db->query("select * from ITbrRwtDD where KodeBed='$kodebed' ")->row_array();
			
			$datatglcekin = date("Y-m-d H:i:s",strtotime($querybed["TgLIsi"]." ".$querybed['JamIsi']));
			$datatglcekout = date("Y-m-d H:i:s",strtotime($querybed['TglKeluar']." ".$querybed['JamKeluar']));
			
				$awal  = date_create($datatglcekin);
				$akhir = date_create($datatglcekout); 
				$difflamainap  = date_diff( $awal, $akhir );
				
				$hasilestimasilamainap = $difflamainap->m . ' bulan, '.$difflamainap->d . ' hari '.'<br>'.$difflamainap->h . ' jam, '.$difflamainap->i . ' menit, '.$difflamainap->s . ' detik';
			
			$tgllahir = $hasilpasien['TanggalLahir'];
			if($tgllahir){
				$hasiltgllahir = date("d F Y",strtotime($hasilpasien['TanggalLahir']));
			}else{
				$hasiltgllahir = "";
			}
			///////////////////////////
			$datakamar [] = '<table class="table table-bordered" >
			<tr>
				<td>Nomor MR</td>
				<td>'.$hasilpasien['Nomor_mr']."</td>
			</tr>".
			'<tr>
				<td>Nama Pasien</td>
				<td>'.$hasilpasien['Nama']."</td>
			</tr>".
			'<tr>
				<td>Tanggal Lahir</td>
				<td>'.date("d F Y",strtotime($hasiltgllahir))."</td>
			</tr>".
			'<tr>
				<td>Umur</td>
				<td>'.$diff->y ." Tahun ".$diff->m ." Bulan"."</td>
			</tr>".
			'<tr>
				<td>Jenis Kelamin</td>
				<td>'.$jkl."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;" >Alamat</td>
				<td>'.$hasilpasien['Alamat']." Rt. ".$hasilpasien['RW']." Rw. ".$hasilpasien['RW']."<br>"."Kel. ".$hasilpasien['Kelurahan']." Kec. ".$hasilpasien['Kecamatan']." Kota. ".$hasilpasien['Kota']."</td>
			</tr>".
			'<tr>
				<td>Diagnosa</td>
				<td>'.$querydiagnosa["DIAGNOSA"]."</td>
			</tr>".
			'<tr>
				<td>Dokter</td>
				<td>'.$querydokter["Nama_Dokter"]."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;">Estimasi Waktu Pulang</td>
				<td>'.$hasilestimasilamainap."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;">Keterangan</td>
				<td>'.$hasilpasien['Keterangan']."</td>
			</tr>".
			"</table>";
		}
		return $datakamar;
		
	}
	
	public function listbed2($kdkamar) {
		$query = $this->db->query ( "SELECT * from ITbrRwtDD where KodeRuang = '$kdkamar' order by StatusKamar ASC" );
		return $query->result();
		/*
		$myquery = $query->result_array();
		$datakamar = [];
		
							foreach ( $myquery as $hasilkamar ) {
								$sts = $hasilkamar['StatusKamar'];
								if($sts == '0'){
									$status = "<td style='background:green;color:white;'><b>Sedang Kosong</b></td>";
								}else if($sts == '1'){
									$status = "<td style='background:orange;color:white;'><b>Sedang Dibersihkan</b></td>";
								}else if($sts == '2'){
									$status = "<td style='background:blue;color:white;'><b>Sedang Terisi</b></td>";
								}else if($sts == '3'){
									$status = "<td style='background:red;color:white;'><b>Tidak Dapat Diguakan</b></td>";
								}
								$datakamar [] = $status;
							}
						return $datakamar;
						*/
	}
////////////////////////////////////////////////////////////////////////////////////////
	public function datamasterbed() {
		$query = $this->db->query ( "SELECT * from ITbrRwtDD where order by NamaBed ASC" );
		return $query->result_array();
	}
	public function namadokter($dokter) {
		$query = $this->db->query ( "SELECT * from JDokter where Kode_Dokter='$dokter' " );
		return $query->row_array();
	}
///////////////////////////////////////////////////////////////////////////////////////////
	public function getUsers($tglawal, $tglakhir) {
		$query = $this->db->query ( "SELECT USERID FROM CHECKINOUT WHERE (CHECKTIME BETWEEN #$tglawal# AND #$tglakhir#) GROUP BY USERID" );
		return $query->result_array ();
	}
	public function getCheckinoutBetweenDate($userId, $tglawal, $tglakhir) {
		$queryString = "SELECT CHECKTIME FROM CHECKINOUT WHERE (USERID=$userId)";
		
		$queryString .= "  AND (CHECKTIME BETWEEN #$tglawal# AND #$tglakhir#) ORDER BY CHECKTIME";
		
		//var_dump($queryString);
		
		$query = $this->db->query ( $queryString );
		
		$checkinOuts = $query->result_array ();
		$checkinOutTimes = [ ];
		foreach ( $checkinOuts as $checkinOut ) {
			$checkinOutTimes [] = date("d F Y - H:i:s",strtotime($checkinOut ['CHECKTIME']));
		}
		return $checkinOutTimes;
	}
	public function nameUser ($userId) {
		$query = $this->db->query ( "SELECT Name FROM USERINFO WHERE (USERID =$userId)" );
		//var_dump($query);
		return $query->row_array ();
	}
	public function jumlahpulanghariini() {
		date_default_timezone_set("Asia/Jakarta");
		$tglskarang = date("Y-m-d");
		$query = $this->db->query ( "SELECT count('KodeBed') as ttlpulang from ITbrRwtDD where TglKeluar='$tglskarang' " );
		//var_dump($query);
		return $query->row_array ();
	}
	public function jumlahpulangbesok() {
		date_default_timezone_set("Asia/Jakarta");
		$besok = mktime (0,0,0, date("m"), date("d")+1,date("Y"));
		$tglpulangbesok =  date('Y-m-d', $besok);
		
		$query = $this->db->query ( "SELECT count('KodeBed') as ttlpulangbesok from ITbrRwtDD where TglKeluar='$tglpulangbesok' " );
		//var_dump($query);
		return $query->row_array ();
	}
	
////////////// untuk pulang sekarang //
public function databedpulanghariini() {
		date_default_timezone_set("Asia/Jakarta");
		$date = date("Y-m-d");
		
		$query = $this->db->query ( "SELECT * from ITbrRwtDD where TglKeluar = '$date' order by TglKeluar ASC" );
		return $query->result();
	}
	
////////////// untuk pulang besok //
public function databedpulangbesok() {
		date_default_timezone_set("Asia/Jakarta");
		$besok = mktime (0,0,0, date("m"), date("d")+1,date("Y"));
		$tglpulangbesok =  date('Y-m-d', $besok);
		
		$query = $this->db->query ( "SELECT * from ITbrRwtDD where TglKeluar = '$tglpulangbesok' order by TglKeluar ASC" );
		return $query->result();
	}
/////////////////////////////////////////
	public function listruanganpulangsekarang() {
		$query = $this->db->query ( "SELECT * from ITbrRwt where ROOT_KLS != 'Non Aktif' order by NAMA_RUANG ASC" );
		return $query->result();
		
		/*
		date_default_timezone_set("Asia/Jakarta");
		$date = date("Y-m-d");
		
		$query = $this->db->query ( "select ITbrRwtDD.*, ITbrRwtD.*, ITbrRwt.* from
ITbrRwtDD join ITbrRwtD on 
ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar join ITbrRwt on
ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG where
ITbrRwtDD.TglKeluar = '$date' order by ITbrRwt.NAMA_RUANG ASC" );
		return $query->result();
		*/
	}
	public function listkamarpulangsekarang($kdruang) {
		$query = $this->db->query ( "SELECT * from ITbrRwtD where KodeRuang = '$kdruang' order by NamaKamar ASC" );
		return $query->result();
	}
public function ambil_data_mr_pulangsekarang($idnya,$kddokter,$kodebed){
		
		$queryString = $this->db->query("SELECT * from JPasien where Nomor_mr='$idnya'");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilpasien ) {
		
			$biday = new DateTime($hasilpasien['TanggalLahir']);
			$today = new DateTime();
	
			$diff = $today->diff($biday);
	
			//////////
			// kelamin //
			$kelamin = $hasilpasien['Jenis_kelamin'];
			if($kelamin == "L"){
				$jkl = "Laki-Laki";
			}else if($kelamin == "P"){
				$jkl = "Perempuan";
			}
			/////// cari diagnosa ///
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$idnya' ")->row_array();
			$querydokter = $this->db->query("select * from JDokter where Kode_Dokter='$kddokter' ")->row_array();
			$querybed = $this->db->query("select * from ITbrRwtDD where KodeBed='$kodebed' ")->row_array();
			
			$koderuang = $querybed["KodeRuang"];
			$querykamar = $this->db->query("select * from ITbrRwtD where KodeKamar='$koderuang' ")->row_array();
			$koderuang = $querykamar["KodeRuang"];
			$queryruang = $this->db->query("select * from ITbrRwt where KODE_RUANG='$koderuang' ")->row_array();
			$kodekelas = $queryruang["KodeKelas"];
			$querykelas = $this->db->query("select * from ITbKelas where KodeKelas='$kodekelas' ")->row_array();
			
			$datatglcekin = date("Y-m-d H:i:s",strtotime($querybed["TgLIsi"]." ".$querybed['JamIsi']));
			$datatglcekout = date("Y-m-d H:i:s",strtotime($querybed['TglKeluar']." ".$querybed['JamKeluar']));
			
				$awal  = date_create($datatglcekin);
				$akhir = date_create($datatglcekout); 
				$difflamainap  = date_diff( $awal, $akhir );
				
				$hasilestimasilamainap = $difflamainap->m . ' bulan, '.$difflamainap->d . ' hari '.'<br>'.$difflamainap->h . ' jam, '.$difflamainap->i . ' menit, '.$difflamainap->s . ' detik';
			
			$tgllahir = $hasilpasien['TanggalLahir'];
			if($tgllahir){
				$hasiltgllahir = date("d F Y",strtotime($hasilpasien['TanggalLahir']));
			}else{
				$hasiltgllahir = "";
			}
			///////////////////////////
			$datakamar [] = '<table class="table table-bordered" >'.
			'<tr>
				<td style="vertical-align:middle;">Kode Ruang</td>
				<td>'.$koderuang."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;">Nama Ruang</td>
				<td>'.$queryruang["NAMA_RUANG"]."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;">Nama Kelas</td>
				<td>'.$querykelas["NamaKelas"]."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;">Nama Kamar</td>
				<td>'.$querykamar["NamaKamar"]."</td>
			</tr>".
			'<tr>
				<td>Nomor MR</td>
				<td>'.$hasilpasien['Nomor_mr']."</td>
			</tr>".
			'<tr>
				<td>Nama Pasien</td>
				<td>'.$hasilpasien['Nama']."</td>
			</tr>".
			'<tr>
				<td>Tanggal Lahir</td>
				<td>'.date("d F Y",strtotime($hasiltgllahir))."</td>
			</tr>".
			'<tr>
				<td>Umur</td>
				<td>'.$diff->y ." Tahun ".$diff->m ." Bulan"."</td>
			</tr>".
			'<tr>
				<td>Jenis Kelamin</td>
				<td>'.$jkl."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;" >Alamat</td>
				<td>'.$hasilpasien['Alamat']." Rt. ".$hasilpasien['RW']." Rw. ".$hasilpasien['RW']."<br>"."Kel. ".$hasilpasien['Kelurahan']." Kec. ".$hasilpasien['Kecamatan']." Kota. ".$hasilpasien['Kota']."</td>
			</tr>".
			'<tr>
				<td>Diagnosa</td>
				<td>'.$querydiagnosa["DIAGNOSA"]."</td>
			</tr>".
			'<tr>
				<td>Dokter</td>
				<td>'.$querydokter["Nama_Dokter"]."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;">Estimasi Waktu Pulang</td>
				<td>'.$hasilestimasilamainap."</td>
			</tr>".
			'<tr>
				<td style="vertical-align:middle;">Keterangan</td>
				<td>'.$hasilpasien['Keterangan']."</td>
			</tr>".
			
			"</table>";
		}
		return $datakamar;
		
	}
	
public function listpasienperbed(){
	$query = $this->db->query("select * from ITbrRwtDD where MR !='0' ");
	return $query->result();
}

////////////// list bed kosong /////////////////
public function listbedkosong($kdkamar){
		
		$queryString = $this->db->query( "SELECT * from ITbrRwtDD where KodeRuang = '$kdkamar' and StatusKamar = '0' order by StatusKamar ASC");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$sts = $hasilkamar['StatusKamar'];
			$mr = $hasilkamar["MR"];
			
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$mr' ")->row_array();
			$querypasien = $this->db->query("SELECT * from JPasien where Nomor_mr='$mr'")->row_array();
			
			$datatglcekout = date("Y-m-d H:i:s",strtotime($hasilkamar['TglKeluar']." ".$hasilkamar['JamKeluar']));
			
			//$hasilestimasi = $tglkluar - $tglmasuk;
			 // $hasilestimasi = "tes";
			  
			  //////////// tgl cekin ////////////
			  $tglcekin = $hasilkamar['TgLIsi'];
			  if($tglcekin){
				$tglisi = date("d F Y",strtotime($hasilkamar['TgLIsi']))." ".$hasilkamar['JamIsi'];
			  }else{
				$tglisi = " "; 
			  }
			  //////////// tgl cekout ////////////
			  $tglcekout = $hasilkamar['TglKeluar'];
			  if($tglcekout){
				$tglkeluar = date("d F Y",strtotime($hasilkamar['TglKeluar']))." ".$hasilkamar['JamKeluar'];
			  }else{
				$tglkeluar = " "; 
			  }
			  //////////// estimasi pulang /////////////////
			  
				$awal  = date_create($datatglcekout);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				//$hasilestimasi = $diff->d . ' hari, '.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
			
			  /////////////// ambil dokter /////////////////
			  $kodedokter = $hasilkamar['Dokter'];
			  $statusboking = $hasilkamar['StatusBooking'];
			  
			  $querydokter = $this->db->query("Select * from JDokter where Kode_Dokter = '$kodedokter' ")->row_array();
			 
			 $tglsekarang = date("Y-m-d");
			 if($tglcekout == $tglsekarang){
					$hasilkedipestimasi = "<p id='kedip'>".$hasilestimasi.'</p>';
				}else{
					$hasilkedipestimasi = '<b>'.$hasilestimasi.'</b>';
					}
			  //////////////////////////////////////////////
			
			if($sts == '0'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-green">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-green'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>Sedang Kosong</span>
							<legend></legend>
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
				
			}
			
			else if($sts == '1'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-yellow">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-yellow'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
								<span class='info-box-text'>Sedang Dibersihkan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}else if($sts == '2'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;b:white;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
						
						
							<div class="info-box-content">
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
								
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				
			}else if($sts == '3'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-primary">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-primary'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>STidak Dapat Digunakan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}
			$datakamar [] = "<tr>".$status."</tr>";
		}
		return $datakamar;
		
	}
	////////////// list bed dibersihkan /////////////////
public function listbeddibersihkan($kdkamar){
		
		$queryString = $this->db->query( "SELECT * from ITbrRwtDD where KodeRuang = '$kdkamar' and StatusKamar = '1' order by StatusKamar ASC");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$sts = $hasilkamar['StatusKamar'];
			$mr = $hasilkamar["MR"];
			
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$mr' ")->row_array();
			$querypasien = $this->db->query("SELECT * from JPasien where Nomor_mr='$mr'")->row_array();
			
			date_default_timezone_set("Asia/Jakarta");
			$datatglcekout = date("Y-m-d H:i:s",strtotime($hasilkamar['TanggalBersih']." ".$hasilkamar['JamBersih']));
			
			
			  //////////// tgl cekout ////////////
			  $tglcekout = date("Y-m-d");
			  if($tglcekout){
				$tglkeluar = date("d F Y H:i:s",strtotime($datatglcekout));
			  }else{
				$tglkeluar = " "; 
			  }
			  //////////// estimasi pulang /////////////////
			  
				$akhir  = date_create($datatglcekout);
				$awal = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				//$hasilestimasi = $diff->d . ' hari, '.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
			
			  /////////////// ambil dokter /////////////////
			  $kodedokter = $hasilkamar['Dokter'];
			  $statusboking = $hasilkamar['StatusBooking'];
			  
			  $querydokter = $this->db->query("Select * from JDokter where Kode_Dokter = '$kodedokter' ")->row_array();
			 
			 $tglsekarang = date("Y-m-d");
			 if($tglcekout == $tglsekarang){
					$hasilkedipestimasi = "<p id='kedip'>".$hasilestimasi.'</p>';
				}else{
					$hasilkedipestimasi = '<b>'.$hasilestimasi.'</b>';
					}
			  //////////////////////////////////////////////
	
			if($sts == '1'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-yellow">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$hasilkedipestimasi."</b></td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-yellow'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
								<span class='info-box-text'>Sedang Dibersihkan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
					
						<a href='prosesstatusdibersihkan/".$hasilkamar['KodeBed']."' style='width:250px' class='glyphicon glyphicon-edit form form-control btn btn-success '> Update Status</a>
					
					</td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$hasilkedipestimasi."</b></td>";
				}
				
			}else {
				
			}
			$datakamar [] = "<tr>".$status."</tr>";
		}
		return $datakamar;
		
	}
	////////////// list bed terisi /////////////////
public function listbedterisi($kdkamar){
		
		$queryString = $this->db->query( "SELECT * from ITbrRwtDD where KodeRuang = '$kdkamar' and StatusKamar = '2' order by StatusKamar ASC");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$sts = $hasilkamar['StatusKamar'];
			$mr = $hasilkamar["MR"];
			
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$mr' ")->row_array();
			$querypasien = $this->db->query("SELECT * from JPasien where Nomor_mr='$mr'")->row_array();
			
			$datatglcekout = date("Y-m-d H:i:s",strtotime($hasilkamar['TglKeluar']." ".$hasilkamar['JamKeluar']));
			
			//$hasilestimasi = $tglkluar - $tglmasuk;
			 // $hasilestimasi = "tes";
			  
			  //////////// tgl cekin ////////////
			  $tglcekin = $hasilkamar['TgLIsi'];
			  if($tglcekin){
				$tglisi = date("d F Y",strtotime($hasilkamar['TgLIsi']))." ".$hasilkamar['JamIsi'];
			  }else{
				$tglisi = " "; 
			  }
			  //////////// tgl cekout ////////////
			  $tglcekout = $hasilkamar['TglKeluar'];
			  if($tglcekout){
				$tglkeluar = date("d F Y",strtotime($hasilkamar['TglKeluar']))." ".$hasilkamar['JamKeluar'];
			  }else{
				$tglkeluar = " "; 
			  }
			  //////////// estimasi pulang /////////////////
			  
				$awal  = date_create($datatglcekout);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				//$hasilestimasi = $diff->d . ' hari, '.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
			
			  /////////////// ambil dokter /////////////////
			  $kodedokter = $hasilkamar['Dokter'];
			  $statusboking = $hasilkamar['StatusBooking'];
			  
			  $querydokter = $this->db->query("Select * from JDokter where Kode_Dokter = '$kodedokter' ")->row_array();
			 
			 $tglsekarang = date("Y-m-d");
			 if($tglcekout == $tglsekarang){
					$hasilkedipestimasi = "<p id='kedip'>".$hasilestimasi.'</p>';
				}else{
					$hasilkedipestimasi = '<b>'.$hasilestimasi.'</b>';
					}
			  //////////////////////////////////////////////
			
			if($sts == '0'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-green">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-green'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>Sedang Kosong</span>
							<legend></legend>
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
				
			}
			
			else if($sts == '1'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-yellow">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-yellow'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
								<span class='info-box-text'>Sedang Dibersihkan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}else if($sts == '2'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;b:white;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
						
						
							<div class="info-box-content">
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
								
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				
			}else if($sts == '3'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-primary">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-primary'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>STidak Dapat Digunakan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}
			$datakamar [] = "<tr>".$status."</tr>";
		}
		return $datakamar;
		
	}
	////////////// list bed tidakaktif /////////////////
public function listbedtidakaktif($kdkamar){
		
		$queryString = $this->db->query( "SELECT * from ITbrRwtDD where KodeRuang = '$kdkamar' and StatusKamar = '3' order by StatusKamar ASC");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$sts = $hasilkamar['StatusKamar'];
			$mr = $hasilkamar["MR"];
			
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$mr' ")->row_array();
			$querypasien = $this->db->query("SELECT * from JPasien where Nomor_mr='$mr'")->row_array();
			
			$datatglcekout = date("Y-m-d H:i:s",strtotime($hasilkamar['TglKeluar']." ".$hasilkamar['JamKeluar']));
			
			//$hasilestimasi = $tglkluar - $tglmasuk;
			 // $hasilestimasi = "tes";
			  
			  //////////// tgl cekin ////////////
			  $tglcekin = $hasilkamar['TgLIsi'];
			  if($tglcekin){
				$tglisi = date("d F Y",strtotime($hasilkamar['TgLIsi']))." ".$hasilkamar['JamIsi'];
			  }else{
				$tglisi = " "; 
			  }
			  //////////// tgl cekout ////////////
			  $tglcekout = $hasilkamar['TglKeluar'];
			  if($tglcekout){
				$tglkeluar = date("d F Y",strtotime($hasilkamar['TglKeluar']))." ".$hasilkamar['JamKeluar'];
			  }else{
				$tglkeluar = " "; 
			  }
			  //////////// estimasi pulang /////////////////
			  
				$awal  = date_create($datatglcekout);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				//$hasilestimasi = $diff->d . ' hari, '.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
			
			  /////////////// ambil dokter /////////////////
			  $kodedokter = $hasilkamar['Dokter'];
			  $statusboking = $hasilkamar['StatusBooking'];
			  
			  $querydokter = $this->db->query("Select * from JDokter where Kode_Dokter = '$kodedokter' ")->row_array();
			 
			 $tglsekarang = date("Y-m-d");
			 if($tglcekout == $tglsekarang){
					$hasilkedipestimasi = "<p id='kedip'>".$hasilestimasi.'</p>';
				}else{
					$hasilkedipestimasi = '<b>'.$hasilestimasi.'</b>';
					}
			  //////////////////////////////////////////////
			
			if($sts == '0'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-green">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-green'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>Sedang Kosong</span>
							<legend></legend>
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
				
			}
			
			else if($sts == '1'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-yellow">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-yellow'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
								<span class='info-box-text'>Sedang Dibersihkan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}else if($sts == '2'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;b:white;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
						
						
							<div class="info-box-content">
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
								
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				
			}else if($sts == '3'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-primary">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-primary'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>STidak Dapat Digunakan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}
			$datakamar [] = "<tr>".$status."</tr>";
		}
		return $datakamar;
		
	}
	////////////// list bed boking /////////////////
public function listbedboking($kdkamar){
		
		$queryString = $this->db->query( "SELECT * from ITbrRwtDD where KodeRuang = '$kdkamar' and StatusBooking = '1' order by StatusKamar ASC");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$sts = $hasilkamar['StatusKamar'];
			$mr = $hasilkamar["MR"];
			
			$querydiagnosa = $this->db->query("select * from RI_DIAGNOSA where NOMOR_MR='$mr' ")->row_array();
			$querypasien = $this->db->query("SELECT * from JPasien where Nomor_mr='$mr'")->row_array();
			
			$datatglcekout = date("Y-m-d H:i:s",strtotime($hasilkamar['TglKeluar']." ".$hasilkamar['JamKeluar']));
			
			//$hasilestimasi = $tglkluar - $tglmasuk;
			 // $hasilestimasi = "tes";
			  
			  //////////// tgl cekin ////////////
			  $tglcekin = $hasilkamar['TgLIsi'];
			  if($tglcekin){
				$tglisi = date("d F Y",strtotime($hasilkamar['TgLIsi']))." ".$hasilkamar['JamIsi'];
			  }else{
				$tglisi = " "; 
			  }
			  //////////// tgl cekout ////////////
			  $tglcekout = $hasilkamar['TglKeluar'];
			  if($tglcekout){
				$tglkeluar = date("d F Y",strtotime($hasilkamar['TglKeluar']))." ".$hasilkamar['JamKeluar'];
			  }else{
				$tglkeluar = " "; 
			  }
			  //////////// estimasi pulang /////////////////
			  
				$awal  = date_create($datatglcekout);
				$akhir = date_create(); // waktu sekarang
				$diff  = date_diff( $awal, $akhir );

				$hasilestimasi = $diff->m . ' bulan, '.$diff->d . ' hari '.'<br>'.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
				//$hasilestimasi = $diff->d . ' hari, '.$diff->h . ' jam, '.$diff->i . ' menit, '.$diff->s . ' detik';
			
			  /////////////// ambil dokter /////////////////
			  $kodedokter = $hasilkamar['Dokter'];
			  $statusboking = $hasilkamar['StatusBooking'];
			  
			  $querydokter = $this->db->query("Select * from JDokter where Kode_Dokter = '$kodedokter' ")->row_array();
			 
			 $tglsekarang = date("Y-m-d");
			 if($tglcekout == $tglsekarang){
					$hasilkedipestimasi = "<p id='kedip'>".$hasilestimasi.'</p>';
				}else{
					$hasilkedipestimasi = '<b>'.$hasilestimasi.'</b>';
					}
			  //////////////////////////////////////////////
			
			if($sts == '0'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-green">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-green'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>Sedang Kosong</span>
							<legend></legend>
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
				
			}
			
			else if($sts == '1'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-yellow">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-yellow'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
								<span class='info-box-text'>Sedang Dibersihkan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}else if($sts == '2'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-red">
						<span class="info-box-icon" style="cursor:pointer;b:white;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
						
						
							<div class="info-box-content">
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
								
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				
			}else if($sts == '3'){
				if($statusboking == 1){
					$status = '<td style="vertical-align:middle;background:;color:white;width:145px;cursor:;">
				
					<div style="width:250px;" class="info-box bg-primary">
						<span class="info-box-icon" style="cursor:pointer;background:#0099FF;" >
						<i class="fa fa-bed" onclick="ambilpasien('."'".$hasilkamar['MR']."'".','."'".$querydokter['Kode_Dokter']."'".','."'".$hasilkamar['KodeBed']."'".','."'".$hasilkamar['NamaBed']."'".')"><br>'.$querypasien["Jenis_kelamin"].'</i>
						
						</span>
							<div class="info-box-content">
								<small><center>Booking</center></small>
								<small>'.$hasilkamar["NamaBed"].'</b></small>
								<legend></legend>
								<span>'.$querydiagnosa["DIAGNOSA"].'</span>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>'.
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglisi."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>".$tglkeluar."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><center>".$hasilkedipestimasi."</td>";
				}
				else if($statusboking == 0){
					$status = "<td style='vertical-align:middle;background:;color:white;width:145px;'>
					<div style='width:250px;' class='info-box bg-primary'>
						<span class='info-box-icon'><i class='fa fa-bed'></i></span>
							<div class='info-box-content'>
							<span class='info-box-text'>STidak Dapat Digunakan</span>
							<legend></legend>
								
								<small style=''>".$hasilkamar['NamaBed']."</b></small>
							</div><!-- /.info-box-content -->
					</div><!-- /.info-box --></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>".
					"<td style='vertical-align:middle;width:;'><div style='width:250px;'><b><center>"."</b></td>";
				}
				
			}
			$datakamar [] = "<tr>".$status."</tr>";
		}
		return $datakamar;
		
	}
public function listpasienpulang($tanggalawal,$tanggalakhir){
	$query = $this->db->query("select * from RI_HRINAP where TANGGAL_KELUAR between '$tanggalawal' and '$tanggalakhir' order by NOMOR_MR ASC");
	return $query->result();
}

///////////// untuk status bed //////
public function kodehystorybedbersih(){
	//$this->db->order_by('Id_Hystori','DESC');
	$q = $this->db->query('select top 1 * from Tb_Hystori_Pembersihanbed order by Id_Hystori DESC');
		
		$kodeakhir;
		$kodejadi;
		$date = date('Ym');
		if(!empty($q->result())){
			foreach($q->result() as $ka){
				$kodeakhir = $ka->Id_Hystori;
			}
			$no = substr($kodeakhir,9,5);
				$intno = (int)$no;
				$next = $intno+1;
				
				//buat nol
				$nol = '';
				$Pintno = strlen($next);
				for($i = 1; $i <= 5-$Pintno; $i++){
					$nol = $nol.'0';
				}
				$kodejadi = 'BED'.$date.$nol.$next;
		}
		else{
			$kodejadi = 'BED'.$date.'00001';
		}
		return $kodejadi;
}
////////////// sampe sini /////////////

}
?>