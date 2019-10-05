<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_form_validation extends CI_Form_validation
{
    function __construct()
    {
        parent::__construct();
    }

	public function edit_unique($str, $field)
	{
		list($table, $field, $col, $id) = explode(".", $field, 4);

	    $query = $this->CI->db->select($field)->from($table)
	        ->where($field, $str)->where($col.' !=', $id)->limit(1)->get();

	    if ($query->row())
	        return false;
	    else
	        return true;
    }

    public function mk_is_unique($str)
	{
		$this->CI->db->select('id_mk')->from('pddikti_tr_mata_kuliah_kurikulum')->where('id_mk', $str)->where('id_kurikulum_sp', $_POST['id_kurikulum_sp'])->where('deleted', '0');
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function nim_is_unique($str)
	{
		$this->CI->db->select('id_reg_pd')->from('pddikti_tr_mahasiswa_pt')->where('nipd', $str)->where('id_sms', $_POST['id_sms'])->where('deleted', '0');
		if(@$_POST['id_reg_pd'])
			$this->CI->db->where('id_reg_pd !=',$_POST['id_reg_pd']);
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function mhs_is_unique($str)
	{
		if(!@$_POST['id_reg_pd'])
		{
			$this->CI->db->select('id_reg_pd')->from('pddikti_tr_mahasiswa_pt')->where('id_pd', $_POST['id_pd'])->where('id_sms', $_POST['id_sms'])->where('deleted', '0');
		    if ($this->CI->db->limit(1)->get()->row())
		        return false;
		    else
		        return true;
		}
			return true;
    }

    public function dosen_pengajar_is_unique($str)
	{
		$this->CI->db->select('id_reg_ptk')->from('pddikti_tr_ajar_dosen')->where('id_reg_ptk', $str)->where('id_kls', $_POST['id_kls'])->where('deleted', '0');
		if(@$_POST['id_reg_ptk_temp'])
			$this->CI->db->where('id_reg_ptk !=',$_POST['id_reg_ptk_temp']);
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }


    //SUDAH
    public function penugasan_is_unique($str)
	{
		$this->CI->db->select('id_reg_ptk')->from('pddikti_tr_dosen_pt')->where('id_thn_ajaran', $_POST['id_thn_ajaran'])->where('id_sdm', $str)->where('deleted', '0');
		if(@$_POST['id_thn_ajaran_temp'])
			$this->CI->db->where('id_thn_ajaran !=',$_POST['id_thn_ajaran_temp']);
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function skala_nilai_is_unique($str)
	{
		$this->CI->db->select('kode_bobot_nilai')->from('pddikti_tr_bobot_nilai')->where('id_sms', $_POST['id_sms'])->where('nilai_huruf', strtoupper($str))->where('deleted', '0');
		if(@$_POST['nilai_huruf_temp'])
			$this->CI->db->where('nilai_huruf !=',strtoupper($_POST['nilai_huruf_temp']));
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function daya_tampung_is_unique($str)
	{
		$this->CI->db->select('id_daya_tampung')->from('pddikti_tr_daya_tampung')->where('id_smt', $_POST['id_smt'])->where('id_sms', $str)->where('deleted', '0');
		if(@$_POST['id_smt_temp'])
			$this->CI->db->where('id_smt !=',$_POST['id_smt_temp']);
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function dosen_pembimbing_is_unique($str)
	{
		$this->CI->db->select('id_sdm')->from('pddikti_tr_dosen_pembimbing')->where('id_sdm', $str)->where('id_reg_pd', $_POST['id_reg_pd'])->where('deleted', '0');
		if(@$_POST['id_sdm_temp'])
			$this->CI->db->where('id_sdm !=',$_POST['id_sdm_temp']);
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function peserta_kelas_is_unique($str)
	{
		$this->CI->db->select('id_reg_pd')
					 ->from('pddikti_tr_nilai')
					 ->where('id_reg_pd', $_POST['id_reg_pd'])
					 ->where_in('id_kls','SELECT id_kls FROM pddikti_tr_kelas_kuliah WHERE deleted="0" AND id_kls IN(SELECT id_kls FROM pddikti_tr_kelas_kuliah WHERE deleted="0" AND id_smt="'.$_POST['id_smt'].'" AND id_mk = (SELECT id_mk FROM pddikti_tr_kelas_kuliah WHERE deleted="0" AND id_kls="'.$_POST['id_kls'].'"))',false)
					 ->where('deleted', '0');
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function kuliah_mhs_is_unique($str)
	{
		$this->CI->db->select('id_reg_pd')->from('pddikti_tr_kuliah_mahasiswa')->where('id_reg_pd', $str)->where('id_smt', $_POST['id_smt'])->where('deleted', '0');
		if(@$_POST['id_smt_temp'])
			$this->CI->db->where('id_smt !=',$_POST['id_smt_temp']);
	    if ($this->CI->db->limit(1)->get()->row())
	        return false;
	    else
	        return true;
    }

    public function matches_table($str, $field)
	{
		list($table, $field, $col_id, $id) = explode(".", $field, 4);

		if($field=="password")
			$str=md5($str);
	    $query = $this->CI->db->select($field)->from($table)
	        ->where($field, $str)->where($col_id, $id)->limit(1)->get();

	    if ($query->row())
	        return true;
	    else
	        return false;
	}
}