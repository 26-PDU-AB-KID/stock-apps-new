<?php

class Supplier_model extends CI_Model
{

	function get_suppliers()
	{
		$result = $this->db->get_where('suppliers', ['is_deleted' => '0'])->result_array();

		return $result;
    }

	function get_supplier_by_id($id)
	{
		$result = $this->db->get_where('suppliers', ['id' => $id])->row_array();

		return $result;
    }

    function add_supplier($data)
    {
        $this->db->insert('suppliers', $data);
        
        return TRUE;
    }

    function edit_supplier($data, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('suppliers', $data);
    }

    function delete_supplier($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('suppliers', $data);
	}

}