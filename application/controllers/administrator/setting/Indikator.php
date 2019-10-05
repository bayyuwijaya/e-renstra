<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Indikator extends Secure_area_adm 
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
		$data['controller']					= 'indikator';
		$data['parent_controller']	= 'indikator';
		$data['sub_menu']          	= 'setting';
		$data['active']							= 'indikator';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
	}


	public function index()
	{
		$data['judul']  = 'Indikator';
		$data['page']		= 'indikator/list';
		$data['desc_judul']	= 'Menampilkan List Indikator';

		$data['breadcumb'][] = array('icon'  => 'list',
																 'link'  => '',
																 'judul' => $data['judul']);
		//$this->db->where('dari','e_library');
		$this->db->where('deleted','0');
		$data['query'] = $this->Content_m->select_db('erenstra_re_indikator');
		$this->load->view('template', $data);
	}


	public function data_table()
	{
		$draw    = $_POST["draw"];
		$start   = $_POST["start"];
		$length  = $_POST['length'];
		$get_sms = $this->M_hakakses->get_role_akademik();
		
		$this->db->start_cache();
		
		$this->db->from('erenstra_re_indikator d');
		$this->db->where('d.deleted','0');

		$this->db->stop_cache();
		$this->db->select('d.id_indikator');
		$recordsTotal = $this->db->count_all_results();
		$recordsFiltered = $recordsTotal;

		if($_GET['filter']=='true')
		{
			parse_str($_POST['form_filter'], $form_filter);
			$this->db->select('d.id_indikator');
			$this->db->start_cache();
			foreach ($form_filter as $kolom => $value) {
				if($value)
				{
					if($kolom=="nm_indikator")
						$this->db->like($kolom, $value);
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
		    $recordsFiltered = $this->db->count_all_results();
		}

		if(isset($_POST['order']))
		{
			foreach ($_POST['order'] as $key => $value) {
				$orderBy = $_POST['columns'][$value['column']]['data'];
				$orderType = $value['dir'];
				$this->db->order_by($orderBy, $orderType);
			}
		}
		$this->db->select('d.id_indikator as id_indikator, d.nm_indikator as nm_indikator');
		$this->db->limit($length,$start);
		$data=$this->db->get()->result_array();
		$this->db->flush_cache();
		$i=1; 
		foreach ($data as $key => $row ) {
			$data[$key]['i'] = $i;
			
			$data[$key]['nm_indikator'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/setting/indikator/edit_indikator').'/'.$row['id_indikator'].'" style="text-decoration:underline;">'.$row['nm_indikator'].'</a>';

			$data[$key]['id_indikator'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/setting/indikator/edit_indikator').'/'.$row['id_indikator'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-toggle="tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$row['id_indikator'].'\',\''.$row['nm_indikator'].'\')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
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

		$data['judul']			='Tambah Data Indikator';
		$data['desc_judul']	='Menambahkan Data Indikator Baru';
		$data['page']				='indikator/tambah_indikator';

		$data['breadcumb'][] = array('icon' => 'list',
																 'link' => site_url('administrator/setting/indikator/index'),
																 'judul'=> 'List Indikator');

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
				$data[$key] = $value != '' ? $value : null;

			date_default_timezone_set('Asia/Makassar');

			$query = $this->Content_m->get_last_value('erenstra_re_indikator','date_added','date_added');
			if($query != '')
			{ 
				$val_indikator = $query->id_indikator;
				$arr      = substr($val_indikator, 4, 10);
				$num      = $arr + 1;
				$dt_idt   = 'idt-'.$num;
			} else 
			{
				$dt_idt   = 'idt-1';
			}

			date_default_timezone_set('Asia/Makassar');
			$data['date_added'] = date("Y-m-d H:i:s");
			$data['added_by']   = $this->session->userdata('userid');
			//$data['id_sdm']			= $this->db->query("select UUID() as id")->row()->id;
			$data['id_indikator'] = $dt_idt;
			$this->db->insert('erenstra_re_indikator', $data);

			echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
		}
	}

	public function edit_indikator($id_indikator)
	{
		$data['indikator'] = $this->db->get_where('erenstra_re_indikator',array('id_indikator'=>$id_indikator))->row();
		if($data['indikator'])
		{
			$data['judul']			= 'Edit Data Indikator';
			$data['desc_judul']	= 'Mengubah Data Indikator';
			$data['page']				= 'indikator/edit_indikator';

			$data['breadcumb'][] = array('icon' => 'list',
																	 'link' => site_url('administrator/setting/indikator/index'),
																	 'judul'=> 'Indikator');

			$data['breadcumb'][] = array('icon' => 'edit',
																	 'link' => '',
																	 'judul'=> $data['judul']);
																	 
			$this->load->view('template',$data);
		} else
				show_404();
	}

	public function proses_edit_indikator($id_indikator)
	{
		if($this->validasi())
		{
			foreach ($_POST as $key => $value)
				$data[$key] = $value != '' ? $value : null;
			
			date_default_timezone_set('Asia/Makassar');
			$data['date_modified'] = date("Y-m-d H:i:s");
			$data['modified_by']   = $this->session->userdata('userid');

			$this->db->update('erenstra_re_indikator', $data, array("id_indikator" => $data['id_indikator']));

			echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Diubah"));
		}
	}

	public function hapus_data_proses()
	{
		$id_indikator = $this->input->post('id');
		if($this->db->update('erenstra_re_indikator', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_indikator"=>$id_indikator)))
		{
			echo json_encode(array("status"=>"1", "title"=>"Sukses !", "message"=>"Data Berhasil Dihapus"));
		}
		else
		{
			echo json_encode(array("status"=>"2", "title"=>"Data gagal dihapus !","message"=>"Data Gagal Dihapus"));
		}
	}

	public function validasi()
	{
		// Form Tambah Kegiatan
		$this->form_validation->set_rules('nm_indikator', 'Nama Indikator', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('bobot', 'Nilai Bobot', 'trim|required|numeric|min_length[3]');

		$this->form_validation->set_message('required', '{field} harus diisi!');
		$this->form_validation->set_message('min_length', '{field} harus minimal terdiri {param} karakter!');
		$this->form_validation->set_message('numeric', '{field} harus berupa katakter angka / numerik!');

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