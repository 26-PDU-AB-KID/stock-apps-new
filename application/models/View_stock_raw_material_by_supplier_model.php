<?php

class view_stock_raw_material_by_supplier_model extends CI_Model
{

    function get_view_stock_raw_material_by_suppliers($code)
    {
        $result = $this->db->get_where('view_stock_raw_material_by_suppliers', ['code' => $code])->result_array();

        return $result;
    }

    function get_view_stock_raw_material_by_suppliers_by_stock_raw_material_id($id)
    {
        $result = $this->db->get_where('view_stock_raw_material_by_suppliers', ['stock_raw_material_id' => $id])->row_array();

        return $result;
    }
    
    function get_view_stock_raw_material_by_suppliers_by_supplier_id($id)
    {
        $result = $this->db->get_where('view_stock_raw_material_by_suppliers', ['supplier_id' => $id])->result_array();

        return $result;
    }

    function get_raw_material_by_supplier_id($id)
	{
		$result = $this->db->get_where('view_stock_raw_material_by_suppliers', ['supplier_id' => $id])->result_array();

		return $result;
	}
    
}