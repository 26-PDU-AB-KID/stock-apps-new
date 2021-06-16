<?php

class view_stock_raw_material_by_raw_material_model extends CI_Model
{

    function check_view_stock_raw_material_by_raw_materials_by_code($code)
    {
        $result = $this->db->get_where('view_stock_raw_material_by_raw_materials', ['code' => $code])->num_rows();

        return $result;
    }

    function get_view_stock_raw_material_by_raw_materials_by_code($code)
    {
        $result = $this->db->get_where('view_stock_raw_material_by_raw_materials', ['code' => $code])->row_array();

        return $result;
    }

}