<?php

class raw_material_model extends CI_Model
{

	function get_raw_materials()
	{
        $result = $this->db->query("SELECT raw_materials.id AS id, code, raw_materials.name AS raw_material_name, unit_id, units.name AS unit_name, SUM(amount) AS stock FROM raw_materials LEFT JOIN units ON raw_materials.unit_id=units.id LEFT JOIN stock_raw_materials ON stock_raw_materials.raw_material_id=raw_materials.id WHERE raw_materials.is_deleted='0' GROUP BY raw_materials.id")->result_array();

        return $result;
    }

    function get_raw_material_by_code($code)
    {
        $result = $this->db->get_where('raw_materials', ['code' => $code])->row_array();

        return $result;
    }
    
    function add_raw_material($data)
    {
        $this->db->insert('raw_materials', $data);
        
        return TRUE;
    }

    function edit_raw_material($data, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('raw_materials', $data);
    }

    function delete_raw_material($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('raw_materials', $data);
    }
    
    function get_raw_material_code()
	{
		$q  = $this->db->query("SELECT MAX(RIGHT(code,5)) AS kd_max FROM raw_materials");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd  = sprintf("%05s", $tmp);
			}
		} else {
			$kd = "00001";
		}

		return 'RAW' . $kd;
	}

}