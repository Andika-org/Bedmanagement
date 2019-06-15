<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controllogin extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
function __construct(){
		parent::__construct();
		$this->load->model('Model_ruang');
		
	}
	
public	function index() 
	{
	$this->session->sess_destroy();
	$this->load->view('login');
	}

public function loginuser(){
	$userid = $this->input->post('USER_ID');
	$hasilid = $this->input->post('ID');
	
	//$hasilid = md5($id);
	
	$datauser = $this->db->query("select * from JPASSWRD where USER_ID='$userid' and PREFIX='$hasilid' ")->row_array();

	$userid = $datauser["USER_ID"];
	$bagian = $datauser["BAGIAN"];

	$where = array(
		'USER_ID' => $userid,
		'PREFIX' => $hasilid,
		);
	$cek = $this->db->query("select * from JPASSWRD where USER_ID='$userid' and PREFIX='$hasilid' ")->num_rows();
		if($cek > 0){
			
			session_start();
			$_SESSION['USER_ID'] 	= $userid;
			$_SESSION['BAGIAN'] 	= $bagian;
			
			redirect(base_url("Controllogin/hakadmin"));
			//echo $bagian;
		else if($cek > 1){
			session_start();
			$_SESSION['USER_ID']	= $userid;
			$_SESSION['BAGIAN'] 	= $bagian;			

			redirect(base_url("Controllogin/h"));
		}

		}
		}else{
			echo "<script>alert('Username Atau Password Salah..!!');</script>";
			redirect(base_url(),'refresh');
		}
	}
public function hakadmin(){
	//if($this->session->userdata['Hak_Akses'] == 'Admin'){
		$datamenu["datakosong"]  = $this->Model_ruang->totalruangkosong();
		$datamenu["datadibersihkan"]  = $this->Model_ruang->totalruangdibersihkan();
		$datamenu["dataterisi"]  = $this->Model_ruang->totalruangterisi();
		$datamenu["datatidakaktif"]  = $this->Model_ruang->totalruangtidakaktif();
		$datamenu["databooking"]  = $this->Model_ruang->totalruangbooking();
		
		$this->load->view('Menuadmin2',$datamenu);
		$this->load->view('Content');
		
	//}
	
	}

}
