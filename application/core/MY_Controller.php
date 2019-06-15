<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class My_Controller extends CI_Controller{
   function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'Model_ruang' );
	}
	
	  function mouldthing($content, $data){
		  
		$datamenu["datakosong"]  = $this->Model_ruang->totalruangkosong();
		$datamenu["datadibersihkan"]  = $this->Model_ruang->totalruangdibersihkan();
		$datamenu["dataterisi"]  = $this->Model_ruang->totalruangterisi();
		$datamenu["datatidakaktif"]  = $this->Model_ruang->totalruangtidakaktif();
		$datamenu["databooking"]  = $this->Model_ruang->totalruangbooking();
		
        $this->load->view('Menuadmin2',$datamenu);
		
		$data['content'] = $this->load->view($content,$data);
    }
}