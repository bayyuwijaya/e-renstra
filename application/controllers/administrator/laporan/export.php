<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
  class Export extends CI_Controller
  {

    public function __construct()
    {
      parent::__construct();

      $this->load->helper(array('form','url'));

      $data['jenis_page']        = "administrator/";
      $data['controller_dir']    = 'laporan/';
      $data['controller']        = 'export';
      $data['parent_controller'] = 'export';
      $data['sub_menu']          = 'laporan';
      $data['active']            = 'export';
      ini_set('max_execution_time', 0);
      ini_set('memory_limit', '-1'); 
      $this->load->vars($data);
    }

    public function index()
    {
      $data['judul']      = 'Export';
      $data['desc_judul'] = 'Tingkatan Data yang di Export';
      $data['page']       = 'export/dashboard';

      $data['breadcumb'][] = array('icon' => 'dashboard',
                                   'link' => '',
                                   'judul'=> 'Dashboard Export');
                                   
      $this->load->view('template', $data);                              
    }
  }

/* End of file filename.php */