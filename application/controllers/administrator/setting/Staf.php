<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Staf extends Secure_area_adm 
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_automatic');
      $this->load->model('M_general');
      $this->load->library('feeder');
      $this->load->library('feeder2');

      $data['jenis_page']        = "administrator/";
      $data['controller_dir']    = 'setting/';
      $data['controller']        = 'staf';
      $data['parent_controller'] = 'staf';
      $data['sub_menu']          = 'setting';
      $data['active']            = 'staf';
      ini_set('max_execution_time', 0);
      ini_set('memory_limit', '-1');
      $this->load->vars($data);
    }


    public function index()
    {
      $data['judul']      = 'Staf';
      $data['page']       = 'staf/list';
      $data['desc_judul'] = 'Menampilkan List Staf E-Renstra';

      $data['breadcumb'][] = array('icon'  => 'list',
                                   'link'  => '',
                                   'judul' => $data['judul']);
      $this->db->where('deleted','0');
      $data['query'] = $this->Content_m->select_db('global_employee');
      $this->load->view('template',$data);
    }

    // public function data_table()
    // {
    //   $draw    = $_POST["draw"];
    //   $start   = $_POST["start"];
    //   $length  = $_POST['length'];
    //   $get_sms = $this->m_hakakses->get_role_akademik();

    //   $this->db->start_cache();

    //   $this->db->from('erenstra_tr_tahun d');
    //   $this->db->where('d.deleted','0');

    //   $this->db->stop_cache();
    //   $this->db->select('d.id_tahun');
    //   $recordsTotal = $this->db->count_all_results();
    //   $recordsFiltered = $recordsTotal;

    //   if($_GET['filter']=='true')
    //   {
    //     parse_str($_POST['form_filter'], $form_filter);
    //     $this->db->select('d.id_tahun');
    //     $this->db->start_cache();
    //     foreach($form_filter as $kolom => $value) {
    //       if($value)
    //       {
    //         if($kolom == "nm_tahun")
    //           $this->db->like($kolom,$value);
    //         else
    //         {
    //           if($kolom == 'id_stat_pegawai')
    //             $this->db->where_in("d.id_stat_pegawai", $value);
    //           else
    //             $this->db->where_in($Kolom, $value);
    //         }
    //       }
    //     }
    //     $this->db->stop_cache();
    //     $recordsFiltered = $this->db->count_all_results();
    //   }

    //   if(isset($_POST['order']))
    //   {
    //     foreach ($_POST['order'] as $key => $value) {
    //       $orderBy = $_POST['columns'][$value['column']]['data'];
    //       $orderType = $value['dir'];
    //       $this->db->order_by($orderBy, $orderType);
    //     }
    //   }
    //   $this->db->select('d.id_tahun as id_tahun, d.nm_tahun as nm_tahun');
    //   $this->db->limit($length,$start);
    //   $data=$this->db->get()->result_array();
    //   $this->db->flush_cache();
    //   $i=1; foreach ($data as $key => $row ) {
    //     $data[$key]['i'] = $i;
        
    //     $data[$key]['nm_tahun'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/tahun/edit_tahun').'/'.$row['id_tahun'].'" style="text-decoration:underline;">'.$row['nm_tahun'].'</a>';
  
    //     $data[$key]['id_tahun'] = '<a data-toggle="tooltip" data-placement="top" title="Ubah" href="'.site_url('administrator/tahun/edit_tahun').'/'.$row['id_tahun'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-toggle="tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$row['id_tahun'].'\',\''.$row['nm_tahun'].'\')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
    //   $i++;
    //   }

    //   $response = array(
    //       "draw" => intval($draw),
    //       "recordsTotal" => $recordsTotal,
    //       "recordsFiltered" => $recordsFiltered,
    //       "data" => $data
    //   );
    //   echo json_encode($response);
    // }

    public function tambah_data($id_sdm = null)
    {
      if($id_sdm == null)
      {
        $data['id_sdm'] = $this->session->userdata('userid');
      }
      else
      {
        $data['id_sdm'] = $id_sdm;
      }
  
      $data['judul']			='Tambah Data Staf';
      $data['desc_judul']	='Menambahkan Data Staf E-Renstra';
      $data['page']				='staf/tambah_staf';
  
      $data['breadcumb'][] = array('icon' => 'user-secret',
                                   'link' => site_url('administrator/setting/staf/index'),
                                   'judul'=> 'List Staf');
  
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
        $data['date_added'] = date("Y-m-d H:i:s");
        $data['added_by'] = $this->session->userdata('userid');
        $data['id_sdm'] = $this->db->query("select UUID() as id")->row()->id;
        $this->db->insert('global_employee',$data);

        echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Ditambahkan"));
      }
    }


    public function edit_staf($id_sdm)
    {
      $data['sdm'] = $this->db->get_where('global_employee',array('id_sdm'=>$id_sdm))->row();
      if($data['sdm'])
      {
        $data['judul']			= 'Edit Data Staf';
        $data['desc_judul']	= 'Mengubah Data Staf E-Renstra';
        $data['page']				= 'staf/edit_staf';
  
        $data['breadcumb'][] = array('icon' => 'user-secret',
                                     'link' => site_url('administrator/setting/staf/index'),
                                     'judul'=> 'Staf');
  
        $data['breadcumb'][] = array('icon' => 'edit',
                                     'link' => '',
                                     'judul'=> $data['judul']);
                                     
        $this->load->view('template',$data);
      } else
          show_404();
    }


    public function proses_edit_staf($id_sdm)
    {
      if($this->validasi())
      {
        foreach ($_POST as $key => $value)
          $data[$key] = $value != '' ? $value : null;
        
        $this->db->update('global_employee', $data, array("id_sdm" => $data['id_sdm']));
  
        echo json_encode(array("status"=>"1","title"=>"Sukses!","message"=>"Data Berhasil Diubah"));
      }
    }


    public function hapus_data_proses()
    {
      $id_sdm = $this->input->post('id');
      if($this->db->update('global_employee', array("deleted"=>"1", "date_modified"=>date("Y-m-d H:i:s")), array("id_sdm"=>$id_sdm)))
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
      $this->form_validation->set_rules('nidn', 'Nomor Induk Pegawai', 'trim|required|min_length[4]');
      $this->form_validation->set_rules('nm_sdm', 'Nama Staf', 'trim|required|min_length[4]');
  
      $this->form_validation->set_message('required', '{field} harus diisi!');
      $this->form_validation->set_message('exact_length', '{field} harus terdiri {param} karakter!');
      $this->form_validation->set_message('min_length', '{field} tidak boleh kurang dari {param} karakter!');
      $this->form_validation->set_message('numeric', '{field} harus terdiri karakter angka!');
  
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
/* End of file filename.php */