<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Pegawai extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');

		$this->load->library('feeder');
		$this->load->library('feeder2');

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'mhs_dir/';
		$data['controller']					= 'pegawai';
		$data['parent_controller']	= 'mahasiswa';
		$data['active']							= 'mahasiswa';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
	}

	public function index()
	{
		$data['judul']		= 'E - Renstra';
		$data['page']		= 'mahasiswa/master';
		$data['desc_judul']	= 'Menampilkan Urutan Prioritas Renstra';

		$data['breadcumb'][] = array('icon'  => 'database',
																 'link'  => '',
																 'judul' => 'E-Renstra');

		$this->load->view('template',$data);
	}

	public function tambah_data()
	{
		$data['judul']			='Tambah Data Renstra';
		$data['desc_judul']	='Menambahkan Data Renstra';
		$data['page']				='tambah_data/tambah_data_pegawai';

		$data['breadcumb'][] = array('icon' => 'database',
																 'link' => site_url('administrator/mhs_dir/pegawai'),
																 'judul'=> 'E-Renstra');

		$data['breadcumb'][] = array('icon' => 'plus',
																 'link' => '',
																 'judul'=> $data['judul']);

		$this->load->view('template',$data);
	}

	public function del_data($id_sdm)
	{
		$data['date_deleted'] = date("Y-m-d H:i:s");
		$data['deleted_by'] 	= $this->session->userdata('userid');
		$data['deleted'] 			= '1';
		$this->db->where('id_sdm',$id_sdm);
		$this->db->update('sispeg_tr_pegawai',$data);

		//echo $this->db->last_query();
		redirect($_SERVER['HTTP_REFERER'],'refresh');	
	}


	public function pilih_tahun($id)
	{
			$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Paket Pekerjaan';
			$data['desc_judul']='Menampilkan dan Mengelola Data Renstra';
			$data['page']='edit_data/edit_data_renstra';
			$data['page_tab']='edit_data/edit_data_diri';

			$data['breadcumb'][]=array('icon'=>'database',
																'link'=>site_url('administrator/mhs_dir/pegawai'),
																'judul'=>'Data Renstra');

			$data['breadcumb'][]=array('icon'=>'database',
																'link'=>'',
																'judul'=>'Edit Data Renstra');
	
			$this->load->view('template',$data);
		} else
		show_404();
	}

	public function edit_data_renstra($id)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Paket Pekerjaan';
			$data['desc_judul']='Menampilkan dan Mengelola Data Renstra';
			$data['page']='edit_data/edit_data_renstra';
			$data['page_tab']='edit_data/edit_data_diri';

			$data['breadcumb'][]=array('icon'=>'database',
																'link'=>site_url('administrator/mhs_dir/pegawai'),
																'judul'=>'Data Renstra');

			$data['breadcumb'][]=array('icon'=>'database',
																'link'=>'',
																'judul'=>'Edit Data Renstra');
	
			$this->load->view('template',$data);
		} else
		show_404();
	}

	public function edit_data($id)
	{
		$data['pegawai'] = $this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['pegawai'])
		{
			$data['judul']			= 'Edit Data Pegawai';
			$data['desc_judul']	= 'Mengubah Data Pegawai';
			$data['page']				= 'mahasiswa/template_detail';
			$data['page_tab']		= 'edit_data/edit_data_diri';

			$data['breadcumb'][] = array('icon' => 'user',
																   'link' => site_url('administrator/mhs_dir/pegawai'),
																   'judul'=> 'Pegawai');

			$data['breadcumb'][] = array('icon' => 'edit',
																   'link' => '',
																   'judul'=> $data['judul']);

			$this->db->select('id_agama as id, nm_agama text');
			$this->db->where('id_agama!=', '98');
			$this->db->where('deleted','0');
			$data['agama'] = json_encode($this->db->get('pddikti_re_agama')->result());

			$this->db->select('id_negara as id_negara, UPPER(nm_negara) as nm_negara');
			$this->db->where('deleted','0');
			$data['mhs_negara'] = $this->db->get_where('pddikti_re_negara',array('id_negara'=>$data['pegawai']->kewarganegaraan))->row();
			$data['mahasiswa']  = $data['pegawai'];

			$this->load->view('template',$data);
		} else
	    	show_404();
	}

	public function edit_data_anak($id)
	{
		$data['mahasiswa'] = $this->db->get_where('pddikti_tr_mahasiswa',array('id_pd'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']		  = 'Edit Data Pegawai';
			$data['desc_judul'] = 'Mengubah Data Pegawai';
			$data['page']				= 'edit_data/edit_data_renstra';
			$data['page_tab']		= 'edit_data/edit_data_anak';

			$data['breadcumb'][] = array('icon' => 'user',
																	 'link' => site_url('administrator/mhs_dir/mahasiswa'),
																	 'judul'=> 'Mahasiswa');

			$data['breadcumb'][] = array('icon' => 'edit',
																	 'link' => '',
																	 'judul'=> $data['judul']);

			$this->db->select('id_agama as id, nm_agama text');
			$this->db->where('id_agama!=', '98');
			$this->db->where('deleted','0');
			$data['agama'] = json_encode($this->db->get('pddikti_re_agama')->result());

			$this->db->select('id_jns_tinggal as id, nm_jns_tinggal text');
			$this->db->where('deleted','0');
			$data['jns_tinggal'] = json_encode($this->db->get('pddikti_re_jenis_tinggal')->result());

			$this->db->select('id_alat_transport as id, nm_alat_transport text');
			$this->db->where('deleted','0');
			$data['alat_transport'] = json_encode($this->db->get('pddikti_re_alat_transport')->result());

			$this->db->select('id_jenj_didik as id, nm_jenj_didik text');
			$this->db->where('deleted','0');
			$data['pendidikan'] = json_encode($this->db->get('pddikti_re_jenjang_pendidikan')->result());

			$this->db->select('id_pekerjaan as id, nm_pekerjaan text');
			$this->db->where('deleted','0');
			$data['pekerjaan'] = json_encode($this->db->get('pddikti_re_pekerjaan')->result());

			$this->db->select('id_penghasilan as id, nm_penghasilan text');
			$this->db->where('deleted','0');
			$data['penghasilan'] = json_encode($this->db->get('pddikti_re_penghasilan')->result());

			$limit=4;
			$offset=0;
			while ($offset<16) {
				$this->db->select('id_kk, nm_kk');
				$this->db->like('nm_kk',' - ');
				$this->db->limit($limit,$offset);
				$this->db->order_by('id_kk','asc');
				$data['kk'][]=$this->db->get('pddikti_re_kebutuhan_khusus')->result();
				$offset+=$limit;
			}

			$this->db->select('kec.id_wil as id, concat(kec.nm_wil," - ",kab.nm_wil," - ",prov.nm_wil) as text');
			$this->db->join('pddikti_re_wilayah kab', 'kec.id_induk_wilayah = kab.id_wil and kab.id_level_wil="2"');
			$this->db->join('pddikti_re_wilayah prov', 'kab.id_induk_wilayah = prov.id_wil and prov.id_level_wil="1"');
			$this->db->where(array('kec.id_level_wil'=>'3','kec.id_wil'=>$data['mahasiswa']->id_wil));
			$data['mhs_wilayah']=$this->db->get('pddikti_re_wilayah kec')->row();
			$data['mhs_negara']=$this->db->get_where('pddikti_re_negara',array('id_negara'=>$data['mahasiswa']->kewarganegaraan))->row();
			$data['mhs_kk']=$this->db->get_where('pddikti_re_kebutuhan_khusus',array('id_kk'=>$data['mahasiswa']->id_kk))->row_array();
			$data['ayah_kk']=$this->db->get_where('pddikti_re_kebutuhan_khusus',array('id_kk'=>$data['mahasiswa']->id_kebutuhan_khusus_ayah))->row_array();
			$data['ibu_kk']=$this->db->get_where('pddikti_re_kebutuhan_khusus',array('id_kk'=>$data['mahasiswa']->id_kebutuhan_khusus_ibu))->row_array();
			$data['mhs_pt']=$this->db->get_where('pddikti_tr_mahasiswa_pt',array('id_pd'=>$id,'deleted'=>'0'))->result();

			$this->load->view('template',$data);
		} else
			show_404();
	}

	public function tambah_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key]=$value!='' ? $value : null;
			
			date_default_timezone_set('Asia/Makassar');
			$data['date_added']=date("Y-m-d H:i:s");
			$data['added_by']=$this->session->userdata('userid');
			$data['id_sdm']=$this->db->query("select UUID() as id")->row()->id;
			$this->db->insert('sispeg_tr_pegawai',$data);

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	public function edit_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key]=$value!='' ? $value : null;
			
			date_default_timezone_set('Asia/Makassar');
			$data['date_modified']=date("Y-m-d H:i:s");
			$data['modified_by'] = $this->session->userdata('userid');
			$this->db->update('sispeg_tr_pegawai',$data,array("id_sdm"=>$data['id_sdm']));

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}

	public function hapus_data_proses()
	{
		$id_pd=$this->input->post('id');
		if($this->db->get_where('pddikti_tr_mahasiswa_pt',array("id_pd"=>$id_pd,"deleted"=>"0"))->result())
		{
			echo json_encode(array("status"=>"2","title"=>"Data gagal dihapus!","message"=>"Mahasiswa tidak bisa dihapus karena sudah terdaftar di Program Studi. Silahkan menghapus data yang mengacu mahasiswa ini terlebih dahulu!"));
		}
		else
		{
			date_default_timezone_set('Asia/Makassar');
			if($this->db->update('pddikti_tr_mahasiswa', array("deleted"=>"1","date_modified"=>date("Y-m-d H:i:s")), array("id_pd"=>$id_pd)))
			{
				$this->log_book->hapus(array("nm_tabel"=>"pddikti_tr_mahasiswa","id_tabel"=>$id_pd,"tanggal"=>date("Y-m-d H:i:s")));
				echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Dihapus"));
			}
			else
			{
				echo json_encode(array("status"=>"3","title"=>"Terjadi Kesalahan!","message"=>"Data Gagal Dihapus"));
			}
		}
	}

	public function validasi()
	{
		$this->form_validation->set_rules('nm_sdm', 'Nama Pegawai', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('id_agama', 'Agama', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|max_length[16]');
		
		$this->form_validation->set_message('required', '{field} harus diisi!');
		$this->form_validation->set_message('numeric', '{field} harus berupa angka!');
		$this->form_validation->set_message('max_length', '{field} tidak boleh lebih dari {param} karakter!');
		$this->form_validation->set_message('valid_email', '{field} tidak valid!');

		$valid = $this->form_validation->run();
		if($valid)
		{
			return $valid;
		}
		else
		{
			echo json_encode(array("status"=>"2", "title"=>"Error!", "message"=>"Terjadi kesalahan, silahkan periksa kembali data yang diinputkan", "detail_error"=>$this->form_validation->field_data()));
		}
	}

	public function print_data()
	{
		$this->load->view('administrator/mahasiswa/print_data');
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
 
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Diri Pegawai');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Tgl Generate : '.date('Y-m-d h:i:s'));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Nama');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'Tempat Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'Tanggal Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Jenis Kelamin');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'NIK');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'NRP');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'NPWP');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', 'No BPJS');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', 'Agama');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K4', 'Alamat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L4', 'Kode Pos');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M4', 'Kewarganegaraan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N4', 'Email');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O4', 'Telpon');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P4', 'HP');

		$this->db->select('*');
		$this->db->from('sispeg_tr_pegawai p');
		$this->db->where('id_sdm', $id);
		$this->db->where('deleted','0');
		$q = $this->db->get();
	
		$ii = 1;
		foreach ($q->result() as $key) { 
			// $tmt_kerja = "";
			// $this->db->order_by('added_by','desc');
			// $this->db->limit(1);
			// $this->db->where('id_sdm',$key->id_sdm);
			// foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
			// 		$tmt_kerja = $keyb->tmt_kerja;
			// }

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
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.($ii+4), $key->tmpt_lahir);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ii+4), $key->tgl_lahir);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ii+4), $key->jk);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F'.($ii+4), $key->nik, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ii+4), $key->nrp);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ii+4), $key->npwp);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I'.($ii+4), $key->bpjs, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ii+4), $this->Content_m->get_value('pddikti_re_agama','id_agama',$key->id_agama,'nm_agama'));
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.($ii+4), $key->jln);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.($ii+4), $key->kode_pos);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.($ii+4), $this->Content_m->get_value('pddikti_re_negara','id_negara',$key->kewarganegaraan,'nm_negara'));
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.($ii+4), $key->email);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O'.($ii+4), $key->no_tlp, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('P'.($ii+4), $key->no_hp, PHPExcel_Cell_DataType::TYPE_STRING);

			$ii++;
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="DETAIL_DATA_DIRI.xls"');
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

	public function excel_data_pejabat($id)
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
 
		// Data Diri Pegawai														 
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Diri Pegawai');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Tgl Generate : '.date('Y-m-d h:i:s'));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Nama');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'Tempat Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'Tanggal Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Jenis Kelamin');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'NIK');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'NRP');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'NPWP');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', 'No BPJS');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', 'Agama');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K4', 'Alamat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L4', 'Kode Pos');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M4', 'Kewarganegaraan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N4', 'Email');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O4', 'Telpon');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P4', 'HP');

		// Data Pasangan
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'Data Pasangan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S4', 'Nama Pasangan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T4', 'Status Perkawinan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U4', 'Tempat Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V4', 'Tanggal Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W4', 'No Akta');

		// Data Anak
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X1', 'Data Anak');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y4', 'Nama Anak');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z4', 'Tempat Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA4', 'Tanggal Lahir');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB4', 'Status');

		// Data Pendidikan
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC1', 'Data Riwayat Pendidikan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD4', 'Jenjang');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE4', 'Jurusan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF4', 'Sekolah / Universitas');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG4', 'Tahun Lulus');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH4', 'No Ijazah');

		// Data Diklat
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI1', 'Data Diklat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ4', 'Jenis Diklat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK4', 'Tempat Diklat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL4', 'Tanggal Mulai');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM4', 'Tanggal Selesai');

		// Data Jabatan
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN1', 'Data Jabatan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO4', 'Jabatan Saat Ini');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP4', 'Tanggal Masuk');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ4', 'Tanggal Keluar');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR4', 'PPK');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS4', 'SATKER');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT4', 'KASI / SUBAG');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AU4', 'LOKA / BALAI / BALAI BESAR');

		// Data Evaluasi
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV1', 'Data Evaluasi');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AW4', 'Periode Penilaian');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AX4', 'Rata" Aspek Teknis Pekerjaan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY4', 'Rata" Aspek Non Teknis Pekerjaan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AZ4', 'Rata" Aspek Kepribadian');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BA4', 'Total');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB4', 'Klasifikasi Nilai');

		// Data Cuti
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC1', 'Data Cuti');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BD4', 'Tahun');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BE4', 'Cuti Sakit');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BF4', 'Cuti Alasan Penting');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BG4', 'Cuti Tahunan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BH4', 'Cuti Besar');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BI4', 'Sisa Cuti');

		// Processing data in PHPEXCEL

		$this->db->select('*');
		$this->db->from('sispeg_tr_pegawai p');
		$this->db->where('id_sdm', $id);
		$this->db->where('deleted','0');
		$q = $this->db->get();
	
		$ii = 1;
		foreach ($q->result() as $key) { 

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($ii+4), $ii);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.($ii+4), $key->nm_sdm);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.($ii+4), $key->tmpt_lahir);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ii+4), $key->tgl_lahir);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ii+4), $key->jk);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F'.($ii+4), $key->nik, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ii+4), $key->nrp);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ii+4), $key->npwp);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I'.($ii+4), $key->bpjs, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ii+4), $this->Content_m->get_value('pddikti_re_agama','id_agama',$key->id_agama,'nm_agama'));
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.($ii+4), $key->jln);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.($ii+4), $key->kode_pos);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.($ii+4), $this->Content_m->get_value('pddikti_re_negara','id_negara',$key->kewarganegaraan,'nm_negara'));
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.($ii+4), $key->email);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O'.($ii+4), $key->no_tlp, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('P'.($ii+4), $key->no_hp, PHPExcel_Cell_DataType::TYPE_STRING);

			$ii++;
		}

		$this->db->order_by('added_by','desc');
		$this->db->limit(1);
		$this->db->where('id_sdm',$key->id_sdm);
		$this->db->where('deleted','0');

		$ia = 1;
		foreach ($this->Content_m->select_db('sispeg_tr_pegawai_pasangan')->result() as $keycouple) {
			$nama_couple 		= $keycouple->nama;
			$married_status = $keycouple->status_pernikahan;
			$plc_born 			= $keycouple->tmpt_lahir;
			$date_born 			= $keycouple->tgl_lahir;
			$id_a 					= $keycouple->no_akta;

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.($ia+4), $ia);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.($ia+4), $nama_couple);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.($ia+4), $married_status);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.($ia+4), $plc_born);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.($ia+4), $date_born);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.($ia+4), $id_a);
			
			$ia++;
		}

		$this->db->order_by('added_by','desc');
		$this->db->limit(5);
		$this->db->where('id_sdm',$key->id_sdm);
		$this->db->where('deleted','0');

		$ib = 1;
		foreach ($this->Content_m->select_db('sispeg_tr_pegawai_anak')->result() as $keychild) {
			$nama_child = $keychild->nama;
			$plc_born 	= $keychild->tmpt_lahir;
			$date_born 	= $keychild->tgl_lahir;
			$status 		= $keychild->status;
	
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($ib+4), $ib);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.($ib+4), $nama_child);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.($ib+4), $plc_born);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.($ib+4), $date_born);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.($ib+4), $status);
		
			$ib++;
		}

		$this->db->select('*');
		$this->db->from('sispeg_tr_pegawai_pt');
		$this->db->where('id_sdm',$key->id_sdm);
		$this->db->order_by('thn_lulus','asc');
		$this->db->where('deleted','0');
		$query = $this->db->get();

		$ic = 1;
		foreach ($query->result() as $keypt) {

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.($ic+4), $ic);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.($ic+4), $keypt->jenjang);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE'.($ic+4), $keypt->jurusan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.($ic+4), $keypt->institusi);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG'.($ic+4), $keypt->thn_lulus);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH'.($ic+4), $keypt->no_ijasah);
			
			$ic++;
		}

		$this->db->select('*');
		$this->db->from('sispeg_tr_pegawai_diklat');
		$this->db->where('id_sdm',$key->id_sdm);
		$this->db->where('deleted','0');
		$query = $this->db->get();

		$idd = 1;
		foreach ($query->result() as $keydiklat) {

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.($idd+4), $idd);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.($idd+4), $keydiklat->jenis_diklat);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK'.($idd+4), $keydiklat->tmpt_diklat);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.($idd+4), $keydiklat->tgl_mulai);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM'.($idd+4), $keydiklat->tgl_selesai);
			
			$idd++;
		}

		$this->db->select('*');
		$this->db->from('sispeg_tr_pegawai_jabatan');
		$this->db->where('id_sdm',$key->id_sdm);
		$this->db->where('deleted','0');
		$query = $this->db->get();

		$ie = 1;
		foreach ($query->result() as $keyjabatan) {

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN'.($ie+4), $ie);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO'.($ie+4), $keyjabatan->jabatan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP'.($ie+4), $keyjabatan->tgl_msk);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ'.($ie+4), $keyjabatan->tgl_keluar);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR'.($ie+4), $keyjabatan->ppk);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS'.($ie+4), $keyjabatan->satker);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT'.($ie+4), $keyjabatan->kasi);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AU'.($ie+4), $keyjabatan->loka);
			
			$ie++;
		}
		
		$this->db->select('*');
		$this->db->from('sispeg_tr_evaluasi');
		$this->db->where('id_sdm',$key->id_sdm);
		$this->db->where('deleted','0');
		$query = $this->db->get();

		$if = 1;
		foreach ($query->result() as $keyevaluasi) {

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV'.($if+4), $if);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AW'.($if+4), $keyevaluasi->periode_penilaian);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AX'.($if+4), $keyevaluasi->rata_rata_aspek_teknis_pekerjaan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY'.($if+4), $keyevaluasi->rata_rata_aspek_non_teknis_pekerjaan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AZ'.($if+4), $keyevaluasi->rata_rata_aspek_kepribadian);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BA'.($if+4), $keyevaluasi->total_kinerja_keseluruhan);
			if($keyevaluasi->total_kinerja_keseluruhan >= 13 && $keyevaluasi->total_kinerja_keseluruhan <= 25) { 
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB'.($if+4), 'Buruk');
			} else if($keyevaluasi->total_kinerja_keseluruhan >= 26 && $keyevaluasi->total_kinerja_keseluruhan == 33 ) { 
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB'.($if+4), 'Cukup'); 
			} else if($keyevaluasi->total_kinerja_keseluruhan >= 34 && $keyevaluasi->total_kinerja_keseluruhan == 44 ) { 					
				 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB'.($if+4), 'Baik');	 
			} else if($keyevaluasi->total_kinerja_keseluruhan >= 45 && $keyevaluasi->total_kinerja_keseluruhan == 52 ) {
				 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB'.($if+4), 'Amat Baik');
			}
			
			$if++;
		}
		
		$this->db->select('*');
		$this->db->from('sispeg_tr_cuti ');
		$this->db->where('id_sdm',$key->id_sdm);
		$this->db->where('deleted','0');
		$query = $this->db->get();

		$ig = 1;
		foreach ($query->result() as $keycuti) {

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC'.($ig+4), $ig);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BD'.($ig+4), $keycuti->tahun);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BE'.($ig+4), $keycuti->cuti_sakit);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BF'.($ig+4), $keycuti->cuti_alasan_penting);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BG'.($ig+4), $keycuti->cuti_tahunan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BH'.($ig+4), $keycuti->cuti_besar);
			$ttl_cuti = $keycuti->cuti_sakit + $keycuti->cuti_alasan_penting + $keycuti->cuti_tahunan + $keycuti->cuti_besar;
			$sisa_cuti = $this->Content_m->get_value('sispeg_re_cuti','id_cuti_total','1','batas_cuti') - $ttl_cuti;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BI'.($ig+4), $sisa_cuti);
			
			$ig++;
		}
		

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Data_Diri_Detail.xls"');
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
