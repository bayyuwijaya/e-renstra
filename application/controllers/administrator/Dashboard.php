<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Dashboard extends Secure_area_adm 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Content_m');
		$data['jenis_page'] = "administrator/";
		$data['controller']	= 'dashboard';
		$data['active']		  = 'dashboard';
		$this->load->vars($data);
	}

	public function index()
	{
		$data['judul']			= 'Dashboard';
		$data['desc_judul'] = '';
		$data['page'] 			= 'dashboard';

		$data['breadcumb'][] = array('icon'  => 'dashboard',
																 'link'  => '',
																 'judul' => 'Beranda Utama Aplikasi');

		$data['kategori'] = $this->db->get('erenstra_tr_kategori')->result();
		$this->load->view('template',$data);
	}
}

/* End of file filename.php */