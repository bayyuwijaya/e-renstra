<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Select_prefillage extends Secure_area_adm 
{
	public function __construct() 
	{
		parent::__construct();
		$data['jenis_page'] = "select_prefillage";
		$data['controller'] = 'dashboard';
		$this->load->vars($data);
	}

	public function index()
	{
		$data['judul']			= 'Pilih Hak akses';
		$data['desc_judul']	= 'Kami mendeteksi ada lebih dari 1 hak akses, pilih salah satu untuk masuk ke sistem';
		$data['page'] 			= 'select_prefillage';

		$data['breadcumb'][] = array('icon'  => 'home',
																 'link'  => '',
																 'judul' => 'Pilih Hak akses');

		$this->load->view('template',$data);
	}
}

/* End of file filename.php */