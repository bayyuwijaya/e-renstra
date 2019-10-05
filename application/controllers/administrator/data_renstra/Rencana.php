<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Rencana extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url')); 

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'data_renstra/';
		$data['controller']					= 'rencana';
		$data['parent_controller']	= 'paket';
		$data['sub_menu']						= 'kegiatan';
		$data['active']							= 'kegiatan';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
		$this->load->helper('currency_format_helper');
	}


	public function index($id_paket, $id_kegiatan = null)
	{
    $data['paket']    = $this->db->get_where('erenstra_tr_paket',array('id_paket'=>$id_paket))->row();
    $data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id_kegiatan))->row();
    if($data['kegiatan'] && $data['paket'])
		{
      $data['judul']      = 'List Rencana Pelaksanaan';
      $data['desc_judul']	= 'Daftar Data Rencana Pelaksanaan';
      $data['page']		    = 'subpaket/template_detail_tabel';
      $data['page_tab']		= 'subpaket/rencana/list_data_rencana';

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
			$data['re_nmkegiatan'] = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $data['kegiatan']->id_nmkegiatan))->row();

      $this->db->where('deleted','0');
      $data['re_nmkategori'] = $this->db->get_where('erenstra_tr_kategori', array('id_kategori' => $data['re_nmkegiatan']->id_kategori))->row();

      $this->db->where('deleted','0');
      $col = $id_paket;
      $data['query'] = $this->Content_m->select_db('erenstra_tr_rencana_pelaksanaan','id_paket',$col);

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
			$data['judul']      = 'Tambah Data Rencana Pelaksanaan';
			$data['desc_judul'] = 'Menambah Data Rencana Pelaksanaan ';
			$data['page']       = 'subpaket/template_detail_tabel';			
			$data['page_tab']   = 'subpaket/rencana/tambah_data_rencana';

      $data['breadcumb'][] = array('icon' => 'book',
                                   'link' => site_url('administrator/data_renstra/kegiatan/index'),
                                   'judul'=> 'Data Kegiatan');

      $data['breadcumb'][]=array('icon'=>'book',
                                 'link'=>site_url('administrator/data_renstra/paket/index').'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'Data Paket');

      $data['breadcumb'][]=array('icon'=>'list',
                                 'link'=>site_url('administrator/data_renstra/rencana/index').'/'.$data['paket']->id_paket.'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'List Rencana');                           

			$data['breadcumb'][]=array('icon'=>'plus',
																'link'=>'',
																'judul'=>$data['judul']);

			$this->db->select('id_satuan as id, nm_satuan text');
			$this->db->where('jns_satuan', 'output');
			$this->db->where('deleted','0');
			$data['satuanoutput'] = json_encode($this->db->get('erenstra_re_satuan')->result());

			$this->db->select('id_satuan as id, nm_satuan text');
			$this->db->where('jns_satuan', 'outcome');
			$this->db->where('deleted','0');
			$data['satuanoutcome'] = json_encode($this->db->get('erenstra_re_satuan')->result());
	
			$this->load->view('template',$data);
		} else
		show_404();
	}


  public function tambah_data_proses()
	{
		if($this->validasi())
		{			
			date_default_timezone_set('Asia/Makassar');
			$data['date_added'] = date("Y-m-d H:i:s");
			$data['added_by']   = $this->session->userdata('userid');
			$data['id_rencana'] = $this->db->query("select UUID() as id")->row()->id;

			$data['id_paket']			= $this->input->post('id_paket', TRUE);
			$data['sub_komponen'] = $this->input->post('sub_komponen', TRUE);
			$data['output_satuan'] = $this->input->post('output_satuan', TRUE);
			$data['output_target'] = $this->input->post('output_target', TRUE);
			$data['outcome_satuan'] = $this->input->post('outcome_satuan', TRUE);
			$data['outcome_target'] = $this->input->post('outcome_target', TRUE);
			$data['anggaran']				= $this->input->post('input_anggaran', TRUE);

			$this->db->insert('erenstra_tr_rencana_pelaksanaan', $data);
			
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
  }
  

  public function edit_data($id_paket, $id_kegiatan, $id_rencana)
	{
    $data['paket']    = $this->db->get_where('erenstra_tr_paket',array('id_paket'=>$id_paket))->row();
    $data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id_kegiatan))->row();
		if($data['kegiatan'] && $data['paket'])
		{
			$data['judul']		  = 'Edit Data Rencana Pelaksanaan';
			$data['desc_judul'] = 'Mengubah Data Rencana Pelaksanaan';
			$data['page']				= 'subpaket/template_detail_tabel';
			$data['page_tab']   = 'subpaket/rencana/edit_data_rencana';

      $data['breadcumb'][] = array('icon' => 'book',
                                   'link' => site_url('administrator/data_renstra/kegiatan/index'),
                                   'judul'=> 'Data Kegiatan');

      $data['breadcumb'][]=array('icon'=>'book',
                                 'link'=>site_url('administrator/data_renstra/paket/index').'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'Data Paket');

      $data['breadcumb'][]=array('icon'=>'list',
                                 'link'=>site_url('administrator/data_renstra/rencana/index').'/'.$data['paket']->id_paket.'/'.$data['kegiatan']->id_kegiatan,
                                 'judul'=>'List Rencana');  

			$data['breadcumb'][]=array('icon'=>'edit',
																 'link'=>'',
																 'judul'=>$data['judul']);
			
			$data['rencana']=$this->db->get_where('erenstra_tr_rencana_pelaksanaan', array('id_rencana'=>$id_rencana))->row();

			$this->db->select('id_satuan as id, nm_satuan text');
			$this->db->where('jns_satuan', 'output');
			$this->db->where('deleted','0');
			$data['satuanoutput'] = json_encode($this->db->get('erenstra_re_satuan')->result());

			$this->db->select('id_satuan as id, nm_satuan text');
			$this->db->where('jns_satuan', 'outcome');
			$this->db->where('deleted','0');
			$data['satuanoutcome'] = json_encode($this->db->get('erenstra_re_satuan')->result());

			$this->load->view('template',$data);
		} else
		show_404();
	}


  public function edit_data_proses()
	{
		if($this->validasi())
		{
			date_default_timezone_set('Asia/Makassar');
			$data['date_modified'] = date("Y-m-d H:i:s");
			$data['modified_by']   = $this->session->userdata('userid');

			$data['id_rencana']		 = $this->input->post('id_rencana', TRUE);
			$data['id_paket']			 = $this->input->post('id_paket', TRUE);
			$data['sub_komponen']  = $this->input->post('sub_komponen', TRUE);
			$data['output_satuan'] = $this->input->post('output_satuan', TRUE);
			$data['output_target'] = $this->input->post('output_target', TRUE);
			$data['outcome_satuan'] = $this->input->post('outcome_satuan', TRUE);
			$data['outcome_target'] = $this->input->post('outcome_target', TRUE);
			$data['anggaran']				= $this->input->post('input_anggaran', TRUE);

			$this->Content_m->update_db('erenstra_tr_rencana_pelaksanaan', 'id_rencana', $data['id_rencana'], $data);
			
			echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Diubah"));
		}
  }
  

  public function hapus_data_proses()
	{
		$id_rencana = $this->input->post('id');
		date_default_timezone_set('Asia/Makassar');
		if($this->db->update('erenstra_tr_rencana_pelaksanaan', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_rencana"=>$id_rencana)))
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
    $this->form_validation->set_rules('sub_komponen', 'Sub Komponen', 'trim|required|min_length[3]');
    $this->form_validation->set_rules('output_target', 'Output Target', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('outcome_target', 'Outcome Target', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('anggaran', 'Jumlah Anggaran', 'trim|required|min_length[8]');

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
