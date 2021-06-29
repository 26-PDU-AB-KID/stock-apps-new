<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Product_model', 'product');
        $this->load->model('Supplier_model', 'supplier');
        $this->load->model('Raw_material_model', 'raw_material');
        $this->load->model('Stock_product_model', 'stock_product');
        $this->load->model('Stock_raw_material_model', 'stock_raw_material');
        $this->load->model('View_stock_raw_material_by_supplier_model', 'view_stock_raw_material_by_supplier');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
            'title'     => 'Supplier',
            'suppliers' => $this->supplier->get_suppliers()
        ];

		$this->load->view('templates/header', $data);
		$this->load->view('suppliers/index');
		$this->load->view('templates/footer');
    }
    
    public function addSupplier()
    {
        $data = [
            'name'          => strtolower($this->input->post('name', TRUE)),
            'address'       => $this->input->post('address', TRUE),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->supplier->add_supplier($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New Supplier has been added!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier');
    }

    public function editSupplier()
    {
        $data = [
            'name'          => strtolower($this->input->post('name', TRUE)),
            'address'       => $this->input->post('address', TRUE),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->supplier->edit_supplier($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Supplier has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier');

    }

    public function deleteSupplier()
    {
        $data = [
            'is_deleted'        => '1',
            'remark_deleted'	=> strtolower($this->input->post('remark', TRUE)),
			'deleted_at'		=> date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->supplier->delete_supplier($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Supplier has been deleted!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier');

    }

    public function detailSupplier($id, $address)
    {
        $data = [
            'title'                 => 'Detail Supplier',
            'supplier'              => $this->supplier->get_supplier_by_id($id),
            'raw_materials'         => $this->raw_material->get_raw_materials(),
            'detail_raw_materials'  => $this->view_stock_raw_material_by_supplier->get_view_stock_raw_material_by_suppliers_by_supplier_id($id),
            'products'              => $this->product->get_products(),
            'detail_products'       => $this->stock_product->get_stock_products_by_supplier_id($id),
            'address'               => $address
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/detail_supplier');
        $this->load->view('templates/footer');

    }

    public function addDetailRawMaterial()
    {
        $data = [
            'supplier_id'       => $this->input->post('supplier_id'),
            'raw_material_id'   => $this->input->post('raw_material_id'),
            'amount'            => 0,
            'created_at'        => date('Y-m-d H:i:s'),
        ];

        $this->stock_raw_material->input_stock_raw_material($data);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New raw material has been added to the supplier!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier/detailSupplier/' . $this->input->post('supplier_id') . '/' . $this->input->post('address'));
    }
    
    public function addDetailProduct()
    {
        $data = [
            'raw_material_id'   => $this->input->post('raw_material_id'),
            'product_id'        => $this->input->post('product_id'),
            'supplier_id'       => $this->input->post('supplier_id'),
            'amount'            => 0,
            'created_at'        => date('Y-m-d H:i:s'),
        ];

        $this->stock_product->insert_stock_products($data);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New product has been added to the supplier!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier/detailSupplier/' . $this->input->post('supplier_id') . '/' . $this->input->post('address'));
    }

}