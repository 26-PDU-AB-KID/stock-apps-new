<?php

class Product_model extends CI_Model
{

	function get_products()
	{
        $this->db->select('products.id as id, barcode, products.name as product_name, product_unit, weight, cost_of_goods, selling_price_of_goods, raw_material_id, raw_materials.name as raw_material_name, per_pcs, units.name as unit_name, stock');
        $this->db->from('products');
        $this->db->join('units', 'units.id = products.unit_id', 'left');
        $this->db->join('raw_materials', 'raw_materials.id = products.raw_material_id', 'left');
        $this->db->where('products.is_deleted', '0');
        $result = $this->db->get()->result_array();

		return $result;
    }

    function add_product($data)
    {
        $this->db->insert('products', $data);
        
        return TRUE;
    }

    function edit_product($data, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('products', $data);
    }

    function delete_product($data, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('products', $data);
    }

}