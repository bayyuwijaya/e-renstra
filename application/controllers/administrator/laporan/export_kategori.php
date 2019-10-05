<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Export_kategori extends CI_Controller 
 {

    public function __construct()
    {
      parent::__construct();

      $this->load->helper(array('form','url'));

      $data['jenis_page']        = "administrator/";
      $data['controller_dir']    = 'laporan/';
      $data['controller']        = 'export_kategori';
      $data['parent_controller'] = 'export_kategori';
      $data['sub_menu']          = 'laporan';
      $data['active']            = 'export_kategori';
      ini_set('max_execution_time', 0);
      ini_set('memory_limit', '-1');
      $this->load->vars($data);
    }

    public function index()
    {
      $data['judul']      = 'Export Daftar Kategori';
      $data['desc_judul'] = 'Silahkan Export Data Kategori ke salah satu jenis berikut (xlsx / pdf / doc)';
      $data['page']       = 'export/kategori/list_kategori';

      $data['breadcumb'][] = array('icon' => 'dashboard',
                                   'link' => site_url('administrator/laporan/export'),
                                   'judul'=> 'Dashboard Export');

      $data['breadcumb'][] = array('icon'  => 'file-text',
                                   'link'  => '',
                                   'judul' => 'Export List Kategori'); 

      $this->db->where('deleted','0');
      $data['query'] = $this->Content_m->select_db('erenstra_tr_kategori');
      $this->load->view('template',$data);
    }

    public function data_table()
    {
      $draw = $_POST['draw'];
      $start = $_POST['start'];
      $length = $_POST['length'];

      $this->db->start_cache();

      $this->db->from('erenstra_tr_kategori d');
      $this->db->where('d.deleted','0');

      $this->db->stop_cache();
      $this->db->select('d.id_kategori');

    }    

 }
/* End of file filename.php */