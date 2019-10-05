<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model
{
    function __construct() 
    {
        parent::__construct();
    }

    public function cek_login($username,$password)
    {    
        $valid = $this->db->where('username',$username)->where('password',$password)->get('global_user');
        if($valid->num_rows() == 1)
        {
            return true;   
        }
        else
            return FALSE;
    }

    function getAllData($namaContent)
    {
        $query = "SELECT * FROM `$namaContent`";
        $result = mysql_query($query);
        $hasil = array();
        while ($row = mysql_fetch_array($result)) 
        {
            $hasil[] = $row;
        }   

        return $hasil;
    }

    function getAllDataNested($namaContent, $id_content_root)
    {
        $w = "id_".$namaContent."_root";
        $query = "SELECT * FROM `$namaContent` WHERE `$w` = '$id_content_root'";
        
        $result = mysql_query($query);
        $hasil = array();
        while ($row = mysql_fetch_array($result)) 
        {
            $hasil[] = $row;

        }   
        
        return $hasil;     
    }

    function getNumFileds($namaContent)
    {
        $query = "SELECT * FROM `$namaContent`";
        $result = mysql_query($query);
        $num_field = mysql_num_fields($result);
        return $num_field;
    }

    function getDataFields($namaContent)
    {
        $query = "SELECT * FROM `$namaContent`";
        $result = mysql_query($query);
        $num_rows = mysql_num_fields($result);

        $hasil = array();

        for($i=0; $i<$num_rows; $i++)
        {
            $hasil[$i] = mysql_field_name($result, $i);
        }

        return $hasil;
    }

    function getTipeFields($namaContent)
    {
        $query = "SELECT * FROM `$namaContent`";
        $result = mysql_query($query);
        $num_rows = mysql_num_fields($result);

        $hasil = array();

        for($i=0; $i<$num_rows; $i++)
        {
            $hasil[$i] = mysql_field_type($result, $i);
        }

        return $hasil;
    }

    function getDataRowFields($id, $namaContent)
    {
        $query = "SELECT * FROM `$namaContent` WHERE id_$namaContent = '$id'";

        $result = mysql_query($query);
        $hasil = array();
        while ($row = mysql_fetch_array($result)) 
        {
            $hasil[] = $row;
        }   

        return $hasil;
    }

    public function insertContent($string, $namaContent)
    {
        $query = "INSERT INTO $namaContent VALUES($string)";
        $result = mysql_query($query);
    }

    public function updateContent($string, $namaContent ,$id)
    {
        $query = "UPDATE $namaContent SET $string WHERE id_$namaContent = '$id' ";
        $result = mysql_query($query);
    }

    public function deleteContent($id, $namaContent)
    {
        $query = "DELETE FROM $namaContent WHERE id_$namaContent = '$id'";
        $result = mysql_query($query);
    }
}

/* End of file filename.php */