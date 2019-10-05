<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeder2 {

	public function __construct()
	{
        $this->CI = &get_instance();
        $this->url='http://localhost:8082/ws/sandbox2.php';
        $this->username='083065';
        $this->password='w2fwp2017yyf';
    }

    function runWS($data, $type='json')
    {
        $ch=curl_init();

        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[]='Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $data=json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result=curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function GetToken2()
    {
        return json_decode($this->runWS(array('act'=>'GetToken','username'=>$this->username,'password'=>$this->password)))->data->token;
        
    }

    function GetToken()
    {
        $data = array(
            'act'=>'GetToken',
            'username'=>$this->username,
            'password'=>$this->password
        );

 
        return json_decode($this->runWS($data))->data->token;
      
    }

    function InsertBiodataMahasiswa($data,$token)
    {
        $data = array(
            'act'=>'InsertBiodataMahasiswa',
            'token'=>$token,
            'record'=>$data,
            
        );

       
        return $this->runWS($data);
       
    }


    function ListTable($proxy,$token)
    {
        return $proxy->ListTable($token);
    }

    function GetDictionary($proxy,$token,$table)
    {
        return $proxy->GetDictionary($token,$table);
    }

    function GetRecord($proxy,$token,$table,$filter)
    {
        return $proxy->GetRecord($token,$table,$filter);
    }

    function GetRecordset($proxy,$token,$table,$filter,$order,$limit,$offset)
    {
        return $proxy->GetRecordset($token,$table,$filter,$order,$limit,$offset);
    }

    function GetCountRecordSet($proxy,$token,$table,$filter)
    {
        return $proxy->GetCountRecordSet($token,$table,$filter);
    }

    function GetDeletedRecordSet($proxy,$token,$table,$filter,$order,$limit,$offset)
    {
        return $proxy->GetDeletedRecordSet($token,$table,$filter,$order,$limit,$offset);
    }

    function InsertRecord($proxy,$token,$table,$data)
    {
        return $proxy->InsertRecord($token,$table,$data);
    }

    function UpdateRecord($proxy,$token,$table,$data)
    {
        return $proxy->UpdateRecord($token,$table,$data);
    }

    function DeleteRecord($proxy,$token,$table,$data)
    {
        return $proxy->DeleteRecord($token,$table,$data);
    }

    function RestoreRecord($proxy,$token,$table,$data)
    {
        return $proxy->RestoreRecord($token,$table,$data);
    }

    function GetListNilai($proxy,$token,$filter,$order,$limit,$offset)
    {
        return $proxy->GetListNilai($token,$filter,$order,$limit,$offset);
    }

    function GetListPenugasanDosen($proxy,$token,$filter,$order,$limit,$offset)
    {
        return $proxy->GetListPenugasanDosen($token,$filter,$order,$limit,$offset);
    }

    function GetListDosenPengajar($proxy,$token,$filter,$order,$limit,$offset)
    {
        return $proxy->GetListDosenPengajar($token,$filter,$order,$limit,$offset);
    }

    function GetListDosenPembimbing($proxy,$token,$filter,$order,$limit,$offset)
    {
        return $proxy->GetListDosenPembimbing($token,$filter,$order,$limit,$offset);
    }

    function GetListDosen($proxy,$token,$filter,$order,$limit,$offset)
    {
        return $proxy->GetListDosen($token,$filter,$order,$limit,$offset);
    }

    function GetListSubstansiKuliah($proxy,$token,$filter,$order,$limit,$offset)
    {
        return $proxy->GetListSubstansiKuliah($token,$filter,$order,$limit,$offset);
    }
}