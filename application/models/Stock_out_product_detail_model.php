<?php 

class stock_out_product_detail_model extends CI_Model
{

    function insert_stock_out_product_detail($data)
    {
        $this->db->insert('stock_out_product_details', $data);

        return true;
    }

}