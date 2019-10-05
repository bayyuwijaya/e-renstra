<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Admin_m');
		$this->load->model('Content_m');
		$this->load->model('M_home');
		$this->load->model('M_function');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')==TRUE) 
		{
			if (in_array(1, $this->session->userdata('id_global_hakakses'))) {	
					redirect('/administrator/select_prefillage');
			} else if(in_array(7, $this->session->userdata('id_global_hakakses'))) {
				redirect('/administrator/dashboard');
			} else {
				//redirect('/account');
				$this->session->sess_destroy();
				redirect('');
			}
		} else {
			$this->load->view('login');
		}	
	}

	public function change_password($dari)
	{		
		$userid = $this->session->userdata('userid');

		if($dari == 'mahasiswa') {
			$this->edit_mahasiswa($userid);
		}
		if($dari == 'dosen') {
			$this->edit_dosen($userid);
		}
	}

	public function edit_mahasiswa($id_user)
	{
		$data['judul']			= 'Ubah Sandi';
		$data['desc_judul']	= 'mohon di ingat kata sandi anda. dikarenakan semua proses akademik akan di lakukan pada sistem ini';
		$data['page']				= 'change_password';
		$data['jenis_page']	= "mahasiswa/";
		$data['controller']	= 'dashboard';
		$data['active']			= 'dashboard';

		$data['breadcumb'][] = array( 'icon'  => 'lock',
																  'link'  => '',
																  'judul' => 'Ubah Password');

		$data['row'] 	 = $this->Content_m->select_db('pddikti_tr_mahasiswa_pt','id_reg_pd',$id_user)->row();
		$data['nm_pd'] = $this->Content_m->select_db('pddikti_tr_mahasiswa','id_pd',$data['row']->id_pd)->row()->nm_pd;
			
		$this->load->view('template',$data);
	}


	public function edit_dosen($id_user)
	{
		$data['judul']			='Ubah Sandi';
		$data['desc_judul']	='mohon di ingat kata sandi anda. dikarenakan semua proses akademik akan di lakukan pada sistem ini';
		$data['page'] 			='change_password';
		$data['jenis_page']	="dosen/";
		$data['controller']	='dashboard';
		$data['active']			='dashboard';

		$data['breadcumb'][] = array('icon'=>'lock',
																 'link' => '',
																 'judul' => 'Ubah Password');
													
		$data['row'] = $this->Content_m->select_db('pddikti_tr_dosen','id_sdm',$id_user)->row();

		$this->load->view('template',$data);
	}


	public function update_password()
	{
		extract($_POST);
		//if(!$this->M_function->exists('global_employee','id_reg_pd',$id_reg_pd) ) {redirect('admin/administrator');}		
		
		if(isset($_POST))
		{
			
			if($password == '' && $confirm_password == '')
			{
				redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
			}
			else
			{
				$cek=$this->M_home->cek_username($username);
				if($cek->num_rows()==0)
				{
					if($confirm_password == $password)
					{
						if(isset($password) && $password != ''){
							$data2=array(
								'username'=>$username,
								'password'=>md5($password),
							);
							$this->session->set_flashdata('sukses',TRUE);
							$this->M_function->update_db('global_user', 'id_user', $id_reg_pd, $data2);
							redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
						}	
					}
					else
					{
						$this->session->set_flashdata('pass_tidak_sama',TRUE);
						redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
					}

				}
				else if($cek->num_rows()==1)
				{
					$get_username_id_user = $this->Content_m->get_row_custom('global_user','username', $username)->id_user;
					if($get_username_id_user == $id_reg_pd)
					{
						if($confirm_password == $password)
						{
							if(isset($password) && $password != ''){
								$data2=array(
									'username'=>$username,
									'password'=>md5($password),
								);
								$this->M_function->update_db('global_user', 'id_user', $id_reg_pd, $data2);
								$this->session->set_flashdata('sukses',TRUE);
								redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
							}
							else
							{
								//echo "password tidak boleh kosong.";
								$this->session->set_flashdata('pass_tidak_boleh_kosong',TRUE);
								redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
							}	
						}
						else
						{
							//echo "password dan confirm password tidak sama.";
							$this->session->set_flashdata('pass_tidak_sama',TRUE);
							redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
						}
					}
					else
					{
						//echo "username sudah ada. silahkan ulangi kembali ...";
						$this->session->set_flashdata('username_sudah_ada',TRUE);
						redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
					}
				}
				else{
					//echo "username sudah ada. silahkan ulangi kembali.";
					$this->session->set_flashdata('username_sudah_ada',TRUE);
					redirect('/account/change_password/'.$dari.'/'.$this->session->userdata('userid'));
				}
			}
			//echo $password;
		}
		else {
			//echo "terjadi error dalam proses update data, silahkan ulangi kembali";
			$this->session->set_flashdata('error',TRUE);
			redirect('/account/change_password/mahasiswa/'.$this->session->userdata('userid'));
			//redirect('admin/daftar_online');
		}
		//echo $this->db->last_query();	
	}


	public function authentication()
	{
		extract($_POST);
		$model = $this->Admin_m->cek_login($username,md5($password));
		if(!$model)
		{
			$this->session->set_flashdata('login_error',TRUE);
			$this->load->view('login');
			//redirect('pd_admin');
			//echo $this->db->last_query();
		}
		else
		{
			/*
			$get= $this->Content_m->get_row_custom('global_user','username', $username);
			$this->session->set_userdata(array(
				'logged_in' => TRUE , xw
				'userid' => $get->id_user ,
				'nama'=>$get->nama ,
				'id_global_hak_akses'=> array('1' ,'2', '2' ,'2' ,'2' ,'2' ,'2' ,'2' ),
			));
			*/			
			$get = $this->Content_m->get_row_custom('global_user','username', $username);
			//echo $this->db->last_query()."<br>";
			$nama = "";
			$cek_employee = $this->Content_m->exists('global_employee','id_sdm', $get->id_user);
			if($cek_employee == 1) {
				$nama = $this->Content_m->get_row_custom('global_employee','id_sdm', $get->id_user)->nm_sdm;
			}

			//GET ALL ID_GLOBAL_HAK_AKSES 
			$arr_id_global_hakakses = array();
			$arr_id_sp = array();
			$arr_id_sms = array();
			foreach ($this->Content_m->select_db('global_user_hakakses','id_global_user',$get->id_global_user)->result() as $key) {
				array_push($arr_id_global_hakakses, $key->id_global_hakakses);
				array_push($arr_id_sp, $key->id_sp);
				array_push($arr_id_sms, $key->id_sms);
			}
			
			if(in_array(1, $arr_id_global_hakakses) || in_array(7,$arr_id_global_hakakses)) {		
			
				$main_session =  array(
					'logged_in' => TRUE , 
					'userid' => $get->id_user ,
					'name' => $nama ,
					'id_global_hakakses' => $arr_id_global_hakakses,
					'id_sp' => $arr_id_sp,
					'id_sms' => $arr_id_sms
				);
				//echo "<pre>";
				//echo print_r($main_session);
				$this->session->set_userdata($main_session);

				$this->session->set_flashdata('login_error',TRUE);
			}
			
			if (in_array(1, $arr_id_global_hakakses)) {	
					redirect('/administrator/select_prefillage');
			}
			else if(in_array(7, $arr_id_global_hakakses)) {
				redirect('/administrator/dashboard');
			}
			else if((!in_array(7, $arr_id_global_hakakses)) && (!in_array(1, $arr_id_global_hakakses))) {
				$this->session->set_flashdata('no_prefillage',TRUE);
				$this->load->view('login');
			}
			else{
				$this->session->set_flashdata('login_error',TRUE);
				$this->load->view('login');
			}
			
		}
	}

	public function log_update()
	{
		$this->load->view('log_update');	
	}
	

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
	

	public function edit_administrator_proses()
	{
		extract($_POST);	
		if(isset($_POST))
		{
			$data = array(
										'nm_sdm'		=> $nm_sdm,
									 );		
			$this->M_function->update_db('global_employee', 'id_sdm', $id_sdm, $data);
			//echo $this->db->last_query();
			if($password == '' && $confirm_password == '')
			{
				//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			else
			{
				$cek = $this->M_home->cek_username($username);
				if($cek->num_rows() == 0)
				{
					if($confirm_password == $password)
					{
						if(isset($password) && $password != '') {
							$data2 = array(
															'username' => $username,
															'password' => md5($password),
														);
							$this->M_function->update_db('global_user', 'id_user', $id_sdm, $data2);
							//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
							redirect($_SERVER['HTTP_REFERER'],'refresh');
						}
						else
						{
							$this->session->set_flashdata('pass_tidak_boleh_kosong',TRUE);
							//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
							redirect($_SERVER['HTTP_REFERER'],'refresh');
						}	
					}
					else
					{
						$this->session->set_flashdata('pass_tidak_sama',TRUE);
						//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
						redirect($_SERVER['HTTP_REFERER'],'refresh');
					}
				}
				else if($cek->num_rows() == 1)
				{
					$get_username_id_user = $this->Content_m->get_row_custom('global_user','username', $username)->id_user;
					if($get_username_id_user == $id_sdm)
					{
						if($confirm_password == $password)
						{
							if(isset($password) && $password != '') {
								$data2=array(
															'username' => $username,
															'password' => md5($password),
														);
								$this->M_function->update_db('global_user', 'id_user', $id_sdm, $data2);
								$this->session->set_flashdata('sukses',TRUE);
								//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
								redirect($_SERVER['HTTP_REFERER'],'refresh');
							}
							else
							{
								//echo "password tidak boleh kosong.";
								$this->session->set_flashdata('pass_tidak_boleh_kosong',TRUE);
								//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
								redirect($_SERVER['HTTP_REFERER'],'refresh');
							}	
						}
						else
						{
							//echo "password dan confirm password tidak sama.";
							$this->session->set_flashdata('pass_tidak_sama',TRUE);
							//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
							redirect($_SERVER['HTTP_REFERER'],'refresh');
						}
					}
					else
					{
						//echo "username sudah ada. silahkan ulangi kembali ...";
						$this->session->set_flashdata('username_sudah_ada',TRUE);
						//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
						redirect($_SERVER['HTTP_REFERER'],'refresh');
					}
				}
				else {
					//echo "username sudah ada. silahkan ulangi kembali.";
					$this->session->set_flashdata('username_sudah_ada',TRUE);
					//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
					redirect($_SERVER['HTTP_REFERER'],'refresh');
				}
			}
			//echo $password;
		}
		else {
			//echo "terjadi error dalam proses update data, silahkan ulangi kembali";
			$this->session->set_flashdata('error', TRUE);
			//redirect('/administrator/pengaturan/atur_hakakses/edit/'.$id_sdm);
			redirect($_SERVER['HTTP_REFERER'],'refresh');
			//redirect('admin/daftar_online');
		}
		//echo $this->db->last_query();	
	}


	public function edit_profile($userid)
	{
		if($this->session->userdata('logged_in')!=TRUE)
			redirect('');

		echo "is under contruction";
	}

	public function lock_screen()
	{
		if($this->session->userdata('logged_in')!=TRUE)
			redirect('');
		
		echo "is under contruction";
	}
}

/* End of file filename.php */