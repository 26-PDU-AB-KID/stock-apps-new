<?php

class stock_raw_material_model extends CI_Model
{   
    
    function delete_stock_raw_material_by_raw_material_id($data, $id)
	{
		$this->db->where('raw_material_id', $id);
		$this->db->update('stock_raw_materials', $data);
	}

	function insert_stock_raw_material($data, $supplier_id, $raw_material_id)
	{
		$now = date('Y-m-d H:i:s');

		$this->db->query("UPDATE stock_raw_materials SET amount=amount+'$data', updated_at='$now' WHERE supplier_id='$supplier_id' AND raw_material_id='$raw_material_id'");

		return true;
	}

	function input_stock_raw_material($data)
	{
		$this->db->insert('stock_raw_materials', $data);

		return TRUE;
	}

	function get_raw_material_id_by_supplier_id($supplier_id)
	{
		$result = $this->db->get_where('stock_raw_materials', ['supplier_id' => $supplier_id])->result_array();

		return $result;
	}

	function get_stock_raw_material_by_supplier_raw_material_id($supplier_id, $raw_material_id)
	{
		$result = $this->db->get_where('stock_raw_materials', ['supplier_id' => $supplier_id, 'raw_material_id' => $raw_material_id])->row_array();

		return $result;
	}

	function min_stock_raw_material($amount, $supplier_id, $raw_material_id)
	{
		$now = date('Y-m-d H:i:s');

		$this->db->query("UPDATE stock_raw_materials SET amount=amount-'$amount', updated_at='$now' WHERE supplier_id='$supplier_id' AND raw_material_id ='$raw_material_id'");

        return true;
	}

}