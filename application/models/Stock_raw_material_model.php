<?php

class stock_raw_material_model extends CI_Model
{   
    
    function delete_stock_raw_material_by_raw_material_id($data, $id)
	{
		$this->db->where('raw_material_id', $id);
		$this->db->update('stock_raw_materials', $data);
	}

	function insert_stock_raw_material($data, $id)
	{
		$now = date('Y-m-d H:i:s');

		$this->db->query("UPDATE stock_raw_materials SET amount=amount+'$data', updated_at='$now' WHERE id='$id'");
	}

	function input_stock_raw_material($data)
	{
		$this->db->insert('stock_raw_materials', $data);

		return TRUE;
	}

}