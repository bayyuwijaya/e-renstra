<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_home extends CI_Model
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

    public function cek_login_guest_double($username,$password,$gelombang)
    {    
        return $this->db->where('email',$username)
                        ->where('password',$password)
                        ->where('gelombang',$gelombang)
                        ->get('permohonan_daftar_mhs');
    }

    public function cek_username($username)
    {    
        return $this->db->where('username', $username)
                        ->get('global_user');
    }   

    /*
    function insert_daftar($data,$id_guest)
    {
        $valid = $this->cek_daftar($id_guest);
       
        if($valid->num_rows() >= 1){         
           //update
            $this->db->where('id_guest',$id_guest)->update('permohonan_daftar',$data);
            
        }
        else{
            //insert
            $this->db->insert('permohonan_daftar',$data);
          
        }   
        return true;   
    }
    */

    function insert_daftar($data, $id = null)
    {
        if($id != null)
          $this->db->where('id_permohonan_daftar_mhs',$id)->update('permohonan_daftar_mhs',$data);
        else
          $this->db->insert('permohonan_daftar_mhs',$data);
        return true;   
    }

    function insert_calon_mahasiswa_temporary($data)
    {
        return $this->db->insert('pddikti_tr_mahasiswa',$data);
    }

    function update_calon_mahasiswa_temporary($data, $id_permohonan_daftar_mhs)
    {
        return $this->db->where('id_permohonan_daftar_mhs',$id_permohonan_daftar_mhs)->update('pddikti_tr_mahasiswa',$data);
    }

    function cek_daftar($id_guest)
    {
        $this->db->where('id_guest',$id_guest);
        return $this->db->get('permohonan_daftar');
    }

    function update_daftar($data,$id_guest)
    {
       return $this->db->where('id_permohonan_daftar_mhs',$id_guest)->update('permohonan_daftar_mhs',$data);
    }

    public function exists($tabel,$col,$value)
    {
        $this->db->where($col,$value);
        $query = $this->db->get($tabel);        
        return ($query->num_rows()==1);
    }
    
    /*
    function get_value($id)
    {
    	return $this->db->where('id_guest',$id)->get('permohonan_daftar');
    }
    */

    function get_value($id)
    {
        return $this->db->where('id_permohonan_daftar_mhs',$id)->get('permohonan_daftar_mhs');
    }

    function get_value_dikti($id)
    {
        //return $this->db->where('id_permohonan_daftar_mhs',$id)->get('pddikti_tr_mahasiswa');
        $query = "SELECT pddikti_tr_mahasiswa.*, permohonan_daftar_mhs.nama_lengkap, permohonan_daftar_mhs.id_sp, permohonan_daftar_mhs.id_sms, 
                  permohonan_daftar_mhs.foto_images, permohonan_daftar_mhs.tempat_lahir, permohonan_daftar_mhs.tanggal_lahir, 
                  permohonan_daftar_mhs.jenis_kelamin, permohonan_daftar_mhs.alamat_rumah, permohonan_daftar_mhs.no_hp,permohonan_daftar_mhs.id_sp,
                  permohonan_daftar_mhs.agama AS agama_dft, permohonan_daftar_mhs.email AS email_dft FROM pddikti_tr_mahasiswa 
                  RIGHT JOIN permohonan_daftar_mhs ON (permohonan_daftar_mhs.id_permohonan_daftar_mhs = pddikti_tr_mahasiswa.id_permohonan_daftar_mhs) 
                  WHERE permohonan_daftar_mhs.id_permohonan_daftar_mhs = '$id'";

        return $this->db->query($query);
    }

    function get_agama()
    {
    	return $this->db->get('pddikti_re_agama');
    }

    function get_sma()
    {
        return $this->db->get('global_list_sma');
    }

    /*
    function get_jenis_kelamin()
    {
        return $this->db->get('permohonan_daftar_kelamin');
    } 
    */

    function get_prodi($prodi)
    {
        $this->db->where('nm_lemb',$prodi);
        return $this->db->get('pddikti_tr_sms');
    }   

    function get_prodi_stikes()
    {
        $this->db->where('id_sp','555ef70d-c159-4dd2-98f1-ee79b0f8e844');
        return $this->db->get('pddikti_tr_sms');
    }   

    function get_prodi_stkip()
    {
        $this->db->where('id_sp','02bbc713-82b4-4f54-adb3-bdba8f487067');
        return $this->db->get('pddikti_tr_sms');
    }    

    /*
    function get_status_sipil()
    {
        return $this->db->get('permohonan_daftar_status_sipil');
    }
    */

    function get_golongan_darah()
    {
        return $this->db->get('global_golongan_darah');   
    }

    function get_pekerjaan_ayah()
    {
        return $this->db->get('pddikti_re_pekerjaan');   
    }

    function get_status_rumah_tinggal()
    {
        return $this->db->get('pddikti_re_jenis_tinggal');
    }

    function get_alumni()
    {
        $query = "SELECT alumni.*, prodi_utama.* FROM alumni 
                  INNER JOIN prodi_utama ON (alumni.prodi_utama = prodi_utama.id_prodi) ORDER BY id_mahasiswa DESC";
        return $this->db->query($query);
    }

    function get_alumni_detail($id)
    {
        $query = "SELECT alumni.*, prodi_utama.* FROM alumni 
                  INNER JOIN prodi_utama ON (alumni.prodi_utama = prodi_utama.id_prodi)
                  WHERE id_mahasiswa='$id'";
        return $this->db->query($query);
    }

    function get_mahasiswa($id = null)
    {
        /*
        if($id !=null)
            $this->db->where('id_mahasiswa',$id);
       
        $this->db->select('*');    
        $this->db->from('mahasiswa');

        $this->db->join('prodi_utama', 'prodi_utama.id_prodi = mahasiswa.prodi_utama');

        $query = $this->db->get();
        return $query;
        */
        if($id == null)
          $query = "SELECT * FROM (`mahasiswa`) JOIN `prodi_utama` ON `prodi_utama`.`id_prodi` = `mahasiswa`.`prodi_utama`
                    WHERE mahasiswa.deleted = '0' AND mahasiswa.status = '0' ORDER BY `mahasiswa`.id_mahasiswa DESC";
        else
          $query = "SELECT * FROM (`mahasiswa`) JOIN `prodi_utama` ON `prodi_utama`.`id_prodi` = `mahasiswa`.`prodi_utama` 
                    WHERE mahasiswa.deleted = '0' AND id_mahasiswa = '$id' AND mahasiswa.status = '0'";
          
        return $this->db->query($query);
    }

    public function get_row_custom($tbl,$where, $id)
    {
        $this->db->where($where,$id);
        $query = $this->db->get($tbl);
        return $query->row();   
    }

    public function get_row_custom2($tbl,$where, $id, $where2,$id2)
    {
        $this->db->where($where,$id);
        $this->db->where($where2,$id2);
        $query = $this->db->get($tbl);
        return $query->row();   
    }

    public function get_row_custom3($tbl,$where, $id, $where2,$id2, $where3,$id3)
    {
        $this->db->where($where,$id);
        $this->db->where($where2,$id2);
        $this->db->where($where3,$id3);
        $query = $this->db->get($tbl);
        return $query->row();   
    }
}
