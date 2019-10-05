<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Paket extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url')); 

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'data_renstra/';
		$data['controller']					= 'paket';
		$data['parent_controller']	= 'paket';
		$data['sub_menu']						= 'kegiatan';
		$data['active']							= 'kegiatan';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
		$this->load->helper('currency_format_helper');
	}

	
	public function index($id_kegiatan = NULL)
	{
		$data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id_kegiatan))->row();
		if($data['kegiatan'])
		{
			$data['judul']		  = 'Paket Pekerjaan';
			$data['desc_judul'] = 'Menampilkan dan Mengelola Data Paket';
			$data['page']				= 'paket/list';
			//$data['page_tab']		= 'paket/edit_data_paket';

			$data['breadcumb'][]=array('icon'=>'book',
																 'link'=>site_url('administrator/data_renstra/kegiatan/index/'.$data['kegiatan']->id_kategori),
																 'judul'=>'Data Kegiatan');

			$data['breadcumb'][]=array('icon'=>'book',
																 'link'=>'',
																 'judul'=>'Data Paket');
			$data['id_kegiatan'] = $id_kegiatan;
			$data['tahun'] = 'all';
			$this->db->where('deleted','0');
			//$query = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id))->row();
			$data['paket'] = $this->db->get_where('erenstra_tr_paket', array('id_kegiatan' => $data['kegiatan']->id_kegiatan));
			$data['re_nmkegiatan'] = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $data['kegiatan']->id_nmkegiatan))->row();
			
			$this->load->view('template',$data);
		} else
		show_404();
	}

	public function select_tahun($id_kegiatan = NULL)
	{
		$data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id_kegiatan))->row();
		if($data['kegiatan'])
		{
			extract($_POST);
			$data['judul']	= 'Paket Pekerjaan';
			$data['desc_judul'] = 'Menampilkan dan Mengelola Data Paket';
			$data['page'] = 'paket/list';

			$data['breadcumb'][] = array('icon' => 'book',
																	 'link' => site_url('administrator/data_renstra/kegiatan/index/'.$data['kegiatan']->id_kategori),
																	 'judul' => 'Data Kegiatan');

			$data['breadcumb'][] = array('icon' => 'book',
																	 'link' => '',
																	 'judul' => 'Data Paket');
			$data['id_kegiatan'] = $id_kegiatan;
			$data['tahun'] = $re_tahun;
			$this->db->where('deleted','0');

			if($re_tahun != 'all')
				$this->db->where('id_tahun', $re_tahun);
				$data['paket'] = $this->db->get_where('erenstra_tr_paket', array('id_kegiatan' => $data['kegiatan']->id_kegiatan));
				$data['re_nmkegiatan'] = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $data['kegiatan']->id_nmkegiatan))->row();

			$this->load->view('template', $data);
		} else
		show_404();
	}


	public function tambah_data($id_kegiatan = null)
	{
		if($id_kegiatan == null)
		{
			redirect(site_url('administrator/data_renstra/kegiatan/index'));
		}
		else
		{
			$data['id_kegiatan'] = $id_kegiatan;
		}
		$data['judul']			= 'Tambah Data Paket';
		$data['desc_judul']	= 'Menambahkan Data Paket Baru';
		$data['page']				= 'paket/tambah_paket';

		$data['breadcumb'][] = array('icon' => 'book',
																 'link' => site_url('administrator/data_renstra/paket/index/'.$id_kegiatan),
																 'judul'=> 'List Paket');

		$data['breadcumb'][] = array('icon' => 'plus',
																 'link' => '',
																 'judul'=> $data['judul']);

		$this->db->select('id_tahun as id, nm_tahun text');
		$this->db->where('deleted','0');
		$data['tahun'] = json_encode($this->db->get('erenstra_tr_tahun')->result());

		$this->load->view('template',$data);
	}


	public function tambah_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value) {
				if($key != 'cost_kegiatan') {
					$data[$key] = $value != '' ? $value : null;
				} 
			}

			date_default_timezone_set('Asia/Makassar');
			$data['date_added'] = date("Y-m-d H:i:s");
			$data['added_by']   = $this->session->userdata('userid');
			$data['id_paket']=$this->db->query("select UUID() as id")->row()->id;
			$this->db->insert('erenstra_tr_paket',$data);
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}


	public function edit_paket($id_paket, $id_kegiatan = null)
	{
		if($id_kegiatan == null)
		{
			redirect(site_url('administrator/data_renstra/kegiatan/index'));
		}
		else
		{
			$data['id_kegiatan'] = $id_kegiatan;
		}
		$data['paket'] = $this->db->get_where('erenstra_tr_paket', array('id_paket' => $id_paket))->row();
		if($data['paket'])
		{
			$data['judul']			= 'Edit Data Paket';
			$data['desc_judul']	= 'Mengubah Data Paket';
			$data['page']				= 'paket/edit_paket';

			$data['breadcumb'][] = array('icon' => 'book',
																   'link' => site_url('administrator/data_renstra/paket/index/'.$id_kegiatan),
																   'judul'=> 'List Paket');

			$data['breadcumb'][] = array('icon' => 'edit',
																   'link' => '',
																   'judul'=> $data['judul']);

			$this->db->select('id_tahun as id, nm_tahun text');
			$this->db->where('deleted','0');
			$data['tahun'] = json_encode($this->db->get('erenstra_tr_tahun')->result());

			$this->load->view('template',$data);
		} else
	    	show_404();
	}


	public function proses_edit_paket($id_paket)
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value) {
				if($key != 'cost_kegiatan') {
					$data[$key] = $value != '' ? $value : null;
				}
			}

			date_default_timezone_set('Asia/Makassar');
			$data['date_modified'] = date("Y-m-d H:i:s");
			$data['modified_by']   = $this->session->userdata('userid');

			$this->db->update('erenstra_tr_paket', $data, array("id_paket" => $data['id_paket']));

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}


	public function hapus_data_proses()
	{
		$id_paket = $this->input->post('id');
		date_default_timezone_set('Asia/Makassar');
		if($this->db->update('erenstra_tr_paket', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_paket"=>$id_paket)))
		{
			echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Dihapus"));
		}
		else
		{
			echo json_encode(array("status"=>"2", "title"=>"Data gagal dihapus!", "message"=>"Data Gagal Dihapus"));
		}
	}


	public function validasi()
	{
		// Form Tambah Paket
		$this->form_validation->set_rules('nm_paket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Anggaran', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('cost_kegiatan', 'Jumlah Anggaran Kegiatan', 'trim|required|min_length[8]');

		$this->form_validation->set_message('required', '{field} harus diisi!');
		$this->form_validation->set_message('numeric', '{field} harus berupa angka!');
		$this->form_validation->set_message('min_length', '{field} tidak boleh kurang dari {param} karakter!');
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

}