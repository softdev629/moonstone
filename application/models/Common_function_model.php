<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_function_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function GetValue($table,$field,$where,$condition) //Get field value in the database//
	{
		$this->db->select($field);
		$this->db->where($where,$condition);
		$querycat = $this->db->get($table);
		foreach ($querycat->result() as $row)
	   	{
		  return $row->$field;
	   	}
	}
	// this is to get filed value in database
	function GetDuplicateValue($table,$field,$field_val,$where,$condition) //Get field value in the database//
	{
		$where_array = array($field => $field_val,''.$where.' !=' => $condition);
		$this->db->select($field);
		$this->db->where($where_array);
		$querycat = $this->db->get($table);
		foreach ($querycat->result() as $row)
	   	{
		  return $row->$field;
	   	}
	}
	// this is to get filed value in database
	function CountByTable($table,$where)
	{
		if($table=='content')
		{
			$querycat = $this->db->get($table);
			return $this->db->affected_rows();
		}
		else
		{
			$qry='SELECT * FROM `'.$table.'` '.$where.'';
			$query = $this->db->query($qry);
			return $query->num_rows();
		}


    }
	function total_count_byid($table,$id,$field)
	{

		$this->db->select('*');

		$this->db->from($table);

		$this->db->where($field, $id);

		$total_sold = $this->db->count_all_results();

		if ($total_sold > 0)
		{
			return $total_sold;
		}

		return NULL;

	}
	function sql_detial()
	{
		$sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );
		return  $sql_details;
	}
	function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
	}
	function update_is_active($val,$id,$fieldName,$fieldId,$tableName)
	{
		$data=array($fieldName=>$val);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);
		if($val==1)
		{
			echo "<a class='fa fa-fw fa-check' onclick=\"return update_is_active(0,".$id.");\"></a>";
		}
		if($val==0)
		{
			echo "<a class='fa fa-fw fa-close' onclick=\"return update_is_active(1,".$id.");\"></a>";
		}
	}
	function update_is_default_notes($val,$id,$fieldName,$fieldId,$tableName)
	{
		$data=array($fieldName=>$val);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);

		$data=array($fieldName=>'0');
		$this->db->where_not_in($fieldId,$id);
		$this->db->update($tableName,$data);

		if($val==1)
		{
			echo "<a class='fa fa-fw fa-check' onclick=\"return update_is_default_notes(0,".$id.");\"></a>";
		}
		if($val==0)
		{
			echo "<a class='fa fa-fw fa-close' onclick=\"return update_is_default_notes(1,".$id.");\"></a>";
		}
	}
	function update_is_publish($val,$id,$fieldName,$fieldId,$tableName)
	{
		$data=array($fieldName=>$val);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);
		if($val==1)
		{
			echo "<a class='fa fa-fw fa-check' onclick=\"return update_is_publish(0,".$id.");\"></a>";
		}
		if($val==0)
		{
			echo "<a class='fa fa-fw fa-close' onclick=\"return update_is_publish(1,".$id.");\"></a>";
		}
	}
	function insert_record ($tblName,$data){  // this is to insert record in database

		$query = $this->db->insert($tblName, $data);
		$insert_id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
            return $insert_id;
        } else {
            return false;
        }
    }
	function update_record ($fieldName,$id,$tblName,$data){  // this is to Update record in database

		$this->db->where($fieldName, $id);
		$this->db->update($tblName, $data);

		if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    } // this is to insert Update in database created end
	function update_record_with_where_and($fieldName1,$fieldName2,$id1,$id2,$tblName,$data){  // this is to Update record with were and condition in database
	$WhereArray = array($fieldName1 => $id1, $fieldName2 => $id2);
		$this->db->where($WhereArray);
		$this->db->update($tblName, $data);

		if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
	function GetSiteValues($key)
	{
		return  $this->common->GetValue("site_setting","value","site_key",$key);
	}


	function GetshortString($str,$len)
	{
		if(strlen($str) > $len)
		{
			$stringval = substr($str, 0, $len)."...";
		}
		else
		{
			$stringval=$str;
		}
		return $stringval;
	}
	function array_column($array,$column_name)
    {

        return array_map(function($element) use($column_name){return $element[$column_name];}, $array);

    }

	function get_site_setting_value()
	{
		$result = $this->db->get('site_settings');
		return $result->row();
	}

	function get_search_array($search="")
	{
    $search_array = array();
		$search_array[]=$search;
		if(strpos(strtoupper($search),'I')!== FALSE || strpos(strtoupper($search),'L')!== FALSE){
			$search_array[]= str_replace('I', '1', $search);
      $search_array[]= str_replace('L', '1', $search);
		}
		if(strpos(strtoupper($search),'Z')!== FALSE || strpos(strtoupper($search),'R')!== FALSE){

			$search_array[]= str_replace('R', '2', $search);
      $search_array[]= str_replace('Z', '2', $search);
		}
		if(strpos(strtoupper($search),'E')!== FALSE || strpos(strtoupper($search),'B')!== FALSE){
			$search_array[]= str_replace('B', '3', $search);
      $search_array[]= str_replace('E', '3', $search);
		}
		if(strpos(strtoupper($search),'A')!== FALSE || strpos(strtoupper($search),'H')!== FALSE || strpos(strtoupper($search),'P')!== FALSE){
      $search_array[]= str_replace('A', '4', $search);
      $search_array[]= str_replace('H', '4', $search);
      $search_array[]= str_replace('P', '4', $search);
		}
		if(strpos(strtoupper($search),'S')!== FALSE){
			$search_array[]= str_replace('S', '5', $search);
		}
		if(strpos(strtoupper($search),'G')!== FALSE || strpos(strtoupper($search),'B')!== FALSE || strpos(strtoupper($search),'C')!== FALSE){
			$search_array[]= str_replace('G', '6', $search);
      $search_array[]= str_replace('B', '6', $search);
      $search_array[]= str_replace('C', '6', $search);
		}
		if(strpos(strtoupper($search),'Y')!== FALSE){
			$search_array[]= str_replace('Y', '7', $search);
		}
		if(strpos(strtoupper($search),'B')!== FALSE || strpos(strtoupper($search),'O')!== FALSE){
			$search_array[]= str_replace('O', '8', $search);
      $search_array[]= str_replace('B', '8', $search);
		}
		if(strpos(strtoupper($search),'G')!== FALSE || strpos(strtoupper($search),'P')!== FALSE){
      $search_array[]= str_replace('G', '9', $search);
      $search_array[]= str_replace('P', '9', $search);
		}
		if(strpos(strtoupper($search),'IO')!== FALSE || strpos(strtoupper($search),'LO')!== FALSE){
      $search_array[]= str_replace('IO', '10', $search);
      $search_array[]= str_replace('LO', '10', $search);
		}
		if(strpos(strtoupper($search),'LL')!== FALSE || strpos(strtoupper($search),'U')!== FALSE || strpos(strtoupper($search),'H')!== FALSE){
      $search_array[]= str_replace('LL', '11', $search);
      $search_array[]= str_replace('U', '11', $search);
      $search_array[]= str_replace('H', '11', $search);
		}
		if(strpos(strtoupper($search),'R')!== FALSE){
			$search_array[]= str_replace('R', '12', $search);
		}
		if(strpos(strtoupper($search),'B')!== FALSE){
			$search_array[]= str_replace('B', '13', $search);
		}
		if(strpos(strtoupper($search),'IA')!== FALSE){
			$search_array[]= str_replace('IA', '14', $search);
		}
    if(strpos(strtoupper($search),'TO')!== FALSE || strpos(strtoupper($search),'TOO')!== FALSE){
			$search_array[]= str_replace('TO', '2', $search);
      $search_array[]= str_replace('TOO', '2', $search);
		}
    $search_array = array_unique($search_array);
		return $search_array;
	}
	function add_notification_record($data){  // this is to insert record in database

		$query = $this->db->insert('notification', $data);
		$insert_id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
            return $insert_id;
        } else {
            return false;
        }
    }

    function get_company_list(){  
    
        $this->db->select('id,name');
        $this->db->from('company');
        $this->db->where('status',1);
        $this->db->order_by("name");
        $query=$this->db->get();
        
        $company_list=array();
        foreach ($query->result() as $company) 
        {
            $company_list[$company->id] = $company->name;
        }
        return $company_list;
    }
}
?>