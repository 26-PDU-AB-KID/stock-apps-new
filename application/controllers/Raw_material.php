<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Raw_material extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Raw_material_model', 'raw_material');
        $this->load->model('Stock_raw_material_model', 'stock_raw_material');
        $this->load->model('View_stock_raw_material_by_supplier_model', 'view_stock_raw_material_by_supplier');
        $this->load->model('View_stock_raw_material_by_raw_material_model', 'view_stock_raw_material_by_raw_material');
        $this->load->model('Unit_model', 'unit');
        $this->load->model('Supplier_model', 'supplier');
        $this->load->model('Stock_in_raw_material_model', 'stock_in_raw_material');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
            'title'         => 'Raw Material',
            'raw_materials' => $this->raw_material->get_raw_materials(),
            'units'         => $this->unit->get_units()
        ];

		$this->load->view('templates/header', $data);
		$this->load->view('raw_materials/index');
		$this->load->view('templates/footer');
    }
    
    public function addRawMaterial()
    {
        $data = [
            'code'          => $this->raw_material->get_raw_material_code(),
            'name'          => strtolower($this->input->post('name', TRUE)),
            'unit_id'       => $this->input->post('unit', TRUE),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->raw_material->add_raw_material($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New Raw Material has been added!',showConfirmButton: false,timer: 1500})</script>");

        redirect('raw_material');
    }

    public function editRawMaterial()
    {
        $data = [
            'name'          => strtolower($this->input->post('name', TRUE)),
            'unit_id'       => $this->input->post('unit', TRUE),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->raw_material->edit_raw_material($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Raw Material has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('raw_material');

    }

    public function deleteRawMaterial()
    {
        $data = [
            'is_deleted'        => '1',
            'remark_deleted'	=> strtolower($this->input->post('remark', TRUE)),
			'deleted_at'		=> date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->raw_material->delete_raw_material($dataFilter, $this->input->post('id', TRUE));
        $this->stock_raw_material->delete_stock_raw_material_by_raw_material_id($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Raw Material has been deleted!',showConfirmButton: false,timer: 1500})</script>");

        redirect('raw_material');

    }

    public function detailRawMaterial($code, $id)
	{
        $check = $this->view_stock_raw_material_by_raw_material->check_view_stock_raw_material_by_raw_materials_by_code($code);
        
        if ($check == 0) {
            $data = [
                'title'                 => 'Raw Material',
                'stock_raw_materials'   => $this->view_stock_raw_material_by_supplier->get_view_stock_raw_material_by_suppliers($code),
                'raw_material'          => $this->raw_material->get_raw_material_by_code($code),
                'detail_raw_material'   => null
            ];
        } else {
            $data = [
                'title'                 => 'Raw Material',
                'stock_raw_materials'   => $this->view_stock_raw_material_by_supplier->get_view_stock_raw_material_by_suppliers($code),
                'raw_material'          => $this->raw_material->get_raw_material_by_code($code),
                'detail_raw_material'   => $this->view_stock_raw_material_by_raw_material->get_view_stock_raw_material_by_raw_materials_by_code($code)
            ];
        }

		$this->load->view('templates/header', $data);
		$this->load->view('raw_materials/detail_raw_material');
		$this->load->view('templates/footer');
    }

    public function stockIn($stock_raw_material_id, $supplier_id, $raw_material_id, $supplier_name)
    {
        $data = [
            'title'                 => 'Stock In Raw Material',
            'stock_raw_materials'   => $this->view_stock_raw_material_by_supplier->get_view_stock_raw_material_by_suppliers_by_stock_raw_material_id($stock_raw_material_id),
        ];

        $this->load->view('templates/header',  $data);
        $this->load->view('raw_materials/stock_in_raw_material');
        $this->load->view('templates/footer');
    }

    public function stockInProcess()
    {
        $amount = $this->input->post('amount', TRUE);

        $amountFilter = $this->security->xss_clean($amount);

        $this->stock_raw_material->insert_stock_raw_material($amountFilter, $this->input->post('stock_raw_material_id', TRUE));

        $data = [
            'no_transaction'    => $this->stock_in_raw_material->get_stock_in_raw_material_code(),
            'date'              => $this->input->post('date', TRUE),
            'supplier_id'       => $this->input->post('supplier_id', TRUE),
            'raw_material_id'   => $this->input->post('raw_material_id', TRUE),
            'unit_id'           => $this->input->post('unit_id', TRUE),
            'amount'            => $this->input->post('amount', TRUE),
            'price'             => $this->input->post('price', TRUE),
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->stock_in_raw_material->stock_in_raw_material($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Stock In Raw Material has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('raw_material/detailRawMaterial/'. $this->input->post('code') . '/' . md5($this->input->post('raw_material_id')));

    }

}