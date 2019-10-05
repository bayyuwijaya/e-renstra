<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Data_evaluasi extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');

		$data['jenis_page']="administrator/";
		$data['controller_dir']='mhs_dir/';
		$data['controller']='data_evaluasi';
		$data['parent_controller']='mahasiswa';
		$data['active']='data_evaluasi';
		$this->load->vars($data);
	}

	public function view($id)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Data Evaluasi';
			$data['desc_judul']='Menampilkan dan Mengelola Evaluasi Kinerja Pegawai';
			$data['page']='mahasiswa/template_detail';
			$data['page_tab']='mahasiswa/data_evaluasi/master';

			$data['breadcumb'][]=array('icon'=>'user',
									'link'=>site_url('administrator/mhs_dir/pegawai'),
									'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'book',
									'link'=>'',
									'judul'=>'Data Evaluasi');

	
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
			$data['judul']='Data Evaluasi Kinerja Pegawai';
	        $data['desc_judul']='Menambah Data Evaluasi Kinerja Pegawai';
	        $data['page']='mahasiswa/template_detail';
	        
	        //$data['page_tab']='mahasiswa/riwayat_pendidikan/add';
	        
	        $data['page_tab']='tambah_data/tambah_data_evaluasi';

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/pegawai'),
    									'judul'=>'Pegawai');

	        $data['breadcumb'][]=array('icon'=>'book',
    									'link'=>site_url('administrator/mhs_dir/data_evaluasi/view').'/'.$id,
    									'judul'=>'Data Evaluasi');

	        $data['breadcumb'][]=array('icon'=>'plus',
    									'link'=>'',
    									'judul'=>$data['judul']);

			
	        $this->load->view('template',$data);
	    }
	    else
	    	show_404();
	}

    public function edit_data($id_sdm, $id_evaluasi)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id_sdm))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Edit Data Evaluasi';
	        $data['desc_judul']='Mengubah Data Data Evaluasi';
	        $data['page']='mahasiswa/template_detail';
	        
	        //$data['page_tab']='mahasiswa/riwayat_pendidikan/edit';

	        $data['page_tab']='edit_data/edit_data_evaluasi';

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/pegawai'),
    									'judul'=>'Pegawai');

	        $data['breadcumb'][]=array('icon'=>'book',
    									'link'=>site_url('administrator/mhs_dir/data_evaluasi/view').'/'.$data['mahasiswa']->id_sdm,
    									'judul'=>'Data Evaluasi');

	        $data['breadcumb'][]=array('icon'=>'edit',
    									'link'=>'',
    									'judul'=>$data['judul']);

	      	
	      	$data['evaluasi']=$this->db->get_where('sispeg_tr_evaluasi',array('id_evaluasi'=>$id_evaluasi))->row();
		

	        $this->load->view('template',$data);
	    }
	    else
	    	show_404();
	}

	public function tambah_data_proses()
	{
		extract($_POST);
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key]=$value!=''?$value:null;

			date_default_timezone_set('Asia/Makassar');
			$data['date_added']=date("Y-m-d H:i:s");
			$data['added_by']=$this->session->userdata('userid');
			unset($data['total_kinerja_keseluruhan']);
			$data['rata_rata_aspek_teknis_pekerjaan']=($pemahaman_terhadap_pekerjaan+$ketepatan_waktu_dalam_menyelesaikan_tugas+$kesesuaian_hasil_kerja_dengan_yang_diharapkan)/3;
			$data['rata_rata_aspek_non_teknis_pekerjaan']=($kerapian_pengadministrasian_pekerjaan+$inisiatif+$kerjasama+$kesopanan_dan_keluwesan_komunikasi+$ketanggapan_dan_ketangkasan_dalam_melayani)/5;
			$data['rata_rata_aspek_kepribadian']=($prilaku+$kedisiplinan+$tanggung_jawab+$loyalitas+$ketaatan_terhadap_instruksi_kerja_atasan)/5;

			$ttl =  $pemahaman_terhadap_pekerjaan + $ketepatan_waktu_dalam_menyelesaikan_tugas + $kesesuaian_hasil_kerja_dengan_yang_diharapkan + $kerapian_pengadministrasian_pekerjaan + $inisiatif + $kerjasama + $kesopanan_dan_keluwesan_komunikasi + $ketanggapan_dan_ketangkasan_dalam_melayani + $prilaku + $kedisiplinan + $tanggung_jawab + $loyalitas + $ketaatan_terhadap_instruksi_kerja_atasan;
			$data['total_kinerja_keseluruhan']= $ttl;
			//unset($data['rata_rata_aspek_teknis_pekerjaan']);
			$this->db->insert('sispeg_tr_evaluasi',$data);

			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	public function edit_data_proses()
	{
		extract($_POST);
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key]=$value!=''?$value:null;

			date_default_timezone_set('Asia/Makassar');
			$data['date_modified']=date("Y-m-d H:i:s");
			$data['modified_by']=$this->session->userdata('userid');
			unset($data['total_kinerja_keseluruhan']);
			unset($data['id_evaluasi']);
			$data['rata_rata_aspek_teknis_pekerjaan']=($pemahaman_terhadap_pekerjaan+$ketepatan_waktu_dalam_menyelesaikan_tugas+$kesesuaian_hasil_kerja_dengan_yang_diharapkan)/3;
			$data['rata_rata_aspek_non_teknis_pekerjaan']=($kerapian_pengadministrasian_pekerjaan+$inisiatif+$kerjasama+$kesopanan_dan_keluwesan_komunikasi+$ketanggapan_dan_ketangkasan_dalam_melayani)/5;
			$data['rata_rata_aspek_kepribadian']=($prilaku+$kedisiplinan+$tanggung_jawab+$loyalitas+$ketaatan_terhadap_instruksi_kerja_atasan)/5;

			$ttl =  $pemahaman_terhadap_pekerjaan + $ketepatan_waktu_dalam_menyelesaikan_tugas + $kesesuaian_hasil_kerja_dengan_yang_diharapkan + $kerapian_pengadministrasian_pekerjaan + $inisiatif + $kerjasama + $kesopanan_dan_keluwesan_komunikasi + $ketanggapan_dan_ketangkasan_dalam_melayani + $prilaku + $kedisiplinan + $tanggung_jawab + $loyalitas + $ketaatan_terhadap_instruksi_kerja_atasan;
			$data['total_kinerja_keseluruhan']= $ttl;

			$this->db->update('sispeg_tr_evaluasi',$data,array("id_evaluasi"=>$id_evaluasi));

			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}

	
	public function del_data($id_evaluasi)
	{
		$data['date_deleted']=date("Y-m-d H:i:s");
		$data['deleted_by'] = $this->session->userdata('userid');
		$data['deleted'] = '1';
		$this->db->where('id_evaluasi',$id_evaluasi);
		$this->db->update('sispeg_tr_evaluasi',$data);

		//echo $this->db->last_query();
		redirect($_SERVER['HTTP_REFERER'],'refresh');	
	}


	public function validasi()
	{
		$this->form_validation->set_rules('periode_penilaian', 'Periode penilaian', 'trim|required');
		
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Data Evaluasi');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Periode Penilaian');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'Rata" Aspek Teknis Pekerjaan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Rata" Aspek Non Teknis Pekerjaan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'Rata" Aspek Kepribadian');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', 'Total');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', 'Klasifikasi Nilai');

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
			$this->db->from('sispeg_tr_evaluasi pt');
			$this->db->where('id_sdm',$id);
			$this->db->where('deleted','0');
			$query = $this->db->get();

			$ia = 1;
			foreach ($query->result() as $keyevaluasi) {

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ia+4), $ia);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ia+4), $keyevaluasi->periode_penilaian);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($ia+4), $keyevaluasi->rata_rata_aspek_teknis_pekerjaan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ia+4), $keyevaluasi->rata_rata_aspek_non_teknis_pekerjaan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ia+4), $keyevaluasi->rata_rata_aspek_kepribadian);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($ia+4), $keyevaluasi->total_kinerja_keseluruhan);
				if($keyevaluasi->total_kinerja_keseluruhan >= 13 && $keyevaluasi->total_kinerja_keseluruhan <= 25) { 
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ia+4), 'Buruk');
				} else if($keyevaluasi->total_kinerja_keseluruhan >= 26 && $keyevaluasi->total_kinerja_keseluruhan == 33 ) { 
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ia+4), 'Cukup'); 
				} else if($keyevaluasi->total_kinerja_keseluruhan >= 34 && $keyevaluasi->total_kinerja_keseluruhan == 44 ) { 					
					 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ia+4), 'Baik');	 
				} else if($keyevaluasi->total_kinerja_keseluruhan >= 45 && $keyevaluasi->total_kinerja_keseluruhan == 52 ) {
					 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ia+4), 'Amat Baik');
				}
				
				$ia++;
			}	

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="DETAIL_DATA_EVALUASI.xls"');
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