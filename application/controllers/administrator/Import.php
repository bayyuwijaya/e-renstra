<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Import extends Secure_area_adm 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');
		$data['jenis_page']="administrator/";
        $data['controller']='import';
        $data['active']='import';
		$this->load->vars($data);
	}

	function downloadFile($file){
	   $file_name = $file;
	   $mime = 'application/force-download';
	   header('Pragma: public');    
	   header('Expires: 0');        
	   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	   header('Cache-Control: private',false);
	   header('Content-Type: '.$mime);
	   header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	   header('Content-Transfer-Encoding: binary');
	   header('Connection: close');
	   readfile($file_name);    
	   exit();
	}

	public function index()
	{
		$data['judul']='Import';
		$data['desc_judul']='';
		$data['page'] = 'import';

		$data['breadcumb'][]=array('icon'=>'upload',
        									'link'=>'',
        									'judul'=>'Import');
		$get_sms = $this->M_hakakses->get_role_akademik();

		

		$this->load->view('template',$data);
	}

	public function get_format_import()
	{
		$this->downloadFile("media/support/import_pegawai.xlsx");
	}


	public function import_excel()
	{
		extract($_POST);
		if( $_FILES['excel_file']['tmp_name'] == null){redirect($_SERVER['HTTP_REFERER'],'refresh');}

		$this->load->library('excel');
		$tmpfname = $_FILES['excel_file']['tmp_name'];
		//$tmpfname = "laporan_exportmhs-3.xls";
		libxml_use_internal_errors(true);
		$data['file'] = $tmpfname;
		$data['excelReader'] = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$data['excelObj'] = $data['excelReader']->load($tmpfname);
		$data['worksheet'] = $data['excelObj']->getSheet(0);
		$data['lastRow'] = $data['worksheet']->getHighestRow();
		
		$this->load->view('administrator/import_database/form_view_excel_import',$data);

	}

}

