<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class File_support extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url')); 

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'data_renstra/';
		$data['controller']					= 'file_support';
		$data['parent_controller']	= 'paket';
		$data['sub_menu']						= 'kegiatan';
		$data['active']							= 'kegiatan';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
	}


	public function index($id_paket, $id_kegiatan = null)
	{
    $data['paket']    = $this->db->get_where('erenstra_tr_paket',array('id_paket'=>$id_paket))->row();
    $data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id_kegiatan))->row();
    if($data['kegiatan'] && $data['paket'])
		{
      $data['judul']      = 'List File Pendukung';
      $data['desc_judul']	= 'Daftar Data File Pendukung';
      $data['page']		    = 'subpaket/template_detail_tabel';
      $data['page_tab']		= 'subpaket/file_support/list_data_file';

      $data['breadcumb'][] = array('icon' => 'book',
                                   'link' => site_url('administrator/data_renstra/kegiatan/index'),
                                   'judul'=> 'Data Kegiatan');

      $data['breadcumb'][]=array('icon'=>'book',
                                 'link'=>site_url('administrator/data_renstra/paket/index').'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'Data Paket');

      $data['breadcumb'][]=array('icon'=>'list',
                                 'link'=>'',
                                 'judul'=>$data['judul']);      

      $this->db->where('deleted','0');
      $col = $id_paket;
			$data['query'] = $this->Content_m->select_db('erenstra_tr_file_support','id_paket',$col);
			
			$this->db->where('deleted','0');
			$data['re_nmkegiatan'] = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $data['kegiatan']->id_nmkegiatan))->row();

      $this->db->where('deleted','0');
      $data['re_nmkategori'] = $this->db->get_where('erenstra_tr_kategori', array('id_kategori' => $data['re_nmkegiatan']->id_kategori))->row();

      $this->load->view('template', $data);
  
		} else
		show_404();
	}
	

	public function tambah_data($id_paket, $id_kegiatan = null)
	{
    $data['paket']    = $this->db->get_where('erenstra_tr_paket',array('id_paket'=>$id_paket))->row();
    $data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id_kegiatan))->row();
		if($data['kegiatan'] && $data['paket'])
		{
			$data['judul']      = 'Tambah Data File Pendukung';
			$data['desc_judul'] = 'Menambah Data File Pendukung ';
			$data['page']       = 'subpaket/template_detail_tabel';			
			$data['page_tab']   = 'subpaket/file_support/tambah_data_file';

      $data['breadcumb'][] = array('icon' => 'book',
                                   'link' => site_url('administrator/data_renstra/kegiatan/index'),
                                   'judul'=> 'Data Kegiatan');

      $data['breadcumb'][]=array('icon'=>'book',
                                 'link'=>site_url('administrator/data_renstra/paket/index').'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'Data Paket');

      $data['breadcumb'][]=array('icon'=>'list',
                                 'link'=>site_url('administrator/data_renstra/file_support/index').'/'.$data['paket']->id_paket.'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'List File');                           

			$data['breadcumb'][]=array('icon'=>'plus',
																'link'=>'',
																'judul'=>$data['judul']);

			$this->db->select('id_kategorifile as id, nm_kategorifile text');
			$this->db->where('deleted','0');
			$data['kategorifile'] = json_encode($this->db->get('erenstra_re_kategorifile')->result());
	
			$this->load->view('template',$data);
		} else
		show_404();
	}


	public function tambah_data_proses()
	{
			extract($_POST);
			if(isset($_POST))
			{
				//print_r($_FILES);
				$target_dir = "media/upload";
				$tmp_name = $_FILES["berkas"]["tmp_name"];
				// basename() may prevent filesystem traversal attacks;
				// further validation/sanitation of the filename may be appropriate
				$name = $_FILES["berkas"]["name"];
				//move_uploaded_file($tmp_name, "$target_dir/$name");
				   	
				$data = array(
											'date_added' 			=> date("Y-m-d H:i:s"),
											"added_by" 			  => $this->session->userdata('userid'),
											"id_file_support" => $this->db->query("select UUID() as id")->row()->id,
											"id_paket" 				=> $id_paket,
											"nm_file" 			  => $nm_file,
											"keterangan" 			=> $keterangan,
											"path_unduh"			=> $name,
											"id_kategorifile"	=> $id_kategorifile,
										);
				
				if($this->Content_m->insert_db('erenstra_tr_file_support',$data)) 
				{
					$terupload = move_uploaded_file($tmp_name, "$target_dir/$name");
					if ($terupload) {
						redirect(site_url('administrator/data_renstra/file_support/index/'.$id_paket.'/'.$id_kegiatan));
					} else {
						echo "Upload Gagal!";
					}
				}
				else
				{
					redirect(site_url('administrator/data_renstra/file_support/tambah_data/'.$id_paket.'/'.$id_kegiatan));
				}
				//echo $this->db->last_query();
			}
	}


  public function edit_data($id_paket, $id_kegiatan, $id_file_support)
	{
    $data['paket']    = $this->db->get_where('erenstra_tr_paket',array('id_paket'=>$id_paket))->row();
    $data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id_kegiatan))->row();
		if($data['kegiatan'] && $data['paket'])
		{
			$data['judul']		  = 'Edit Data File Pendukung';
			$data['desc_judul'] = 'Mengubah Data File Pendukung';
			$data['page']				= 'subpaket/template_detail_tabel';
			$data['page_tab']   = 'subpaket/file_support/edit_data_file';

      $data['breadcumb'][] = array('icon' => 'book',
                                   'link' => site_url('administrator/data_renstra/kegiatan/index'),
                                   'judul'=> 'Data Kegiatan');

      $data['breadcumb'][]=array('icon'=>'book',
                                 'link'=>site_url('administrator/data_renstra/paket/index').'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'Data Paket');

      $data['breadcumb'][]=array('icon'=>'list',
                                 'link'=>site_url('administrator/data_renstra/file_support/index').'/'.$data['paket']->id_paket.'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'List File');     

			$data['breadcumb'][]=array('icon'=>'edit',
																 'link'=>'',
																 'judul'=>$data['judul']);
			
			$data['file_support']=$this->db->get_where('erenstra_tr_file_support', array('id_file_support'=>$id_file_support))->row();

			$this->db->select('id_kategorifile as id, nm_kategorifile text');
			$this->db->where('deleted','0');
			$data['kategorifile'] = json_encode($this->db->get('erenstra_re_kategorifile')->result());

			$this->load->view('template',$data);
		} else
		show_404();
	}


	public function edit_data_proses()
	{
			extract($_POST);
			if(isset($_POST))
			{
				//print_r($_FILES);
				$target_dir = "media/upload";
				$tmp_name = $_FILES["berkas"]["tmp_name"];
				// basename() may prevent filesystem traversal attacks;
				// further validation/sanitation of the filename may be appropriate
				$name = $_FILES["berkas"]["name"];
				//move_uploaded_file($tmp_name, "$target_dir/$name");
				   	
				$data = array(
											"date_modified" 	=> date("Y-m-d H:i:s"),
											"modified_by" 		=> $this->session->userdata('userid'),
											"id_file_support" => $id_file_support,
											"id_paket" 				=> $id_paket,
											"nm_file" 			  => $nm_file,
											"keterangan" 			=> $keterangan,
											"path_unduh"			=> $name,
											"id_kategorifile"	=> $id_kategorifile,
										);
				
				if($this->Content_m->update_db('erenstra_tr_file_support', 'id_file_support', $id_file_support, $data)) 
				{
					$terupload = move_uploaded_file($tmp_name, "$target_dir/$name");
					if ($terupload) {
						redirect(site_url('administrator/data_renstra/file_support/index/'.$id_paket.'/'.$id_kegiatan));
					} else {
						echo "Upload Gagal!";
					}
				}
				else
				{
					redirect(site_url('administrator/data_renstra/file_support/tambah_data/'.$id_paket.'/'.$id_kegiatan));
				}
				//echo $this->db->last_query();
			}
	}


	public function download($id_file_support)
	{
		$nama_file = $this->Content_m->get_row_custom('erenstra_tr_file_support','id_file_support',$id_file_support)->path_unduh;
		$this->downloadFile("media/upload/$nama_file");
	}


	function downloadFile($file) {
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
	

  public function validasi()
	{
    $this->form_validation->set_rules('nm_file', 'Nama File ', 'trim|required|min_length[5]');
    //$this->form_validation->set_rules('path_unduh', 'File Upload', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[5]');

		$this->form_validation->set_message('required', '{field} harus diisi!');
		$this->form_validation->set_message('numeric', '{field} harus berupa angka!');
		$this->form_validation->set_message('min_length', '{field} tidak boleh kurang dari {param} karakter!');
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
}