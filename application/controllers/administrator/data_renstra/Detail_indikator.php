<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Detail_indikator extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url')); 

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'data_renstra/';
		$data['controller']					= 'detail_indikator';
		$data['parent_controller']	= 'detail_indikator';
		$data['sub_menu']						= 'kegiatan';
		$data['active']							= 'kegiatan';
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->load->vars($data);
	}


	public function index()
	{
    $data['judul']      = 'List Indikator';
    $data['desc_judul']	= 'Daftar Data Indikator';
    $data['page']		    = 'subpaket/template_detail_table';
    $data['page_tab']		= 'subpaket/detail_indikator/list';

    $data['breadcumb'][]=array('icon'=>'edit',
                                'link'=>'',
                                'judul'=>$data['judul']);
    
    $this->db->where('deleted','0');
    //$data['query'] = $this->db->get_where('erenstra_tr_sub_paket',array('kode_paket'=>$data['paket']->kode));
    $value = $this->db->get_where('erenstra_re_indikator', array('id_indikator' => $id_paket));
    
    if($value->num_rows() > 0) {
      $data['indikator'] = $value->result();
    } else {
      $data['indikator'] = 'Belum Ada Data Variabel Indikator';
    }

    $this->load->view('template',$data);
  }


	public function tambah_data($id)
	{
    $data['judul']      = 'Tambah Data Indikator';
    $data['desc_judul'] = 'Menambah Data Variabel Indikator ';
    $data['page']       = 'subpaket/template_detail_table';
    $data['page_tab']   = 'subpaket/detail_indikator/tambah_data';
                              
    $data['breadcumb'][]=array('icon'=>'book',
                              'link'=>site_url('administrator/data_renstra/paket/index').'/'.$data['kegiatan']->id_kegiatan,
                              'judul'=>'Data Paket');

    $data['breadcumb'][]=array('icon'=>'plus',
                              'link'=>'',
                              'judul'=>$data['judul']);

    $this->load->view('template',$data);
	}

  public function validasi()
	{
		// Form Tambah Paket
		$this->form_validation->set_rules('latitude', 'Koordinat Garis Lintang', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('longitude', 'Koordinat Garis Bujur', 'trim|required|min_length[5]');

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
