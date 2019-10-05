<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Riwayat_pendidikan extends Secure_area_adm 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');

		$data['jenis_page']="administrator/";
		$data['controller_dir']='mhs_dir/';
		$data['controller']='riwayat_pendidikan';
		$data['parent_controller']='mahasiswa';
		$data['active']='mahasiswa';
		$this->load->vars($data);
	}

	public function view($id)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Riwayat Pendidikan';
			$data['desc_judul']='Menampilkan dan Mengelola Riwayat Pendidikan Pegawai';
			$data['page']='mahasiswa/template_detail';
			$data['page_tab']='mahasiswa/riwayat_pendidikan/master';

			$data['breadcumb'][]=array('icon'=>'user',
									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
									'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'graduation-cap',
									'link'=>'',
									'judul'=>'Riwayat Pendidikan');
	
			$this->load->view('template',$data);
		}
		else
			show_404();
	}

	public function tambah_data($id)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Tambaht Riwayat Pendidikan';
			$data['desc_judul']='Menambah Data Riwayat Pendidikan Baru';
			$data['page']='mahasiswa/template_detail';
			
			//$data['page_tab']='mahasiswa/riwayat_pendidikan/add';
			
			$data['page_tab']='tambah_data/tambah_riwayat_pendidikan';

			$data['breadcumb'][]=array('icon'=>'user',
									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
									'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'graduation-cap',
									'link'=>site_url('administrator/mhs_dir/riwayat_pendidikan/view').'/'.$id,
									'judul'=>'Riwayat Pendidikan');

			$data['breadcumb'][]=array('icon'=>'plus',
									'link'=>'',
									'judul'=>$data['judul']);
	
			$this->load->view('template',$data);
		}
		else
			show_404();
	}

	public function edit_data($id_sdm, $id_sdm_pt)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id_sdm))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Edit Riwayat Pendidikan';
			$data['desc_judul']='Mengubah Data Riwayat Pendidikan';
			$data['page']='mahasiswa/template_detail';
			
			//$data['page_tab']='mahasiswa/riwayat_pendidikan/edit';

			$data['page_tab']='edit_data/edit_riwayat_pendidikan';

			$data['breadcumb'][]=array('icon'=>'user',
									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
									'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'graduation-cap',
									'link'=>site_url('administrator/mhs_dir/riwayat_pendidikan/view').'/'.$data['mahasiswa']->id_sdm,
									'judul'=>'Riwayat Pendidikan');

			$data['breadcumb'][]=array('icon'=>'edit',
									'link'=>'',
									'judul'=>$data['judul']);
			
			$data['pegawai_pt']=$this->db->get_where('sispeg_tr_pegawai_pt',array('id_sdm_pt'=>$id_sdm_pt))->row();

			$this->load->view('template',$data);
		}
		else
			show_404();
	}

	public function tambah_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key]=$value!=''?$value:null;

			date_default_timezone_set('Asia/Makassar');
			$data['date_added']=date("Y-m-d H:i:s");
			$data['added_by']=$this->session->userdata('userid');
			$data['id_sdm_pt']=$this->db->query("select UUID() as id")->row()->id;
			$this->db->insert('sispeg_tr_pegawai_pt',$data);

			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	public function edit_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key]=$value!=''?$value:null;

			date_default_timezone_set('Asia/Makassar');
			$data['date_modified']=date("Y-m-d H:i:s");
			$data['modified_by']=$this->session->userdata('userid');
			$this->db->update('sispeg_tr_pegawai_pt',$data,array("id_sdm_pt"=>$data['id_sdm_pt']));
			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}
	
	public function del_data($id_sdm_pt)
	{
		$data['date_deleted']=date("Y-m-d H:i:s");
		$data['deleted_by'] = $this->session->userdata('userid');
		$data['deleted'] = '1';
		$this->db->where('id_sdm_pt',$id_sdm_pt);
		$this->db->update('sispeg_tr_pegawai_pt',$data);

		//echo $this->db->last_query();
		redirect($_SERVER['HTTP_REFERER'],'refresh');	
	}

	public function validasi()
	{		
		$this->form_validation->set_rules('jenjang', 'Jenis Pendaftaran', 'trim|required');		
		$valid = $this->form_validation->run();
		if($valid)
		{
			return $valid;
		}
		else
		{
			echo json_encode(array("status"=>"2","title"=>"Error!","message"=>"Terjadi kesalahan, silahkan periksa kembali data yang diinputkan","detail_error"=>$this->form_validation->field_data()));
		}
	}
	
	public function print_excel($id)
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
 
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Pegawai');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Tgl Generate : '.date('Y-m-d h:i:s'));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Nama Pegawai');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'NRP');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Data Riwayat Pendidikan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Jenjang');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'Jurusan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Sekolah / Universitas');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'Tahun Lulus');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', 'No Ijazah');

		$this->db->select('*');
		$this->db->from('sispeg_tr_pegawai p');
		$this->db->where('id_sdm', $id);
		$this->db->where('deleted','0');
		// $this->db->where('deleted','0');
		$q = $this->db->get();
	
		$ii = 1;
		foreach ($q->result() as $key) { 

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($ii+4), $ii);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.($ii+4), $key->nm_sdm);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.($ii+4), $key->nrp);

			$ii++;
		}

			$this->db->select('*');
			$this->db->from('sispeg_tr_pegawai_pt pt');
			$this->db->where('id_sdm',$id);
			$this->db->order_by('thn_lulus','asc');
			$this->db->where('deleted','0');
			$query = $this->db->get();

			$ia = 1;
			foreach ($query->result() as $keypt) {

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ia+4), $ia);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ia+4), $keypt->jenjang);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($ia+4), $keypt->jurusan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ia+4), $keypt->institusi);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ia+4), $keypt->thn_lulus);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($ia+4), $keypt->no_ijasah);
				
				$ia++;
			}


		

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="DETAIL_DATA_PENDIDIKAN.xls"');
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
