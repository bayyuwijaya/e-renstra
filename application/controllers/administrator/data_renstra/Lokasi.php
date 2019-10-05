<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Lokasi extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url')); 

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'data_renstra/';
		$data['controller']					= 'lokasi';
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
      $data['judul']      = 'Edit Data Lokasi';
      $data['desc_judul']	= 'Mengubah Data Lokasi';
      $data['page']		    = 'subpaket/template_detail';
      $data['page_tab']		= 'subpaket/edit_data_lokasi';

      $data['breadcumb'][] = array('icon' => 'book',
                                  'link' => site_url('administrator/data_renstra/kegiatan/index'),
                                  'judul'=> 'Data Kegiatan');

      $data['breadcumb'][]=array('icon'=>'book',
                                  'link'=>site_url('administrator/data_renstra/paket/index').'/'.$data['kegiatan']->id_kegiatan,
                                  'judul'=>'Data Paket');

      $data['breadcumb'][]=array('icon'=>'edit',
                                  'link'=>'',
                                  'judul'=>$data['judul']);
      
      $this->db->where('deleted','0');
      //$data['query'] = $this->db->get_where('erenstra_tr_sub_paket',array('kode_paket'=>$data['paket']->kode));
      $value = $this->db->get_where('erenstra_tr_lokasi', array('id_paket' => $id_paket));
			$data['re_nmkegiatan'] = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $data['kegiatan']->id_nmkegiatan))->row();

      $this->db->where('deleted','0');
      $data['re_nmkategori'] = $this->db->get_where('erenstra_tr_kategori', array('id_kategori' => $data['re_nmkegiatan']->id_kategori))->row();

      if($value->num_rows() > 0) {
        $data['latitude']  = $value->row()->latitude;
        $data['longitude'] = $value->row()->longitude;
        $data['kab_kota']  = $value->row()->kab_kota;
        $data['kecamatan'] = $value->row()->kecamatan;
        $data['desa']      = $value->row()->desa;
      } else {
        $data['latitude'] = '';
        $data['longitude'] = '';
        $data['kab_kota'] = '';
        $data['kecamatan'] = '';
        $data['desa']      = '';
      }
      $this->load->view('template',$data);
  
		} else
		show_404();
  }


  public function proses_data($id_paket, $id_kegiatan) 
  {
    $this->db->where('deleted','0');
    $value = $this->db->get_where('erenstra_tr_lokasi', array('id_paket' => $id_paket));
    
    if($value->num_rows() > 0) {
      // jalankan proses update
      if($this->validasi())
      {
        foreach ($_POST as $key => $value)
          $data[$key] = $value != '' ? $value : null;
        
        date_default_timezone_set('Asia/Makassar');
        $data['date_modified'] = date("Y-m-d H:i:s");
        $data['modified_by']   = $this->session->userdata('userid');
  
        $this->db->update('erenstra_tr_lokasi', $data, array("id_paket" => $id_paket));
  
        echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Diubah"));
        //redirect(site_url('administrator/data_renstra/lokasi/index/'.$id_paket.'/'.$id_kegiatan));
      }
    } 
    else {
      // jalankan proses insert
      if($this->validasi())
      {
        foreach ($_POST as $key => $value)
          $data[$key]=$value!='' ? $value : null;
  
        date_default_timezone_set('Asia/Makassar');
        $data['date_added'] = date("Y-m-d H:i:s");
        $data['added_by']   = $this->session->userdata('userid');
        $data['id_lokasi']  = $this->db->query("select UUID() as id")->row()->id;
        $data['id_paket']   = $id_paket;

        $this->db->insert('erenstra_tr_lokasi', $data);

        echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
        //redirect(site_url('administrator/data_renstra/lokasi/index/'.$id_paket.'/'.$id_kegiatan));
      }
    }
  }

  public function validasi()
	{
		// Form Tambah Paket
		$this->form_validation->set_rules('latitude', 'Koordinat Garis Lintang', 'trim|required|min_length[5]');
    $this->form_validation->set_rules('longitude', 'Koordinat Garis Bujur', 'trim|required|min_length[5]');
    $this->form_validation->set_rules('kab_kota', 'Kabupaten atau Kota', 'trim|required|min_length[5]');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|min_length[5]');
    $this->form_validation->set_rules('desa', 'Desa', 'trim|required|min_length[5]');

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
