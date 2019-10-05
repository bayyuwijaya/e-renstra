<?php

class Import_model extends CI_Model {
	
	public function select_db($tbl,$col=NULL, $col_val=NULL,$sort_col=NULL, $sort='ASC')
    {
        if($col != NULL) {$this->db->where($col,$col_val); }        
        if($sort_col != NULL) {$this->db->order_by($sort_col, $sort); }
        return $this->db->get($tbl);
    }
    
    public function select_db_search($tbl,$col,$search)
    {
        $this->db->like($col,$search);
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

    public function exists4($tabel, $col1,$value1, $col2,$value2, $col3,$value3, $col4,$value4)
    {
        $this->db->where($col1,$value1);
        $this->db->where($col2,$value2);
        $this->db->where($col3,$value3);
        $this->db->where($col4,$value4);
        $query = $this->db->get($tabel);        
        return ($query->num_rows()==1);
    }

    public function exists3($tabel, $col1,$value1, $col2,$value2, $col3,$value3)
    {
        $this->db->where($col1,$value1);
        $this->db->where($col2,$value2);
        $this->db->where($col3,$value3);
     
        $query = $this->db->get($tabel);        
        return ($query->num_rows()==1);
    }

    public function get_row_custom4($tabel, $col1,$value1, $col2,$value2, $col3,$value3, $col4,$value4)
    {
        $this->db->where($col1,$value1);
        $this->db->where($col2,$value2);
        $this->db->where($col3,$value3);
        $this->db->where($col4,$value4);
        $query = $this->db->get($tabel);
        return $query->row();   
    }

    public function get_row_custom3($tabel, $col1,$value1, $col2,$value2, $col3,$value3)
    {
        $this->db->where($col1,$value1);
        $this->db->where($col2,$value2);
        $this->db->where($col3,$value3);
     
        $query = $this->db->get($tabel);
        return $query->row();   
    }

    public function get_row_custom2($tabel, $col1,$value1, $col2,$value2)
    {
        $this->db->where($col1,$value1);
        $this->db->where($col2,$value2);
     
        $query = $this->db->get($tabel);
        return $query->row();   
    }

    public function get_row_custom($tabel, $col1,$value1)
    {
        $this->db->where($col1,$value1);
      
        $query = $this->db->get($tabel);
        return $query->row();   
    }


    function update_data($tabel, $data, $kolom_where, $id_where)
    {
        $this->db->where($kolom_where, $id_where);
        return $this->db->update($tabel, $data);
    }

    function insert_data($tabel, $data)
    {
        return $this->db->insert($tabel,$data);
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

   


	
	
}