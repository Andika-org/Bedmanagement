<?php
class Model_ruang extends CI_Model {
	public function dataruang() {
		$query = $this->db->query ( "SELECT * from ITbrRwt order by ROOT_KLS ASC" );
		return $query->result_array();
	}
	public function kelas($kodekelas) {
		$query = $this->db->query ( "SELECT * from ITbKelas where KodeKelas='$kodekelas' " );
		return $query->row_array();
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
	
	public function ambil_data_bad($idnya){
		
		$queryString = $this->db->query("SELECT * from ITbrRwtDD where KodeRuang='$idnya' order by StatusKamar ASC");

		$dataquery = $queryString->result_array ();
		$datakamar = [];
		
		foreach ( $dataquery as $hasilkamar ) {
			$sts = $hasilkamar['StatusKamar'];
			if($sts == '0'){
				$status = "<td style='background:green;color:white;'><b>Sedang Kosong</b></td>";
			}else if($sts == '1'){
				$status = "<td style='background:orange;color:white;'><b>Sedang Dibersihkan</b></td>";
			}else if($sts == '2'){
				$status = "<td style='background:red;color:white;'><b>Sedang Terisi</b></td>";
			}else if($sts == '3'){
				$status = "<td style='background:blue;color:white;'><b>Tidak Dapat Diguakan</b></td>";
			}
			$datakamar [] = '<table class="table table-bordered" ><tr><td style="width:50%;">'.$hasilkamar['NamaBed']."</td>".$status."</tr></table>";
		}
		return $datakamar;
		
	}
	public function totalruangkosong() {
		$query = $this->db->query ( "SELECT count('ITbrRwtDD.StatusKamar') as Kosong FROM ITbrRwtDD join ITbrRwtD
		on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar join ITbrRwt
		on ITbrRwtD.KodeRuang = ITbrRwt.Kode_Ruang where ITbrRwtDD.StatusKamar='0' and ITbrRwt.ROOT_KLS !='Non Aktif' " );
		return $query->row_array();
	}
	public function totalruangdibersihkan(){
		$query = $this->db->query ( "SELECT count('ITbrRwtDD.StatusKamar') as Dibersihkan FROM ITbrRwtDD join ITbrRwtD
		on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar join ITbrRwt
		on ITbrRwtD.KodeRuang = ITbrRwt.Kode_Ruang where ITbrRwtDD.StatusKamar='1' and ITbrRwt.ROOT_KLS !='Non Aktif' " );
		return $query->row_array();
	}
	public function totalruangterisi() {
		$query = $this->db->query ( "SELECT count('ITbrRwtDD.StatusKamar') as Isi FROM ITbrRwtDD join ITbrRwtD
		on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar join ITbrRwt
		on ITbrRwtD.KodeRuang = ITbrRwt.Kode_Ruang where ITbrRwtDD.StatusKamar='2' and ITbrRwt.ROOT_KLS !='Non Aktif' " );
		return $query->row_array();
	}
	public function totalruangtidakaktif() {
		$query = $this->db->query ( "SELECT count('ITbrRwtDD.StatusKamar') as Tidakaktif FROM ITbrRwtDD join ITbrRwtD
		on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar join ITbrRwt
		on ITbrRwtD.KodeRuang = ITbrRwt.Kode_Ruang where ITbrRwtDD.StatusKamar='3' and ITbrRwt.ROOT_KLS !='Non Aktif' " );
		return $query->row_array();
	}
	public function totalruangbooking() {
		$query = $this->db->query ( "SELECT count('ITbrRwtDD.StatusBooking') as Booking FROM ITbrRwtDD join ITbrRwtD
		on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar join ITbrRwt
		on ITbrRwtD.KodeRuang = ITbrRwt.Kode_Ruang where ITbrRwtDD.StatusBooking='1' and ITbrRwt.ROOT_KLS !='Non Aktif' " );
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
	
}
?>