<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_m extends CI_Model {
	
	function get_table_data($table=NULL,$where=NULL,$limit=NULL,$offset=NULL) {
		if($table == NULL)
			return FALSE;
		if($where != NULL)
			$this->db->where($where);
		if($limit != NULL && $offset == NULL)
			$this->db->limit($limit);
		else if($limit != NULL && $offset != NULL)
			$this->db->limit($offset,$limit);
		return $this->db->get($table);
	}

	function save($table=NULL,$db_data=NULL) {
		if($table == NULL || $db_data == NULL)
			return FALSE;
		$this->db->insert($table,$db_data);
	}

	function update($table=NULL,$db_data=NULL,$where=NULL) {
		if($table == NULL || $db_data == NULL)
			return FALSE;
		if($where != NULL)
		$this->db->where($where);
		$this->db->update($table,$db_data);
	}
	
	function delete($table=NULL,$where=NULL) {
		if($where != NULL)
		$this->db->where($where);
		$this->db->delete($table);
	}
}