<?php

class Convert_data_model extends CI_Model
{

	function insert_convert_data($data)
	{
		$this->db->insert('convert_data', $data);

		return true;
    }

}