<?php

class stock_raw_material_model extends CI_Model
{

	function get_stock_raw_materials()
	{
        $result = $this->db->get_where('stock_raw_materials', ['is_deleted' => '0'])->result_array();
        return $result;
    }
    
    function add_stock_raw_material($data)
    {
        $this->db->insert('stock_raw_materials', $data);
        
        return TRUE;
    }

    function edit_stock_raw_material($data, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('stock_raw_materials', $data);
    }

    function delete_stock_raw_material_by_raw_material_id($data, $id)
	{
		$this->db->where('raw_material_id', $id);
		$this->db->update('stock_raw_materials', $data);
    }

}