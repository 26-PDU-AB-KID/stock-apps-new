<?php 

class stock_out_product_model extends CI_Model
{
    
    function get_no_transaction()
	{
		$year = date('Y');
		$month = date('m');

		$q  = $this->db->query("SELECT MAX(RIGHT(no_transaction,4)) AS kd_max FROM stock_out_products WHERE MONTH(created_at)='$month' AND YEAR(created_at)='$year'");
		$kd = "";
        if( $q->num_rows() > 0 ){
            foreach( $q->result() as $k ){
				$tmp = ((int)$k->kd_max)+1;
				$kd  = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return date('my'). '02' .$kd;
	}

    function insert_stock_out_product($data)
    {
        $this->db->insert('stock_out_products', $data);

        return true;
    }

}