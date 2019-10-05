<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_function extends CI_Model 
{		
	//date
	public function get_tgl()
	{
		return date("Y-m-d");
	}
	public function get_timestamp()
	{
		return date("Y-m-d H:i:s");
	}	
	public function date_ymd($tgl)
	{
		return date('Y-m-d', strtotime($tgl));
	}
	public function date_jfy($tgl='')
	{
		if($tgl == '') return '';
		return date('j F Y', strtotime($tgl));
	}
	
	//generic query
	public function select_db($tbl,$col=NULL, $col_val=NULL,$sort_col=NULL, $sort='ASC')
	{
		if($col != NULL) {$this->db->where($col,$col_val); }		
		if($sort_col != NULL) {$this->db->order_by($sort_col, $sort); }
		return $this->db->get($tbl);
	}
	public function get_row($tbl, $col, $val)
	{
		$this->db->where($col,$val);
		$query = $this->db->get($tbl);
		return $query->row();	
	}
	public function get_data($tbl, $id, $col)
	{
		if($id==NULL || $id==''){ return '';}
		else if(!$this->exists($tbl, 'id', $id)){ return '';  }
		$this->db->where('id',$id);
		$query = $this->db->get($tbl);
		return $query->row()->$col;			
	}
	public function get_value($tbl=NULL, $col=NULL, $val=NULL, $field=NULL)
	{
		if($tbl==NULL || $col==NULL || $val==NULL || $field==NULL){ return '';}
		else if(!$this->exists($tbl, $col, $val)){ return '';  }
		$this->db->where($col,$val);
		$query = $this->db->get($tbl);
		return $query->row()->$field;
	}
	public function exists($tabel,$col,$value)
	{
		$this->db->where($col,$value);
		$query = $this->db->get($tabel);		
		return ($query->num_rows()==1);
	}
	function get_ai($tbl)
	{		
		$row = $this->db->query("SHOW TABLE STATUS LIKE '$tbl' ")->row();		
		return $row->Auto_increment;
	}
	function insert_db($tabel, $data)
	{
		if($this->db->insert($tabel,$data))
		return true;
		return false;
	}
	function update_db($tabel, $col, $val, $data)
	{
		$this->db->where($col,$val);
		if($this->db->update($tabel,$data))
		return true;
		return false;
	}
	function update_db2($tabel, $col, $val, $col2, $val2, $data)
	{
		$this->db->where($col,$val);
		$this->db->where($col2,$val2);
		if($this->db->update($tabel,$data))
		return true;
		return false;
	}

	function update_db3($tabel, $col, $val, $col2, $val2, $col3, $val3, $data)
	{
		$this->db->where($col,$val);
		$this->db->where($col2,$val2);
		$this->db->where($col3,$val3);
		if($this->db->update($tabel,$data))
		return true;
		return false;
	}

	function delete_db($tabel, $col, $val)
	{
		$this->db->where($col, $val);
		if($this->db->delete($tabel))
		return true;
		return false;
	}
	
	function semester_mhs($angkatan, $thn_akademis=NULL)
	{
		if($thn_akademis==NULL) {
			$this->db->where('status', 'Aktif');
			$row = $this->db->get('semester')->row();
			$semester = $row->semester;
			$th = explode('-',$row->tahun_akademis);
		}
		else {
			$th = explode('-',$thn_akademis);
			$sm = explode(' ',$th[1]);
			$semester = $sm[1];
		}
		$selisih = $th[0]-$angkatan;
		if($semester == 'Ganjil')
		return (1 + ($selisih * 2) );
		return (2 + ($selisih * 2) );
	}
	
	
	public function msg_box($class, $msg)
	{
		if($class=='success'){
			$this->session->set_flashdata('msg',"<div class='msg_box msg_success'><h3><i class='fa fa-fw fa-check-square-o'></i> Sukses</h3>$msg</div>");
		}
		else{ $this->session->set_flashdata('msg',"<div class='msg_box msg_error'><h3><i class='fa fa-fw fa-warning'></i> Error</h3>$msg</div>"); }
		
	}
	
	public function format_number($n = '')
	{
		return ($n === '') ? '' : number_format( (float) $n, 0, ',', '.');
	}
	
	public function select_month()
	{
		$options = array();
		$options += array('01' => 'Januari');
		$options += array('02' => 'Februari');
		$options += array('03' => 'Maret');
		$options += array('04' => 'April');
		$options += array('05' => 'Mei');
		$options += array('06' => 'Juni');
		$options += array('07' => 'Juli');
		$options += array('08' => 'Agustus');
		$options += array('09' => 'September');
		$options += array('10' => 'Oktober');
		$options += array('11' => 'November');
		$options += array('12' => 'Desember');
		return $options;
	}
	
	public function nama_bln($bln)
	{
		if($bln == '01') return 'Januari';
		else if($bln == '02') return 'Februari';
		else if($bln == '03') return 'Maret';
		else if($bln == '04') return 'April';
		else if($bln == '05') return 'Mei';
		else if($bln == '06') return 'Juni';
		else if($bln == '07') return 'Juli';
		else if($bln == '08') return 'Agustus';
		else if($bln == '09') return 'September';
		else if($bln == '10') return 'Oktober';
		else if($bln == '11') return 'November';
		else if($bln == '12') return 'Desember';
	}

	public function get_value_khs($smt, $id_mahasiswa)
	{
		$this->db->where('id_mahasiswa',$id_mahasiswa);
		$this->db->where('semester',$smt);		
		return $this->db->get('krs'); 
	}
	
	public function nilai($grade, $sks)
	{	
		if($sks==0 || $grade == ''){ return 0;}
		if($grade == 'A' || $grade == 'a') { $nilai = 4;}
		else if($grade == 'B' || $grade == 'b') { $nilai = 3;}
		else if($grade == 'C' || $grade == 'c') { $nilai = 2;}
		else if($grade == 'D' || $grade == 'd') { $nilai = 1;}
		else if($grade == 'E' || $grade == 'e') { $nilai = 0;}
		else if($grade == 'F' || $grade == 'f') { $nilai = 0;}
		else { $nilai = 0;}
		return $nilai * $sks; 
	}	
	public function ipk($nim)
	{
		$ttl_nilai = 0;
		$ttl_sks = 0;		
		$this->db->where('id_mahasiswa',$nim);
		foreach ($this->select_db('krs')->result() as $row){
			if($row->grade != NULL){
				$sks = $this->get_value('mata_kuliah', 'id', $row->id_matkul, 'sks');
				$ttl_sks += $sks;
				$ttl_nilai += $this->nilai($row->grade, $sks);	
			}
		}
		if($ttl_nilai== 0 )return 0;
		return round($ttl_nilai/$ttl_sks, 2); 
	}
	
	function upload_prod_img($imgfile, $dir, $new_img_name) {
		$name = $imgfile['name'];
		if(strlen($name))
		{
			if($imgfile['size'] < 2097153 && $imgfile['error'] < 1 )
			{
				list($txt, $ext) = explode(".", $name);
				$valid_formats = array("jpg", "jpeg" ,"png", "gif", "bmp");
				if(in_array(strtolower($ext),$valid_formats))
				{
					$old_img = $imgfile['tmp_name'];				
					$img_lg = $dir.$new_img_name;

					$img = new SimpleImage();
					$img->load($old_img)->thumbnail(300, 400)->save($img_lg);
				} else{ }	//in array						
			} else { } //	$imgfile['size']
		} else{ } //strlen
	}

	function upload_bukti_transfer($imgfile, $dir, $new_img_name ) {
		$name = $imgfile['name'];
		if(strlen($name))
		{
			if($imgfile['size'] < 2097153 && $imgfile['error'] < 1 )
			{
				list($txt, $ext) = explode(".", $name);
				$valid_formats = array("jpg", "jpeg" ,"png", "gif", "bmp");
				if(in_array(strtolower($ext),$valid_formats))
				{
					$old_img = $imgfile['tmp_name'];				
					$img_lg = $dir.$new_img_name;
				
					$img = new SimpleImage();
					$img->load($old_img)->fit_to_width(600)->save($img_lg);
					
				} else{ }	//in array						
			} else { } //	$imgfile['size']
		} else{ } //strlen
	}
	
	public function next_semester($thn_akademis, $semester)
	{
		if($semester == 'Ganjil' ){
			$var['tahun'] = $thn_akademis;
			$var['smt'] = 'Genap';
		}else{
			$th = explode('-',$thn_akademis);			
			$var['tahun'] = $th[1].'-'.($th[1] + 1);
			$var['smt'] = 'Ganjil';
		}
		return $var;
	}
	
	function semester_aktif()
	{
		$smt_aktif = $this->get_row('semester', 'status', 'Aktif');
		return $smt_aktif->tahun_akademis.' '.$smt_aktif->semester;
	}

	function is_cuti($nim=NULL, $smt=NULL)
	{
		$this->db->where('nim',$nim);
		$this->db->where('smt_awal <=',$smt);
		$this->db->where('smt_akhir >=',$smt);		
		$query = $this->db->get('cuti');
		return ($query->num_rows()>=1);
	}


	function get_jadwal($id_prodi, $hari)
	{
		$query = "SELECT jadwal.* , mata_kuliah.semester, mata_kuliah.id_prodi FROM jadwal
					INNER JOIN mata_kuliah ON (mata_kuliah.id = jadwal.id_matkul)
					WHERE mata_kuliah.id_prodi = '$id_prodi' AND hari='$hari'
					GROUP BY jam_mulai, jam_selesai, id_matkul ORDER BY hari ASC, jam_mulai ASC";
		return $this->db->query($query);	
	}
	
	function get_dosen_mengajar($id_matkul, $id_ruang, $hari, $jam_mulai, $jam_selesai)
	{
		$this->db->where('id_matkul',$id_matkul);
		$this->db->where('id_ruang',$id_ruang);
		$this->db->where('hari',$hari);
		$this->db->where('jam_mulai',$jam_mulai);
		$this->db->where('jam_selesai',$jam_selesai);
		
		$var = $this->db->get('jadwal');

		$string = "";
		foreach ($var->result() as $key) {
			$string = $string.$this->get_data('dosen',$key->id_dosen,'nama')."<br>";
		}
		return $string;
	}
	
	function batas_registrasi()
	{
		$batas = $this->get_value('semester', 'status', 'aktif', 'batas_registrasi');
		if($this->get_tgl() <= $batas)
		return true;
		return false; 
	}
	function batas_input()
	{
		$batas = $this->get_value('semester', 'status', 'aktif', 'batas_input');
		if($this->get_tgl() <= $batas)
		return true;
		return false; 
	}
	
	function get_value_for_email($id)
	{
			return $this->db->where('id_permohonan_daftar',$id)->get('permohonan_daftar');
	}
	
	function status_mhs($status)
	{
		if($status == 0) {return 'Aktif'; }
		else if($status == 1) {return 'Alumni'; }
		else if($status == 2) {return 'Cuti'; }
		else if($status == 3) {return 'Non Aktif'; }
	}
	
	function semester_max($nim)
	{
		$this->db->where('id_mahasiswa',$nim);
		$this->db->select_max('semester');
		$query = $this->db->get('krs');
		return $query->row()->semester;
	}
	
	function angakatan_min()
	{
		$this->db->select_min('angkatan');
		$query = $this->db->get('vw_mahasiswa');
		return $query->row()->angkatan;
	}
	
	function thn_min()
	{
		$this->db->select_min('tahun_akademis');
		$query = $this->db->get('semester');
		return $query->row()->tahun_akademis;
	}
}

/* End of file filename.php */