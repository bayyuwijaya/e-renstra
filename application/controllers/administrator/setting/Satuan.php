<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Satuan extends Secure_area_adm 
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
		$data['controller']					= 'satuan';
		$data['parent_controller']	= 'satuan';
		$data['sub_menu']          	= 'setting';
		$data['active']							= 'satuan';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
	}


	public function index()
	{
		$data['judul']  = 'Satuan';
		$data['page']		= 'satuan/list';
		$data['desc_judul']	= 'Menampilkan List Satuan';

		$data['breadcumb'][] = array('icon'  => 'list',
																 'link'  => '',
																 'judul' => $data['judul']);
		//$this->db->where('dari','e_library');
		$this->db->where('deleted','0');
		$data['query'] = $this->Content_m->select_db('erenstra_re_satuan');
		$this->load->view('template',$data);
	}


	public function data_table()
	{
		$draw    = $_POST["draw"];
		$start   = $_POST["start"];
		$length  = $_POST['length'];
		$get_sms = $this->M_hakakses->get_role_akademik();
		
		$this->db->start_cache();
		
		$this->db->from('erenstra_re_satuan d');
		$this->db->where('d.deleted','0');

		$this->db->stop_cache();
		$this->db->select('d.id_satuan');
		$recordsTotal = $this->db->count_all_results();
		$recordsFiltered = $recordsTotal;

		if($_GET['filter'] == 'true')
		{
			parse_str($_POST['form_filter'], $form_filter);
			$this->db->select('d.id_satuan');
			$this->db->start_cache();
			foreach ($form_filter as $kolom => $value) {
				if($value)
				{
					if($kolom == "nm_satuan")
						$this->db->like($kolom, $value);
					else
					{
						if($kolom == 'id_stat_pegawai')
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
		$this->db->select('d.id_satuan as id_satuan, d.nm_satuan as nm_satuan');
		$this->db->limit($length, $start);
		$data = $this->db->get()->result_array();
		$this->db->flush_cache();
		$i=1; 
		foreach ($data as $key => $row ) {
			$data[$key]['i'] = $i;
			
			$data[$key]['nm_satuan'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/setting/satuan/edit_satuan').'/'.$row['id_satuan'].'" style="text-decoration:underline;">'.$row['nm_satuan'].'</a>';

			$data[$key]['id_satuan'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/setting/satuan/edit_satuan').'/'.$row['id_satuan'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-toggle="tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$row['id_satuan'].'\',\''.$row['nm_satuan'].'\')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
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

		$data['judul']			='Tambah Data Satuan';
		$data['desc_judul']	='Menambahkan Data Satuan Baru';
		$data['page']				='satuan/tambah_satuan';

		$data['breadcumb'][] = array('icon' => 'list',
																 'link' => site_url('administrator/setting/satuan/index'),
																 'judul'=> 'List Satuan');

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

			$query = $this->Content_m->get_last_value('erenstra_re_satuan','date_added','date_added');
			if($query != '')
			{ 
				$val_satuan = $query->id_satuan;
				$arr      = substr($val_satuan, 4, 10);
				$num      = $arr + 1;
				$dt_sat   = 'sat-'.$num;
			} else 
			{
				$dt_sat   = 'sat-1';
			}

			date_default_timezone_set('Asia/Makassar');
			$data['date_added'] = date("Y-m-d H:i:s");
			$data['added_by']   = $this->session->userdata('userid');
			//$data['id_sdm']			= $this->db->query("select UUID() as id")->row()->id;
			$data['id_satuan'] = $dt_sat;
			$this->db->insert('erenstra_re_satuan',$data);

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	public function edit_satuan($id_satuan)
	{
		$data['satuan'] = $this->db->get_where('erenstra_re_satuan', array('id_satuan'=>$id_satuan))->row();
		if($data['satuan'])
		{
			$data['judul']			= 'Edit Data Satuan';
			$data['desc_judul']	= 'Mengubah Data Satuan';
			$data['page']				= 'satuan/edit_satuan';

			$data['breadcumb'][] = array('icon' => 'list',
																	 'link' => site_url('administrator/setting/nmkegiatan/index'),
																	 'judul'=> 'List Satuan');

			$data['breadcumb'][] = array('icon' => 'edit',
																	 'link' => '',
																	 'judul'=> $data['judul']);
																	 
			$this->load->view('template',$data);
		} else
				show_404();
	}

	public function proses_edit_satuan()
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key] = $value != '' ? $value : null;
			
			date_default_timezone_set('Asia/Makassar');
			$data['date_modified'] = date("Y-m-d H:i:s");
			$data['modified_by']   = $this->session->userdata('userid');

			$this->db->update('erenstra_re_satuan', $data, array("id_satuan" => $data['id_satuan']));

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
		}
	}

	public function hapus_data_proses()
	{
		$id_satuan = $this->input->post('id');
		if($this->db->update('erenstra_re_satuan', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_satuan"=>$id_satuan)))
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
    $this->form_validation->set_rules('nm_satuan', 'Nama Satuan', 'trim|required|min_length[2]');
    $this->form_validation->set_rules('jns_satuan', 'Jenis Satuan', 'trim|required|min_length[2]');

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