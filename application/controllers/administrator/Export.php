<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Export extends Secure_area_adm 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');
		$data['jenis_page'] = "administrator/";
		$data['controller'] = 'export';
		$data['active'] = 'export';
		$this->load->vars($data);
	}

	public function index()
	{
		$data['judul']		  ='Export';
		$data['desc_judul'] ='';
		$data['page'] 			= 'export';

		$data['breadcumb'][] = array('icon'=>'download',
																 'link'=>'',
																 'judul'=>'Export');

		$this->load->view('template',$data);
	}

	// public function print_excel()
	// {
	// 	$this->load->library('excel');
	// 	$objPHPExcel = new PHPExcel();
	// 	// Set document properties
	// 	$objPHPExcel->getProperties()->setCreator("SISPEG")
	// 															 ->setTitle("SISPEG")
	// 															 ->setSubject("SISPEG")
	// 															 ->setDescription("SISPEG")
	// 															 ->setKeywords("office 2007 openxml php")
	// 															 ->setCategory("result file");

	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Kegegawaian ');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Tgl Generate : '.date('Y-m-d h:i:s'));
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'No');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Nama');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'NRP');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'TTL');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'TMT Kerja');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'No SK');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Alamat');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'Agama');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', 'Diklat');
	// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', 'Pendidikan Terakhir');

	// 	$this->db->select('*');
	// 	$this->db->from('sispeg_tr_pegawai p');
	// 	$this->db->where('deleted','0');
	// 	$q = $this->db->get();
	
	// 	$ii = 1;
	// 	foreach ($q->result() as $key) { 
	// 		$tmt_kerja = "";
	// 		$this->db->order_by('added_by','desc');
	// 		$this->db->limit(1);
	// 		$this->db->where('id_sdm',$key->id_sdm);
	// 		foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
	// 				$tmt_kerja = $keyb->tmt_kerja;
	// 		}

	// 		$no_sk = "";
	// 		$this->db->order_by('added_by','desc');
	// 		$this->db->limit(1);
	// 		$this->db->where('id_sdm',$key->id_sdm);
	// 		foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
	// 				$no_sk = $keyb->no_sk;
	// 		}

	// 		$diklat= "";
	// 		$this->db->order_by('added_by','desc');
	// 		$this->db->limit(1);
	// 		$this->db->where('id_sdm',$key->id_sdm);
	// 		foreach ($this->Content_m->select_db('sispeg_tr_pegawai_diklat')->result() as $keyb ) {
	// 				$diklat = $keyb->jenis_diklat;
	// 		}
			
	// 		$pt= "";
	// 		$this->db->order_by('show','desc');
	// 		$this->db->where('id_sdm',$key->id_sdm);
	// 		$this->db->limit(1);
	// 		foreach ($this->Content_m->select_db('sispeg_tr_pegawai_pt')->result() as $keyb ) {
	// 				$pt = $keyb->jenjang;
	// 		}

	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($ii+4), $ii);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.($ii+4), $key->nm_sdm);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.($ii+4), $key->nrp);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ii+4), $key->tmpt_lahir." ".$key->tgl_lahir);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ii+4), $tmt_kerja);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($ii+4), $no_sk);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ii+4), $key->jln);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ii+4), $this->Content_m->get_value('pddikti_re_agama','id_agama',$key->id_agama,'nm_agama'));
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($ii+4), $diklat);
	// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ii+4), $pt);
	// 		$ii++;
	// 	}

	// 	header('Content-Type: application/vnd.ms-excel');
	// 	header('Content-Disposition: attachment;filename="LIST_TRANSAKSI.xls"');
	// 	header('Cache-Control: max-age=0');
	// 	header('Cache-Control: max-age=1');
		
	// 	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	// 	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	// 	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	// 	header ('Pragma: public'); // HTTP/1.0
		
	// 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	// 	$objWriter->save('php://output');
	// 	exit;
	// }
	
	public function print_excel_field()
	{
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("SISPEG")
																 ->setTitle("SISPEG")
																 ->setSubject("SISPEG")
																 ->setDescription("SISPEG")
																 ->setKeywords("office 2007 openxml php")
																 ->setCategory("result file");

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Kepegawaian ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Tgl Generate : '.date('Y-m-d h:i:s'));

		$this->db->select('');
		$this->db->from('sispeg_tr_pegawai p');
		$this->db->where('deleted','0');
		$q = $this->db->get();

		$colH = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
									'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
									'U', 'V', 'W', 'X', 'Y', 'Z');
										
		$ii = 1;
		foreach ($q->result() as $key) { 
			$checkBoxes = $this->input->post('fieldExport');
			$arrlengthH = count($checkBoxes);
			$x = 1;	
			foreach ($checkBoxes as $field) 
			{	
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'No');
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($ii+4), $ii);

					if($field == 'nama') 
					{
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'Nama');			
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $key->nm_sdm);

					} elseif($field == 'nrp') 
					{
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'NRP');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $key->nrp);

					} elseif($field == 'ttl') 
					{
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'TTL');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $key->tmpt_lahir." ".$key->tgl_lahir);

					} elseif($field == 'tmt_krj')
					{
							$tmt_kerja = "";
							$this->db->order_by('added_by','desc');
							$this->db->limit(1);
							$this->db->where('id_sdm',$key->id_sdm);
							foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
									$tmt_kerja = $keyb->tmt_kerja;
							}
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'TMT Kerja');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $tmt_kerja);

					} elseif($field == 'no_sk')
					{
							$no_sk = "";
							$this->db->order_by('added_by','desc');
							$this->db->limit(1);
							$this->db->where('id_sdm',$key->id_sdm);
							foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
									$no_sk = $keyb->no_sk;
							}
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'No SK');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $no_sk);

					} elseif($field == 'alamat')
					{
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'Alamat');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $key->jln);

					} elseif($field == 'agama')  
					{
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'Agama');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $this->Content_m->get_value('pddikti_re_agama','id_agama',$key->id_agama,'nm_agama'));

					} elseif($field == 'diklat') 
					{
							$diklat= "";
							$this->db->order_by('added_by','desc');
							$this->db->limit(1);
							$this->db->where('id_sdm',$key->id_sdm);
							foreach ($this->Content_m->select_db('sispeg_tr_pegawai_diklat')->result() as $keyb ) {
									$diklat = $keyb->jenis_diklat;
							}
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'Diklat');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $diklat);

					} elseif($field == 'education') 
					{
							$pt= "";
							$this->db->order_by('show','desc');
							$this->db->where('id_sdm',$key->id_sdm);
							$this->db->limit(1);
							foreach ($this->Content_m->select_db('sispeg_tr_pegawai_pt')->result() as $keyb ) {
									$pt = $keyb->jenjang;
							}
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].'4', 'Pendidikan Terakhir');
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colH[$x].($ii+4), $pt);
					}
			$x++;											
			}
		$ii++;
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Pegawai.xls"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
}

/* End of file filename.php */