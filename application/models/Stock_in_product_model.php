<?php

class stock_in_product_model extends CI_Model
{   

    function stock_in_product($data)
    {
        $this->db->insert('stock_in_products', $data);

        return TRUE;
    }

	function get_stock_in_product_code()
	{
		$year = date('Y');
		$month = date('m');

		$q  = $this->db->query("SELECT MAX(RIGHT(no_transaction,4))  AS kd_max FROM stock_in_products WHERE MONTH(created_at) = '$month' AND YEAR(created_at) = '$year'");
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