<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My_model extends CI_Model {
	function create_table($tname,$data)
	{
	    $data['status']='active';
	    $data['entry_time']=time();
		$sql="CREATE TABLE ".$tname."(".$tname."_id int auto_increment primary key";
		foreach ($data as $key => $value) {
			$sql.=", ".$key." text";
		}
		$sql.=");";
		return($this->db->query($sql));
	}
    public function insert($tbl_name,$data)
	{
	    $data['status']='active';
	    $data['entry_time']=time();
		$this->db->insert($tbl_name,$data);
		return $this->db->insert_id();
	}
    public function select_where($tbl_name,$cond)
	{
		$this->db->where($cond);
		return $this->db->get($tbl_name)->result_array();
	}
	public function update($tname,$cond,$data)
	{
		$this->db->where($cond);
		return $this->db->update($tname, $data);
	}
}
