<?php

class raw_material_model extends CI_Model
{

	function get_raw_materials()
	{
        $this->db->select('raw_materials.id as id, code, raw_materials.name as name, unit_id, units.name as unit_name');
        $this->db->from('raw_materials');
        $this->db->join('units', 'units.id=raw_materials.unit_id', 'left');
        $this->db->where('is_deleted', '0');
        $result = $this->db->get()->result_array();

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