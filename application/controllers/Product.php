<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Product_model', 'product');
        $this->load->model('Raw_material_model', 'raw_material');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
            'title'         => 'Product',
            'products'      => $this->product->get_products(),
            'raw_materials' => $this->raw_material->get_raw_materials()
        ];

		$this->load->view('templates/header', $data);
		$this->load->view('products/index');
		$this->load->view('templates/footer');
    }

    public function addProduct()
    {
        $raw_material_id = $this->input->post('raw_material');
        $unit = $this->raw_material->get_unit_id_by_raw_material_id($raw_material_id);
        $unit_id = $unit['unit_id'];

        $data = [
            'barcode'                   => $this->input->post('barcode', TRUE),
            'name'                      => strtolower($this->input->post('name', TRUE)),
            'product_unit'              => strtolower($this->input->post('product_unit', TRUE)),
            'weight'                    => $this->input->post('weight', TRUE),
            'cost_of_goods'             => $this->input->post('cost_of_goods', TRUE),
            'selling_price_of_goods'    => $this->input->post('selling_price_of_goods', TRUE),
            'raw_material_id'           => $this->input->post('raw_material', TRUE),
            'per_pcs'                   => $this->input->post('weight', TRUE) / 1000,
            'unit_id'                   => $unit_id,
            'created_at'                => date('Y-m-d H:i:s')
        ];
        
        $dataFilter = $this->security->xss_clean($data);

        $this->product->add_product($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New Product has been added!',showConfirmButton: false,timer: 1500})</script>");

        redirect('product');

    }

    public function editProduct()
    {
        $raw_material_id = $this->input->post('raw_material');
        $unit = $this->raw_material->get_unit_id_by_raw_material_id($raw_material_id);
        $unit_id = $unit['unit_id'];

        $data = [
            'barcode'                   => $this->input->post('barcode', TRUE),
            'name'                      => strtolower($this->input->post('name', TRUE)),
            'product_unit'              => strtolower($this->input->post('product_unit', TRUE)),
            'weight'                    => $this->input->post('weight', TRUE),
            'cost_of_goods'             => $this->input->post('cost_of_goods', TRUE),
            'selling_price_of_goods'    => $this->input->post('selling_price_of_goods', TRUE),
            'raw_material_id'           => $this->input->post('raw_material', TRUE),
            'per_pcs'                   => $this->input->post('weight', TRUE) / 1000,
            'unit_id'                   => $unit_id,
            'updated_at'                => date('Y-m-d H:i:s')
        ];
        
        $dataFilter = $this->security->xss_clean($data);

        $this->product->edit_product($dataFilter, $this->input->post('id'));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Product has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('product');

    }

    public function deleteProduct()
    {
        $data = [
            'is_deleted'        => '1',
            'remark_deleted'	=> strtolower($this->input->post('remark', TRUE)),
			'deleted_at'		=> date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->product->delete_product($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Product has been deleted!',showConfirmButton: false,timer: 1500})</script>");

        redirect('product');

    }
    
}
