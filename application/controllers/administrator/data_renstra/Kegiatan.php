<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Kegiatan extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url')); 

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'data_renstra/';
		$data['controller']					= 'kegiatan';
		$data['parent_controller']	= 'kegiatan';
		$data['sub_menu']						= 'kegiatan';
		$data['active']							= 'kegiatan';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
	}


	public function index($id_kategori=NULL)
	{
		$data['judul']  = 'Kegiatan';
		$data['page']		= 'kegiatan/list';
		$data['desc_judul']	= 'Menampilkan dan Mengelola Data Kegiatan';

		$data['breadcumb'][] = array('icon'  => 'book',
																 'link'  => '',
																 'judul' => 'List Kegiatan');
		//$this->db->where('dari','e_library');
		if($id_kategori != '') 
		{
			$col = $id_kategori;
			$data['id_kategori'] = $id_kategori;
			$this->db->where('deleted','0');
			$data['query'] = $this->Content_m->select_db('erenstra_tr_kegiatan','id_kategori',$col);
		} else
		{
			$this->db->where('deleted','0');
			$data['query'] = $this->Content_m->select_db('erenstra_tr_kegiatan');
		}
		$this->load->view('template',$data);
	}


	public function data_table()
	{
		$draw    = $_POST["draw"];
		$start   = $_POST["start"];
		$length  = $_POST['length'];
		$get_sms = $this->M_hakakses->get_role_akademik();
		
		$this->db->start_cache();
		
		$this->db->from('erenstra_tr_kegiatan d');
		$this->db->join('erenstra_tr_kategori a', 'id_kategori','left');
		$this->db->where('d.deleted','0');

		$this->db->stop_cache();
		$this->db->select('d.id_kegiatan');
		$recordsTotal=$this->db->count_all_results();
		$recordsFiltered=$recordsTotal;

		if($_GET['filter']=='true')
		{
			parse_str($_POST['form_filter'], $form_filter);
			$this->db->select('d.id_kegiatan');
			$this->db->start_cache();
			foreach ($form_filter as $kolom => $value) {
				if($value)
				{
					if($kolom=="nm_kegiatan")
						$this->db->like($kolom,$value);
					else
					{
						if($kolom=='id_stat_pegawai')
							$this->db->where_in("d.id_stat_pegawai", $value);
						else
							$this->db->where_in($kolom, $value);
					}
				}
			}
		    $this->db->stop_cache();
		    $recordsFiltered=$this->db->count_all_results();
		}

		if(isset($_POST['order']))
		{
			foreach ($_POST['order'] as $key => $value) {
				$orderBy = $_POST['columns'][$value['column']]['data'];
				$orderType = $value['dir'];
				$this->db->order_by($orderBy, $orderType);
			}
		}
		$this->db->select('d.id_kegiatan as id_kegiatan, d.nm_kegiatan as nm_kegiatan');
		$this->db->limit($length,$start);
		$data=$this->db->get()->result_array();
		$this->db->flush_cache();
		$i=1; 
		foreach ($data as $key => $row ) {
			$data[$key]['i'] = $i;
			
			$data[$key]['nm_kegiatan'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/data_renstra/kegiatan/edit_kegiatan').'/'.$row['id_kegiatan'].'" style="text-decoration:underline;">'.$row['nm_kegiatan'].'</a>';

			$data[$key]['id_kegiatan'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/data_renstra/kegiatan/edit_kegiatan').'/'.$row['id_kegiatan'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-toggle="tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$row['id_kegiatan'].'\',\''.$row['nm_kegiatan'].'\')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
			$i++;
	  }
		
		$response = array(
		    "draw" => intval($draw),
		    "recordsTotal" => $recordsTotal,
		    "recordsFiltered" => $recordsFiltered,
		    "data" => $data
		);
		echo json_encode($response);
	}


	public function tambah_data($id_kategori=null, $id_sdm=null)
	{
		if($id_sdm == null)
		{
			$data['id_sdm'] = $this->session->userdata('userid');
		}
		else
		{
			$data['id_sdm'] = $id_sdm;
		}

		$data['judul']			='Tambah Data Kegiatan';
		$data['desc_judul']	='Menambahkan Data Kegiatan Baru';
		$data['page']				='kegiatan/tambah_kegiatan';

		$data['breadcumb'][] = array('icon' => 'book',
																 'link' => site_url('administrator/data_renstra/kegiatan/index/'.$id_kategori),
																 'judul'=> 'List Kegiatan');

		$data['breadcumb'][] = array('icon' => 'plus',
																 'link' => '',
																 'judul'=> $data['judul']);
		
		if(isset($id_kategori)) {
			$data['idkategori'] = $id_kategori;

			$this->db->select('id_kategori as id, nm_kategori text');
			$this->db->where('deleted','0');
			$data['kategori'] = json_encode($this->db->get('erenstra_tr_kategori')->result());

			$this->db->select('id_nmkegiatan as id, nm_kegiatan text');
			$this->db->where('id_kategori', $id_kategori);
			$this->db->where('deleted','0');
			$data['nmkegiatan'] = json_encode($this->db->get('erenstra_re_nmkegiatan')->result());
		} 
		else {
			$this->db->select('id_kategori as id, nm_kategori text');
			$this->db->where('deleted','0');
			$data['kategori'] = $this->db->get('erenstra_tr_kategori');

			$this->db->select('id_nmkegiatan as id, nm_kegiatan text');
			$this->db->where('deleted','0');
			$data['nmkegiatan'] = json_encode($this->db->get('erenstra_re_nmkegiatan')->result());
		}

		$this->load->view('template',$data);
	}


	public function get_option_nmkegiatan()
	{
		$id_kategori = $this->input->post('id_kategori');

		$this->db->select('id_nmkegiatan as id, nm_kegiatan as text');
		$this->db->where_in('id_kategori', $id_kategori);
		$this->db->where('deleted','0');
		echo json_encode($this->db->get('erenstra_re_nmkegiatan')->result());
	}


	public function tambah_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key] = $value != '' ? $value : null;

			date_default_timezone_set('Asia/Makassar');
			$data['date_added']	 = date("Y-m-d H:i:s");
			$data['added_by']		 = $this->session->userdata('userid');
			$data['id_kegiatan'] = $this->db->query("select UUID() as id")->row()->id;

			$this->db->insert('erenstra_tr_kegiatan', $data);
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	
	public function edit_kegiatan($id, $id_kategori=null)
	{
		$data['kegiatan'] = $this->db->get_where('erenstra_tr_kegiatan',array('id_kegiatan'=>$id))->row();
		if($data['kegiatan'])
		{
			$data['judul']			= 'Edit Data Kegiatan';
			$data['desc_judul']	= 'Mengubah Data Kegiatan';
			$data['page']				= 'kegiatan/edit_kegiatan';

			$data['breadcumb'][] = array('icon' => 'book',
																   'link' => site_url('administrator/data_renstra/kegiatan/index/'.$id_kategori),
																   'judul'=> 'Kegiatan');

			$data['breadcumb'][] = array('icon' => 'edit',
																   'link' => '',
																	 'judul'=> $data['judul']);


			$this->db->select('id_kategori as id, nm_kategori text');
			$this->db->where('deleted','0');
			$data['kategori'] = json_encode($this->db->get('erenstra_tr_kategori')->result());

			$this->db->select('id_nmkegiatan as id, nm_kegiatan text');
			$this->db->where('id_kategori', $data['kegiatan']->id_kategori);
			$this->db->where('deleted','0');
			$data['nmkegiatan'] = json_encode($this->db->get('erenstra_re_nmkegiatan')->result());
																	 
			$this->load->view('template',$data);
		} else
	    	show_404();
	}


	public function proses_edit_kegiatan($id_kegiatan)
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key] = $value != '' ? $value : null;
			
			date_default_timezone_set('Asia/Makassar');
			$data['date_modified'] = date("Y-m-d H:i:s");
			$data['modified_by']   = $this->session->userdata('userid');

			$this->db->update('erenstra_tr_kegiatan', $data, array("id_kegiatan" => $data['id_kegiatan']));

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}


	public function hapus_data_proses()
	{
		$id_kegiatan = $this->input->post('id');
		date_default_timezone_set('Asia/Makassar');
		if($this->db->update('erenstra_tr_kegiatan', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_kegiatan"=>$id_kegiatan)))
		{
			echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Dihapus"));
		}
		else
		{
			echo json_encode(array("status"=>"2", "title"=>"Data gagal dihapus!", "message"=>"Data Gagal Dihapus"));
		}
	}

	// public function hapus_data_proses()
	// {
	// 	$id_kegiatan = $this->input->post('id');
	// 	date_default_timezone_set('Asia/Makassar');
	// 	if($this->db->update('erenstra_tr_kegiatan', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_kegiatan"=>$id_kegiatan)))
	// 	{
	// 		$this->db->from('erenstra_tr_kegiatan keg, erenstra_tr_paket pkt, erenstra_tr_lokasi lok, erenstra_tr_indikator ind, erenstra_tr_rencana_pelaksanaan ren, erenstra_tr_file_support file');
	// 		$this->db->update('keg', array("keg.deleted"=>"1", "keg.date_modified"=>date("Y-m-d H:i:s")), array("keg.id_kegiatan"=>$id_kegiatan);
	// 		$this->db->join('pkt', 'pkt.id_kegiatan = keg.id_kegiatan', 'inner');
	// 		$this->db->update('pkt', array("pkt.deleted"=>"1", "pkt.date_modified"=>date("Y-m-d H:i:s")), array("pkt.id_kegiatan"=>$id_kegiatan);
	// 		$this->db->join('lok', 'lok.id_paket = pkt.id_paket', 'inner');
	// 		$this->db->update('lok', array("lok.deleted"=>"1", "lok.date_modified"=>date("Y-m-d H:i:s")), array("lok.id_paket"=>'pkt.id_paket');
	// 		$this->db->join('ind', 'ind.id_paket = pkt.id_paket', 'inner');
	// 		$this->db->update('ind', array("ind.deleted"=>"1", "ind.date_modified"=>date("Y-m-d H:i:s")), array("ind.id_paket"=>'pkt.id_paket');
	// 		$this->db->join('ind', 'ind.id_paket = pkt.id_paket', 'inner');
	// 		$this->db->update('ind', array("ind.deleted"=>"1", "ind.date_modified"=>date("Y-m-d H:i:s")), array("ind.id_paket"=>'pkt.id_paket');
	// 		$query = $this->db->get();

	// 		echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Dihapus"));
	// 	}
	// 	else
	// 	{
	// 		echo json_encode(array("status"=>"2", "title"=>"Data gagal dihapus!", "message"=>"Data Gagal Dihapus"));
	// 	}
	// }


	public function validasi()
	{
		// Form Tambah Kegiatan
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required|min_length[4]|max_length[40]');

		$this->form_validation->set_message('required', '{field} harus diisi!');
		$this->form_validation->set_message('numeric', '{field} harus berupa angka!');
		$this->form_validation->set_message('max_length', '{field} tidak boleh lebih dari {param} karakter!');
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
