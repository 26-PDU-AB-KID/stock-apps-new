<?php

class stock_in_raw_material_model extends CI_Model
{   

    function stock_in_raw_material($data)
    {
        $this->db->insert('stock_in_raw_materials', $data);

        return TRUE;
    }

	function get_stock_in_raw_material_code()
	{
		$q  = $this->db->query("SELECT MAX(RIGHT(no_transaction,4)) AS kd_max FROM stock_in_raw_materials");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd  = sprintf("%04s", $tmp);
			}
		} else {
			$kd = "0001";
		}

		return 'INV-IN-'. date('m-y') . '02' . $kd;
	}

}