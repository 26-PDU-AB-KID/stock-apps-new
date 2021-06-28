<?php

class Product_model extends CI_Model
{

	function get_products()
	{
        $this->db->select('products.id as id, barcode, products.name as product_name, product_unit, weight, cost_of_goods, selling_price_of_goods, products.raw_material_id as raw_material_id, raw_materials.name as raw_material_name, per_pcs, units.name as unit_name, SUM(amount) as amount');
        $this->db->from('products');
        $this->db->join('units', 'units.id = products.unit_id', 'left');
        $this->db->join('raw_materials', 'raw_materials.id = products.raw_material_id', 'left');
        $this->db->join('stock_products', 'stock_products.product_id = products.id', 'left');
        $this->db->where('products.is_deleted', '0');
        $this->db->group_by('products.id');
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

    function get_product_by_raw_materials_id($raw_material_id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('is_deleted', '0');
        $this->db->where_in('raw_material_id', $raw_material_id);
        $result = $this->db->get()->result_array();

        return $result;
    }

    function get_product_by_product_id($product_id)
    {
        $this->db->select('products.id as product_id, barcode, products.name as product_name, product_unit, weight, cost_of_goods, selling_price_of_goods, products.raw_material_id as raw_material_id, per_pcs, units.name as unit_name, SUM(amount) as amount');
        $this->db->from('products');
        $this->db->join('units', 'units.id = products.unit_id', 'left');
        $this->db->join('stock_products', 'stock_products.product_id = products.id', 'left');
        $this->db->where(['products.id' => $product_id, 'products.is_deleted' => '0']);
        $this->db->group_by('products.id');
        $result = $this->db->get()->row_array();

        return $result;

        $result = $this->db->get_where('products', ['id' => $product_id, 'is_deleted' => '0'])->row_array();

        return $result;
    }

    function insert_product($amount, $id)
	{
		$now = date('Y-m-d H:i:s');

		$this->db->query("UPDATE products SET stock=stock+'$amount', updated_at='$now' WHERE id='$id'");

        return true;
	}

}