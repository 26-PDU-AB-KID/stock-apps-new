<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Convert extends CI_Controller
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
        $this->load->model('Convert_data_model', 'convert_data');
        $this->load->model('Stock_product_model', 'stock_product');
        $this->load->model('stock_raw_material_model', 'stock_raw_material');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
            'title'     => 'Convert',
            'suppliers' => $this->supplier->get_suppliers(),
        ];

		$this->load->view('templates/header', $data);
		$this->load->view('converts/index');
		$this->load->view('templates/footer');
    }

    public function convertDetail()
    {
        $product = $this->input->post('product');
        $supplier = $this->input->post('supplier');
        $amount = $this->input->post('amount');

        $products = $this->product->get_product_by_product_id($product);
        
        $raw_material_id = $products['raw_material_id'];

        $stock_raw_materials = $this->stock_raw_material->get_stock_raw_material_by_supplier_raw_material_id($supplier, $raw_material_id);

        $amount_raw_material = $stock_raw_materials['amount'];

        $amount_raw_material_reduced = $amount_raw_material - ($amount * $products['per_pcs']);

        if ( $amount_raw_material_reduced < 0 ) {
            $this->session->set_flashdata('flash', "<script>Swal.fire({icon: 'error', title: 'Failed...', text: 'Out of Stocks!'})</script>");
	        redirect('convert');
        } else {
            $data = [
                'title'                 => 'Detail Convert',
                'stock_raw_materials'   => $stock_raw_materials,
                'products'              => $products,
                'amount'                => $amount
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('converts/detail_convert');
            $this->load->view('templates/footer');
        }

    }

    public function convertProcess()
    {
        $raw_material_id = $this->input->post('raw_material');
        $amount_raw_material = $this->input->post('amount_raw_material');
        $amount_product = $this->input->post('amount_product');
        $product_id = $this->input->post('product');
        $supplier_id = $this->input->post('supplier');

        $dataConvert = [
            'date'                  => date('Y-m-d H:i:s'),
            'raw_material_id'       => $raw_material_id,
            'product_id'            => $product_id,
            'supplier_id'           => $supplier_id,
            'amount_raw_material'   => $amount_raw_material,
            'amount_product'        => $amount_product,
        ];

        $this->convert_data->insert_convert_data($dataConvert);

        if ($this->stock_product->check_stock_products($raw_material_id, $product_id) > 0) {
            $this->stock_product->input_stock_products($amount_product, $raw_material_id, $product_id);
        } else {
            $data = [
                'raw_material_id'   => $raw_material_id,
                'product_id'        => $product_id,
                'supplier_id'       => $supplier_id,
                'amount'            => $amount_product,
                'created_at'        => date('Y-m-d H:i:s')
            ];
            $this->stock_product->insert_stock_products($data);
        }

        $this->stock_raw_material->min_stock_raw_material($amount_raw_material, $supplier_id, $raw_material_id);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Product has been added!',showConfirmButton: false,timer: 1500})</script>");

        redirect('convert');

    }

    public function getProducts($supplier_id)
    {
        $raw_materials = $this->stock_raw_material->get_raw_material_id_by_supplier_id($supplier_id);

        $raw_materials_id = [];

        foreach($raw_materials as $raw_material) {
            $raw_materials_id[] = $raw_material['raw_material_id'];
        }

        $products = $this->product->get_product_by_raw_materials_id($raw_materials_id);

        echo "<option value='0' disabled selected>Select Product</option>";
		foreach ($products as $key => $product) {
            if($product['amount'] == NULL)
            $product['amount'] = 0;
			echo "<option value='". $product['id'] ."'>". $product['barcode'] . ' | ' . ucwords($product['name']) . ' ' . $product['weight'] . ' ' . ucwords($product['product_unit']) . ' | Stock :  ' . $product['amount'] . "</option>";
        }

    }
    
}