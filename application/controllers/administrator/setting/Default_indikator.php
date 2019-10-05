<?php defined('BASEPATH') OR exit('No direct script access allowed');

 require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
  class Default_indikator extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();

      $this->load->helper(array('form', 'url'));

      $data['jenis_page']					= "administrator/";
      $data['controller_dir']			= 'setting/';
      $data['controller']					= 'default_indikator';
      $data['parent_controller']	= 'paket';
      $data['sub_menu']						= 'setting';
      $data['sub_menu_child']     = 'default_indikator';
      ini_set('max_execution_time', 0);
      ini_set('memory_limit', '-1');
      $this->load->vars($data);
    }

    public function index($id_kategori)
    {
      $data['active'] = $id_kategori;
      $this->load->vars($data);
      $data['kategori'] = $this->db->get_where('erenstra_tr_kategori', array('id_kategori'=>$id_kategori))->row();
      if($data['kategori'])
      {
        $data['judul']      = 'Default Indikator '.$data['kategori']->nm_kategori;
        $data['desc_judul']	= 'Pilih Default Indikator untuk '.$data['kategori']->nm_kategori;
        $data['page']		    = 'defaultindikator/list_indikator';

        $data['breadcumb'][] = array('icon'  => 'check-square',
                                   'link'  => '',
                                   'judul' => $data['kategori']->nm_kategori);

        $this->db->where('deleted','0');
        $value = $this->db->get_where('erenstra_re_indikator');
        if($value->num_rows() > 0) {
          $data['indikator'] = $value->result();
        } else {
          $data['indikator'] = '';
        }

        $this->db->where('deleted','0');
        $value_id_kategori = $this->db->get_where('erenstra_default_indikator',array('id_kategori'=>$data['kategori']->id_kategori));
        
        if($value_id_kategori->num_rows() > 0) {
          $query = $this->db->get_where('erenstra_default_indikator', array('id_kategori' => $id_kategori));
          if($query->num_rows() > 0) {
            $data['val_indikator'] = $query->result();
          } else {
            $data['val_indikator'] = '';
          }
        }

        $this->load->view('template', $data);
      } 
      else {
        show_404();
      }
    }


    public function proses_data($id_kategori) 
    {
      $this->db->where('deleted','0');
      $value_id_def_indikator = $this->db->get_where('erenstra_default_indikator', array('id_kategori' => $id_kategori));
      
      if(($value_id_def_indikator->num_rows() > 0)) {
        // jalankan proses update        
          extract($_POST);
          if(count($id_indikator) > 0) {
            $this->db->delete('erenstra_default_indikator', array("id_kategori" => $id_kategori));
            for ($i=0; $i < count($id_indikator); $i++) {
              $data['id_kategori']  = $id_kategori;
              $data['id_indikator'] = $id_indikator[$i];
  
              date_default_timezone_set('Asia/Makassar');
              $data['date_added'] = date("Y-m-d H:i:s");
              $data['added_by']   = $this->session->userdata('userid');
              $data['id_default_indikator']  = $this->db->query("select UUID() as id")->row()->id;
      
              $this->db->insert('erenstra_default_indikator', $data);  
            }
            //echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
            redirect(site_url('administrator/setting/default_indikator/index/'.$id_kategori));   
          } 
          else {
            $this->db->delete('erenstra_default_indikator', array("id_kategori" => $id_kategori));
            //echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
            redirect(site_url('administrator/setting/default_indikator/index/'.$id_kategori));   
          }        
          //redirect(site_url('administrator/data_renstra/indikator/index/'.$id_paket.'/'.$id_kegiatan));   
      } 
      else {
        // jalankan proses insert 
          extract($_POST);
          for ($i=0; $i < count($id_indikator); $i++) { 
            // echo $id_indikator[$i]."<br>";
            $data['id_kategori'] = $id_kategori;
            $data['id_indikator'] = $id_indikator[$i];
  
            date_default_timezone_set('Asia/Makassar');
            $data['date_added'] = date("Y-m-d H:i:s");
            $data['added_by']   = $this->session->userdata('userid');
            $data['id_default_indikator']  = $this->db->query("select UUID() as id")->row()->id;
    
            $this->db->insert('erenstra_default_indikator', $data);  
          }
          //echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Data Berhasil Ditambahkan"));
          redirect(site_url('administrator/setting/default_indikator/index/'.$id_kategori));
      }
    }


  }
/* End of file filename.php */