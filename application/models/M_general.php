<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_general extends CI_Model
{		
	public function get_tgl()
	{
		return date("Y-m-d");
	}

	public function get_timestamp()
	{
		return date("Y-m-d H:i:s");
	}	

	public function format_date($format="Y-m-d", $tgl='')
	{
		if($tgl==''){ $tgl = date("Y-m-d"); }
		return date($format, strtotime($tgl));
	}	

	public function add_date($tgl)
	{
		return date("Y-m-d", strtotime("+1 day", strtotime($tgl)));
	}

	public function roman($bln)
	{
		if($bln == '1' ) return 'I';
		else if($bln == '2' ) return 'II';
		else if($bln == '3' ) return 'III';
		else if($bln == '4' ) return 'IV';
		else if($bln == '5' ) return 'V';
		else if($bln == '6' ) return 'VI';
		else if($bln == '7' ) return 'VII';
		else if($bln == '8' ) return 'VIII';
		else if($bln == '9' ) return 'IX';
		else if($bln == '10' ) return 'X';
		else if($bln == '11' ) return 'XI';
		else if($bln == '12' ) return 'XII';
	}
	
	public function number($n = '')
	{
		return ($n === '') ? '' : number_format( (float) $n, 0, ',', '.');
	}

	public function currency($n = 0)
	{
		$cur = number_format( (float) abs($n), 2, '.', ',');
		if($n >= 0) { return "<span>Rp. ".$cur."</span>";}
		else { return "<span class='red'>- Rp. ".$cur."</span>";}
	}

	public function currency_ajax($n = 0)
	{
		$cur = number_format( (float) abs($n), 2, '.', ',');
		if($n >= 0) { return "Rp. ".$cur."";}
		else { return "(Rp. ".$cur.")";}
	}

	public function currency_invoices($n = 0)
	{
		$cur = number_format( (float) abs($n), 0, '.', ',');
		if($n >= 0) { return "<span>Rp. ".$cur."</span>";}
		else { return "<span class='red'>- Rp. ".$cur."</span>";}
	}

	public function currency_edit($n = 0)
	{
		$cur = number_format( (float) abs($n), 0, '.', ',');
		return $cur;
	}

	public function currency_ammount($n = 0)
	{
		$cur = number_format( (float) abs($n), 2, '.', ',');
		return "$cur";
	}

	public function currency_total_ammount($n = 0)
	{
		$cur = number_format( (float) abs($n), 2, '.', ',');
		return "Rp. $cur";
	}
	
	public function msg_box($class, $msg)
	{
		if($class=='success') {
			$this->session->set_flashdata('msg',"<div class='alert alert-success'><strong>Success</strong><br>$msg</div>");
		}
		else { $this->session->set_flashdata('msg',"<div class='alert alert-warning'><strong>Terjadi Kesalahan!!</strong><br>$msg</div>"); }
	}
	
	//genric query
	public function select_db($tbl, $sort_col=NULL, $sort='ASC')
	{
		$this->db->where('deleted','0');
		if($sort_col != NULL) { $this->db->order_by($sort_col, $sort); }
		return $this->db->get($tbl);
	}

	public function select_db_custom($tbl, $where, $id, $sort_col=NULL, $sort='ASC')
	{
		$this->db->where('deleted','0');
		$this->db->where($where,$id);
		if($sort_col != NULL) { $this->db->order_by($sort_col, $sort); }
		return $this->db->get($tbl);
	}

	public function select_all($tbl, $sort_col=NULL, $sort='ASC')
	{
		$this->db->where('deleted','0');
		if($sort_col != NULL) { $this->db->order_by($sort_col, $sort); }
		return $this->db->get($tbl);
	}

	public function select($tbl, $sort_col=NULL, $sort='ASC')
	{
		if($sort_col != NULL) { $this->db->order_by($sort_col, $sort); }
		return $this->db->get($tbl);
	}

	public function get_row($tbl, $id)
	{
		$this->db->where('deleted','0');
		$this->db->where('id',$id);
		$query = $this->db->get($tbl);
		return $query->row();	
	}

	public function get_row_custom($tbl,$where, $id)
	{
		$this->db->where('deleted','0');
		$this->db->where($where,$id);
		$query = $this->db->get($tbl);
		return $query->row();	
	}

	public function get_row_custom_with_del($tbl,$where, $id)
	{
		$this->db->where('deleted','1');
		$this->db->where($where,$id);
		$query = $this->db->get($tbl);
		return $query->row();	
	}

	public function get_data($tbl, $id, $col)
	{
		if($id == NULL || $id == '') { return '';}
		else if( ! $this->exists($tbl, 'id', $id)) { return '';  }
		$this->db->where('id',$id);
		$query = $this->db->get($tbl);
		return $query->row()->$col;
	} 

	public function get_value($tbl = NULL, $col = NULL, $val = NULL, $field = NULL)
	{
		if($tbl == NULL || $col == NULL || $val == NULL || $field == NULL) { return '';}
		else if( ! $this->exists($tbl, $col, $val)) { return '';  }
		$this->db->where($col,$val);
		$query = $this->db->get($tbl);
		return $query->row()->$field;
	}

	public function get_id($tbl, $col, $val)
	{
		$this->db->where($col,$val);
		$query = $this->db->get($tbl);
		return $query->row()->id;
	}
	
	function get_ai($tbl)
	{		
		$row = $this->db->query("SHOW TABLE STATUS LIKE '$tbl' ")->row();		
		return $row->Auto_increment;
	}

	public function insert_db($tabel, $data)
	{
		if($this->db->insert($tabel,$data))
		return true;
		return false;
	}

	public function insert_batch_db($tabel, $data)
	{
		if($this->db->insert_batch($tabel,$data))
		return true;
		return false;
	}

	public function update_batch_db($tabel, $data, $id)
	{
		if($this->db->update_batch($tabel, $data, $id))
		return true;
		return false;
	}

	function update_db($tabel, $id, $data)
	{
		$this->db->where('id',$id);
		if($this->db->update($tabel,$data))
		return true;
		return false;
	}

	function update_db_custom($tabel, $where, $id, $data)
	{
		$this->db->where($where,$id);
		if($this->db->update($tabel,$data))
		return true;
		return false;
	}

	function delete_db($tabel, $id)
	{
		$this->db->where('id', $id);
		if($this->db->delete($tabel))
		return true;
		return false;
	}

	function delete_db_custom($tabel, $where, $id)
	{
		$this->db->where($where, $id);
		if($this->db->delete($tabel))
		return true;
		return false;
	}
	
	public function exists($tabel,$col,$value)
	{
		$this->db->select($col);
		$this->db->from($tabel);
		$this->db->where('deleted','0');
		$this->db->where($col,$value);
		$query = $this->db->get();		
		return ($query->num_rows()==1);
	}
	
	public function num_row($tabel,$col,$value)
	{
		$this->db->where('deleted','0');
		$this->db->where($col,$value);
		$query = $this->db->get($tabel);		
		return $query->num_rows();
	}

	public function paid_status($balance=NULL)
	{
		if($balance<=0){ return '<span class="label label-success">Paid in full</span>'; }
		else{ return '<span class="label label-danger">No due date</span>'; }
	}

	public function get_no_otomatis($tbl)
	{
		  $i=1;
		  $cek_akhir=0;
		  $all_inv = count($this->select_db($tbl)->result());
		  //echo $all_inv;
		  foreach ($this->select_db($tbl)->result() as $key ) {
				// IF DEPAN ADA TULISAN INV BARU JALANIN KODE DI BAWAH INI BIAR GA ERROR NNTI  
				// IF DEPAN ADA TULISAN INV BARU JALANIN KODE DI BAWAH INI BIAR GA ERROR NNTI  
				//echo $this->db->last_query();

				//$aas = explode("/", $key->no_inv);
				//$no = str_replace("INV", "", $aa[0]);
				$ii = sprintf("%03d",$i);

				$yo = 0; 
				foreach ($this->select_db($tbl)->result() as $keyb ) {
						$aa = explode("/", $keyb->no_inv);
						if($tbl == "siak_tr_invoice")
							$no = str_replace("INV", "", $aa[0]);
						else if($tbl == "siak_tr_journal_entry")
							$no = str_replace("JU", "", $aa[0]);
						else 
							$no = str_replace("PI", "", $aa[0]);
						
						//echo $yo." ".$ii." ".$no."<br>";
						if($ii == $no)
						{
								//echo "ada $ii<br>";
								//echo "input pake no $ii"."<br>";
								//$cek_akhir=1;
								break;
						}
						$yo++;

						if($yo == $all_inv)
						{
							//echo "inv ini yang di pake $ii <br>";
							break;
						}
				}

				if($yo == $all_inv)
				{
					break;
				}
				$i++;  
		  }
		  //echo $i;
		  if($cek_akhir == 0)
		  {
		    $ii = sprintf("%03d",$i);
		    return $ii;
		    //echo "inputs pake no $ii"."<br>";
		  }
	}

	public function get_periode_akttif_mhs()
	{
		return $this->db->get_where('pddikti_re_semester',array('a_smt_aktif'=>'1'))->row()->id_smt;
	}

	public function get_format_date($date)
	{
		return $date;
	}

	public function getSelectedData($table, $data)
	{
		return $this->db->get_where($table, $data);
	}	

	public function set_all()
	{
		$data  = array(
			'status'=> '3'  
		);

		$this->db->update('siak_tr_purchase_item', $data);

		$this->db->update('siak_tr_receipt_item', $data);
		//echo $this->db->last_query();
		$this->db->update('siak_tr_inv_item', $data);

		$this->db->update('siak_tr_journal_entry_item', $data);

		$this->db->update('siak_tr_cash_transfer', $data);

		$this->db->update('siak_tr_payslips_item', $data);

		$this->db->update('siak_tr_fixed_asset_dep', $data);
	}
}

/* End of file filename.php */