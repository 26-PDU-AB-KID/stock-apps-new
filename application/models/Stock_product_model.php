<?php 

class stock_product_model extends CI_Model
{

    function get_stock_products_by_supplier_id($supplier_id)
    {
        $this->db->select('stock_products.product_id as product_id, stock_products.supplier_id as supplier_id, products.name as product_name, weight, product_unit');
        $this->db->from('stock_products');
        $this->db->join('products', 'products.id = stock_products.product_id', 'left');
        $this->db->where('supplier_id', $supplier_id);
        $result = $this->db->get()->result_array();

        return $result;
    }
    
    function get_stock_products_by_product_id($product_id)
    {
        $this->db->select('stock_products.product_id as product_id, stock_products.supplier_id as supplier_id, products.name as product_name, weight, product_unit');
        $this->db->from('stock_products');
        $this->db->join('products', 'products.id = stock_products.product_id', 'left');
        $this->db->where('products.id', $product_id);
        $result = $this->db->get()->row_array();

        return $result;
    }
    
    function check_stock_products($raw_material_id, $product_id, $supplier_id)
    {
        $result = $this->db->get_where('stock_products', ['raw_material_id' => $raw_material_id, 'product_id' => $product_id, 'supplier_id' => $supplier_id])->num_rows();

        return $result;
    }

    function insert_stock_products($data)
    {
        $this->db->insert('stock_products', $data);

        return true;
    }

    function input_stock_products($data, $raw_material_id, $product_id, $supplier_id)
    {
        $now = date('Y-m-d H:i:s');

        $this->db->query("UPDATE stock_products SET amount=amount+'$data', updated_at='$now' WHERE raw_material_id='$raw_material_id' AND product_id='$product_id' AND supplier_id='$supplier_id'");

        return true;
    }

}