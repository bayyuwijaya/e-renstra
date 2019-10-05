<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hakakses extends CI_Model
{
    function __construct() 
    {
        parent::__construct();
    }

    public function cek_login_guest($username,$password)
    {    
        return $this->db->where('email',$username)
                        ->where('password',$password)
                        ->get('permohonan_daftar_mhs');
    }

    public function get_role_akademik()
    {
        $id_global_hakakses = array();
        $id_sp = array();
        $id_sms = array();

        $id_global_user = $this->Content_m->get_row_custom('global_user','id_user', $this->session->userdata('userid'))->id_global_user;
        $this->db->where('id_global_hakakses', 2);
        foreach ($this->Content_m->select_db('global_user_hakakses','id_global_user',$id_global_user)->result() as $key ) {    
            array_push($id_global_hakakses, $key->id_global_hakakses);  
            array_push($id_sms, $key->id_sms);
            array_push($id_sp, $key->id_sp);
        }
            
        $a = [];
        $a[0] = $id_global_user;
        $a[1] = array_unique($id_sp);
        $a[2] = array_unique($id_sms);

        return $a;
    }

    public function get_role_akademik_sekolah()
    {
        $id_global_hakakses = array();
        $id_sp = array();
        $id_sms = array();

        $id_global_user = $this->Content_m->get_row_custom('global_user','id_user', $this->session->userdata('userid'))->id_global_user;
        $this->db->where('id_global_hakakses',9);
        foreach ($this->Content_m->select_db('global_user_hakakses','id_global_user',$id_global_user)->result() as $key ) {    
            array_push($id_global_hakakses, $key->id_global_hakakses);  
            array_push($id_sms, $key->id_sms);
            array_push($id_sp, $key->id_sp);
        }
            
        $a = [];
        $a[0] = $id_global_user;
        $a[1] = array_unique($id_sp);
        $a[2] = array_unique($id_sms);

        return $a;
    }

    public function get_role_akademik_dosen()
    {
        $id_global_hakakses = array();
        $id_sp = array();
        $id_sms = array();

        $id_global_user = $this->Content_m->get_row_custom('global_user','id_user', $this->session->userdata('userid'))->id_global_user;
        $this->db->where('id_global_hakakses',7);
        foreach ($this->Content_m->select_db('global_user_hakakses','id_global_user',$id_global_user)->result() as $key ) {    
            array_push($id_global_hakakses, $key->id_global_hakakses);  
            array_push($id_sms, $key->id_sms);
            array_push($id_sp, $key->id_sp);
        }
            
        $a = [];
        $a[0] = $id_global_user;
        $a[1] = array_unique($id_sp);
        $a[2] = array_unique($id_sms);

        return $a;
    }


    public function get_hakakses_superadmin()
    {
        $id_global_hakakses = $this->session->userdata('id_global_hakakses');
        $is_superadmin = false;     
        $i = 0;
        foreach ($id_global_hakakses as $id_hak_akses) {
            if($id_global_hakakses[$i] == 1){
                $is_superadmin = true;
            }
            $i++;
        }

        return $is_superadmin;
    }

    public function get_query_hakakses($filter=null)
    {
        $id_global_hakakses = $this->session->userdata('id_global_hakakses');
        $id_sp = $this->session->userdata('id_sp');
        $id_sms = $this->session->userdata('id_sms');

        $rule = 0;
        $i = 0;
        foreach ($id_global_hakakses as $id_hak_akses) {
            if($id_global_hakakses[$i] == 2) {       
                $rule++;
            }
            $i++;
        }

        //echo "GET RULE ID_SMS PER AKUN<br><br><br><br><br><br>";
        $i = 0;
        $j = 0;
        $where = "";
        foreach ($id_global_hakakses as $id_hak_akses) {            
            if($id_global_hakakses[$i] == 2) {   
                if($j == $rule-1)
                    $where = $where." id_sms='".$id_sms[$i]."'";
                else
                    $where = $where." id_sms='".$id_sms[$i]."' OR";                
                $j++;
            }            
            $i++; 
        }
        $where_hakakses = "tahun_masuk='".date('Y')."' AND (".$where.")";
        if($rule==0)
            $where_hakakses = "tahun_masuk='".date('Y')."' AND id_sms='-99'";
        if($where =="")
            $where="id_sms='-99'";

        $where_filter = "id_sms='$filter'";

        $arr_where = [];
        $arr_where[0] = $where;
        if($filter == 'all')
        $arr_where[1] = $where_hakakses;
        else
        $arr_where[1] = $where_filter;

        return $arr_where;
    }
}

/* End of file filename.php */