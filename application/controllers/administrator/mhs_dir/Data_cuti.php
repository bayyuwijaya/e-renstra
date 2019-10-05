<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Data_cuti extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');

		$data['jenis_page']="administrator/";
		$data['controller_dir']='mhs_dir/';
		$data['controller']='data_cuti';
		$data['parent_controller']='mahasiswa';
		$data['active']='data_cuti';
		$this->load->vars($data);
	}

	public function view($id)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Data Cuti';
			$data['desc_judul']='Menampilkan dan Mengelola Cuti Pegawai';
			$data['page']='mahasiswa/template_detail';
			$data['page_tab']='mahasiswa/data_cuti/master';

			$data['breadcumb'][]=array('icon'=>'user',
									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
									'judul'=>'Pegawai');

			$data['breadcumb'][]=array('icon'=>'book',
									'link'=>'',
									'judul'=>'Data Cuti');
	
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
			$data['judul']='Data Cuti Pegawai';
	        $data['desc_judul']='Menambah Data Cuti Pegawai';
	        $data['page']='mahasiswa/template_detail';
	        
	        //$data['page_tab']='mahasiswa/riwayat_pendidikan/add';
	        
	        $data['page_tab']='tambah_data/tambah_data_cuti';

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
    									'judul'=>'Pegawai');

	        $data['breadcumb'][]=array('icon'=>'book',
    									'link'=>site_url('administrator/mhs_dir/data_cuti/view').'/'.$id,
    									'judul'=>'Data Cuti');

	        $data['breadcumb'][]=array('icon'=>'plus',
    									'link'=>'',
    									'judul'=>$data['judul']);

			
	        $this->load->view('template',$data);
	    }
	    else
	    	show_404();
	}

    public function edit_data($id_sdm, $id_cuti)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id_sdm))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Edit Data Cuti';
	        $data['desc_judul']='Mengubah Data Data Cuti';
	        $data['page']='mahasiswa/template_detail';
	        
	        //$data['page_tab']='mahasiswa/riwayat_pendidikan/edit';

	        $data['page_tab']='edit_data/edit_data_cuti';

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
    									'judul'=>'Pegawai');

	        $data['breadcumb'][]=array('icon'=>'graduation-cap',
    									'link'=>site_url('administrator/mhs_dir/data_cuti/view').'/'.$data['mahasiswa']->id_sdm,
    									'judul'=>'Data Cuti');

	        $data['breadcumb'][]=array('icon'=>'edit',
    									'link'=>'',
    									'judul'=>$data['judul']);

	      	
	      	$data['cuti']=$this->db->get_where('sispeg_tr_cuti',array('id_cuti'=>$id_cuti))->row();
		

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
			$this->db->insert('sispeg_tr_cuti',$data);

			
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
			$this->db->update('sispeg_tr_cuti',$data,array("id_cuti"=>$data['id_cuti']));

			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}

	
	public function del_data($id_cuti)
	{
		$data['date_deleted']=date("Y-m-d H:i:s");
		$data['deleted_by'] = $this->session->userdata('userid');
		$data['deleted'] = '1';
		$this->db->where('id_cuti',$id_cuti);
		$this->db->update('sispeg_tr_cuti',$data);

		//echo $this->db->last_query();
		redirect($_SERVER['HTTP_REFERER'],'refresh');	
	}


	public function validasi()
	{
		$this->form_validation->set_rules('tahun', 'tahun', 'trim');
		
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Data Cuti');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Tahun');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'Cuti Sakit');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Cuti Alasan Penting');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'Cuti Tahunan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', 'Cuti Besar');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', 'Sisa Cuti');

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
			$this->db->from('sispeg_tr_cuti pt');
			$this->db->where('id_sdm',$id);
			$this->db->where('deleted','0');
			$query = $this->db->get();

			$ia = 1;
			foreach ($query->result() as $keycuti) {

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ia+4), $ia);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ia+4), $keycuti->tahun);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($ia+4), $keycuti->cuti_sakit);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ia+4), $keycuti->cuti_alasan_penting);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ia+4), $keycuti->cuti_tahunan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($ia+4), $keycuti->cuti_besar);
				$ttl_cuti = $keycuti->cuti_sakit + $keycuti->cuti_alasan_penting + $keycuti->cuti_tahunan + $keycuti->cuti_besar;
				$sisa_cuti = $this->Content_m->get_value('sispeg_re_cuti','id_cuti_total','1','batas_cuti') - $ttl_cuti;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($ia+4), $sisa_cuti);
				
				$ia++;
			}	

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="DETAIL_DATA_CUTI.xls"');
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
