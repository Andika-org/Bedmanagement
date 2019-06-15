<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Controlbor extends MY_Controller {
	
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
		error_reporting(0);
		
		$tglawal = date("Y-m-d",strtotime($this->input->post("Tanggal_Awal")));
		$tglakhir = date("Y-m-d",strtotime($this->input->post("Tanggal_Akhir")));
		
		if($this->input->post()){
			$data["tglawal"]= $tglawal;
			$data["tglakhir"]= $tglakhir;
		}else{
			$data["tglawal"]=date("d F Y");
			$data["tglakhir"]=date("d F Y");
		}
		
		$print="";
		
		$data["datakelas"] = $this->db->query("select * from ITbKelas order by NamaKelas ASC")->result();

		$i = 1;
		foreach($data["datakelas"] as $dtkls){
			$idkelas = $dtkls->KodeKelas;
			
			
			
			
			$print = $print ."
			</tr>";
				
			$totalbedperkelas = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbedperkelas FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' and ITbKelas.KodeKelas='$idkelas'")->row_array();
			
			$totalbedranap = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranap from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbKelas.KodeKelas='$idkelas' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiode = $diff->d+1 . ' Periode ';
			$hasilperiodeuntukrumus = $diff->d+1;
			
			$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbedperkelas["totalbedperkelas"]*$hasilperiodeuntukrumus)*100;
			$print = $print ."
				<td style='background:white;vertical-align:middle;'>".$dtkls->NamaKelas."</td>
				<td style='background:white;vertical-align:middle;'><center>".$totalbedperkelas["totalbedperkelas"]."</center></td>
				<td style='background:white;vertical-align:middle;'><center>".$totalbedranap["totalbedranap"]."</center></td>
				<td style='background:white;vertical-align:middle;'><center>".number_format($totalbedspersentase).' %'."</center></td>
				";
				
			$print = $print ."
			</tr>";
		}
		
		$data["test"] = $print;
		$this->mouldthing('Badmanagement/Bor/View_borperkelas',$data);
	}
	
	public function cetakborexcel() {
		
		
		$tglawal = $this->uri->segment(3);
		$tglakhir = $this->uri->segment(4);
		
	
			$data["tglawal"]= date("d F Y",strtotime($tglawal));
			$data["tglakhir"]= date("d F Y",strtotime($tglakhir));
	
		
		$print="";
		
		$data["datakelas"] = $this->db->query("select * from ITbKelas order by NamaKelas ASC")->result();

		$i = 1;
		foreach($data["datakelas"] as $dtkls){
			$idkelas = $dtkls->KodeKelas;
			
			
			
			
			$print = $print ."
			</tr>";
				
			$totalbedperkelas = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbedperkelas FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' and ITbKelas.KodeKelas='$idkelas'")->row_array();
			
			$totalbedranap = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranap from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbKelas.KodeKelas='$idkelas' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiode = $diff->d+1 . ' Periode ';
			$hasilperiodeuntukrumus = $diff->d+1;
			
			$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbedperkelas["totalbedperkelas"]*$hasilperiodeuntukrumus)*100;
			$print = $print ."
				<td style='background:white;vertical-align:middle;border:1px solid black;'>".$dtkls->NamaKelas."</td>
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$totalbedperkelas["totalbedperkelas"]."</center></td>
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$totalbedranap["totalbedranap"]."</center></td>
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".number_format($totalbedspersentase).' %'."</center></td>";
				
			$print = $print ."
			</tr>";
		}
		
		$data["test"] = $print;
		$this->load->view('Badmanagement/Bor/View_borperkelascetakexcel',$data);
	}
public function overall() {
		
		
		$tglawal = date("Y-m-d",strtotime($this->input->post("Tanggal_Awal")));
		$tglakhir = date("Y-m-d",strtotime($this->input->post("Tanggal_Akhir")));
		
		if($this->input->post()){
			$data["tglawal"]= $tglawal;
			$data["tglakhir"]= $tglakhir;
		}else{
			$data["tglawal"]=date("d F Y");
			$data["tglakhir"]=date("d F Y");
		}
		
		$print="";
		
			
			$print = $print ."
			</tr>";
			
			$totalbedkeseluruhan = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbed FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' ")->row_array();
			
			$totalbedranap = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranap from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiode = $diff->d+1 . ' Periode ';
			$hasilperiodeuntukrumus = $diff->d+1;
			
			//$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbedkeseluruhan["totalbed"]*$hasilperiodeuntukrumus)*100;
			$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbedkeseluruhan["totalbed"]*$hasilperiodeuntukrumus)*100;
			
			$print = $print ."
				<td style='background:white;vertical-align:middle;'><center>".$totalbedkeseluruhan["totalbed"]."</center></td>
				<td style='background:white;vertical-align:middle;'><center>".$totalbedranap["totalbedranap"]."</center></td>
				<td style='background:white;vertical-align:middle;'><center>".number_format($totalbedspersentase).' %'."</center></td>";
			
					
			$print = $print ."
			</tr>";
		
		
		$data["test"] = $print;
		$this->mouldthing('Badmanagement/Bor/View_boroverall',$data);
	}
public function overallcetakexcel() {
		
		
		$tglawal = $this->uri->segment(3);
		$tglakhir = $this->uri->segment(4);
		
			$data["tglawal"]= date("d F Y",strtotime($tglawal));
			$data["tglakhir"]= date("d F Y",strtotime($tglakhir));
	
		
		$print="";
		
			
			$print = $print ."
			</tr>";
			
			$totalbedkeseluruhan = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbed FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' ")->row_array();
			
			$totalbedranap = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranap from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiode = $diff->d+1 . ' Periode ';
			$hasilperiodeuntukrumus = $diff->d+1;
			
			//$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbedkeseluruhan["totalbed"]*$hasilperiodeuntukrumus)*100;
			$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbedkeseluruhan["totalbed"]*$hasilperiodeuntukrumus)*100;
			
			$print = $print ."
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$totalbedkeseluruhan["totalbed"]."</center></td>
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$totalbedranap["totalbedranap"]."</center></td>
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".number_format($totalbedspersentase).' %'."</center></td>";
			
					
			$print = $print ."
			</tr>";
		
		
		$data["test"] = $print;
		$this->load->view('Badmanagement/Bor/View_boroverallcetakexcel',$data);
	}	
	
public function kumulatif() {
		
		
		$tglawal = date("Y-m-d",strtotime($this->input->post("Tanggal_Awal")));
		$tglakhir = date("Y-m-d",strtotime($this->input->post("Tanggal_Akhir")));
		
		if($this->input->post()){
			$data["tglawal"]= $tglawal;
			$data["tglakhir"]= $tglakhir;
		}else{
			$data["tglawal"]=date("d F Y");
			$data["tglakhir"]=date("d F Y");
		}
		
		$print="";
		
		$data["datakelas"] = $this->db->query("select * from ITbKelas order by NamaKelas ASC")->result();
		
		////////// total bed keseluruhan //////////
		$totalbedkeseluruhan = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbed FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' ")->row_array();
		////////// sampe sini //////////
		
		////////// total bed ranap between//////////
		$totalbedranapbetween = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranapbtwen from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
		////////// sampe sini //////////			
					
		$i = 1;
		
		foreach($data["datakelas"] as $dtkls){
			$idkelas = $dtkls->KodeKelas;
			
			$print = $print ."
			</tr>";
			
			$totalbedperkelas = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbedperkelas FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' and ITbKelas.KodeKelas='$idkelas'")->row_array();
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiode = $diff->d+1 . ' Periode ';
			$hasilperiodeuntukrumus = $diff->d+1;
			
			//$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbed["totalbed"]*$hasilperiodeuntukrumus)*100;
			
			$print = $print ."
				<td style='background:white;vertical-align:middle;'>".$dtkls->NamaKelas."</td>";
				
			$print = $print ."
				<td style='background:white;vertical-align:middle;'><center>".$totalbedperkelas["totalbedperkelas"]."</center></td>";
			
			//////////////////////////////////////////////////////////////////////////////////////////
			$starawal = date("d",strtotime($this->input->post("Tanggal_Awal")));
			$starakhir = date("d",strtotime($this->input->post("Tanggal_Akhir")));
			
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->input->post("Tanggal_Awal")));
			$starawaltahun = date("Y",strtotime($this->input->post("Tanggal_Awal")));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totalbedranap = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranap from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbKelas.KodeKelas='$idkelas' and RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
					
				if($totalbedranap["totalbedranap"]>0){
					$print = $print ."
					<td style='background:#90EE90;vertical-align:middle;'><center>".$totalbedranap["totalbedranap"]."</center></td>";
				}else{
					$print = $print ."
					<td style='background:white;vertical-align:middle;'><center>".$totalbedranap["totalbedranap"]."</center></td>";	
				}
				
			}
			
			$ttllbedranapperkelas = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranapkelas from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbKelas.KodeKelas='$idkelas' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
			
			
			$print = $print ."
				<td style='background:white;vertical-align:middle;'><center>".$ttllbedranapperkelas["totalbedranapkelas"]."</center></td>";
				
			$print = $print ."
			</tr>";
			
			
		}
		
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr >";
			
			$print = $print ."
				<td style='background:#FFEBCD;vertical-align:middle;' colspan='2' ><b>".'Bed Occupied'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->input->post("Tanggal_Awal")));
			$starawaltahun = date("Y",strtotime($this->input->post("Tanggal_Awal")));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totaloccupiedpertanggal = $this->db->query("select count('RI_HRINAP.NomorBed') as totaloccupied from RI_HRINAP 
						where RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
						
				$print = $print ."
				<td style='background:#FFEBCD;vertical-align:middle;'><center><b>".$totaloccupiedpertanggal["totaloccupied"]."</b></center></td>";
				
			}
			
			
			
			$print = $print ."
				<td style='background:#FFEBCD;vertical-align:middle;'><center><b>".$totalbedranapbetween["totalbedranapbtwen"]."</b></center></td>";
				
			$print = $print ."
			 </tbody></tr>";
		
		//////////////////////////////////////////////////////////////////////////////////////////
		
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#FFC0CB;vertical-align:middle;' colspan='2'><b>".'Bed Analisa'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
		
				$print = $print ."
				<td style='background:#FFC0CB;vertical-align:middle;'><center><b>".$totalbedkeseluruhan["totalbed"]."</b></center></td>";
				
			}
			
			$print = $print ."
				<td style='background:#FFC0CB;vertical-align:middle;'><center><b>".$totalbedkeseluruhan["totalbed"]*$starakhir."</b></center></td>";
			
			$print = $print ."
			 </tbody></tr>";
		
		//////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;' colspan='2'><b>".'Persentase'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){

			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->input->post("Tanggal_Awal")));
			$starawaltahun = date("Y",strtotime($this->input->post("Tanggal_Awal")));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totaloccupiedpertanggal = $this->db->query("select count('RI_HRINAP.NomorBed') as totaloccupied from RI_HRINAP 
						where RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
						
				$hasilpersentasepertanggal = ($totaloccupiedpertanggal['totaloccupied']/$totalbedkeseluruhan["totalbed"])*100;
						
				$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;'><center><b>".number_format($hasilpersentasepertanggal)." %</b></center></td>";
				
			}
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiodeuntukrumus = $diff->d+1;
			
			$hitungtotalpersen = $totalbedkeseluruhan["totalbed"]*$starakhir; //total bed analisa
			
			$totalbedspersentase = ($totalbedranapbetween["totalbedranapbtwen"]/$hitungtotalpersen)*100;
			
			$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;'><center><b>".number_format($totalbedspersentase)." %</b></center></td>";
			
			$print = $print ."
			 </tbody></tr>";
		
		$data["span"] = $starakhir;
		
		$data["tanggalcolomawal"] = date("d",strtotime($this->input->post("Tanggal_Awal")));
		$data["tanggalcolomakhir"] = date("d",strtotime($this->input->post("Tanggal_Akhir")));
		
		$data["test"] = $print;
		$this->mouldthing('Badmanagement/Bor/View_borkumulatif',$data);
	}

public function kumulatifcetakexcel() {
		
		
		$tglawal = date("Y-m-d",strtotime($this->uri->segment(3)));
		$tglakhir = date("Y-m-d",strtotime($this->uri->segment(4)));
		
			$data["tglawal"]= $tglawal;
			$data["tglakhir"]= $tglakhir;

		
		$print="";
		
		$data["datakelas"] = $this->db->query("select * from ITbKelas order by NamaKelas ASC")->result();

		////////// total bed keseluruhan //////////
		$totalbedkeseluruhan = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbed FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' ")->row_array();
		////////// sampe sini //////////
		
		////////// total bed ranap between//////////
		$totalbedranapbetween = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranapbtwen from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
		////////// sampe sini //////////			
					
		$i = 1;
		
		foreach($data["datakelas"] as $dtkls){
			$idkelas = $dtkls->KodeKelas;
			
			$print = $print ."
			</tr>";
			
			$totalbedperkelas = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbedperkelas FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' and ITbKelas.KodeKelas='$idkelas'")->row_array();
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiode = $diff->d+1 . ' Periode ';
			$hasilperiodeuntukrumus = $diff->d+1;
			
			//$totalbedspersentase = $totalbedranap["totalbedranap"]/($totalbed["totalbed"]*$hasilperiodeuntukrumus)*100;
			
			$print = $print ."
				<td style='background:white;vertical-align:middle;border:1px solid black;'>".$dtkls->NamaKelas."</td>";
				
			$print = $print ."
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$totalbedperkelas["totalbedperkelas"]."</center></td>";
			
			//////////////////////////////////////////////////////////////////////////////////////////
			$starawal = date("d",strtotime($this->uri->segment(3)));
			$starakhir = date("d",strtotime($this->uri->segment(4)));
			
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->uri->segment(3)));
			$starawaltahun = date("Y",strtotime($this->uri->segment(4)));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totalbedranap = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranap from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbKelas.KodeKelas='$idkelas' and RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
					
				if($totalbedranap["totalbedranap"]>0){
					$print = $print ."
					<td style='background:#90EE90;vertical-align:middle;border:1px solid black;'><center>".$totalbedranap["totalbedranap"]."</center></td>";
				}else{
					$print = $print ."
					<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$totalbedranap["totalbedranap"]."</center></td>";	
				}
				
			}
			
			$ttllbedranapperkelas = $this->db->query("select count('RI_HRINAP.NomorBed') as totalbedranapkelas from RI_HRINAP join ITbrRwtD
						on RI_HRINAP.NomorKamar = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbKelas.KodeKelas='$idkelas' and RI_HRINAP.TANGGAL_MASUK BETWEEN '$tglawal' and '$tglakhir'")->row_array();
			
			
			$print = $print ."
				<td style='background:white;vertical-align:middle;border:1px solid black;'><center>".$ttllbedranapperkelas["totalbedranapkelas"]."</center></td>";
				
			$print = $print ."
			</tr>";
			
			
		}
		
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#FFEBCD;vertical-align:middle;border:1px solid black;' colspan='2' ><b>".'Bed Occupied'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->uri->segment(3)));
			$starawaltahun = date("Y",strtotime($this->uri->segment(4)));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totaloccupiedpertanggal = $this->db->query("select count('RI_HRINAP.NomorBed') as totaloccupied from RI_HRINAP 
						where RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
						
				$print = $print ."
				<td style='background:#FFEBCD;vertical-align:middle;border:1px solid black;'><center><b>".$totaloccupiedpertanggal["totaloccupied"]."</b></center></td>";
				
			}
			
			
			
			$print = $print ."
				<td style='background:#FFEBCD;vertical-align:middle;border:1px solid black;'><center><b>".$totalbedranapbetween["totalbedranapbtwen"]."</b></center></td>";
				
			$print = $print ."
			 </tbody></tr>";
		
		//////////////////////////////////////////////////////////////////////////////////////////
		
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#FFC0CB;vertical-align:middle;border:1px solid black;' colspan='2'><b>".'Bed Analisa'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
		
				$print = $print ."
				<td style='background:#FFC0CB;vertical-align:middle;border:1px solid black;'><center><b>".$totalbedkeseluruhan["totalbed"]."</b></center></td>";
				
			}
			
			$print = $print ."
				<td style='background:#FFC0CB;vertical-align:middle;border:1px solid black;'><center><b>".$totalbedkeseluruhan["totalbed"]*$starakhir."</b></center></td>";
			
			$print = $print ."
			 </tbody></tr>";
		
		//////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;border:1px solid black;' colspan='2'><b>".'Persentase'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){

			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->uri->segment(3)));
			$starawaltahun = date("Y",strtotime($this->uri->segment(4)));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totaloccupiedpertanggal = $this->db->query("select count('RI_HRINAP.NomorBed') as totaloccupied from RI_HRINAP 
						where RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
						
				$hasilpersentasepertanggal = ($totaloccupiedpertanggal['totaloccupied']/$totalbedkeseluruhan["totalbed"])*100;
						
				$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;border:1px solid black;'><center><b>".number_format($hasilpersentasepertanggal)." %</b></center></td>";
				
			}
			
			$awal  = date_create($tglawal);
			$akhir = date_create($tglakhir); // waktu sekarang
			$diff  = date_diff( $awal, $akhir );

			$hasilperiodeuntukrumus = $diff->d+1;
			
			$hitungtotalpersen = $totalbedkeseluruhan["totalbed"]*$starakhir; //total bed analisa
			
			$totalbedspersentase = ($totalbedranapbetween["totalbedranapbtwen"]/$hitungtotalpersen)*100;
			
			$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;border:1px solid black;'><center><b>".number_format($totalbedspersentase)." %</b></center></td>";
			
			$print = $print ."
			 </tbody></tr>";
		
		$data["span"] = $starakhir;
		
		$data["tanggalcolomawal"] = date("d",strtotime($this->uri->segment(3)));
		$data["tanggalcolomakhir"] = date("d",strtotime($this->uri->segment(4)));
		
		$data["test"] = $print;
		$this->load->view('Badmanagement/Bor/View_borkumulatifcetakexcel',$data);
	}
	
public function borgrafik() {
		
		
		$tglawal = date("Y-m-d",strtotime($this->input->post("Tanggal_Awal")));
		$tglakhir = date("Y-m-d",strtotime($this->input->post("Tanggal_Akhir")));
		
		if($this->input->post()){
			$data["tglawal"]= $tglawal;
			$data["tglakhir"]= $tglakhir;
		}else{
			$data["tglawal"]=date("d F Y");
			$data["tglakhir"]=date("d F Y");
		}
		
		$print="";

		$starawal = date("d",strtotime($this->input->post("Tanggal_Awal")));
		$starakhir = date("d",strtotime($this->input->post("Tanggal_Akhir")));
		
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#FFF8DC;vertical-align:middle;'><b><center>".'Grafik <br> Persentase'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->input->post("Tanggal_Awal")));
			$starawaltahun = date("Y",strtotime($this->input->post("Tanggal_Awal")));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totaloccupiedpertanggal = $this->db->query("select count('RI_HRINAP.NomorBed') as totaloccupied from RI_HRINAP 
						where RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
						
			$totalbed = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbed FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif' and ITbrRwtDD.StatusKamar !='3' ")->row_array();
						
				$hasilpersentase = $totaloccupiedpertanggal['totaloccupied']/$totalbed["totalbed"]*100;
				//$hasilpersentase = $totaloccupiedpertanggal['totaloccupied']*100;
				
				$hasilpersen = number_format($hasilpersentase);
				$print = $print ."
				<td style='background:white;vertical-align:bottom;'><center><b>".$hasilpersen." %</b><br><span class='form form-control' style='height:".$hasilpersen*10 ."px;background:#DC143C;'></span></center></td>";
				
			}
			
			$print = $print ."
			 </tbody></tr>";
			 
			//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;'><b>".'Tanggal'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i+1-1;
			
				$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;'><center><b>".$tanggal."</b></center></td>";
				
			}
			
			
			
			$print = $print ."
			 </tbody></tr>";
			 
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$spn = $starakhir+1;
		$print = $print ."
				<td colspan='".$spn."' style='background:#90EE90;vertical-align:middle;'><center><b> Data Bor Grafik Rawat Inap Pada Tanggal ".date("d F Y",strtotime($tglawal)).' Sampai '.date("d F Y",strtotime($tglakhir))."</b></center></td>";
			
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
		$data["span"] = $starakhir;
		
		$data["tanggalcolomawal"] = date("d",strtotime($this->input->post("Tanggal_Awal")));
		$data["tanggalcolomakhir"] = date("d",strtotime($this->input->post("Tanggal_Akhir")));
		
		$data["test"] = $print;
		$this->mouldthing('Badmanagement/Bor/View_borgrafik',$data);
	}
/*
public function borgrafikcetakexcel() {
		
		
		$tglawal = date("Y-m-d",strtotime($this->uri->segment(3)));
		$tglakhir = date("Y-m-d",strtotime($this->uri->segment(4)));
		
			$data["tglawal"]= $tglawal;
			$data["tglakhir"]= $tglakhir;
	
		
		$print="";

		$starawal = date("d",strtotime($this->uri->segment(3)));
		$starakhir = date("d",strtotime($this->uri->segment(4)));
		
		//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#FFF8DC;vertical-align:middle;border:1px solid black;'><b><center>".'Grafik <br> Persentase'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i;
			$starawalbulan = date("m",strtotime($this->uri->segment(3)));
			$starawaltahun = date("Y",strtotime($this->uri->segment(4)));
			
			$hasilstart = $starawaltahun.'-'.$starawalbulan.'-'.$tanggal;
			$starakhirbulantahun = date("Y-m-d",strtotime($hasilstart));
			
			$totaloccupiedpertanggal = $this->db->query("select count('RI_HRINAP.NomorBed') as totaloccupied from RI_HRINAP 
						where RI_HRINAP.TANGGAL_MASUK ='$starakhirbulantahun' ")->row_array();
						
			$totalbed = $this->db->query("SELECT count('ITbrRwtDD.NamaBed') as totalbed FROM ITbrRwtDD join ITbrRwtD
						on ITbrRwtDD.KodeRuang = ITbrRwtD.KodeKamar
						join ITbrRwt
						on ITbrRwtD.KodeRuang = ITbrRwt.KODE_RUANG
						join ITbKelas
						on ITbrRwt.KodeKelas = ITbKelas.KodeKelas
						where ITbrRwt.ROOT_KLS != 'Non Aktif'")->row_array();
						
				$hasilpersentase = $totaloccupiedpertanggal['totaloccupied']/$totalbed["totalbed"]*100;
				//$hasilpersentase = $totaloccupiedpertanggal['totaloccupied']*100;
				
				$hasilpersen = number_format($hasilpersentase);
				$print = $print ."
				<td style='background:white;vertical-align:bottom;'><center><b>".$hasilpersen." %</b><br><div class='form form-control' style='height:".$hasilpersen*10 ."px;background:#DC143C;'></div></center></td>";
				
			}
			
			$print = $print ."
			 </tbody></tr>";
			 
			//////////////////////////////////////////////////////////////////////////////////////////
			$print = $print ."
			 <tbody><tr>";
			
			$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;border:1px solid black;'><b>".'Tanggal'."</b></center></td>";
				
			for($i=$starawal;$i<=$starakhir;$i++){
			
			$tanggal = $i+1-1;
			
				$print = $print ."
				<td style='background:#87CEFA;vertical-align:middle;border:1px solid black;'><center><b>".$tanggal."</b></center></td>";
				
			}
			
			
			
			$print = $print ."
			 </tbody></tr>";
			 
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$spn = $starakhir+1;
		$print = $print ."
				<td colspan='".$spn."' style='background:#90EE90;vertical-align:middle;border:1px solid black;'><center><b> Data Bor Grafik Rawat Inap Pada Tanggal ".date("d F Y",strtotime($tglawal)).' Sampai '.date("d F Y",strtotime($tglakhir))."</b></center></td>";
			
		///////////////////////////////////////////////////////////////////////////////////////////////////////////
		$data["span"] = $starakhir;
		
		$data["tanggalcolomawal"] = date("d",strtotime($this->uri->segment(3)));
		$data["tanggalcolomakhir"] = date("d",strtotime($this->uri->segment(4)));
		
		$data["test"] = $print;
		$this->load->view('Badmanagement/Bor/View_borgrafikcetakexcel',$data);
	}
	*/
////////////// bor sampe sini //////////////////////////////////////////////
	
}
