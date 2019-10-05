<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeder {

	public function __construct()
	{
        $this->CI = &get_instance();
        require_once(str_replace("\\","/",APPPATH).'libraries/nusoap/nusoap.php');
        require_once(str_replace("\\","/",APPPATH).'libraries/nusoap/class.wsdlcache.php');
    }

    function GetProxy()
    {
        $client = new nusoap_client('http://localhost:8082/ws/sandbox.php?wsdl', true);
		$proxy = $client->GetProxy();
		if ($proxy == NULL)
		{
			return false;
		}
		else
		{
			return $proxy;
		}
    }

    function GetToken($proxy)
    {
		return $proxy->GetToken('username','password');
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

    function InsertRecordSet($proxy,$token,$table,$data)
    {
         return $proxy->InsertRecordset($token, $table, $data);
       
    }

    function UpdateRecord($proxy,$token,$table,$data)
    {
        return $proxy->UpdateRecord($token,$table,$data);
    }

    function UpdateRecordSet($proxy,$token,$table,$data)
    {
        return $proxy->UpdateRecordSet($token,$table,$data);
    }

    function DeleteRecord($proxy,$token,$table,$data)
    {
        return $proxy->DeleteRecord($token,$table,$data);
    }

    function DeleteRecordSet($proxy,$token,$table,$data)
    {
        return $proxy->DeleteRecordSet($token,$table,$data);
    }

    function RestoreRecord($proxy,$token,$table,$data)
    {
        return $proxy->RestoreRecord($token,$table,$data);
    }

    function RestoreRecordSet($proxy,$token,$table,$data)
    {
        return $proxy->RestoreRecordSet($token,$table,$data);
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