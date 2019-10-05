<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Data_anak extends Secure_area_adm 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');

		$data['jenis_page']="administrator/";
		$data['controller_dir']='mhs_dir/';
		$data['controller']='data_anak';
		$data['parent_controller']='mahasiswa';
		$data['active']='mahasiswa';
		$this->load->vars($data);
	}

	public function view($id)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Data Anak';
			$data['desc_judul']='Menampilkan dan Mengelola Data Anak';
			$data['page']='mahasiswa/template_detail';
			$data['page_tab']='mahasiswa/data_anak/master';

			$data['breadcumb'][]=array('icon'=>'user',
									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
									'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'user',
									'link'=>'',
									'judul'=>'Data Anak');
	
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
			$data['judul']='Tambah Data Anak';
			$data['desc_judul']='Menambah Data Anak ';
			$data['page']='mahasiswa/template_detail';
			
			//$data['page_tab']='mahasiswa/riwayat_pendidikan/add';
			
			$data['page_tab']='tambah_data/tambah_data_anak';

			$data['breadcumb'][]=array('icon'=>'user',
																 'link'=>site_url('administrator/mhs_dir/mahasiswa'),
																 'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'user',
																 'link'=>site_url('administrator/mhs_dir/data_anak/view').'/'.$id,
																 'judul'=>'Data Anak');

			$data['breadcumb'][]=array('icon'=>'plus',
																 'link'=>'',
																 'judul'=>$data['judul']);

			$this->load->view('template',$data);
		}
		else
			show_404();
	}

	public function edit_data($id_sdm, $id_sdm_anak)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id_sdm))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Edit Data Anak';
			$data['desc_judul']='Mengubah Data Anak';
			$data['page']='mahasiswa/template_detail';
			
			//$data['page_tab']='mahasiswa/riwayat_pendidikan/edit';

			$data['page_tab']='edit_data/edit_data_anak';

			$data['breadcumb'][]=array('icon'=>'user',
																 'link'=>site_url('administrator/mhs_dir/mahasiswa'),
																 'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'user',
																 'link'=>site_url('administrator/mhs_dir/data_anak/view').'/'.$data['mahasiswa']->id_sdm,
																 'judul'=>'Data Anak');

			$data['breadcumb'][]=array('icon'=>'edit',
																 'link'=>'',
																 'judul'=>$data['judul']);
			
			$data['anak']=$this->db->get_where('sispeg_tr_pegawai_anak',array('id_sdm_anak'=>$id_sdm_anak))->row();

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
			$data['id_sdm_anak']=$this->db->query("select UUID() as id")->row()->id;
			$this->db->insert('sispeg_tr_pegawai_anak',$data);
			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	public function edit_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key] = $value != '' ? $value : null;

			date_default_timezone_set('Asia/Makassar');
			$data['date_modified'] = date("Y-m-d H:i:s");
			$data['modified_by']=$this->session->userdata('userid');
			$this->db->update('sispeg_tr_pegawai_anak',$data,array("id_sdm_anak"=>$data['id_sdm_anak']));
			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}
	
	public function del_data($id_sdm_pasangan)
	{
		$data['date_deleted'] = date("Y-m-d H:i:s");
		$data['deleted_by'] = $this->session->userdata('userid');
		$data['deleted'] = '1';
		$this->db->where('id_sdm_anak',$id_sdm_pasangan);
		$this->db->update('sispeg_tr_pegawai_anak',$data);

		//echo $this->db->last_query();
		redirect($_SERVER['HTTP_REFERER'],'refresh');	
	}

	public function validasi()
	{
		$this->form_validation->set_rules('nama', 'Nama anak', 'trim|required');
		
		$valid=$this->form_validation->run();
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Data Anak');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Nama Anak');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'Tempat Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Tanggal Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'Status');

		$this->db->select('*');
		$this->db->from('sispeg_tr_pegawai p');
		$this->db->where('id_sdm', $id);
		$this->db->where('deleted','0');
		$q = $this->db->get();
	
		$ii = 1;
		foreach ($q->result() as $key) { 
			$ia = 1;

			$this->db->order_by('added_by','desc');
			$this->db->limit(5);
			$this->db->where('id_sdm',$key->id_sdm);
			$this->db->where('deleted','0');
			foreach ($this->Content_m->select_db('sispeg_tr_pegawai_anak')->result() as $keychild) {
					$nama_child = $keychild->nama;
					$plc_born = $keychild->tmpt_lahir;
					$date_born = $keychild->tgl_lahir;
					$status = $keychild->status;
			}

			// $no_sk = "";
			// $this->db->order_by('added_by','desc');
			// $this->db->limit(1);
			// $this->db->where('id_sdm',$key->id_sdm);
			// foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
			// 		$no_sk = $keyb->no_sk;
			// }

			// $diklat= "";
			// $this->db->order_by('added_by','desc');
			// $this->db->limit(1);
			// $this->db->where('id_sdm',$key->id_sdm);
			// foreach ($this->Content_m->select_db('sispeg_tr_pegawai_diklat')->result() as $keyb ) {
			// 		$diklat = $keyb->jenis_diklat;
			// }
			
			// $pt= "";
			// $this->db->order_by('show','desc');
			// $this->db->where('id_sdm',$key->id_sdm);
			// $this->db->limit(1);
			// foreach ($this->Content_m->select_db('sispeg_tr_pegawai_pt')->result() as $keyb ) {
			// 		$pt = $keyb->jenjang;
			// }

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($ii+4), $ii);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.($ii+4), $key->nm_sdm);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.($ii+4), $key->nrp);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ii+4), $ia);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ii+4), $nama_child);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($ii+4), $plc_born);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ii+4), $date_born);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ii+4), $status);

			$ii++;
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="DETAIL_DATA_ANAK.xls"');
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
