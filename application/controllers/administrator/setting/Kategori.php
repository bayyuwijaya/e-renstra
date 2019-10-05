<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Kategori extends Secure_area_adm 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_automatic');
		$this->load->model('M_general');
		$this->load->library('feeder');
		$this->load->library('feeder2');

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'setting/';
		$data['controller']					= 'kategori';
		$data['parent_controller']	= 'kategori';
		$data['sub_menu']          	= 'setting';
		$data['active']							= 'kategori';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
	}


	public function index()
	{
		$data['judul']  = 'Kategori';
		$data['page']		= 'kategori/list';
		$data['desc_judul']	= 'Menampilkan List Kategori';

		$data['breadcumb'][] = array('icon'  => 'list',
																 'link'  => '',
																 'judul' => $data['judul']);
		//$this->db->where('dari','e_library');
		$this->db->where('deleted','0');
		$data['query'] = $this->Content_m->select_db('erenstra_tr_kategori');
		$this->load->view('template',$data);
	}


	public function data_table()
	{
		$draw    = $_POST["draw"];
		$start   = $_POST["start"];
		$length  = $_POST['length'];
		$get_sms = $this->M_hakakses->get_role_akademik();
		
		$this->db->start_cache();
		
		$this->db->from('erenstra_tr_kategori d');
		$this->db->where('d.deleted','0');

		$this->db->stop_cache();
		$this->db->select('d.id_kategori');
		$recordsTotal=$this->db->count_all_results();
		$recordsFiltered=$recordsTotal;

		if($_GET['filter']=='true')
		{
			parse_str($_POST['form_filter'], $form_filter);
			$this->db->select('d.id_sdm');
			$this->db->start_cache();
			foreach ($form_filter as $kolom => $value) {
				if($value)
				{
					if($kolom=="nm_kategori")
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
		$this->db->select('d.id_kategori as id_kategori, d.nm_kategori as nm_kategori');
		$this->db->limit($length,$start);
		$data=$this->db->get()->result_array();
		$this->db->flush_cache();
		$i=1; 
		foreach ($data as $key => $row ) {
			$data[$key]['i'] = $i;
			
			$data[$key]['nm_kategori'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/setting/kategori/edit_kategori').'/'.$row['id_kategori'].'" style="text-decoration:underline;">'.$row['nm_kategori'].'</a>';

			$data[$key]['id_kategori'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/setting/kategori/edit_kategori').'/'.$row['id_kategori'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-toggle="tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$row['id_kategori'].'\',\''.$row['nm_kategori'].'\')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
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


	public function tambah_data($id_sdm=null)
	{
		if($id_sdm == null)
		{
			$data['id_sdm'] = $this->session->userdata('userid');
		}
		else
		{
			$data['id_sdm'] = $id_sdm;
		}

		$data['judul']			='Tambah Data Kategori';
		$data['desc_judul']	='Menambahkan Data Kategori Baru';
		$data['page']				='kategori/tambah_kategori';

		$data['breadcumb'][] = array('icon' => 'list',
																 'link' => site_url('administrator/setting/kategori/index'),
																 'judul'=> 'List Kategori');

		$data['breadcumb'][] = array('icon' => 'plus',
																 'link' => '',
																 'judul'=> $data['judul']);

		$this->load->view('template',$data);
	}

	public function tambah_data_proses()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key]=$value!='' ? $value : null;

			date_default_timezone_set('Asia/Makassar');

			$query = $this->Content_m->get_last_value('erenstra_tr_kategori','date_added','date_added');
			if($query != '')
			{ 
				$val_kategori = $query->id_kategori;
				$arr      = substr($val_kategori, 4, 10);
				$num      = $arr + 1;
				$dt_ktg   = 'ktg-'.$num;
			} else 
			{
				$dt_ktg   = 'ktg-1';
			}

			date_default_timezone_set('Asia/Makassar');
			$data['date_added'] = date("Y-m-d H:i:s");
			$data['added_by']   = $this->session->userdata('userid');
			//$data['id_sdm']			= $this->db->query("select UUID() as id")->row()->id;
			$data['id_kategori'] = $dt_ktg;
			$this->db->insert('erenstra_tr_kategori',$data);

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	public function edit_kategori($id_kategori)
	{
		$data['kategori'] = $this->db->get_where('erenstra_tr_kategori',array('id_kategori'=>$id_kategori))->row();
		if($data['kategori'])
		{
			$data['judul']			= 'Edit Data Kategori';
			$data['desc_judul']	= 'Mengubah Data Kategori';
			$data['page']				= 'kategori/edit_kategori';

			$data['breadcumb'][] = array('icon' => 'list',
																	 'link' => site_url('administrator/setting/kategori/index'),
																	 'judul'=> 'Tahun');

			$data['breadcumb'][] = array('icon' => 'edit',
																	 'link' => '',
																	 'judul'=> $data['judul']);
																	 
			$this->load->view('template',$data);
		} else
				show_404();
	}

	public function proses_edit_kategori($id_kategori)
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key] = $value != '' ? $value : null;
			
			date_default_timezone_set('Asia/Makassar');
			$data['date_modified'] = date("Y-m-d H:i:s");
			$data['modified_by']   = $this->session->userdata('userid');

			$this->db->update('erenstra_tr_kategori', $data, array("id_kategori" => $data['id_kategori']));

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}

	public function hapus_data_proses()
	{
		$id_kategori = $this->input->post('id');
		if($this->db->update('erenstra_tr_kategori', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_kategori"=>$id_kategori)))
		{
			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Dihapus"));
		}
		else
		{
			echo json_encode(array("status"=>"2","title"=>"Data gagal dihapus!","message"=>"Data Gagal Dihapus"));
		}
	}

	public function validasi()
	{
		// Form Tambah Kegiatan
		$this->form_validation->set_rules('nm_kategori', 'Nama Kategori', 'trim|required|min_length[2]');

		$this->form_validation->set_message('required', '{field} harus diisi!');
		$this->form_validation->set_message('min_length', '{field} harus minimal terdiri {param} karakter!');

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