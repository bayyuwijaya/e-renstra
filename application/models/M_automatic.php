<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_automatic extends CI_Model 
{			
	//!! NOTE : INGAT KLO ADA PERUBAHAN , BERUBAH JUGA DI DAFTAR ONLINE DAN SIAKAD
	public function langsung_insert_db($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran = null , $id_kategori = null)
	{
	    //echo $this->db->last_query();
	    $arr1 = array();
	    $arr2 = array();

	    $id = $this->M_general->get_ai('siak_tr_invoice');
	    $iii = $id;
	    //get data siswa yang udah di insert

	    if($untuk == 'sekolah')
	    {
	      $this->db->select('*');
	      $this->db->from('sekolah_tr_siswa s');
	      $this->db->join('sekolah_tr_siswa_pt spt', 's.id_pd = spt.id_pd and spt.deleted = "0"','left');
	      $this->db->where('s.deleted','0');
	      $this->db->where('spt.id_reg_pd',$id_reg_pd);
	      $key = $this->db->get()->row();

	      //get grup invoice 
	      $this->db->select('*');
	      $this->db->from('siak_tr_group_invoice');
	      $this->db->where('deleted','0');
	      $this->db->where('id_sp',$id_sp);
	      $this->db->where('id_sms',$id_sms);
	      if($id_thn_ajaran != null)
	        $this->db->where('id_thn_ajaran',$id_thn_ajaran);
	      if($id_kategori != null)
	        $this->db->where('id_kategori',$id_kategori);

	      $get_invoice = $this->db->get();
	      //echo $this->db->last_query()."<br><br>";
	    }

	    if($untuk == 'kuliah')
	    {
	      $this->db->select('*');
	      $this->db->from('pddikti_tr_mahasiswa s');
	      $this->db->join('pddikti_tr_mahasiswa_pt spt', 's.id_pd = spt.id_pd and spt.deleted="0"','left');
	      $this->db->where('s.deleted','0');
	      $this->db->where('spt.id_reg_pd',$id_reg_pd);
	      $key = $this->db->get()->row();

	      //get grup invoice 
	      $this->db->select('*');
	      $this->db->from('siak_tr_group_invoice');
	      $this->db->where('deleted','0');
	      $this->db->where('id_sp',$id_sp);
	      $this->db->where('id_sms',$id_sms);
	      if($id_thn_ajaran != null)
	        $this->db->where('id_smt',$id_thn_ajaran);
	      if($id_kategori != null)
	        $this->db->where('id_kategori',$id_kategori);

	      $get_invoice = $this->db->get();
	      //echo $this->db->last_query()."<br><br>";
	    }
	    
	    //echo $get_invoice->num_rows();
	    if($get_invoice->num_rows() > 0) {
	      $id_invs = $iii;
	      $id_group_invoice = $get_invoice->row()->id;
	      
	      foreach ($get_invoice->result() as $keya ) {
					$no_inv = 'INV'.sprintf("%03d",$id_invs).'/SIAK/'.$this->M_general->roman(date("n")).'/'.date("Y");
			
					$data = array(
						'id'	=>	$iii,
						'id_group_invoice'	=>	$id_group_invoice,
						'id_kategori'	=>	$id_kategori,
						'tgl'	=>	$keya->tgl,
						'no_inv'	=>	$no_inv,
						'no_po'	=>	'',
						'id_cust'	=>	$key->id_reg_pd,
						'addr'	=>	$key->jln == null ? '' : $key->jln,
						'desc'	=>	$keya->desc,
						'note'	=>	$keya->note,
						'untuk'	=>	$keya->untuk
		      );
		      array_push($arr1, $data);

		      if($untuk == 'sekolah')
	    	  {
		       	//get grup invoice item
		      	$this->db->select('gii.*');
		      	$this->db->from('siak_tr_group_invoice gi');
		      	$this->db->join('siak_tr_group_inv_item gii', 'gi.id = gii.id_inv');
		      	$this->db->where('gi.deleted','0');
		      	$this->db->where('gi.id_sp',$id_sp);
		      	$this->db->where('gi.id_sms',$id_sms);
		      	$this->db->where('gi.id',$keya->id);
		      	if($id_thn_ajaran !=null)
		        	$this->db->where('gi.id_thn_ajaran',$id_thn_ajaran);
		      	if($id_kategori !=null)
		        	$this->db->where('gi.id_kategori',$id_kategori);
					}
					
		      if($untuk == 'kuliah')
		      {
						//get grup invoice item
						$this->db->select('gii.*');
						$this->db->from('siak_tr_group_invoice gi');
						$this->db->join('siak_tr_group_inv_item gii', 'gi.id = gii.id_inv');
						$this->db->where('gi.deleted','0');
						$this->db->where('gi.id_sp',$id_sp);
						$this->db->where('gi.id_sms',$id_sms);
						$this->db->where('gi.id',$keya->id);
						if($id_thn_ajaran !=null)
								$this->db->where('gi.id_smt',$id_thn_ajaran);
						if($id_kategori !=null)
								$this->db->where('gi.id_kategori',$id_kategori);
		      }
					$get_invoice_item = $this->db->get();	      
		      foreach ($get_invoice_item->result() as $keyb ) {
		        $data2=array(
		          'id_inv'	=>	$iii,
		          'id_group_invoice'	=>	$id_group_invoice,
		          'id_kategori'	=>	$id_kategori,
		          'acc'	=>	$keyb->acc,
		          'desc'	=>	$keyb->desc,
		          'qty'	=>	$keyb->qty,
		          'price'	=>	str_replace(",", "", $keyb->price),
		          'disc'	=>	$keyb->disc,
		          'tax'	=>	$keyb->tax,
		          'added_by'	=>	$this->session->userdata('userid'),
		          'date_added'	=>	date('Y-m-d h:i:s')
		        );
		        array_push($arr2, $data2);  
		      }
		      $iii++;
	      }	     	      
	    } 
	    if(count($arr1) > 0)
	      $this->M_general->insert_batch_db('siak_tr_invoice', $arr1);
	    if(count($arr2) > 0)
	      $this->M_general->insert_batch_db('siak_tr_inv_item', $arr2);
	}

	//!! NOTE : INGAT KLO ADA PERUBAHAN , BERUBAH JUGA DI DAFTAR ONLINE DAN SIAKAD
	public function update_insert_db($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran , $id_kategori)
	{
		$arr2 = array();
		
		//get id invoice sebelumnya
		$get = $this->M_general->get_row_custom('siak_tr_invoice', 'id_cust', $id_reg_pd);

		//update jadi kategori baru
		$data_update_inv = array(
			'id_kategori' => $id_kategori, 
		);
		$this->M_general->update_db_custom('siak_tr_invoice','id',$get->id, $data_update_inv);

		$this->db->where('id_inv ',$get->id);
		$this->db->where('id_kategori !=','0');
		if($this->db->delete('siak_tr_inv_item')==true)
		{
			$this->db->select('gi.id as id_group_invoice, gii.*');
			$this->db->from('siak_tr_group_invoice gi');
			$this->db->join('siak_tr_group_inv_item gii', 'gi.id = gii.id_inv');
			$this->db->where('gi.deleted','0');
			$this->db->where('gi.id_sp',$id_sp);
			$this->db->where('gi.id_sms',$id_sms);
			$this->db->where('gi.id_thn_ajaran',$id_thn_ajaran);
			$this->db->where('gi.id_kategori',$id_kategori);

			$get_invoice_item = $this->db->get();
			//echo $this->db->last_query()."<br>";
			foreach ($get_invoice_item->result() as $keyb ) {
				$data2=array(
				  'id_inv'=>$get->id,
				  'id_group_invoice'=>$keyb->id_group_invoice,
				  'id_kategori'=>$id_kategori,
				  'acc'=>$keyb->acc,
				  'desc'=>$keyb->desc,
				  'qty'=>$keyb->qty,
				  'price'=>str_replace(",", "", $keyb->price),
				  'disc'=>$keyb->disc,
				  'tax'=>$keyb->tax,
				  'added_by'=>$this->session->userdata('userid'),
				  'date_added'=>date('Y-m-d h:i:s')
				);
				array_push($arr2, $data2);
				//echo "insert data ";	
			}
			if(count($arr2) > 0)
				$this->M_general->insert_batch_db('siak_tr_inv_item', $arr2);
		}	
		//echo $this->db->last_query();
	}

	//!! NOTE : INGAT KLO ADA PERUBAHAN , BERUBAH JUGA DI DAFTAR ONLINE DAN SIAKAD
	public function get_semua_biaya($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran = null , $id_kategori = null)
	{
		//cek di invoice ada id_reg_pd atau tidak
		$cek = $this->M_general->select_db_custom('siak_tr_invoice','id_cust', $id_reg_pd)->num_rows();
		if($cek > 0) {
			//echo  "ada hapus dulu inv item dan get id_invnya<br>";
			//sementara di disable dlu 
			//$this->update_insert_db($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran , $id_kategori);
		} else {
			//echo "langsung insert saja<br>";
			$this->langsung_insert_db($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran , $id_kategori);
		}
	}

	//!! NOTE : INGAT KLO ADA PERUBAHAN , BERUBAH JUGA DI DAFTAR ONLINE DAN SIAKAD
	public function get_semua_biaya_update($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran = null , $id_kategori = null)
	{
		//cek dulu invoice yang ada sekarang oleh siswa/mhs
		//kalo ada invoice dengan ada transaksi di dalamnya
			//pesan update gagal karena sudah ada transaksi masuk, jadi update manual saja
		//kalo ada invoice tapi tidak ada transaksi di dalamnya
			//hapus semua invoice dan invoice item, ganti dengan invoice yg baru (pake langsung method langsung_insert_db)

		//cek invoice mahasiswa
		$ada = 0;

		$this->db->select('*');
		$this->db->from('siak_tr_invoice');
		$this->db->where('id_cust',$id_reg_pd);
		$this->db->where('deleted','0');
		$query = $this->db->get();

		//echo "<br>".$this->db->last_query()."<br><br>";

		foreach ($query->result() as $key ) {
			
			$this->db->where('id_inv',$key->id);
			foreach ($this->M_general->select_db('siak_tr_receipt_item')->result() as $keya) {
				$ada = 1;
			}
		}
		if($ada == 1) {
			//echo "ada transaksi di invoice ini, silahkan edit manual invoice siswa yang bersangkutan<br>";
			$this->M_general->msg_box('error','Sistem Tidak bisa mengubah harga invoice secara otomatis.<br>
			 Dikarenakan sistem sudah membaca adanya <b>TRANSAKSI</b> pada invoice tersebut<br> SILAHKAN EDIT MANUAL INVOICE JIKA ADA PERUBAHAN BIAYA ');
		} else {
			//echo "delete invoice beserta semua itemnya dan tambah invoice baru<br>";
			$this->db->select('*');
			$this->db->from('siak_tr_invoice');
			$this->db->where('id_cust',$id_reg_pd);
			$this->db->where('deleted','0');
			$query_del = $this->db->get();

			foreach ($query->result() as $keys ) {
				if($this->M_general->delete_db_custom('siak_tr_invoice', 'id', $keys->id)==true) {
					$this->M_general->delete_db_custom('siak_tr_inv_item', 'id_inv', $keys->id);
				}
			}
			$this->langsung_insert_db($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran , $id_kategori);
			$this->M_general->msg_box('success','Data Invoice Lama sudah di hapus dan digantikan dengan Invoice Baru');
			/*
			if($this->M_general->delete_db_custom('siak_tr_invoice', 'id_cust', $id_reg_pd)==true)
			{
				//delete juga siak_tr_inv_item

				$this->langsung_insert_db($untuk, $id_reg_pd, $id_sp, $id_sms, $id_thn_ajaran , $id_kategori);
				$this->M_general->msg_box('success','Data Invoice Lama sudah di hapus dan digantikan dengan Invoice Baru');
			}
			else
			{
				$this->M_general->msg_box('error','Kesalahan dalam update database ..');
			}
			*/
		}
	}
}

