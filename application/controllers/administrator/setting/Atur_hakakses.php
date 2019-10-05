<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(str_replace("\\", "/", APPPATH) . 'helpers/Secure_area_adm.php');
class Atur_hakakses extends Secure_area_adm
{
  public function __construct()
  {
    parent::__construct();
    $data['jenis_page']         = "administrator/";
    $data['controller_dir']     = 'setting/';
    $data['controller']         = 'atur_hakakses';
    $data['parent_controller']  = 'atur_hakakses';
    $data['sub_menu']           = 'setting';
    $data['active']             = 'atur_hakakses';
    $data['sdm']                = $this->db->get_where('global_employee', array('deleted' => '0'))->result();

    $this->load->vars($data);
    $this->load->model('M_hakakses');
    $this->load->model('M_home');
    $this->load->model('M_function');
  }


  public function index()
  {
    $data['judul']      = 'Atur Hakakses';
    $data['desc_judul'] = 'Role Based Access Control ( RBAC )';
    $data['page']       = 'atur_hakakses/list';

    $data['breadcumb'][] = array( 'icon'  => 'list',
                                  'link'  => '',
                                  'judul' => $data['judul'] );

    $this->load->view('template', $data);
  }


	public function add_prefillage($id_global_user, $id_sdm)
	{
		$data['judul']      = 'Atur Hak Akses User';
    $data['desc_judul'] = 'Role Based Access Control ( RBAC )';
		//$data['page']       = 'atur_hakakses/tambah_hakakses';
		$data['page']       = 'atur_hakakses/edit_hakakses';

    $data['breadcumb'][] = array('icon'  => 'unlock',
                                'link'  => site_url('administrator/setting/atur_hakakses'),
                                'judul' => 'Atur Hakakses' );

    $data['breadcumb'][] = array('icon'  => 'plus',
                                'link'  => '',
																'judul' => $data['judul'] );
																
		$this->db->select('id_global_hakakses as id, jenis_hakakses as text');
		$this->db->where('deleted', 0);
		$data['level'] = json_encode($this->db->get('global_hakakses')->result());

		$data['user_hakakses']=$this->db->get_where('global_user_hakakses',array('id_global_user'=>$id_global_user))->row();
 		
 		$data['id_sdm']         = $id_sdm;
		$data['id_global_user'] = $id_global_user;
		 
		if ($id_global_user != '0') {
			$data['page'] = 'atur_hakakses/edit_hakakses';
		} else {
			$data['page'] = 'atur_hakakses/tambah_hakakses';
		}
	
    $this->load->view('template', $data);	
  }
  

	public function edit_prefillage()
	{
		extract($_POST);
		if(isset($_POST))
		{
			$cek = 0;
			if($id_global_user == '0') {
				$uuid = $this->db->query("select UUID() as id")->row()->id;
				$data = array( 'id_global_user' => $uuid,
											 'id_user' 			 => $id_sdm,
											 'username'			 => date('ymdhis'),
											 'password'			 =>	md5('erenstra'),
											 'date_added'		 => date('Y-m-d h:i:s') );

				$this->M_function->insert_db('global_user',  $data);

				$id_global_user = $uuid;
				$cek = 1;
			}

			$this->M_function->delete_db('global_user_hakakses', 'id_global_user', $id_global_user);

			$id_kategori = 0;
			$id_kegiatan = 0;

			$uuid = $this->db->query("select UUID() as id")->row()->id;
			$data = array('id_global_user_hakakses'	=> $uuid,
										'id_global_user'					=> $id_global_user,
										'id_global_hakakses'			=> $id_global_hakakses,
										'id_sp'						  			=> $id_kategori,
										'id_sms'						 		  => $id_kegiatan,
										'date_added'							=> date('Y-m-d h:i:s'),
										'date_modified'						=> date('Y-m-d h:i:s'));	
          
			$this->M_function->insert_db('global_user_hakakses', $data);

			if($cek == 0) {
				echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Semester Berlaku berhasil diubah"));
			} else {
				echo json_encode(array("status"=>"2", "title"=>"Error!", "message"=>"Semester Berlaku gagal diubah"));
			}

		}
	}


	public function process_add_prefillage()
	{
		extract($_POST);
		if(isset($_POST))
		{
			$cek = 0;
			if($id_global_user == '0') {
				$uuid = $this->db->query("select UUID() as id")->row()->id;
				$data = array( 'id_global_user' => $uuid,
											 'id_user' 			 => $id_sdm,
											 'username'			 => date('ymdhis'),
											 'password'			 =>	md5('erenstra'),
											 'date_added'		 => date('Y-m-d h:i:s') );

				$this->M_function->insert_db('global_user',  $data);

				$id_global_user = $uuid;
				$cek = 1;
			}

			$id_kategori = 0;
			$id_kegiatan = 0;

			$uuid = $this->db->query("select UUID() as id")->row()->id;
			$data = array('id_global_user_hakakses'	=> $uuid,
										'id_global_user'					=> $id_global_user,
										'id_global_hakakses'			=> $id_global_hakakses,
										'id_sp'						  			=> $id_kategori,
										'id_sms'						 		  => $id_kegiatan,
										'date_added'							=> date('Y-m-d h:i:s'),
										'date_modified'						=> date('Y-m-d h:i:s'));	
          
			$this->M_function->insert_db('global_user_hakakses', $data);

			if($cek == 1) {
				echo json_encode(array("status"=>"1", "title"=>"Sukses!", "message"=>"Semester Berlaku berhasil ditambah"));
			} else {
				echo json_encode(array("status"=>"2", "title"=>"Error!", "message"=>"Semester Berlaku gagal ditambah"));
			}

		}
	}


	public function atur_akun($id_user, $dari = null)
	{	
		$data['judul'] 			= 'Atur Akun User';
		$data['desc_judul'] = 'Role Based Access Control ( RBAC )';
		$data['page']			  = 'atur_hakakses/atur_akun_user';

		$data['breadcumb'][] = array('icon'	 => 'unlock',
															   'link'	 => site_url('administrator/setting/atur_hakakses'),
															   'judul' => 'List Hakakses');

		$data['breadcumb'][] = array('icon'  => 'pencil',
														     'link'  => '',
															   'judul' => $data['judul']);

		$data['dari'] = $dari;

		$get1 = $this->Content_m->get_row_custom('global_employee', 'id_sdm', $id_user);

		if(count($get1) > 0) {
			//$nm = $this->Content_m->get_value('global_employee_non_dosen','id_sdm',$id_user,'nm_sdm');
			$row = $this->Content_m->select_db('global_employee', 'id_sdm', $id_user)->row();
			$data['id_sdm'] 	 = $row->id_sdm;
			$data['nm_sdm'] 	 = isset($row->nm_sdm) ? $row->nm_sdm : '';
			$data['username']	 = $this->Content_m->get_row_custom('global_user', 'id_user', $row->id_sdm)->username;
		} 
									
		$this->load->view('template',$data);
	}

}
