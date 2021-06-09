<?php

class Customer_model extends CI_Model
{

	function get_customers()
	{
		$result = $this->db->get_where('customers', ['is_deleted' => '0'])->result_array();

		return $result;
    }
    
    function add_customer($data)
    {
        $this->db->insert('customers', $data);
        
        return TRUE;
    }

    function edit_customer($data, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('customers', $data);
    }

    function delete_customer($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('customers', $data);
    }
    
    function get_customer_code()
	{
		$q  = $this->db->query("SELECT MAX(RIGHT(code,5)) AS kd_max FROM customers");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd  = sprintf("%05s", $tmp);
			}
		} else {
			$kd = "00001";
		}

		return 'CUST' . $kd;
	}

}