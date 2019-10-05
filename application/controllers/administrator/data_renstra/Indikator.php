<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Indikator extends Secure_area_adm {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url')); 

		$data['jenis_page']					= "administrator/";
		$data['controller_dir']			= 'data_renstra/';
		$data['controller']					= 'indikator';
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
      $data['judul']      = 'Pilih Indikator';
      $data['desc_judul']	= 'Pilihlah Data Indikator';
      $data['page']		    = 'subpaket/template_detail';
      $data['page_tab']		= 'subpaket/list_data_indikator';

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
      $value = $this->db->get_where('erenstra_re_indikator', array('deleted'=>0));
      if($value->num_rows() > 0) {
        $data['indikator'] = $value->result();
      } else {
        $data['indikator'] = '';
      }

      $this->db->where('deleted','0');
			$data['re_nmkegiatan'] = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $data['kegiatan']->id_nmkegiatan))->row();

      $this->db->where('deleted','0');
      $data['re_nmkategori'] = $this->db->get_where('erenstra_tr_kategori', array('id_kategori' => $data['re_nmkegiatan']->id_kategori))->row();

      // $query2 = $this->db->get_where('erenstra_default_indikator', array('id_kategori' => $data['kegiatan']->id_kategori));
      // if($query2->num_rows() > 0) {
      //   $data['val_indikator2'] = $query2->result();
      // } else {
      //   $data['val_indikator2'] = '';
      // }

      // $obj_kat = $this->db->get_where('erenstra_re_indikator', array('id_indikator' => $data['kegiatan']->id_indikator))->row();
      // $data['nm_kategori'] = $obj_kat->nm_kategori;

      $this->db->where('deleted','0');
      $value_id_paket = $this->db->get_where('erenstra_tr_indikator', array('id_paket' => $id_paket));
      $value_id_kegiatan = $this->db->get_where('erenstra_tr_indikator',array('id_kegiatan'=>$id_kegiatan));
      
      if(($value_id_paket->num_rows() > 0) && ($value_id_kegiatan->num_rows() > 0)) {
        $query = $this->db->get_where('erenstra_tr_indikator', array('id_paket' => $id_paket));
        if($query->num_rows() > 0) {
          $data['val_indikator'] = $query->result();
        } else {
          $data['val_indikator'] = '';
        }
      } 
      else {
        $query2 = $this->db->get_where('erenstra_default_indikator', array('id_kategori' => $data['kegiatan']->id_kategori));
        if($query2->num_rows() > 0) {
          $data['val_indikator2'] = $query2->result();
        } else {
          $data['val_indikator2'] = '';
        }
      }

      $this->load->view('template', $data);
  
		} else
		show_404();
  }

  // public function asd($id_paket, $id_kegiatan){
  //   extract($_POST);
  //   //echo $id_paket, $id_kegiatan;

  //   //echo count($id_indikator);
  //   for ($i=0; $i < count($id_indikator) ; $i++) { 
  //       echo $id_indikator[$i]."<br>";
  //       $data['id_paket'] = $id_paket;
  //       $data['id_kegiatan'] = $id_kegiatan;
  //       $data['id_indikator'] = $id_indikator[$i];
  //       $data['id_tr_indikator']  = $this->db->query("select UUID() as id")->row()->id;

  //       $this->db->insert('erenstra_tr_indikator', $data);  
  //   }
  // }

  public function proses_data($id_paket, $id_kegiatan) 
  {
    $this->db->where('deleted','0');
    $value_id_paket = $this->db->get_where('erenstra_tr_indikator', array('id_paket' => $id_paket));
    //$value_id_kegiatan = $this->db->get_where('erenstra_tr_indikator',array('id_kegiatan'=>$id_kegiatan));
    extract($_POST);
    if(($value_id_paket->num_rows() > 0)) {
      // jalankan proses update
        if(isset($id_indikator)) {               
          $this->db->delete('erenstra_tr_indikator', array("id_paket" => $id_paket, "id_kegiatan" => $id_kegiatan));
          for ($i=0; $i < count($id_indikator); $i++) {
            $data['id_paket']     = $id_paket;
            $data['id_kegiatan']  = $id_kegiatan;
            $data['id_indikator'] = $id_indikator[$i];

            date_default_timezone_set('Asia/Makassar');
            $data['date_added'] = date("Y-m-d H:i:s");
            $data['added_by']   = $this->session->userdata('userid');
            $data['id_tr_indikator']  = $this->db->query("select UUID() as id")->row()->id;
    
            $this->db->insert('erenstra_tr_indikator', $data);  
          }
          //echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
          redirect(site_url('administrator/data_renstra/indikator/index/'.$id_paket.'/'.$id_kegiatan));   
        } 
        else {
          $this->db->delete('erenstra_tr_indikator', array("id_paket" => $id_paket, "id_kegiatan" => $id_kegiatan));
          //echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
          redirect(site_url('administrator/data_renstra/indikator/index/'.$id_paket.'/'.$id_kegiatan));   
        }        
        //redirect(site_url('administrator/data_renstra/indikator/index/'.$id_paket.'/'.$id_kegiatan));   
    } 
    else {
      // jalankan proses insert
        if(isset($id_indikator)) { 
          for ($i=0; $i < count($id_indikator); $i++) { 
            // echo $id_indikator[$i]."<br>";
            $data['id_paket'] = $id_paket;
            $data['id_kegiatan'] = $id_kegiatan;
            $data['id_indikator'] = $id_indikator[$i];

            date_default_timezone_set('Asia/Makassar');
            $data['date_added'] = date("Y-m-d H:i:s");
            $data['added_by']   = $this->session->userdata('userid');
            $data['id_tr_indikator']  = $this->db->query("select UUID() as id")->row()->id;
    
            $this->db->insert('erenstra_tr_indikator', $data);  
          }
          //echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
          redirect(site_url('administrator/data_renstra/indikator/index/'.$id_paket.'/'.$id_kegiatan));
        } 
        else {
          //echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
          redirect(site_url('administrator/data_renstra/indikator/index/'.$id_paket.'/'.$id_kegiatan));   
        }     
    }
  }

  public function validasi()
	{
		// Form Tambah Paket
		// $this->form_validation->set_rules('id_indikator', 'Indikator', 'trim|required|min_length[5]');

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
