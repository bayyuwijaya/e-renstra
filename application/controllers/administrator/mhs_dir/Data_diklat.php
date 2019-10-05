<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Data_diklat extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');

		$data['jenis_page']="administrator/";
		$data['controller_dir']='mhs_dir/';
        $data['controller']='data_diklat';
        $data['parent_controller']='mahasiswa';
        $data['active']='mahasiswa';
       	$this->load->vars($data);
	}

	public function view($id)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Data Diklat';
	        $data['desc_judul']='Menampilkan dan Mengelola Data Diklat';
	        $data['page']='mahasiswa/template_detail';
	        $data['page_tab']='mahasiswa/data_diklat/master';

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
    									'judul'=>'Pegawai');

	        $data['breadcumb'][]=array('icon'=>'book',
    									'link'=>'',
    									'judul'=>'Data Diklat');

	    
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
			$data['judul']='Tambah Data Diklat';
	        $data['desc_judul']='Menambah Data Diklat/Seminar ';
	        $data['page']='mahasiswa/template_detail';
	        
	        //$data['page_tab']='mahasiswa/riwayat_pendidikan/add';
	        
	        $data['page_tab']='tambah_data/tambah_data_diklat';

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
    									'judul'=>'Pegawai');

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/data_diklat/view').'/'.$id,
    									'judul'=>'Data Diklat');

	        $data['breadcumb'][]=array('icon'=>'plus',
    									'link'=>'',
    									'judul'=>$data['judul']);

			
	        $this->load->view('template',$data);
	    }
	    else
	    	show_404();
	}

    public function edit_data($id_sdm, $id_sdm_diklat)
	{
		$data['mahasiswa']=$this->db->get_where('sispeg_tr_pegawai',array('id_sdm'=>$id_sdm))->row();
		if($data['mahasiswa'])
		{
			$data['judul']='Edit Data Diklat';
	        $data['desc_judul']='Mengubah Data Diklat';
	        $data['page']='mahasiswa/template_detail';
	        
	        //$data['page_tab']='mahasiswa/riwayat_pendidikan/edit';

	        $data['page_tab']='edit_data/edit_data_diklat';

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/mahasiswa'),
    									'judul'=>'Pegawai');

	        $data['breadcumb'][]=array('icon'=>'user',
    									'link'=>site_url('administrator/mhs_dir/data_diklat/view').'/'.$data['mahasiswa']->id_sdm,
    									'judul'=>'Data Diklat');

	        $data['breadcumb'][]=array('icon'=>'edit',
    									'link'=>'',
    									'judul'=>$data['judul']);

	      	
	      	$data['diklat']=$this->db->get_where('sispeg_tr_pegawai_diklat',array('id_sdm_diklat'=>$id_sdm_diklat))->row();
		

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
			$data['id_sdm_diklat']=$this->db->query("select UUID() as id")->row()->id;
			$this->db->insert('sispeg_tr_pegawai_diklat',$data);

			
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
			$this->db->update('sispeg_tr_pegawai_diklat',$data,array("id_sdm_diklat"=>$data['id_sdm_diklat']));

			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}

	
	public function del_data($id_sdm_diklat)
	{
		$data['date_deleted']=date("Y-m-d H:i:s");
		$data['deleted_by'] = $this->session->userdata('userid');
		$data['deleted'] = '1';
		$this->db->where('id_sdm_diklat',$id_sdm_diklat);
		$this->db->update('sispeg_tr_pegawai_diklat',$data);

		//echo $this->db->last_query();
		redirect($_SERVER['HTTP_REFERER'],'refresh');	
	}


	public function validasi()
	{
		
        $this->form_validation->set_rules('jenis', 'jenis diklat', 'trim');
        
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Data Diklat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Jenis Diklat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'Tempat Diklat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Tanggal Mulai');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'Tanggal Selesai');

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
			$this->db->from('sispeg_tr_pegawai_diklat pt');
			$this->db->where('id_sdm',$id);
			$this->db->where('deleted','0');
			$query = $this->db->get();

			$ia = 1;
			foreach ($query->result() as $keydiklat) {

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.($ia+4), $ia);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($ia+4), $keydiklat->jenis_diklat);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($ia+4), $keydiklat->tmpt_diklat);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($ia+4), $keydiklat->tgl_mulai);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($ia+4), $keydiklat->tgl_selesai);
				
				$ia++;
			}	

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="DETAIL_DATA_DIKLAT.xls"');
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
