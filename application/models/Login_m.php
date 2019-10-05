<?php
class Login_m extends CI_Model{
	
	function login_guest()
	{
		$valid = $this->cek_login_guest($this->input->ip_address());
		//echo $this->db->last_query();
		if($valid->num_rows() == 1){
			
			if($this->session->userdata('id_guest') == ''){
				$data = array('id_guest'=>$valid->row()->id_guest,
				  'guest'=>TRUE);
				$this->session->set_userdata($data);
			}

		}
		else{
			$ip = $this->input->ip_address();
			$data_guest=array(
				'ip'=>$ip
			);

			$this->insert_guest($data_guest);
		}
	}

	function insert_guest($data)
	{
		return $this->db->insert('guest',$data);
	}

	function cek_login_guest($ip){
		$this->db->where('ip',$ip);
		return $this->db->get('guest');
	}


	
	
	
}
?>