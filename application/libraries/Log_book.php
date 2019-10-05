<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_book {

	public function __construct()
	{
        $this->ci = &get_instance();
    }

    function tambah($data)
    {
        $data['id_user']=$this->ci->session->userdata('userid');
        $data['action']="tambah";
        $data['status_sinkron']="pending";
        $data['id_log_book']=$this->ci->db->query("select UUID() as id")->row()->id;
        return $this->ci->db->insert('log_book',$data);
    }

    function edit($data)
    {
        $data['id_user']=$this->ci->session->userdata('userid');
        $data['action']="edit";
        $data['status_sinkron']="pending";
        $data['id_log_book']=$this->ci->db->query("select UUID() as id")->row()->id;
        return $this->ci->db->insert('log_book',$data);
    }

    function hapus($data)
    {
        $data['id_user']=$this->ci->session->userdata('userid');
        $data['action']="hapus";
        $data['status_sinkron']="pending";
        $data['id_log_book']=$this->ci->db->query("select UUID() as id")->row()->id;
        return $this->ci->db->insert('log_book',$data);
    }
}