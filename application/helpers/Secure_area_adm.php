<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Secure_area_adm extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Makassar');
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect('account');
		}

		if (in_array(1, $this->session->userdata('id_global_hakakses'))|| in_array(7, $this->session->userdata('id_global_hakakses'))) 
		{

		} else if (in_array(8, $this->session->userdata('id_global_hakakses'))) {
			redirect('/mahasiswa/dashboard');
		} else {
			//$this->session->sess_destroy();
			redirect('/account');
		}

	}
}
