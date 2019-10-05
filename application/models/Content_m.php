<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_m extends CI_Model
{

    function __construct() 
    {
        parent::__construct();
    }


    public function get_kk($a, $b, $c, $c1, $d, $d1, $e, $f, $h, $i, $j, $k, $n, $o, $p, $q){
        $this->db->where('a_kk_a',$a);
        $this->db->where('a_kk_b',$b);
        $this->db->where('a_kk_c',$c);
        $this->db->where('a_kk_c1',$c1);
        $this->db->where('a_kk_d',$d);
        $this->db->where('a_kk_d1',$d1);
        $this->db->where('a_kk_e',$e);
        $this->db->where('a_kk_f',$f);
        $this->db->where('a_kk_h',$h);
        $this->db->where('a_kk_i',$i);
        $this->db->where('a_kk_j',$j);
        $this->db->where('a_kk_k',$k);
        $this->db->where('a_kk_n',$n);
        $this->db->where('a_kk_o',$o);
        $this->db->where('a_kk_p',$p);
        $this->db->where('a_kk_q',$q);

        return $this->db->get('pddikti_re_kebutuhan_khusus');
  
    }

    public function currency($n = 0)
    {
        $cur = number_format( (float) abs($n), 2, '.', ',');
        if($n >=0){ return "<span>Rp. ".$cur."</span>";}
        else{ return "<span class='red'>- Rp. ".$cur."</span>";}
    }
    
    public function get_autocomplete()
    {
        $this->db->like('nm_wil',$this->input->post('queryString'));
        return $this->db->get('table', 10);    
    }

    function get_all_akun_non_admin()
    {
        $this->db->order_by('nm_sdm','ASC');
        $this->db->where('deleted','0');
        return $this->db->get('global_employee');   
    }

    function get_akun_non_admin($userid)
    {
        $this->db->where('id_sdm',$userid);
        $this->db->where('deleted','0');
        return $this->db->get('global_employee');   
    }

    public function select_db($tbl,$col=NULL, $col_val=NULL,$sort_col=NULL, $sort='ASC')
    {
        $this->db->where('deleted','0');
        if($col != NULL) {$this->db->where($col,$col_val); }        
        if($sort_col != NULL) {$this->db->order_by($sort_col, $sort); }
        return $this->db->get($tbl);
    }

    public function get_where($tbl, $field, $val)
    {
        $this->db->select('*');
        $this->db->where($field, $val);
        $query = $this->db->get($tbl);
        return $query->row();
    }

    public function get_row($tbl, $col, $val)
    {
        $this->db->where($col,$val);
        $query = $this->db->get($tbl);
        return $query->row();   
    }
    
    public function get_last_value($tbl, $col, $field) 
    {
        $this->db->select('*');
        $this->db->order_by($col,'desc');
        $this->db->limit(1);
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

    public function msg_box($class, $msg)
    {
        
        if($class=='success'){
            $this->session->set_flashdata('msg',"<div class='alert alert-success'><strong>Berhasil !!</strong><br>$msg</div>");
        }
        else{ $this->session->set_flashdata('msg',"<div class='alert alert-warning'><strong>Terjadi Kesalahan !!</strong><br>$msg</div>"); }
    }


    public function get_value($tbl=NULL, $col=NULL, $val=NULL, $field=NULL)
    {
        if($tbl==NULL || $col==NULL || $val==NULL || $field==NULL){ return ''; }
        else if(!$this->exists($tbl, $col, $val)){ return '';  }
        $this->db->where($col,$val);
        $query = $this->db->get($tbl);
        return $query->row()->$field;
    }

    public function get_row_custom($tbl,$where, $id)
    {
        $this->db->where($where,$id);
        $query = $this->db->get($tbl);
        return $query->row();   
    }

     public function get_row_custom2($tbl,$where, $id, $where2, $id2)
    {
        $this->db->where($where,$id);
        $this->db->where($where2,$id2);
        $query = $this->db->get($tbl);
        return $query->row();   
    }

    public function select_db_custom($tbl, $where, $id, $sort_col=NULL, $sort='ASC')
    {
        //$this->db->where('deleted','0');
        $this->db->where($where,$id);
        if($sort_col != NULL) {$this->db->order_by($sort_col, $sort); }
        return $this->db->get($tbl);
    }

    public function select_db_custom2($tbl, $where, $id, $where2, $id2, $sort_col=NULL, $sort='ASC')
    {
        //$this->db->where('deleted','0');
        $this->db->where($where,$id);
        $this->db->where($where2,$id2);
        if($sort_col != NULL) {$this->db->order_by($sort_col, $sort); }
        return $this->db->get($tbl);
    }
    
    public function exists($tabel,$col,$value)
    {
        $this->db->where($col,$value);
        $query = $this->db->get($tabel);        
        return ($query->num_rows()==1);
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

    function insert_registrasi_online($data)
    {
        return $this->db->insert('permohonan_daftar_mhs',$data);
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
   
    function get_all_admin()
    {
        $this->db->order_by('nm_sdm','ASC');
        return $this->db->get('global_employee');   
    }

    function get_admin($userid)
    {
        $this->db->where('id_sdm',$userid);
        return $this->db->get('global_employee');   
    }

    function get_all_dosen()
    {
        $this->db->order_by('nm_sdm','ASC');
        return $this->db->get('pddikti_tr_dosen');   
    }

    public function insert_batch_db($tabel, $data)
    {
        if($this->db->insert_batch($tabel,$data))
        return true;
        return false;
    }

}
