<?php

class Unit_model extends CI_Model
{

	function get_units()
	{
		$result = $this->db->get('units')->result_array();

		return $result;
    }

}