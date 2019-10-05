<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(str_replace("\\","/",APPPATH).'helpers/Secure_area_adm.php');
class Ajax extends Secure_area_adm {

	function __construct()
    {
        parent::__construct();
    }
    
	public function select2_program_studi()
	{
		$get_sms = $this->M_hakakses->get_role_akademik();
		$this->db->select('id_sms as id, concat(nm_jenj_didik," ",nm_lemb) as text');
		$this->db->where_in('id_sp',$_POST['id_sp']);
		$this->db->where("sms.deleted","0");
		$this->db->join('pddikti_re_jenjang_pendidikan jp', 'jp.id_jenj_didik=sms.id_jenj_didik and jp.deleted="0"','left');
		$this->db->order_by('sms.id_jenj_didik','asc');
		$this->db->order_by('nm_lemb','asc');
		$this->db->where_in('id_sms', $get_sms[2]);
		echo json_encode($this->db->get('pddikti_tr_sms sms')->result());
	}

	public function select2_wilayah()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('pddikti_re_wilayah kec');
		$this->db->join('pddikti_re_wilayah kab', 'kec.id_induk_wilayah = kab.id_wil and kab.id_level_wil="2"');
		$this->db->join('pddikti_re_wilayah prov', 'kab.id_induk_wilayah = prov.id_wil and prov.id_level_wil="1"');
		$this->db->where('kec.id_level_wil', '3');
		$this->db->like('concat(kec.nm_wil," - ",kab.nm_wil," - ",prov.nm_wil)', $query);
		$this->db->stop_cache();
		$total_count=$this->db->count_all_results();

		$this->db->select('kec.id_wil as id, concat(kec.nm_wil," - ",kab.nm_wil," - ",prov.nm_wil) as value');
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_kewarganegaraan()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('pddikti_re_negara');
		$this->db->like('nm_negara', $query);
		$this->db->start_cache();
		$total_count=$this->db->count_all_results();

		$this->db->select('id_negara as id, nm_negara as value');
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_mata_kuliah()
	{
		if($_POST['id_sp'])
		{
			$query=$_POST['term'];
			$limit=10;
			$page=$_POST['page'];
			$offset = ($page - 1) * $limit;

			$this->db->start_cache();
			$this->db->from('pddikti_tr_mata_kuliah');
			$this->db->group_start();
			$this->db->like('nm_mk', $query);
			$this->db->or_like('kode_mk', $query);
			$this->db->group_end();
			$this->db->where('deleted', '0');
			$this->db->where_in('id_sms', 'select id_sms from pddikti_tr_sms where id_sp = "'.$_POST['id_sp'].'"',false);
			$this->db->order_by('kode_mk','asc');
			$this->db->start_cache();

			$total_count=$this->db->count_all_results();

			$this->db->select('id_mk as id, concat(kode_mk," - ",nm_mk," (",sks_mk," sks)") value');
			$this->db->limit($limit,$offset);
			$results=$this->db->get()->result_array();
			$this->db->flush_cache();

	        $morePages = $total_count > ($offset + $limit);

			$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		}
		else
		{
			$response=array("results"=>array(array('value'=>false)));
		}
		echo json_encode($response);
	}

	public function select2_mk_transfer()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('pddikti_tr_mata_kuliah mk');
		$this->db->join('pddikti_tr_mata_kuliah_kurikulum mkk', 'mk.id_mk=mkk.id_mk and mkk.deleted="0"');
		$this->db->join('pddikti_tr_kurikulum k', 'k.id_kurikulum_sp=mkk.id_kurikulum_sp and k.deleted="0"');
		$this->db->like('concat(kode_mk," ",nm_mk)', $query);
		$this->db->where('mk.deleted', '0');
		$this->db->where_in('k.id_sms', 'select id_sms from pddikti_tr_sms where id_sp = "'.$_POST['id_sp'].'"',false);
		$this->db->order_by('kode_mk','asc');
		$this->db->start_cache();

		$total_count=$this->db->count_all_results();

		$this->db->select('mk.id_mk as id, concat(kode_mk," - ",nm_mk," (",mk.sks_mk," sks) ",nm_kurikulum_sp) value');
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));

		echo json_encode($response);
	}

	public function select2_dosen_pengajar()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('pddikti_tr_dosen d');
		$this->db->join('pddikti_tr_dosen_pt dp', 'd.id_sdm=dp.id_sdm and dp.deleted="0"');
		$this->db->group_start();
		$this->db->like('nidn', $query);
		$this->db->or_like('nm_sdm', $query);
		$this->db->group_end();
		$this->db->where('d.deleted', '0');
		$this->db->where('dp.id_sp',$_POST['id_sp']);
		$this->db->where('id_thn_ajaran',$_POST['id_thn_ajaran']);
		$this->db->order_by('id_thn_ajaran','desc');
		$this->db->start_cache();

		$total_count=$this->db->count_all_results();

		$this->db->select('id_reg_ptk as id, concat(nidn," - ",nm_sdm) value');
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_peserta_kelas()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('siakad_tr_history_krs krs');
		$this->db->join('pddikti_tr_mahasiswa_pt mpt','krs.id_reg_pd=mpt.id_reg_pd and mpt.deleted="0"');
		$this->db->join('pddikti_tr_mahasiswa m', 'm.id_pd=mpt.id_pd and m.deleted="0"');
		$this->db->group_start();
		$this->db->like('nipd', $query);
		$this->db->or_like('nm_pd', $query);
		$this->db->group_end();
		$this->db->where('krs.deleted', '0');
		$this->db->where('id_status_krs', '2');
		$this->db->where('id_mk',$_POST['id_mk']);
		$this->db->where('krs.id_smt',$_POST['id_smt']);
		$this->db->order_by('nipd','asc');
		$this->db->start_cache();

		$total_count=$this->db->count_all_results();

		$this->db->select('id_krs as id, concat(nipd," - ",nm_pd) value');
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_krs_mhs()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('siakad_tr_history_krs krs');
		$this->db->join('pddikti_tr_kelas_kuliah k','krs.id_mk=k.id_mk and k.deleted="0" and k.id_smt="'.$_POST['id_smt'].'"');
		$this->db->join('pddikti_tr_mata_kuliah m', 'm.id_mk=k.id_mk and m.deleted="0"');
		$this->db->join('pddikti_tr_sms sms', 'sms.id_sms=k.id_sms and sms.deleted="0"');
		$this->db->like("concat(kode_mk,' ',nm_mk,' - ',nm_kls,' - ',coalesce(m.sks_mk,'0'),' sks (',nm_lemb,')')", $query);
		$this->db->where('krs.deleted', '0');
		$this->db->where('krs.id_smt',$_POST['id_smt']);
		$this->db->where('id_reg_pd',$_POST['id_reg_pd']);
		$this->db->order_by('k.id_sms','asc');
		$this->db->order_by('m.kode_mk','asc');
		$this->db->start_cache();

		$total_count=$this->db->count_all_results();

		$this->db->select("id_krs,id_kls as id, concat(kode_mk,' ',nm_mk,' - ',nm_kls,' - ',coalesce(m.sks_mk,'0'),' sks (',nm_lemb,')') value");
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_mhs_keluar()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('pddikti_tr_mahasiswa_pt mpt');
		$this->db->join('pddikti_tr_mahasiswa m','id_pd');
		$this->db->like("concat(nipd,' - ',nm_pd)", $query);
		$this->db->where('mpt.deleted', '0');
		$this->db->where('id_jns_keluar IS NULL');
		$this->db->order_by('nipd','asc');
		$this->db->start_cache();

		$total_count=$this->db->count_all_results();

		$this->db->select("id_reg_pd as id, concat(nipd,' - ',nm_pd) value");
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_dosen_pembimbing()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->distinct();
		$this->db->from('pddikti_tr_dosen d');
		$this->db->join('pddikti_tr_dosen_pt dp','d.id_sdm=dp.id_sdm and dp.deleted="0" and id_sp="'.$_POST['id_sp'].'"');
		$this->db->like("concat(nidn,' - ',nm_sdm)", $query);
		$this->db->where('d.deleted', '0');
		$this->db->order_by('nidn','asc');
		$this->db->group_by('id_sdm');
		$this->db->start_cache();
		$this->db->select('d.id_sdm');
		$total_count=$this->db->count_all_results();

		$this->db->select("d.id_sdm as id, concat(nidn,' - ',nm_sdm) value");
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_mhs_kuliah()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->from('pddikti_tr_mahasiswa_pt mpt');
		$this->db->join('pddikti_tr_mahasiswa m','id_pd');
		$this->db->like("concat(nipd,' - ',nm_pd)", $query);
		$this->db->where('mpt.deleted', '0');
		$this->db->order_by('nipd','asc');
		$this->db->start_cache();

		$total_count=$this->db->count_all_results();

		$this->db->select("id_reg_pd as id, concat(nipd,' - ',nm_pd) value");
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function select2_penugasan_dosen()
	{
		$query=$_POST['term'];
		$limit=10;
		$page=$_POST['page'];
		$offset = ($page - 1) * $limit;

		$this->db->start_cache();
		$this->db->distinct();
		$this->db->from('pddikti_tr_dosen');
		$this->db->like("concat(nidn,' - ',nm_sdm)", $query);
		$this->db->where('deleted', '0');
		$this->db->order_by('nidn','asc');
		$this->db->start_cache();
		$this->db->select('id_sdm');
		$total_count=$this->db->count_all_results();

		$this->db->select("id_sdm as id, concat(nidn,' - ',nm_sdm) value");
		$this->db->limit($limit,$offset);
		$results=$this->db->get()->result_array();
		$this->db->flush_cache();

        $morePages = $total_count > ($offset + $limit);

		$response=array("results"=>$results,"pagination" => array("more" => $morePages));
		echo json_encode($response);
	}

	public function get_mhs_ipk()
	{
		$this->db->select('sum(m.sks_mk*coalesce(nilai_indeks,0))/sum(m.sks_mk) as ipk');
		$this->db->from('pddikti_tr_nilai n');
		$this->db->join('pddikti_tr_kelas_kuliah k','id_kls');
		$this->db->join('pddikti_tr_mata_kuliah m', 'id_mk');
		$this->db->where(array('n.deleted'=>'0','n.id_reg_pd'=>$_POST['id_reg_pd']));
		$this->db->group_start();
		$this->db->where('nilai_huruf IS NOT NULL OR nilai_angka IS NOT NULL');
		$this->db->group_end();
		echo json_encode(number_format($this->db->get()->row()->ipk,2,',',''));
	}

	public function get_kuliah_mhs_data()
	{
		$this->db->select('sum(m.sks_mk*coalesce(nilai_indeks,0))/sum(m.sks_mk) as ipk');
		$this->db->from('pddikti_tr_nilai n');
		$this->db->join('pddikti_tr_kelas_kuliah k','id_kls');
		$this->db->join('pddikti_tr_mata_kuliah m', 'id_mk');
		$this->db->where(array('n.deleted'=>'0','n.id_reg_pd'=>$_POST['id_reg_pd']));
		$this->db->group_start();
		$this->db->where('nilai_huruf IS NOT NULL OR nilai_angka IS NOT NULL');
		$this->db->group_end();
		$ipk=number_format($this->db->get()->row()->ipk,2,',','');

		$this->db->select('sum(m.sks_mk*coalesce(nilai_indeks,0))/sum(m.sks_mk) as ips');
		$this->db->from('pddikti_tr_nilai n');
		$this->db->join('pddikti_tr_kelas_kuliah k','id_kls');
		$this->db->join('pddikti_tr_mata_kuliah m', 'id_mk');
		$this->db->where(array('n.deleted'=>'0','n.id_reg_pd'=>$_POST['id_reg_pd'],'k.id_smt'=>$_POST['id_smt']));
		$this->db->group_start();
		$this->db->where('nilai_huruf IS NOT NULL OR nilai_angka IS NOT NULL');
		$this->db->group_end();
		$ips=number_format($this->db->get()->row()->ips,2,',','');

		$this->db->select('coalesce(sum(m.sks_mk),0) as sks_mk');
		$this->db->from('pddikti_tr_nilai n');
		$this->db->join('pddikti_tr_kelas_kuliah k','id_kls');
		$this->db->join('pddikti_tr_mata_kuliah m', 'id_mk');
		$this->db->where(array('n.deleted'=>'0','n.id_reg_pd'=>$_POST['id_reg_pd']));
		$sks_total=$this->db->get()->row()->sks_mk;

		$this->db->select('coalesce(sum(m.sks_mk),0) as sks_mk');
		$this->db->from('pddikti_tr_nilai n');
		$this->db->join('pddikti_tr_kelas_kuliah k','id_kls');
		$this->db->join('pddikti_tr_mata_kuliah m', 'id_mk');
		$this->db->where(array('n.deleted'=>'0','n.id_reg_pd'=>$_POST['id_reg_pd'],'k.id_smt'=>$_POST['id_smt']));
		$sks_smt=$this->db->get()->row()->sks_mk;

		$response['ipk']=$ipk;
		$response['ips']=$ips;
		$response['sks_total']=$sks_total;
		$response['sks_smt']=$sks_smt;
		echo json_encode($response);
	}
}
