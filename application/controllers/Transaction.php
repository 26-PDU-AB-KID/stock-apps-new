<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Supplier_model', 'supplier');
        $this->load->model('Raw_material_model', 'raw_material');
        $this->load->model('stock_raw_material_model', 'stock_raw_material');
        $this->load->model('stock_in_raw_material_model', 'stock_in_raw_material');
        $this->load->model('View_stock_raw_material_by_supplier_model', 'view_stock_raw_material_by_supplier');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
        redirect('transaction/stockIn');
    }

    public function stockIn()
    {
        $data = [
            'title'         => 'Stock In',
            'suppliers'     => $this->supplier->get_suppliers(),
            'raw_materials' => $this->raw_material->get_raw_materials(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('transactions/index');
        $this->load->view('templates/footer');
    }

    public function stockInProcess()
    {
        $amount = $this->input->post('amount', TRUE);

        $amountFilter = $this->security->xss_clean($amount);

        $this->stock_raw_material->insert_stock_raw_material($amountFilter, $this->input->post('raw_material', TRUE));

        $data = [
            'no_transaction'    => $this->stock_in_raw_material->get_stock_in_raw_material_code(),
            'date'              => date('Y-m-d', strtotime($this->input->post('date', TRUE))),
            'supplier_id'       => $this->input->post('supplier', TRUE),
            'raw_material_id'   => $this->input->post('raw_material', TRUE),
            'unit_id'           => $this->input->post('unit', TRUE),
            'amount'            => $this->input->post('amount', TRUE),
            'price'             => $this->input->post('price', TRUE),
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->stock_in_raw_material->stock_in_raw_material($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Stock In Raw Material has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('transaction/stockIn');

    }

    public function getRawMaterial($supplier_id)
    {
        $raw_materials = $this->view_stock_raw_material_by_supplier->get_raw_material_by_supplier_id($supplier_id);

        echo "<option value='0' disabled selected>Select Raw Material</option>";
		foreach ($raw_materials as $key => $raw_material) {
			echo "<option value='". $raw_material['raw_material_id'] ."'>". ucwords($raw_material['raw_material_name']) ."</option>";
        }
    }

    public function getUnit($raw_material_id)
    {
        $unit = $this->raw_material->get_raw_material_by_unit_id($raw_material_id);

        echo "<option value='". $unit['unit_id'] ."' readonly selected>". ucwords($unit['unit_name']) . "</option>";

    }

}